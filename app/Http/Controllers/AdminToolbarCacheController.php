<?php

namespace App\Http\Controllers;

use App\Filament\Pages\SystemMaintenance;
use App\Services\ApplicationCacheService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminToolbarCacheController extends Controller
{
    public function store(Request $request, ApplicationCacheService $cache): RedirectResponse
    {
        abort_unless(SystemMaintenance::canAccess(), 403);

        $cache->clear();

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
