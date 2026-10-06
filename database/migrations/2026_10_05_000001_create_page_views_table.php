<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->uuid('visitor_id');
            $table->timestamp('visited_at');
            $table->string('path', 255);
            $table->string('content_type', 32)->nullable();
            $table->unsignedBigInteger('content_id')->nullable();
            $table->string('referrer_host', 255)->nullable();
            $table->char('country', 2)->nullable();
            $table->string('device', 16)->nullable();
            $table->string('browser', 32)->nullable();
            $table->string('operating_system', 32)->nullable();

            $table->index('visited_at');
            $table->index('path');
            $table->index(['content_type', 'content_id']);
            $table->index('visitor_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
