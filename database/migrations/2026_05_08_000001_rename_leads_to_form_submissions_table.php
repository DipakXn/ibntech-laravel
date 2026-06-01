<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('lead')) {
            Schema::rename('lead', 'form_submissions');
        } elseif (Schema::hasTable('leads')) {
            Schema::rename('leads', 'form_submissions');
        }

        if (! Schema::hasTable('form_submissions')) {
            return;
        }

        if (Schema::hasColumn('form_submissions', 'lead_type') && ! Schema::hasColumn('form_submissions', 'form_name')) {
            Schema::table('form_submissions', function (Blueprint $table): void {
                $table->renameColumn('lead_type', 'form_name');
            });
        }

        Schema::table('form_submissions', function (Blueprint $table): void {
            if (! Schema::hasColumn('form_submissions', 'form_name')) {
                $table->string('form_name')->default('general')->after('company');
            }

            if (! Schema::hasColumn('form_submissions', 'page_url')) {
                $table->text('page_url')->nullable()->after('message');
            }

            if (! Schema::hasColumn('form_submissions', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('page_url');
            }

            if (! Schema::hasColumn('form_submissions', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('user_agent');
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('form_submissions')) {
            return;
        }

        Schema::table('form_submissions', function (Blueprint $table): void {
            if (Schema::hasColumn('form_submissions', 'ip_address')) {
                $table->dropColumn('ip_address');
            }

            if (Schema::hasColumn('form_submissions', 'user_agent')) {
                $table->dropColumn('user_agent');
            }

            if (Schema::hasColumn('form_submissions', 'page_url')) {
                $table->dropColumn('page_url');
            }
        });

        if (Schema::hasColumn('form_submissions', 'form_name') && ! Schema::hasColumn('form_submissions', 'lead_type')) {
            Schema::table('form_submissions', function (Blueprint $table): void {
                $table->renameColumn('form_name', 'lead_type');
            });
        }

        Schema::rename('form_submissions', 'leads');
    }
};
