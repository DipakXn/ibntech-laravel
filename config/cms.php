<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Legacy administrator emails
    |--------------------------------------------------------------------------
    |
    | These mailboxes keep administrator access even when the stored role is
    | Author. Leave this empty in production so the role column is the only
    | source of access. Local development defaults to admin@example.com when
    | the variable is omitted, which preserves the previous development login.
    |
    */

    'legacy_super_admin_emails' => array_values(array_unique(array_filter(array_map(
        static fn (string $email): string => strtolower(trim($email)),
        explode(',', (string) env(
            'CMS_LEGACY_SUPER_ADMIN_EMAILS',
            env('APP_ENV') === 'local' ? 'admin@example.com' : '',
        )),
    )))),

];
