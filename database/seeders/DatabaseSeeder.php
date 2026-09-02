<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => 'password',
                'role' => User::ROLE_ADMINISTRATOR,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'author@example.com'],
            [
                'name' => 'Author User',
                'password' => 'password',
                'role' => User::ROLE_AUTHOR,
            ]
        );

        $this->call(WebsiteSettingSeeder::class);
        $this->call(CmsDemoSeeder::class);
        $this->call(IndustrySeeder::class);
        $this->call(LandingPageSeeder::class);
        $this->call(NewsletterSeeder::class);
        $this->call(WordPressPagesSeeder::class);
    }
}
