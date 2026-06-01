<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    public function up(): void
    {
        $mediaItems = DB::table('media')
            ->where('model_type', App\Models\Blog::class)
            ->where('collection_name', 'featured_image')
            ->where('disk', 'local')
            ->get(['id', 'file_name']);

        foreach ($mediaItems as $media) {
            $source = $media->id.'/'.$media->file_name;

            if (Storage::disk('local')->exists($source) && ! Storage::disk('public')->exists($source)) {
                Storage::disk('public')->put($source, Storage::disk('local')->get($source));
            }

            DB::table('media')
                ->where('id', $media->id)
                ->update([
                    'disk' => 'public',
                    'conversions_disk' => 'public',
                ]);
        }
    }

    public function down(): void
    {
        DB::table('media')
            ->where('model_type', App\Models\Blog::class)
            ->where('collection_name', 'featured_image')
            ->where('disk', 'public')
            ->update([
                'disk' => 'local',
                'conversions_disk' => 'local',
            ]);
    }
};
