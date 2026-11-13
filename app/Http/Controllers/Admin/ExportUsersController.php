<?php

namespace App\Http\Controllers\Admin;

use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportUsersController
{
    public function __invoke(Request $request): StreamedResponse
    {
        abort_unless(
            $request->user() instanceof User && $request->user()->isAdministrator(),
            403,
        );

        $filename = 'ibntech-users-'.now()->format('Y-m-d').'.csv';

        return response()->streamDownload(function (): void {
            $output = fopen('php://output', 'w');

            if ($output === false) {
                return;
            }

            fputcsv($output, [
                'Name',
                'Email',
                'Role',
                'Active',
                'Created at',
                'Updated at',
                'Last session activity',
            ]);

            User::query()
                ->withLastSessionActivity()
                ->orderBy('name')
                ->each(function (User $user) use ($output): void {
                    fputcsv($output, [
                        $user->name,
                        $user->email,
                        UsersTable::roleLabel((string) $user->role),
                        $user->isActiveAccount() ? 'yes' : 'no',
                        optional($user->created_at)->toDateTimeString(),
                        optional($user->updated_at)->toDateTimeString(),
                        blank($user->last_session_activity)
                            ? ''
                            : Carbon::createFromTimestamp((int) $user->last_session_activity)->toDateTimeString(),
                    ]);
                });

            fclose($output);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
