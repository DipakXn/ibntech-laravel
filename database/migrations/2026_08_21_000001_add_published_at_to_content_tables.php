<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @var list<string>
     */
    private array $tables = [
        'pages',
        'industries',
        'case_studies',
        'landing_pages',
        'press_releases',
        'ebooks',
        'white_papers',
        'articles',
        'newsletters',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            if (! Schema::hasTable($tableName) || Schema::hasColumn($tableName, 'published_at')) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) {
                $table->dateTime('published_at')->nullable()->after('status')->index();
            });
        }

        foreach ($this->tables as $tableName) {
            if (! Schema::hasTable($tableName) || ! Schema::hasColumn($tableName, 'published_at')) {
                continue;
            }

            DB::table($tableName)
                ->whereNull('published_at')
                ->update(['published_at' => DB::raw('created_at')]);
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (! Schema::hasTable($tableName) || ! Schema::hasColumn($tableName, 'published_at')) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('published_at');
            });
        }
    }
};
