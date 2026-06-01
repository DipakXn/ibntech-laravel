<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')
            ->where('email', 'admin@example.com')
            ->update(['role' => User::ROLE_ADMINISTRATOR]);

        DB::table('users')
            ->whereNull('role')
            ->orWhere('role', '')
            ->update(['role' => User::ROLE_AUTHOR]);
    }

    public function down(): void
    {
        DB::table('users')
            ->where('email', 'admin@example.com')
            ->update(['role' => User::ROLE_AUTHOR]);
    }
};
