<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('form_submissions')) {
            return;
        }

        Schema::table('form_submissions', function (Blueprint $table): void {
            if (! Schema::hasColumn('form_submissions', 'status')) {
                $table->string('status', 32)->default('new')->after('form_name');
                $table->index('status');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('form_submissions')) {
            return;
        }

        Schema::table('form_submissions', function (Blueprint $table): void {
            if (Schema::hasColumn('form_submissions', 'status')) {
                $table->dropIndex(['status']);
                $table->dropColumn('status');
            }
        });
    }
};