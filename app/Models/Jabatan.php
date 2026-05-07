<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jabatan extends Model
{
    protected $fillable = [
        'nama_jabatan'
    ];

    public function perangkatDesas() : HasMany
    {
        return $this->hasMany(PerangkatDesa::class);
    }
}
