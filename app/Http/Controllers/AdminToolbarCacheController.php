<?php

namespace App\Http\Controllers;

use App\Filament\Pages\SystemMaintenance;
use App\Models\User;
use App\Services\ApplicationCacheService;
use App\Services\MaintenanceActionLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class AdminToolbarCacheController extends Controller
{
    public function store(
        Request $request,
        ApplicationCacheService $cache,
        MaintenanceActionLogger $logger,
    ): RedirectResponse {
        abort_unless(SystemMaintenance::canAccess(), 403);

        $actor = $request->user() instanceof User ? $request->user() : null;

        try {
            $cache->clear();
        } catch (Throwable $exception) {
            $logger->failed(
                'Failed to clear application cache.',
                'clear_application_cache',
                $actor,
                $exception,
            );

            return redirect()->to($this->safeReturnUrl($request))->with(
                'adminToolbarNotice',
                'Could not clear the application cache. Please try again or check the application logs.',
            );
        }

        $logger->succeeded('clear_application_cache', $actor);

        return redirect()->to($this->safeReturnUrl($request))->with(
            'adminToolbarNotice',
            'Cache cleared.',
        );
    }

    private function safeReturnUrl(Request $request): string
    {
        $return = $request->string('return')->toString();
        $parts = parse_url($return);
        $path = is_array($parts) ? (string) ($parts['path'] ?? '') : '';
        $host = is_array($parts) ? ($parts['host'] ?? null) : null;

        if (
            $host !== $request->getHost()
            || $path === ''
            || str_starts_with($path, '/admin')
            || str_starts_with($path, '/ibn-tech-cms-login')
        ) {
            return url('/');
        }

        $query = isset($parts['query']) && is_string($parts['query']) && $parts['query'] !== ''
            ? '?'.$parts['query']
            : '';

        return url($path).$query;
    }
}
