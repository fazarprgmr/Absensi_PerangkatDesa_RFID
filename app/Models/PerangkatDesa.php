<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerangkatDesa extends Model
{
    protected $fillable = [
        'nik',
        'nama',
        'jabatan_id',
        'dusun',
        'rt',
        'rw',
        'jenis_kelamin',
        'no_hp',
        'foto',
        'rfid_uid'
    ];

    public function kehadirans() : HasMany
    {
        return $this->hasMany(Kehadiran::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
