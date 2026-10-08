<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cloudflare_settings', function (Blueprint $table) {
            $table->id();
            $table->text('api_token')->nullable();
            $table->string('zone_id', 32)->nullable();
            $table->string('last_purge_type', 32)->nullable();
            $table->unsignedSmallInteger('last_purge_url_count')->nullable();
            $table->timestamp('last_purged_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cloudflare_settings');
    }
};
