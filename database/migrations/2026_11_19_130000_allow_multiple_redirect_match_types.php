<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_redirects', function (Blueprint $table) {
            $table->dropUnique(['source_path']);
            $table->unique(['source_path', 'match_type']);
        });
    }

    public function down(): void
    {
        Schema::table('content_redirects', function (Blueprint $table) {
            $table->dropUnique(['source_path', 'match_type']);
            $table->unique('source_path');
        });
    }
};
