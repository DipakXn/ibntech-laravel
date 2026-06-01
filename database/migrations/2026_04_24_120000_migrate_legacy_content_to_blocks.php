<?php

use App\Support\BlockContent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['blogs', 'case_studies', 'ebooks'] as $table) {
            DB::table($table)
                ->select(['id', 'content'])
                ->orderBy('id')
                ->chunkById(100, function ($records) use ($table): void {
                    foreach ($records as $record) {
                        DB::table($table)
                            ->where('id', $record->id)
                            ->update([
                                'content' => BlockContent::encode(BlockContent::normalize($record->content)),
                            ]);
                    }
                });
        }
    }

    public function down(): void
    {
        //
    }
};

