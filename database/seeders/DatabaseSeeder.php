<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedAccount(
            email: (string) env('SEED_ADMIN_EMAIL', 'admin@example.com'),
            name: 'Admin User',
            role: User::ROLE_ADMINISTRATOR,
        );

        $this->seedAccount(
            email: (string) env('SEED_AUTHOR_EMAIL', 'author@example.com'),
            name: 'Author User',
            role: User::ROLE_AUTHOR,
        );

        $this->call(WebsiteSettingSeeder::class);
        $this->call(CmsDemoSeeder::class);
        $this->call(IndustrySeeder::class);
        $this->call(LandingPageSeeder::class);
        $this->call(NewsletterSeeder::class);
        $this->call(WordPressPagesSeeder::class);
    }

    private function seedAccount(string $email, string $name, string $role): void
    {
        if (User::query()->where('email', $email)->exists()) {
            return;
        }

        User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => $this->seedPassword(),
            'role' => $role,
            'is_active' => true,
        ]);
    }

    private function seedPassword(): string
    {
        $password = env('SEED_ADMIN_PASSWORD');

        if (is_string($password) && $password !== '') {
            return $password;
        }

        if (app()->environment('local')) {
            return 'password';
        }

        throw new RuntimeException('Set SEED_ADMIN_PASSWORD before seeding new control-panel users outside the local environment.');
    }
}
