<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $fillable = [
        'tahun',
    ];

    public function pelaporan()
    {
        return $this->hasMany(Pelaporan::class);
    }
}
