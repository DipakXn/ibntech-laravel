<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('content_redirects', function (Blueprint $table) {
            $table->string('match_type', 32)->default('exact')->after('status_code');
            $table->boolean('ignore_case')->default(false)->after('match_type');
        });
    }

    public function down(): void
    {
        Schema::table('content_redirects', function (Blueprint $table) {
            $table->dropColumn(['match_type', 'ignore_case']);
        });
    }
};
