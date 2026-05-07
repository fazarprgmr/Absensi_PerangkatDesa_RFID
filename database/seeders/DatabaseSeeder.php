<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\AlamatSeeder;
use Database\Seeders\JabatanSeeder;
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin123'),
        ]);

        $this->call([
            JabatanSeeder::class,
            AlamatSeeder::class
        ]);
    }
}
