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
        'telepon',
        'user_id',
        'jabatan',
        'wilayah_kerja',
        'tanggal_ijin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
