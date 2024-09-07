<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelaporan_id',
        'deadline',
    ];

    public function LaporanPerorangan()
    {
        return $this->hasMany(LaporanPerorangan::class);
        
    }
}
