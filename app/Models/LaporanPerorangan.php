<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPerorangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'akta',
        'bentuk_perbuatan_hukum',
        'npwp',
        'jenis_nomor',
        'letak_tanah',
        'luas',
        'harga_transaksi',
        'sppt',
        'ssp',
        'ssb',
        'ket',
        'status',
    ];
}
