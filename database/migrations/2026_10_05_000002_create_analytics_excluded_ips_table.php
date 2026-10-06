<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_excluded_ips', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 64)->unique();
            $table->string('description', 255)->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();

            $table->index('is_enabled');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics_excluded_ips');
    }
};
