<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        if (! Schema::hasTable('media')) {
            return;
        }

        if (Schema::hasColumn('media', 'mediable_type')) {
            DB::statement('ALTER TABLE media MODIFY mediable_type VARCHAR(255) NULL');
        }

        if (Schema::hasColumn('media', 'mediable_id')) {
            DB::statement('ALTER TABLE media MODIFY mediable_id BIGINT UNSIGNED NULL');
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        if (! Schema::hasTable('media')) {
            return;
        }

        if (Schema::hasColumn('media', 'mediable_type')) {
            DB::statement('ALTER TABLE media MODIFY mediable_type VARCHAR(255) NOT NULL');
        }

        if (Schema::hasColumn('media', 'mediable_id')) {
            DB::statement('ALTER TABLE media MODIFY mediable_id BIGINT UNSIGNED NOT NULL');
        }
    }
};
