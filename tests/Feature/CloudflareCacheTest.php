<?php

namespace Tests\Feature;

use App\Filament\Auth\Login;
use App\Filament\Pages\CloudflareCache;
use App\Models\CloudflareSetting;
use App\Models\User;
use App\Services\CloudflareCacheService;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Factory;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Tests\TestCase;

class CloudflareCacheTest extends TestCase
{
    use RefreshDatabase;

    private ?string $secret = null;

    /**
     * @var list<MessageLogged>
     */
    private array $logs = [];

    private string $notificationSnapshot = '';

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        Http::preventStrayRequests();

        Log::listen(function (MessageLogged $event): void {
            $this->logs[] = $event;
        });
    }

    protected function tearDown(): void
    {
        try {
            if (is_string($this->secret) && $this->secret !== '') {
                $this->assertLogsDoNotContain($this->secret);
                $this->assertNotificationsDoNotContain($this->secret);
            }
        } finally {
            parent::tearDown();
        }
    }

    public function test_guests_cannot_access_cloudflare_cache(): void
    {
        $this->storeCredentials();

        $response = $this->get('/admin/cloudflare-cache');

        $response->assertRedirect('/'.Login::ROUTE_PATH);
        $this->assertSecretAbsent($response->getContent(), 'Guest response exposed a Cloudflare credential.');
    }

    public function test_authors_cannot_access_cloudflare_cache(): void
    {
        $this->storeCredentials();

        $author = User::factory()->create([
            'role' => User::ROLE_AUTHOR,
        ]);

        $response = $this->actingAs($author)->get('/admin/cloudflare-cache');

        $this->assertSame(403, $response->getStatusCode(), 'Authors must receive HTTP 403.');
        $this->assertSecretAbsent($response->getContent(), 'Author response exposed a Cloudflare credential.');
    }

    public function test_administrator_sees_saved_credentials_in_the_admin_form(): void
    {
        $this->storeCredentials();

        $admin = $this->administrator();

        $response = $this->actingAs($admin)->get('/admin/cloudflare-cache');

        $this->assertSame(200, $response->getStatusCode(), 'Administrators should be able to open Cloudflare Cache.');

        $html = $response->getContent();

        $this->assertTrue(str_contains($html, 'Cloudflare Configuration'), 'The configuration section should be visible.');
        $this->assertTrue(str_contains($html, 'Cache Management'), 'The cache management section should be visible.');
        $this->assertTrue(str_contains($html, 'Purge Everything'), 'Purge Everything should be visible.');
        $this->assertTrue(str_contains($html, 'Custom Purge'), 'Custom Purge should be visible.');
        $this->assertTrue(str_contains($html, $this->token()), 'Administrators should see the saved API token.');
        $this->assertTrue(str_contains($html, $this->zoneId()), 'Administrators should see the saved Zone ID.');
        $this->assertFalse(str_contains($html, 'type="password"'), 'The API token field must not be masked.');
    }

    public function test_administrator_can_save_encrypted_api_token_and_zone_id(): void
    {
        $admin = $this->administrator();
        $this->token();

        $component = Livewire::actingAs($admin)
            ->test(CloudflareCache::class)
            ->fillForm([
                'api_token' => $this->token(),
                'zone_id' => strtoupper($this->zoneId()),
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertNotification('Cloudflare settings saved');

        $settings = CloudflareSetting::query()->first();
        $storedToken = (string) $settings?->getAttributes()['api_token'];

        $this->assertNotNull($settings);
        $this->assertFalse(str_contains($storedToken, $this->token()), 'API token was stored in plaintext.');
        $this->assertTrue(
            hash_equals(hash('sha256', $this->token()), hash('sha256', (string) $settings->api_token)),
            'Saved API token could not be read back.',
        );
        $this->assertSame($this->zoneId(), $settings->zone_id);
        $this->assertFalse(
            str_contains($settings->toJson(), $this->token()),
            'Serialized Cloudflare settings exposed the API token.',
        );

        $stateToken = $component->get('data.api_token');
        $this->assertTrue(
            is_string($stateToken) && hash_equals(hash('sha256', $this->token()), hash('sha256', $stateToken)),
            'The saved API token is not available in the administrator form.',
        );
        $this->assertSame($this->zoneId(), $component->get('data.zone_id'));
    }

    public function test_purge_everything_does_not_call_cloudflare_when_credentials_are_missing(): void
    {
        $admin = $this->administrator();

        Livewire::actingAs($admin)
            ->test(CloudflareCache::class)
            ->callAction('purgeEverything');

        $this->assertNotification('Cloudflare cache purge failed', 'Save a Cloudflare API token and Zone ID');
        Http::assertNothingSent();

        $this->storeCredentials(zoneId: null);

        Livewire::actingAs($admin)
            ->test(CloudflareCache::class)
            ->callAction('purgeEverything');

        $this->assertNotification('Cloudflare cache purge failed', 'Save a Cloudflare Zone ID');
        Http::assertNothingSent();

        CloudflareSetting::query()->delete();
        CloudflareSetting::query()->create([
            'zone_id' => $this->zoneId(),
        ]);

        Livewire::actingAs($admin)
            ->test(CloudflareCache::class)
            ->callAction('purgeEverything');

        $this->assertNotification('Cloudflare cache purge failed', 'Save a Cloudflare API token');
        Http::assertNothingSent();
    }

    public function test_purge_everything_requires_confirmation_and_succeeds(): void
    {
        $this->travelTo('2026-10-08 10:47:00');
        $this->storeCredentials();
        $this->fakeCloudflare(200, [
            'success' => true,
            'errors' => [],
            'messages' => [],
            'result' => ['id' => 'purge-1'],
        ]);

        $component = Livewire::actingAs($this->administrator())
            ->test(CloudflareCache::class)
            ->assertSee('No successful purge has been recorded yet.')
            ->call('mountAction', 'purgeEverything')
            ->assertSet('mountedActions.0.name', 'purgeEverything');

        Http::assertNothingSent();

        $component
            ->call('callMountedAction')
            ->assertSee('Purge Everything · Oct 8, 2026 10:47 AM');

        $this->assertNotification('Cloudflare cache purged', 'Cloudflare purged the entire cache');

        Http::assertSentCount(1);
        $this->assertPurgeRequest(['purge_everything' => true]);

        $settings = CloudflareSetting::query()->first();
        $this->assertSame(CloudflareCacheService::PURGE_EVERYTHING, $settings?->last_purge_type);
        $this->assertTrue(
            hash_equals(hash('sha256', $this->token()), hash('sha256', (string) $settings?->api_token)),
            'Purge changed the stored API token.',
        );
    }

    public function test_purge_everything_reports_cloudflare_failure_without_the_token(): void
    {
        $this->storeCredentials();
        $this->fakeCloudflare(403, [
            'success' => false,
            'errors' => [[
                'code' => 10000,
                'message' => 'Authentication error '.$this->token(),
            ]],
        ]);

        Livewire::actingAs($this->administrator())
            ->test(CloudflareCache::class)
            ->callAction('purgeEverything');

        Http::assertSentCount(1);
        $this->assertNull(CloudflareSetting::query()->value('last_purged_at'));
        $this->assertNotification(
            'Cloudflare cache purge failed',
            'Cloudflare rejected the API token.',
        );
    }

    public function test_custom_purge_rejects_invalid_and_empty_urls(): void
    {
        $this->storeCredentials();

        $component = Livewire::actingAs($this->administrator())
            ->test(CloudflareCache::class);

        $this->fillCustomPurge($component, [
            'not-a-url',
            'javascript:alert(1)',
        ])->call('callMountedAction');

        $errors = json_encode($component->errors());
        $this->assertIsString($errors);
        $this->assertStringContainsString('Enter an absolute http or https URL.', $errors);
        $this->assertSame('customPurge', $component->get('mountedActions.0.name'));
        Http::assertNothingSent();

        $empty = Livewire::actingAs($this->administrator())
            ->test(CloudflareCache::class);
        $this->fillCustomPurge($empty, [])->call('callMountedAction');
        $this->assertNotSame('confirmCustomPurge', $empty->get('mountedActions.0.name'));
        Http::assertNothingSent();

        $result = app(CloudflareCacheService::class)->purgeUrls([], $this->administrator());

        $this->assertFalse($result->successful);
        $this->assertSame('Add at least one valid URL before purging.', $result->message);
        Http::assertNothingSent();
    }

    public function test_custom_purge_requires_confirmation_and_succeeds(): void
    {
        $this->travelTo('2026-10-08 10:47:00');
        $this->storeCredentials();
        $this->fakeCloudflare(200, [
            'success' => true,
            'errors' => [],
            'messages' => [],
            'result' => ['id' => 'purge-2'],
        ]);

        $urls = [
            'https://www.ibntech.com/',
            'https://www.ibntech.com/services/',
        ];

        $component = Livewire::actingAs($this->administrator())
            ->test(CloudflareCache::class);

        $this->fillCustomPurge($component, $urls)->call('callMountedAction');

        $this->assertSame('confirmCustomPurge', $component->get('mountedActions.0.name'));
        Http::assertNothingSent();

        $component
            ->call('callMountedAction')
            ->assertSee('Custom Purge (2 URLs) · Oct 8, 2026 10:47 AM');

        $this->assertNotification('Cloudflare cache purged', 'Cloudflare purged 2 URLs.');

        Http::assertSentCount(1);
        $this->assertPurgeRequest(['files' => $urls]);
        $this->assertSame(CloudflareCacheService::CUSTOM_PURGE, CloudflareSetting::query()->value('last_purge_type'));
        $this->assertSame(2, CloudflareSetting::query()->value('last_purge_url_count'));
    }

    public function test_custom_purge_reports_cloudflare_failure(): void
    {
        $this->storeCredentials();
        $this->fakeCloudflare(400, [
            'success' => false,
            'errors' => [[
                'code' => 1010,
                'message' => 'Unable to purge files',
            ]],
        ]);

        $component = Livewire::actingAs($this->administrator())
            ->test(CloudflareCache::class);

        $this->fillCustomPurge($component, [
            'https://www.ibntech.com/blog/example/',
        ])->call('callMountedAction');

        Http::assertNothingSent();

        $component->call('callMountedAction');

        Http::assertSentCount(1);
        $this->assertNull(CloudflareSetting::query()->value('last_purged_at'));
        $this->assertNotification('Cloudflare cache purge failed', 'Unable to purge files');
    }

    public function test_cloudflare_timeouts_and_connection_failures_are_safe(): void
    {
        $this->storeCredentials();

        $this->fakeHttp(function (): void {
            throw new ConnectionException('cURL error 28: Operation timed out');
        });

        $timeout = app(CloudflareCacheService::class)->purgeEverything($this->administrator());

        $this->assertFalse($timeout->successful);
        $this->assertSame('The request to Cloudflare timed out. Try again in a moment.', $timeout->message);
        $this->assertSecretAbsent($timeout->message, 'Timeout message exposed a Cloudflare credential.');

        $this->fakeHttp(function (): void {
            throw new ConnectionException('cURL error 7: Connection refused');
        });

        $connection = app(CloudflareCacheService::class)->purgeEverything($this->administrator());

        $this->assertFalse($connection->successful);
        $this->assertSame('Could not connect to Cloudflare. Try again in a moment.', $connection->message);
        $this->assertNull($connection->httpStatus);
    }

    public function test_invalid_zone_id_does_not_call_cloudflare(): void
    {
        $this->token();

        CloudflareSetting::query()->create([
            'api_token' => $this->token(),
            'zone_id' => 'not-a-valid-zone',
        ]);

        $result = app(CloudflareCacheService::class)->purgeEverything($this->administrator());

        $this->assertFalse($result->successful);
        $this->assertStringContainsString('Zone ID is not valid', $result->message);
        Http::assertNothingSent();
    }

    public function test_public_pages_do_not_expose_cloudflare_credentials(): void
    {
        $this->storeCredentials();

        foreach (['/robots.txt', '/'] as $path) {
            $response = $this->get($path);
            $this->assertSecretAbsent($response->getContent(), 'Public response for '.$path.' exposed a Cloudflare credential.');
        }
    }

    private function administrator(): User
    {
        return User::factory()->create([
            'role' => User::ROLE_ADMINISTRATOR,
        ]);
    }

    private function token(): string
    {
        return $this->secret ??= 'cf-test-token-9f3a2c7b-do-not-log';
    }

    private function zoneId(): string
    {
        return '0123456789abcdef0123456789abcdef';
    }

    private function storeCredentials(?string $zoneId = '0123456789abcdef0123456789abcdef'): CloudflareSetting
    {
        return CloudflareSetting::query()->create([
            'api_token' => $this->token(),
            'zone_id' => $zoneId,
        ]);
    }

    /**
     * @param  array<string, mixed>  $body
     */
    /**
     * @param  array<string, mixed>|callable  $fake
     */
    private function fakeHttp(array|callable $fake): void
    {
        $this->app->forgetInstance(Factory::class);
        Http::clearResolvedInstances();
        Http::preventStrayRequests();
        Http::fake($fake);
    }

    /**
     * @param  array<string, mixed>  $body
     */
    private function fakeCloudflare(int $status, array $body): void
    {
        $this->fakeHttp([
            'https://api.cloudflare.com/*' => Http::response($body, $status),
        ]);
    }

    /**
     * @param  list<string>  $urls
     */
    private function fillCustomPurge(Testable $component, array $urls): Testable
    {
        $component->call('mountAction', 'customPurge');

        $state = [];

        foreach ($urls as $url) {
            $state[(string) Str::uuid()] = ['url' => $url];
        }

        $component->set('mountedActions.0.data.urls', $state);

        return $component;
    }

    private function assertNotification(string $title, ?string $bodyFragment = null): void
    {
        $text = $this->latestNotificationText();

        $this->assertStringContainsString($title, $text, 'Expected notification was not sent.');

        if ($bodyFragment !== null) {
            $this->assertStringContainsString($bodyFragment, $text);
        }

        $this->assertSecretAbsent($text, 'Notification exposed a Cloudflare credential.');
    }

    /**
     * @param  array<string, mixed>  $expectedJson
     */
    private function assertPurgeRequest(array $expectedJson): void
    {
        $matchedToken = false;

        foreach (Http::recorded() as [$request]) {
            $this->assertSame('POST', $request->method());
            $this->assertSame(CloudflareCacheService::purgeEndpoint($this->zoneId()), $request->url());
            $this->assertSame($expectedJson, $request->data());
            $this->assertFalse(str_contains($request->url(), $this->token()), 'Cloudflare request URL contained the API token.');

            $body = json_encode($request->data());
            $this->assertIsString($body);
            $this->assertFalse(str_contains($body, $this->token()), 'Cloudflare request body contained the API token.');

            $authorization = $request->header('Authorization')[0] ?? '';
            $matchedToken = hash_equals(hash('sha256', 'Bearer '.$this->token()), hash('sha256', $authorization));
        }

        $this->assertTrue($matchedToken, 'Cloudflare request did not use the saved API token.');
    }

    private function assertSecretAbsent(string $haystack, string $message): void
    {
        $this->assertFalse(str_contains($haystack, $this->token()), $message);
        $this->assertFalse(str_contains($haystack, $this->zoneId()), $message);
    }

    private function assertLogsDoNotContain(string $secret): void
    {
        foreach ($this->logs as $event) {
            $blob = $event->message."\n".$this->stringifyLogContext($event->context);
            $this->assertFalse(str_contains($blob, $secret), 'Application log contained the Cloudflare API token.');
        }
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private function stringifyLogContext(array $context): string
    {
        $parts = [];

        foreach ($context as $key => $value) {
            if (is_scalar($value) || $value === null) {
                $parts[] = $key.'='.(string) $value;

                continue;
            }

            $parts[] = $key.'='.get_debug_type($value);
        }

        return implode("\n", $parts);
    }

    private function assertNotificationsDoNotContain(string $secret): void
    {
        $this->assertFalse(
            str_contains($this->notificationText(), $secret),
            'Notification contained the Cloudflare API token.',
        );
    }

    private function notificationText(): string
    {
        $text = $this->latestNotificationText();

        if ($text !== '' && ! str_contains($this->notificationSnapshot, $text)) {
            $this->notificationSnapshot .= $text."\n";
        }

        return $this->notificationSnapshot.$text;
    }

    private function latestNotificationText(): string
    {
        $notifications = [
            ...(array) session('filament.notifications', []),
            ...(array) session('filament.claimed_notifications', []),
        ];

        $lines = [];

        foreach ($notifications as $notification) {
            if (! is_array($notification)) {
                continue;
            }

            $body = $notification['body'] ?? '';
            $lines[] = (string) ($notification['title'] ?? '').' '.($body instanceof Htmlable ? $body->toHtml() : (string) $body);
        }

        $text = implode("\n", $lines);

        if ($text !== '' && ! str_contains($this->notificationSnapshot, $text)) {
            $this->notificationSnapshot .= $text."\n";
        }

        return $text;
    }
}
