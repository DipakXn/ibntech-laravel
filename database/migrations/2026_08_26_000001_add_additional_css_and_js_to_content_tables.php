<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @var list<string>
     */
    private array $tables = [
        'blogs',
        'articles',
        'case_studies',
        'ebooks',
        'press_releases',
        'white_papers',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            if (! Schema::hasTable($tableName)) {
                continue;
            }

            if (! Schema::hasColumn($tableName, 'additional_css')) {
                Schema::table($tableName, function (Blueprint $table): void {
                    $table->longText('additional_css')->nullable()->after('content');
                });
            }

            if (! Schema::hasColumn($tableName, 'additional_js')) {
                Schema::table($tableName, function (Blueprint $table): void {
                    $table->longText('additional_js')->nullable()->after('additional_css');
                });
            }
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (! Schema::hasTable($tableName)) {
                continue;
            }

            $columns = array_values(array_filter([
                Schema::hasColumn($tableName, 'additional_css') ? 'additional_css' : null,
                Schema::hasColumn($tableName, 'additional_js') ? 'additional_js' : null,
            ]));

            if ($columns === []) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) use ($columns): void {
                $table->dropColumn($columns);
            });
        }
    }
};
