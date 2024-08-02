<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_ijin',
    ];

    public function laporan ()
    {
        return $this->hasMany(Laporan::class);
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
