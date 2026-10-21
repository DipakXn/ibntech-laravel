<?php

namespace Tests\Unit;

use App\Support\FormSubmissionPageUrl;
use Illuminate\Http\Request;
use Tests\TestCase;

class FormSubmissionPageUrlTest extends TestCase
{
    public function test_detects_livewire_hashed_update_endpoint(): void
    {
        $this->assertTrue(
            FormSubmissionPageUrl::isLivewireEndpoint('https://dev.ibntech.com/livewire-4e37d65f/update')
        );
    }

    public function test_resolve_prefers_valid_candidate_over_livewire_url(): void
    {
        $resolved = FormSubmissionPageUrl::resolve('https://dev.ibntech.com/blog/vapt-insights/');

        $this->assertSame('https://dev.ibntech.com/blog/vapt-insights/', $resolved);
    }

    public function test_resolve_uses_referer_when_candidate_is_livewire_endpoint(): void
    {
        $request = Request::create(
            'https://dev.ibntech.com/livewire-4e37d65f/update',
            'POST',
            server: ['HTTP_REFERER' => 'https://dev.ibntech.com/blog/msoc-dashboard/']
        );

        $this->app->instance('request', $request);

        $resolved = FormSubmissionPageUrl::resolve('https://dev.ibntech.com/livewire-4e37d65f/update');

        $this->assertSame('https://dev.ibntech.com/blog/msoc-dashboard/', $resolved);
    }
}
