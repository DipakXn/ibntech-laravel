<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('health_signals', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->timestamp('recorded_at');
        });

        Schema::create('health_check_runs', function (Blueprint $table) {
            $table->id();
            $table->string('trigger');
            $table->string('overall');
            $table->json('checks');
            $table->timestamp('checked_at')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('health_check_runs');
        Schema::dropIfExists('health_signals');
    }
};
