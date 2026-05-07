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
        'alamat_id',
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

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }
}
