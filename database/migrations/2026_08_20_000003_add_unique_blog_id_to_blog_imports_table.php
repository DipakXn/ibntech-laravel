<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_imports', function (Blueprint $table) {
            $table->unique('blog_id');
        });
    }

    public function down(): void
    {
        Schema::table('blog_imports', function (Blueprint $table) {
            $table->dropUnique(['blog_id']);
        });
    }
};
