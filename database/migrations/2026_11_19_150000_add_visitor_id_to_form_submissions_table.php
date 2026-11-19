<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('form_submissions') || Schema::hasColumn('form_submissions', 'visitor_id')) {
            return;
        }

        Schema::table('form_submissions', function (Blueprint $table): void {
            $table->uuid('visitor_id')->nullable()->after('page_url');
            $table->index('visitor_id');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('form_submissions') || ! Schema::hasColumn('form_submissions', 'visitor_id')) {
            return;
        }

        Schema::table('form_submissions', function (Blueprint $table): void {
            $table->dropIndex(['visitor_id']);
            $table->dropColumn('visitor_id');
        });
    }
};
