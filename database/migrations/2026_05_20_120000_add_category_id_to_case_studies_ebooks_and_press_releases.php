<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('case_studies', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete()->after('featured_image');
        });

        Schema::table('ebooks', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete()->after('featured_image');
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete()->after('featured_image');
        });
    }

    public function down(): void
    {
        Schema::table('case_studies', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });

        Schema::table('ebooks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });

        Schema::table('press_releases', function (Blueprint $table) {
            $table->dropConstrainedForeignId('category_id');
        });
    }
};
