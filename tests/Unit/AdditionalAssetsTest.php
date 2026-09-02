<?php

namespace Tests\Unit;

use App\Support\AdditionalAssets;
use PHPUnit\Framework\TestCase;

class AdditionalAssetsTest extends TestCase
{
    public function test_it_normalizes_raw_and_single_style_wrappers(): void
    {
        $this->assertSame('.hero { color: red; }', AdditionalAssets::normalizeCss('.hero { color: red; }'));
        $this->assertSame('.hero { color: red; }', AdditionalAssets::normalizeCss('<style>.hero { color: red; }</style>'));
        $this->assertSame('.hero { color: red; }', AdditionalAssets::normalizeCss("  <style type=\"text/css\">\n.hero { color: red; }\n</style>  "));
        $this->assertNull(AdditionalAssets::normalizeCss(''));
        $this->assertNull(AdditionalAssets::normalizeCss('   '));
        $this->assertNull(AdditionalAssets::normalizeCss('<style></style>'));
    }

    public function test_it_normalizes_raw_and_single_script_wrappers(): void
    {
        $this->assertSame("console.log('ok');", AdditionalAssets::normalizeJs("console.log('ok');"));
        $this->assertSame("console.log('ok');", AdditionalAssets::normalizeJs("<script>console.log('ok');</script>"));
        $this->assertSame("console.log('ok');", AdditionalAssets::normalizeJs("  <script type=\"module\">\nconsole.log('ok');\n</script>  "));
        $this->assertNull(AdditionalAssets::normalizeJs(null));
        $this->assertNull(AdditionalAssets::normalizeJs('<script></script>'));
    }

    public function test_it_does_not_unwrap_multiple_style_or_script_tags(): void
    {
        $css = '<style>.a{}</style><style>.b{}</style>';
        $js = '<script>a();</script><script>b();</script>';

        $this->assertSame($css, AdditionalAssets::normalizeCss($css));
        $this->assertSame($js, AdditionalAssets::normalizeJs($js));
    }

    public function test_it_wraps_normalized_assets_once(): void
    {
        $this->assertSame('<style>.hero { color: red; }</style>', AdditionalAssets::styleTag('<style>.hero { color: red; }</style>'));
        $this->assertSame("<script>console.log('ok');</script>", AdditionalAssets::scriptTag("<script>console.log('ok');</script>"));
        $this->assertNull(AdditionalAssets::styleTag(null));
        $this->assertNull(AdditionalAssets::scriptTag(''));
    }

    public function test_it_escapes_closing_tags_inside_payloads(): void
    {
        $this->assertSame('<style>/* <\/style> */</style>', AdditionalAssets::styleTag('/* </style> */'));
        $this->assertSame('<script>/* <\/script> */</script>', AdditionalAssets::scriptTag('/* </script> */'));
    }
}
