<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notaris extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_ijin',
        'alamat',
        'teleoin',
        'user_id',
        'wilayah_kerja',
        'tanggal_ijin',
    ];
}
