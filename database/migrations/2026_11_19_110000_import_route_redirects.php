<?php

use App\Support\Redirects\ImportedRouteRedirects;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_redirects', function (Blueprint $table) {
            $table->unsignedSmallInteger('status_code')->default(301)->after('target_path');
            $table->unsignedInteger('hits')->default(0)->after('is_active');
            $table->timestamp('last_accessed_at')->nullable()->after('hits');
            $table->softDeletes();
        });

        $now = now();

        foreach (ImportedRouteRedirects::definitions() as $row) {
            $exists = DB::table('content_redirects')->where('source_path', $row['source'])->exists();

            if ($exists) {
                continue;
            }

            DB::table('content_redirects')->insert([
                'source_path' => $row['source'],
                'target_path' => $row['target'],
                'status_code' => $row['status'],
                'is_active' => true,
                'origin' => 'legacy',
                'hits' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        DB::table('content_redirects')->where('origin', 'legacy')->delete();

        Schema::table('content_redirects', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn(['status_code', 'hits', 'last_accessed_at']);
        });
    }
};
