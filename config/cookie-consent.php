<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Consent cookie
    |--------------------------------------------------------------------------
    |
    | First-party cookie that stores category choices, a timestamp, and the
    | policy and configuration versions. It does not store a visitor id or
    | an IP address. JavaScript writes it, so it is excluded from encryption.
    |
    */

    'cookie' => 'ibn_cookie_consent',

    /*
    |--------------------------------------------------------------------------
    | Optional measurement ID overrides
    |--------------------------------------------------------------------------
    |
    | Leave these empty to use the IDs stored for this environment. Google
    | Analytics and Tag Manager IDs live in Website Settings. Google Ads and
    | LinkedIn IDs live in Cookie Management. An empty value must not fall
    | back to another environment's ID.
    |
    */

    'google_analytics_id' => env('GOOGLE_ANALYTICS_ID') ?: null,

    'google_tag_manager_id' => env('GOOGLE_TAG_MANAGER_ID') ?: null,

    'google_ads_id' => env('GOOGLE_ADS_ID') ?: null,

    'linkedin_partner_id' => env('LINKEDIN_PARTNER_ID') ?: null,

    'environments' => ['local', 'staging', 'production', 'testing'],

];
