<?php

use App\Support\Testimonials\ImportedTestimonials;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->text('customer_name');
            $table->text('designation')->nullable();
            $table->text('company_name')->nullable();
            $table->text('quote');
            $table->unsignedTinyInteger('rating')->nullable();
            $table->foreignId('page_id')->nullable()->constrained('pages')->nullOnDelete();
            $table->string('status')->default('published');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['status', 'is_active']);
        });

        Schema::create('testimonial_placements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('testimonial_id')->constrained()->cascadeOnDelete();
            $table->string('placement');
            $table->unsignedInteger('sort_order')->default(0);

            $table->unique(['testimonial_id', 'placement']);
            $table->index(['placement', 'sort_order']);
        });

        ImportedTestimonials::import();
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonial_placements');
        Schema::dropIfExists('testimonials');
    }
};
