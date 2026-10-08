-- Local canonical cleanup for seo_meta.canonical_url
--
-- Run this only against the LOCAL database.
-- Do not run it on staging or production.
--
-- What it changes:
--   Sets seo_meta.canonical_url to NULL when the stored value is an absolute
--   URL on this application (www.ibntech.com, ibntech.com, dev.ibntech.com,
--   localhost, or 127.0.0.1, with or without a port).
--
-- What it does not change:
--   No rows are deleted.
--   No other columns are updated.
--   Canonicals on any other host are left as stored.
--   Content HTML, media source_url, imports, form submissions, and email logs
--   are not touched. Those public links are rewritten in application code.
--
-- Why NULL is safe locally:
--   SeoService rebuilds a same-site canonical from the current APP_URL
--   (http://localhost:8000). Clearing the stored origin stops a production or
--   staging host from being printed, and stops a localhost canonical from
--   being locked into this row.
--
-- The WHERE clause matches the URL text, not record IDs, so it does not
-- depend on which rows exist in this database. If nothing matches, the
-- statement updates 0 rows and that is a successful no-op.
--
-- Preview before running:
-- SELECT id, metable_type, metable_id, canonical_url
-- FROM seo_meta
-- WHERE canonical_url LIKE 'https://www.ibntech.com/%'
--    OR canonical_url = 'https://www.ibntech.com'
--    OR canonical_url = 'https://www.ibntech.com/'
--    OR canonical_url LIKE 'http://www.ibntech.com/%'
--    OR canonical_url = 'http://www.ibntech.com'
--    OR canonical_url = 'http://www.ibntech.com/'
--    OR canonical_url LIKE 'https://ibntech.com/%'
--    OR canonical_url = 'https://ibntech.com'
--    OR canonical_url = 'https://ibntech.com/'
--    OR canonical_url LIKE 'http://ibntech.com/%'
--    OR canonical_url = 'http://ibntech.com'
--    OR canonical_url = 'http://ibntech.com/'
--    OR canonical_url LIKE 'https://dev.ibntech.com/%'
--    OR canonical_url = 'https://dev.ibntech.com'
--    OR canonical_url = 'https://dev.ibntech.com/'
--    OR canonical_url LIKE 'http://dev.ibntech.com/%'
--    OR canonical_url = 'http://dev.ibntech.com'
--    OR canonical_url = 'http://dev.ibntech.com/'
--    OR canonical_url LIKE 'http://localhost/%'
--    OR canonical_url LIKE 'http://localhost:%'
--    OR canonical_url = 'http://localhost'
--    OR canonical_url LIKE 'https://localhost/%'
--    OR canonical_url LIKE 'https://localhost:%'
--    OR canonical_url = 'https://localhost'
--    OR canonical_url LIKE 'http://127.0.0.1/%'
--    OR canonical_url LIKE 'http://127.0.0.1:%'
--    OR canonical_url = 'http://127.0.0.1'
--    OR canonical_url LIKE 'https://127.0.0.1/%'
--    OR canonical_url LIKE 'https://127.0.0.1:%'
--    OR canonical_url = 'https://127.0.0.1';

UPDATE `seo_meta`
SET `canonical_url` = NULL
WHERE `canonical_url` LIKE 'https://www.ibntech.com/%'
   OR `canonical_url` = 'https://www.ibntech.com'
   OR `canonical_url` = 'https://www.ibntech.com/'
   OR `canonical_url` LIKE 'http://www.ibntech.com/%'
   OR `canonical_url` = 'http://www.ibntech.com'
   OR `canonical_url` = 'http://www.ibntech.com/'
   OR `canonical_url` LIKE 'https://ibntech.com/%'
   OR `canonical_url` = 'https://ibntech.com'
   OR `canonical_url` = 'https://ibntech.com/'
   OR `canonical_url` LIKE 'http://ibntech.com/%'
   OR `canonical_url` = 'http://ibntech.com'
   OR `canonical_url` = 'http://ibntech.com/'
   OR `canonical_url` LIKE 'https://dev.ibntech.com/%'
   OR `canonical_url` = 'https://dev.ibntech.com'
   OR `canonical_url` = 'https://dev.ibntech.com/'
   OR `canonical_url` LIKE 'http://dev.ibntech.com/%'
   OR `canonical_url` = 'http://dev.ibntech.com'
   OR `canonical_url` = 'http://dev.ibntech.com/'
   OR `canonical_url` LIKE 'http://localhost/%'
   OR `canonical_url` LIKE 'http://localhost:%'
   OR `canonical_url` = 'http://localhost'
   OR `canonical_url` LIKE 'https://localhost/%'
   OR `canonical_url` LIKE 'https://localhost:%'
   OR `canonical_url` = 'https://localhost'
   OR `canonical_url` LIKE 'http://127.0.0.1/%'
   OR `canonical_url` LIKE 'http://127.0.0.1:%'
   OR `canonical_url` = 'http://127.0.0.1'
   OR `canonical_url` LIKE 'https://127.0.0.1/%'
   OR `canonical_url` LIKE 'https://127.0.0.1:%'
   OR `canonical_url` = 'https://127.0.0.1';
