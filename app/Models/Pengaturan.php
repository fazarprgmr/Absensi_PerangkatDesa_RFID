<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;
    
    protected $fillable = ['jam_masuk', 'jam_toleransi', 'jam_pulang', 'nama_kades', 'nip_kades'];
}
