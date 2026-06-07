<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengaturan::create([
            'jam_masuk' => '08:00:00',
            'jam_toleransi' => '08:30:00',
            'jam_pulang' => '14:00:00',
            'nama_kades' => 'Mista Rangun',
            'nip_kades' => '-', // Beri tanda strip jika tidak ada NIP
        ]);
    }
}
