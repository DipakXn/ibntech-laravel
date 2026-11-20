<?php

namespace Tests\Feature;

use App\Filament\Resources\Testimonials\Pages\CreateTestimonial;
use App\Filament\Resources\Testimonials\Pages\EditTestimonial;
use App\Filament\Resources\Testimonials\Pages\ListTestimonials;
use App\Models\Page;
use App\Models\Testimonial;
use App\Models\User;
use App\Support\Testimonials\ImportedTestimonials;
use App\Support\Testimonials\Testimonials;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class TestimonialsModuleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        config(['cms.legacy_super_admin_emails' => []]);
    }

    public function test_imported_quotes_keep_their_wording_order_and_hide_when_withdrawn(): void
    {
        $this->assertSame(count(ImportedTestimonials::definitions()), Testimonial::query()->count());

        $before = Testimonial::query()->count();
        ImportedTestimonials::import();
        $this->assertSame($before, Testimonial::query()->count());

        $home = Testimonials::cards('home');
        $this->assertSame('Vishal Tompe', $home[0]['name']);
        $this->assertSame('Senior IT Associate, Digitalzone', $home[0]['role']);
        $this->assertSame(5, $home[0]['rating']);
        $this->assertNull($home[0]['image']);

        $this->homePage();

        $html = $this->get('/')->assertOk()->getContent();
        $this->assertIsString($html);
        $this->assertLessThan(
            strpos($html, 'Syed Muhammad Umair'),
            strpos($html, 'Vishal Tompe'),
        );
        $this->assertStringContainsString('fa-solid fa-user', $html);
        $this->assertStringContainsString('aria-label="5 star rating"', $html);
        $this->assertStringNotContainsString('home-testimonial__avatar" aria-hidden="true">'."\n".'                                                <img', $html);

        $vishal = Testimonial::query()->where('customer_name', 'Vishal Tompe')->firstOrFail();
        $quote = $vishal->quote;

        $vishal->update(['status' => Testimonial::STATUS_UNPUBLISHED]);
        $this->get('/')->assertOk()->assertDontSee($quote, false);

        $vishal->update([
            'status' => Testimonial::STATUS_PUBLISHED,
            'is_active' => false,
        ]);
        $this->get('/')->assertOk()->assertDontSee($quote, false);

        $syed = Testimonial::query()->where('customer_name', 'Syed Muhammad Umair')->firstOrFail();
        $syed->placements()->where('placement', 'home')->update(['sort_order' => 0]);
        $vishal->update(['status' => Testimonial::STATUS_PUBLISHED, 'is_active' => true]);

        $reordered = Testimonials::cards('home');
        $this->assertSame('Syed Muhammad Umair', $reordered[0]['name']);
        $this->assertSame('Vishal Tompe', $reordered[1]['name']);

        Page::query()->create([
            'title' => 'Travel bookkeeping',
            'slug' => 'travel-bookkeeping-service',
            'template' => 'travel-bookkeeping-service',
            'status' => 'published',
        ]);

        $this->followingRedirects()
            ->get('/travel-bookkeeping-service/')
            ->assertOk()
            ->assertSee('Janikin Rooke Contracts', false)
            ->assertSee('We have been with IBN for just a short of year now', false);
    }

    public function test_missing_image_and_empty_section_render_without_errors(): void
    {
        $this->homePage();

        $vishal = Testimonial::query()->where('customer_name', 'Vishal Tompe')->firstOrFail();
        DB::table('media')->insert([
            'model_type' => Testimonial::class,
            'model_id' => $vishal->getKey(),
            'mediable_type' => Testimonial::class,
            'mediable_id' => $vishal->getKey(),
            'uuid' => (string) Str::uuid(),
            'collection_name' => 'client_image',
            'name' => 'avatar',
            'file_name' => 'missing-avatar.webp',
            'disk' => 'media',
            'conversions_disk' => 'media',
            'path' => 'missing/missing-avatar.webp',
            'mime_type' => 'image/webp',
            'size' => 12,
            'manipulations' => '[]',
            'custom_properties' => '[]',
            'generated_conversions' => '[]',
            'responsive_images' => '[]',
            'order_column' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $vishal->unsetRelation('media');
        $this->assertNull($vishal->clientImageUrl());

        $html = view('components.home.testimonials')->render();
        $this->assertStringContainsString('fa-solid fa-user', $html);
        $this->assertStringNotContainsString('<img', $html);

        Testimonial::query()->update(['is_active' => false]);

        $empty = view('components.home.testimonials')->render();
        $this->assertStringNotContainsString('data-home-testimonial-card', $empty);
        $this->get('/')->assertOk();

        $this->assertSame([], Testimonials::cards('not-a-section'));
        $this->assertSame([], Testimonials::cites('hedge-fund-accounting'));
    }

    public function test_administrators_can_create_edit_publish_and_delete_testimonials(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMINISTRATOR]);
        $this->actingAs($admin);
        Filament::setCurrentPanel('admin');

        Livewire::test(CreateTestimonial::class)
            ->fillForm([
                'customer_name' => 'Ada Lovelace',
                'designation' => 'Mathematician',
                'company_name' => 'Analytical Engines',
                'quote' => 'The analytical engine weaves algebraic patterns.',
                'rating' => 4,
                'status' => Testimonial::STATUS_UNPUBLISHED,
                'is_active' => true,
                'placements' => [
                    ['placement' => 'home', 'sort_order' => 50],
                ],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $record = Testimonial::query()->where('customer_name', 'Ada Lovelace')->first();
        $this->assertNotNull($record);
        $this->assertSame(Testimonial::STATUS_UNPUBLISHED, $record->status);
        $this->assertTrue($record->placements()->where('placement', 'home')->where('sort_order', 50)->exists());
        $this->assertNotContains('Ada Lovelace', array_column(Testimonials::cards('home'), 'name'));

        Livewire::test(EditTestimonial::class, ['record' => $record->getKey()])
            ->fillForm([
                'customer_name' => 'Ada Lovelace',
                'designation' => 'Mathematician',
                'company_name' => 'Analytical Engines',
                'quote' => 'The analytical engine weaves algebraic patterns just as the Jacquard loom weaves flowers.',
                'rating' => 4,
                'status' => Testimonial::STATUS_PUBLISHED,
                'is_active' => true,
                'placements' => [
                    ['placement' => 'home', 'sort_order' => 50],
                ],
            ])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertContains('Ada Lovelace', array_column(Testimonials::cards('home'), 'name'));

        Livewire::test(ListTestimonials::class)
            ->assertCanSeeTableRecords([$record])
            ->searchTable('Jacquard')
            ->assertCanSeeTableRecords([$record])
            ->filterTable('status', Testimonial::STATUS_PUBLISHED)
            ->filterTable('placement', 'home')
            ->callTableAction('unpublish', $record);

        $this->assertSame(Testimonial::STATUS_UNPUBLISHED, $record->fresh()->status);

        Livewire::test(ListTestimonials::class)
            ->callTableAction('publish', $record)
            ->callTableAction('deactivate', $record);

        $fresh = $record->fresh();
        $this->assertSame(Testimonial::STATUS_PUBLISHED, $fresh->status);
        $this->assertFalse($fresh->is_active);

        Livewire::test(ListTestimonials::class)
            ->callTableAction('activate', $record);

        $this->assertTrue($record->fresh()->is_active);

        Livewire::test(EditTestimonial::class, ['record' => $record->getKey()])
            ->callAction('delete');

        $this->assertDatabaseMissing('testimonials', ['id' => $record->getKey()]);
    }

    public function test_authors_cannot_open_testimonials(): void
    {
        $author = User::factory()->create(['role' => User::ROLE_AUTHOR]);

        $this->actingAs($author)
            ->get('/admin/testimonials')
            ->assertForbidden();
    }

    private function homePage(): void
    {
        Page::query()->create([
            'title' => 'Home',
            'slug' => 'home',
            'template' => 'home',
            'status' => 'published',
        ]);
    }
}
