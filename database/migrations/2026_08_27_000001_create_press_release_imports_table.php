<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('press_release_imports', function (Blueprint $table) {
            $table->id();
            $table->string('source_key')->unique();
            $table->string('source_url', 2048);
            $table->foreignId('press_release_id')->constrained()->cascadeOnDelete()->unique();
            $table->string('source_file')->nullable();
            $table->string('checksum')->nullable();
            $table->timestamp('imported_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('press_release_imports');
    }
};
