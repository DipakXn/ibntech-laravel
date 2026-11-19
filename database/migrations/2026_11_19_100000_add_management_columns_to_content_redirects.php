<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_redirects', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('target_path');
            $table->string('origin', 20)->default('manual')->after('is_active');
            $table->string('note')->nullable()->after('origin');
        });

        DB::table('content_redirects')->update(['origin' => 'slug']);
    }

    public function down(): void
    {
        Schema::table('content_redirects', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'origin', 'note']);
        });
    }
};
