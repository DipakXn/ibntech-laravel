<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Existing publish dates stay as stored. A published row whose date is
     * still in the future is not live, so its status becomes scheduled.
     *
     * @var list<string>
     */
    private array $tables = [
        'blogs',
        'articles',
        'case_studies',
        'ebooks',
        'white_papers',
        'press_releases',
    ];

    public function up(): void
    {
        $now = now();

        DB::transaction(function () use ($now): void {
            foreach ($this->tables as $table) {
                DB::table($table)
                    ->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '>', $now)
                    ->update(['status' => 'scheduled']);
            }
        });
    }

    public function down(): void
    {
        DB::transaction(function (): void {
            foreach ($this->tables as $table) {
                DB::table($table)
                    ->where('status', 'scheduled')
                    ->update(['status' => 'published']);
            }
        });
    }
};
