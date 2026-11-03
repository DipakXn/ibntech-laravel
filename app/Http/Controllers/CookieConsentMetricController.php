<?php

namespace App\Http\Controllers;

use App\Models\CookieConsentMetric;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CookieConsentMetricController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'action' => ['required', 'string', 'in:accept_all,reject_all,custom,withdrawal'],
        ]);

        CookieConsentMetric::record($validated['action']);

        return response()->json(['ok' => true]);
    }
}
