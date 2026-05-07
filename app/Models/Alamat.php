<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alamat extends Model
{
    protected $fillable = [
        'dusun'
    ];

    public function perangkatDesas() : HasMany
    {
        return $this->hasMany(PerangkatDesa::class);
    }
}
