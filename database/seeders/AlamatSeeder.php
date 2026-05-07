<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alamats')->insert([
            [
                'dusun' => 'Warung Nangka',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dusun' => 'Krajan Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dusun' => 'Krajan Timur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dusun' => 'Tanjung Baru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dusun' => 'Tanjung Asem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dusun' => 'Wanarasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dusun' => 'Wanajaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dusun' => 'Babakan Maja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dusun' => 'Marjim',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
