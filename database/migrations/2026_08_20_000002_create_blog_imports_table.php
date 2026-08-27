<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_imports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wordpress_id')->unique();
            $table->string('wordpress_guid')->nullable();
            $table->foreignId('blog_id')->constrained()->cascadeOnDelete()->unique();
            $table->string('source_file')->nullable();
            $table->string('source_url', 2048)->nullable();
            $table->string('checksum')->nullable();
            $table->json('unmapped_categories')->nullable();
            $table->timestamp('imported_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_imports');
    }
};
