<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('media', function (Blueprint $table) {
            if (! Schema::hasColumn('media', 'model_type')) {
                $table->nullableMorphs('model');
            }

            if (! Schema::hasColumn('media', 'uuid')) {
                $table->uuid('uuid')->nullable()->unique()->after('id');
            }

            if (! Schema::hasColumn('media', 'collection_name')) {
                $table->string('collection_name')->default('default')->after('uuid');
            }

            if (! Schema::hasColumn('media', 'name')) {
                $table->string('name')->nullable()->after('collection_name');
            }

            if (! Schema::hasColumn('media', 'file_name')) {
                $table->string('file_name')->nullable()->after('name');
            }

            if (! Schema::hasColumn('media', 'conversions_disk')) {
                $table->string('conversions_disk')->nullable()->after('disk');
            }

            if (! Schema::hasColumn('media', 'size')) {
                $table->unsignedBigInteger('size')->default(0)->after('conversions_disk');
            }

            if (! Schema::hasColumn('media', 'manipulations')) {
                $table->json('manipulations')->nullable()->after('size');
            }

            if (! Schema::hasColumn('media', 'custom_properties')) {
                $table->json('custom_properties')->nullable()->after('manipulations');
            }

            if (! Schema::hasColumn('media', 'generated_conversions')) {
                $table->json('generated_conversions')->nullable()->after('custom_properties');
            }

            if (! Schema::hasColumn('media', 'responsive_images')) {
                $table->json('responsive_images')->nullable()->after('generated_conversions');
            }

            if (! Schema::hasColumn('media', 'order_column')) {
                $table->unsignedInteger('order_column')->nullable()->index()->after('responsive_images');
            }
        });

        if (Schema::hasColumn('media', 'mediable_type') && Schema::hasColumn('media', 'model_type')) {
            DB::table('media')
                ->whereNull('model_type')
                ->update([
                    'model_type' => DB::raw('mediable_type'),
                    'model_id' => DB::raw('mediable_id'),
                ]);
        }

        if (Schema::hasColumn('media', 'path') && Schema::hasColumn('media', 'file_name')) {
            DB::table('media')
                ->whereNull('file_name')
                ->update([
                    'file_name' => DB::raw('path'),
                    'name' => DB::raw('COALESCE(title, path)'),
                ]);
        }

        DB::table('media')->whereNull('manipulations')->update(['manipulations' => '{}']);
        DB::table('media')->whereNull('custom_properties')->update(['custom_properties' => '{}']);
        DB::table('media')->whereNull('generated_conversions')->update(['generated_conversions' => '{}']);
        DB::table('media')->whereNull('responsive_images')->update(['responsive_images' => '{}']);
    }

    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            foreach ([
                'order_column',
                'responsive_images',
                'generated_conversions',
                'custom_properties',
                'manipulations',
                'size',
                'conversions_disk',
                'file_name',
                'name',
                'collection_name',
                'uuid',
            ] as $column) {
                if (Schema::hasColumn('media', $column)) {
                    $table->dropColumn($column);
                }
            }

            if (Schema::hasColumn('media', 'model_type')) {
                $table->dropMorphs('model');
            }
        });
    }
};
