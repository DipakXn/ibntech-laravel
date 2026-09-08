<?php

namespace App\Filament\Clusters\SmtpSettings\Pages;

use App\Filament\Clusters\SmtpSettings\Concerns\HasSmtpSettingsPageHeading;
use App\Filament\Clusters\SmtpSettings\SmtpSettingsCluster;
use App\Mail\SmtpTestMail;
use App\Models\EmailLog;
use App\Services\SmtpSettingService;
use App\Support\Mail\SmtpExceptionSanitizer;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\Width;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use RuntimeException;
use Throwable;

/**
 * @property-read Schema $form
 */
class TestSmtp extends Page
{
    use HasSmtpSettingsPageHeading;

    protected static ?string $cluster = SmtpSettingsCluster::class;

    protected static ?string $title = 'SMTP Settings';

    protected static string|\BackedEnum|null $navigationIcon = null;

    protected static ?string $navigationLabel = 'Test SMTP';

    protected static ?string $slug = 'test';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.clusters.smtp-settings.pages.test-smtp';

    protected Width|string|null $maxContentWidth = 'full';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->isAdministrator() ?? false;
    }

    public function mount(): void
    {
        $this->form->fill([
            'recipient' => auth()->user()?->email,
            'subject' => 'IBNTECH SMTP test',
            'body' => 'This is a test email from the IBNTECH Control SMTP settings.',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    Section::make('Test email')
                        ->description('Sent immediately with the active mailer. Passwords are never shown in the result.')
                        ->columns([
                            'default' => 1,
                            'md' => 2,
                        ])
                        ->schema([
                            TextInput::make('recipient')
                                ->label('Test recipient email')
                                ->email()
                                ->required()
                                ->maxLength(255),
                            TextInput::make('subject')
                                ->required()
                                ->maxLength(255),
                            Textarea::make('body')
                                ->label('Test message')
                                ->required()
                                ->rows(5)
                                ->maxLength(5000)
                                ->columnSpanFull(),
                        ]),
                ])
                    ->livewireSubmitHandler('sendTest')
                    ->footer([
                        Actions::make([
                            Action::make('sendTest')
                                ->label('Send test email')
                                ->submit('sendTest'),
                        ])->alignment(Alignment::Center),
                    ]),
            ])
            ->statePath('data');
    }

    public function sendTest(): void
    {
        $data = $this->form->getState();
        $userId = (int) auth()->id();
        $rateLimitKey = 'smtp-test:'.$userId;

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            Notification::make()
                ->danger()
                ->title('Too many test emails')
                ->body('Please wait before sending another test email.')
                ->send();

            return;
        }

        RateLimiter::hit($rateLimitKey, 60);

        $service = app(SmtpSettingService::class);
        $service->applyToRuntimeConfig();

        try {
            Mail::to($data['recipient'])->sendNow(new SmtpTestMail(
                $data['subject'],
                $data['body'],
            ));

            $log = EmailLog::query()
                ->where('subject', $data['subject'])
                ->where('recipient', $data['recipient'])
                ->latest('id')
                ->first();

            if ($log?->status === EmailLog::STATUS_FAILED) {
                throw new RuntimeException($log->error_message ?: 'The mailer rejected the test message.');
            }

            Notification::make()
                ->success()
                ->title('Test email sent')
                ->body($log?->status === EmailLog::STATUS_SENT
                    ? 'The test message was accepted by the SMTP server. Check the recipient inbox and Email Logs.'
                    : 'The test message was handed to the active mailer. Check Email Logs if it does not arrive.')
                ->send();
        } catch (Throwable $exception) {
            $message = app(SmtpExceptionSanitizer::class)
                ->sanitize($exception->getMessage(), $service->secretsToRedact());

            Notification::make()
                ->danger()
                ->title('Test email failed')
                ->body($message !== '' ? $message : 'The test email could not be sent.')
                ->send();
        }
    }
}
