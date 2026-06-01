<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('media')) {
            return;
        }

        if (Schema::hasColumn('media', 'path')) {
            DB::statement('ALTER TABLE media MODIFY path VARCHAR(255) NULL');
        }

        if (Schema::hasColumn('media', 'disk')) {
            DB::statement('ALTER TABLE media MODIFY disk VARCHAR(255) NOT NULL DEFAULT "public"');
        }

        if (Schema::hasColumn('media', 'title')) {
            DB::statement('ALTER TABLE media MODIFY title VARCHAR(255) NULL');
        }

        if (Schema::hasColumn('media', 'alt_text')) {
            DB::statement('ALTER TABLE media MODIFY alt_text VARCHAR(255) NULL');
        }

        if (Schema::hasColumn('media', 'mime_type')) {
            DB::statement('ALTER TABLE media MODIFY mime_type VARCHAR(255) NULL');
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('media')) {
            return;
        }

        if (Schema::hasColumn('media', 'path')) {
            DB::statement('ALTER TABLE media MODIFY path VARCHAR(255) NOT NULL');
        }

        if (Schema::hasColumn('media', 'disk')) {
            DB::statement('ALTER TABLE media MODIFY disk VARCHAR(255) NOT NULL DEFAULT "public"');
        }
    }
};
