-- Staging canonical cleanup for seo_meta.canonical_url
--
-- Run this only against the STAGING database (dev.ibntech.com).
-- Do not run it on local or production.
-- This file does not use local record IDs. Staging rows are matched only by
-- the canonical URL text, so it is safe when staging contains different data.
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
-- Why NULL is safe on staging:
--   After the code deploy, SeoService rebuilds a same-site canonical from
--   APP_URL (https://dev.ibntech.com). A stored production or localhost
--   canonical would otherwise advertise the wrong origin. A stored
--   dev.ibntech.com canonical is cleared for the same reason: the public URL
--   should come from the current environment, not from a saved copy of it.
--
-- If staging has none of these values, the statement updates 0 rows. That is
-- a successful no-op.
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
