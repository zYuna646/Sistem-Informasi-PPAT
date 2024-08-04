<?php
namespace App\Exports;

use App\Models\Pelaporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PelaporanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $id;

    /**
     * Create a new instance with the given ID.
     *
     * @param int $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pelaporan::where('id', $this->id)->with('laporan')->get();
    }

    /**
     * @param mixed $pelaporan
     *
     * @return array
     */
    public function map($pelaporan): array
    {
        $mappedData = [];

        foreach ($pelaporan->laporan as $laporan) {
            $mappedData[] = [
                $laporan->akta['no'] ?? '',
                $laporan->akta['tanggal_akta'] ?? '',
                $laporan->bentuk_perbuatan_hukum ?? '',
                $laporan->npwp['pihak_memberikan'] ?? '',
                $laporan->npwp['pihak_menerima'] ?? '',
                $laporan->jenis_nomor ?? '',
                $laporan->letak_tanah ?? '',
                $laporan->luas['luas_tanah'] ?? '',
                $laporan->luas['luas_bangunan'] ?? '',
                $laporan->harga_transaksi ?? '',
                $laporan->sppt['nop_tahun'] ?? '',
                $laporan->sppt['njop'] ?? '',
                $laporan->ssp['tanggal_ssp'] ?? '',
                $laporan->ssp['harga_ssp'] ?? '',
                $laporan->ssb['tanggal_ssb'] ?? '',
                $laporan->ssb['harga_ssb'] ?? '',
                $laporan->ket ?? '',
            ];
        }

        return $mappedData;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Akta No.',
            'Akta Tanggal',
            'Bentuk Perbuatan Hukum',
            'NPWP Pihak Memberikan',
            'NPWP Pihak Menerima',
            'Jenis dan Nomor Hak',
            'Letak Tanah dan Bangunan',
            'Luas Tanah',
            'Luas Bangunan',
            'Harga Transaksi',
            'SPPT NOP Tahun',
            'SPPT NJOP',
            'SSP Tanggal',
            'SSP Harga',
            'SSB Tanggal',
            'SSB Harga',
            'Keterangan',
        ];
    }
}
