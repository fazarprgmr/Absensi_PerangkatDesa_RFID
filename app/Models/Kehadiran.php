<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $fillable = [
        'perangkat_desa_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status_kehadiran',
        'status_ketepatan',
    ];

    public function perangkatDesa()
    {
        return $this->belongsTo(PerangkatDesa::class);
    }
}
