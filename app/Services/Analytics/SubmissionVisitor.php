<?php

namespace App\Services\Analytics;

use App\Services\CookieConsent\CookieConsentRepository;
use Illuminate\Http\Request;

/**
 * Copies the visitor id that page-view tracking already issued.
 * It does not create an id, and it does not record one when analytics
 * consent is missing or the address is excluded.
 */
final class SubmissionVisitor
{
    public function __construct(
        private readonly AnonymousVisitor $visitors,
        private readonly CookieConsentRepository $consent,
        private readonly ExcludedIpMatcher $excludedIps,
    ) {}

    public function id(Request $request): ?string
    {
        if (! $this->consent->choiceFromRequest($request)?->allows('analytics')) {
            return null;
        }

        if ($this->excludedIps->excludes(ClientAddress::from($request))) {
            return null;
        }

        return $this->visitors->existingId($request);
    }
}
