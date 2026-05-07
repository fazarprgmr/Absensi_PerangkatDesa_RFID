<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatans')->insert([
            [
                'nama_jabatan' => 'Sekretaris Desa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Kasi Pem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Kasi Kesra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Kaur Bendahara',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Kaur Umum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Ka.Satgas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Staf Desa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jabatan' => 'Kepala Dusun',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ]);
    }
}
