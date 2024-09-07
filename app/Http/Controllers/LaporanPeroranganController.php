<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\LaporanPerorangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanPeroranganController extends Controller
{
    //
    public function show($idLaporan)
    {
        $laporan = Laporan::findOrFail($idLaporan);
        $laporan_perorangan = LaporanPerorangan::where('laporan_id', $idLaporan)->get();
        return view('admin.master-data.laporan_perorangan.index', [
            'title' => 'Laporan Perorangan ',
            'subtitle' => 'laporan perorangan',
            'active' => 'pelaporan',
            'datas' => $laporan_perorangan,
            'laporan' => $laporan,
        ]);
    }


    public function showByNotaris($idLaporan)
    {
        $laporan = Laporan::findOrFail($idLaporan);
        $laporan_perorangan = LaporanPerorangan::where('laporan_id', $idLaporan)->get();
        return view('notaris.master-data.laporan_perorangan.index', [
            'title' => 'Laporan Perorangan ',
            'subtitle' => 'laporan perorangan',
            'active' => 'pelaporan',
            'datas' => $laporan_perorangan,
            'laporan' => $laporan,
        ]);
    }

    

    public function create($id)
    {
        // $laporan = Laporan::where('pelaporan_id', $id)->get();
        return view('admin.master-data.laporan_perorangan.create', [
            'title' => 'Laporan Perorangan',
            'subtitle' => 'Add Laporan Perorangan',
            'active' => 'pelaporan',
            'laporan' => Laporan::findOrFail($id),
        ]);
    }

    public function createByNotaris($id)
    {
        // $laporan = Laporan::where('pelaporan_id', $id)->get();
        return view('notaris.master-data.laporan_perorangan.create', [
            'title' => 'Laporan Perorangan',
            'subtitle' => 'Add Laporan Perorangan',
            'active' => 'pelaporan',
            'laporan' => Laporan::findOrFail($id),
        ]);
    }

    public function store(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'laporan_pelaporan' => 'required',
        //     'laporan_no_akta' => 'required|string|max:255',
        //     'laporan_tanggal' => 'required|date',
        //     'laporan_bentuk' => 'required|string|max:255',
        //     'laporan_nama_pihak_memberikan' => 'required|string|max:255',
        //     'laporan_nik_pihak_memberikan' => 'required|string|max:255',
        //     'laporan_alamat_pihak_memberikan' => 'required|string|max:255',
        //     'laporan_pihak_menerima' => 'required|string|max:255',
        //     'laporan_nama_pihak_menerima' => 'required|string|max:255',
        //     'laporan_nik_pihak_menerima' => 'required|string|max:255',
        //     'laporan_jenis_hak' => 'required|string|max:255',
        //     'laporan_letak_tanah' => 'required|string|max:255',
        //     'laporan_tanah' => 'required|integer|min:0',
        //     'laporan_bangunan' => 'required|integer|min:0',
        //     'laporan_harga' => 'required|numeric|min:0',
        //     'laporan_nop' => 'required|string|max:255',
        //     'laporan_njop' => 'required|numeric|min:0',
        //     'laporan_tanggal_ssp' => 'required|date',
        //     'laporan_harga_ssp' => 'required|numeric|min:0',
        //     'laporan_tanggal_ssb' => 'required|date',
        //     'laporan_harga_ssb' => 'required|numeric|min:0',
        //     'laporan_keterangan' => 'nullable|string|max:255',
        // ]);

        LaporanPerorangan::create([
            'akta' => json_encode([
                'no' => $request->laporan_no_akta,
                'tanggal_akta' => $request->laporan_tanggal
            ]),
            'npwp' => json_encode([
                'nama_pihak_memberikan' => $request->laporan_nama_pihak_memberikan,
                'nik_pihak_memberikan' => $request->laporan_nik_pihak_memberikan,
                'alamat_pihak_memberikan' => $request->laporan_alamat_pihak_memberikan,
                'nama_pihak_menerima' => $request->laporan_nama_pihak_menerima,
                'nik_pihak_menerima' => $request->laporan_nik_pihak_menerima,
                'alamat_pihak_menerima' => $request->laporan_alamat_pihak_menerima,
            ]),
            'sppt' => json_encode([
                'nop_tahun' => $request->laporan_nop,
                'njop' => $request->laporan_njop,
            ]),
            'ssp' => json_encode([
                'tanggal_ssp' => $request->laporan_tanggal_ssp,
                'harga_ssp' => $request->laporan_harga_ssp,
            ]),
            'ssb' => json_encode([
                'tanggal_ssb' => $request->laporan_tanggal_ssb,
                'harga_ssb' => $request->laporan_harga_ssb,
            ]),
            'luas' => json_encode([
                'luas_tanah' => $request->laporan_tanah,
                'luas_bangunan' => $request->laporan_bangunan,
            ]),
            'letak_tanah' => $request->laporan_letak_tanah,
            'harga_transaksi' => $request->laporan_harga,
            'bentuk_perbuatan_hukum' => $request->laporan_bentuk,
            'ket' => $request->laporan_keterangan,
            'jenis_nomor' => $request->laporan_jenis_hak,
            'laporan_id' => $id,
            'deadline' => Carbon::now()->addYear()->toDateString(),
        ]);

        return redirect()->route('admin.laporan_perorangan', $id)->with('success', 'Laporan perorangan has been added!');
    }


    public function storeByNotaris(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'laporan_pelaporan' => 'required',
        //     'laporan_no_akta' => 'required|string|max:255',
        //     'laporan_tanggal' => 'required|date',
        //     'laporan_bentuk' => 'required|string|max:255',
        //     'laporan_nama_pihak_memberikan' => 'required|string|max:255',
        //     'laporan_nik_pihak_memberikan' => 'required|string|max:255',
        //     'laporan_alamat_pihak_memberikan' => 'required|string|max:255',
        //     'laporan_pihak_menerima' => 'required|string|max:255',
        //     'laporan_nama_pihak_menerima' => 'required|string|max:255',
        //     'laporan_nik_pihak_menerima' => 'required|string|max:255',
        //     'laporan_jenis_hak' => 'required|string|max:255',
        //     'laporan_letak_tanah' => 'required|string|max:255',
        //     'laporan_tanah' => 'required|integer|min:0',
        //     'laporan_bangunan' => 'required|integer|min:0',
        //     'laporan_harga' => 'required|numeric|min:0',
        //     'laporan_nop' => 'required|string|max:255',
        //     'laporan_njop' => 'required|numeric|min:0',
        //     'laporan_tanggal_ssp' => 'required|date',
        //     'laporan_harga_ssp' => 'required|numeric|min:0',
        //     'laporan_tanggal_ssb' => 'required|date',
        //     'laporan_harga_ssb' => 'required|numeric|min:0',
        //     'laporan_keterangan' => 'nullable|string|max:255',
        // ]);

        LaporanPerorangan::create([
            'akta' => json_encode([
                'no' => $request->laporan_no_akta,
                'tanggal_akta' => $request->laporan_tanggal
            ]),
            'npwp' => json_encode([
                'nama_pihak_memberikan' => $request->laporan_nama_pihak_memberikan,
                'nik_pihak_memberikan' => $request->laporan_nik_pihak_memberikan,
                'alamat_pihak_memberikan' => $request->laporan_alamat_pihak_memberikan,
                'nama_pihak_menerima' => $request->laporan_nama_pihak_menerima,
                'nik_pihak_menerima' => $request->laporan_nik_pihak_menerima,
                'alamat_pihak_menerima' => $request->laporan_alamat_pihak_menerima,
            ]),
            'sppt' => json_encode([
                'nop_tahun' => $request->laporan_nop,
                'njop' => $request->laporan_njop,
            ]),
            'ssp' => json_encode([
                'tanggal_ssp' => $request->laporan_tanggal_ssp,
                'harga_ssp' => $request->laporan_harga_ssp,
            ]),
            'ssb' => json_encode([
                'tanggal_ssb' => $request->laporan_tanggal_ssb,
                'harga_ssb' => $request->laporan_harga_ssb,
            ]),
            'luas' => json_encode([
                'luas_tanah' => $request->laporan_tanah,
                'luas_bangunan' => $request->laporan_bangunan,
            ]),
            'letak_tanah' => $request->laporan_letak_tanah,
            'harga_transaksi' => $request->laporan_harga,
            'bentuk_perbuatan_hukum' => $request->laporan_bentuk,
            'ket' => $request->laporan_keterangan,
            'jenis_nomor' => $request->laporan_jenis_hak,
            'laporan_id' => $id,
            'deadline' => Carbon::now()->addYear()->toDateString(),
        ]);

        return redirect()->route('notaris.laporan_perorangan', $id)->with('success', 'Laporan perorangan has been added!');
    }

    public function edit($id, $idPerorangan)
    {
        return view('admin.master-data.laporan_perorangan.edit', [
            'title' => 'Laporan Perorangan',
            'subtitle' => 'Edit Laporan Perorangan',
            'active' => 'pelaporan',
            'data' => LaporanPerorangan::findOrFail($idPerorangan),
            'laporan' => Laporan::findOrFail($id),
        ]);
    }


    public function editByNotaris($id, $idPerorangan)
    {
        return view('notaris.master-data.laporan_perorangan.edit', [
            'title' => 'Laporan Perorangan',
            'subtitle' => 'Edit Laporan Perorangan',
            'active' => 'pelaporan',
            'data' => LaporanPerorangan::findOrFail($idPerorangan),
            'laporan' => Laporan::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id, $idPerorangan)
    {
        $laporan_perorangan = LaporanPerorangan::findOrFail($idPerorangan);

        // Validate data received from request
        // $validatedData = $request->validate([
        //     'akta_no' => 'required|string|max:255',
        //     'akta_tanggal' => 'required|date',
        //     'bentuk_perbuatan_hukum' => 'required|string|max:255',
        //     'npwp_pihak_memberikan' => 'required|string|max:255',
        //     'npwp_pihak_menerima' => 'required|string|max:255',
        //     'jenis_nomor' => 'required|string|max:255',
        //     'letak_tanah' => 'required|string|max:255',
        //     'luas_tanah' => 'required|integer|min:0',
        //     'luas_bangunan' => 'required|integer|min:0',
        //     'harga_transaksi' => 'required|numeric|min:0',
        //     'sppt_njop' => 'required|numeric|min:0',
        //     'sppt_nop_tahun' => 'required|string|max:255',
        //     'ssp_harga_ssp' => 'required|numeric|min:0',
        //     'ssp_tanggal_ssp' => 'required|date',
        //     'ssb_harga_ssb' => 'required|numeric|min:0',
        //     'ssb_tanggal_ssb' => 'required|date',
        //     'ket' => 'nullable|string|max:255',
        // ]);

        // Update laporan data
        $laporan_perorangan->update([
            'akta' => json_encode([
                'no' => $request->akta_no,
                'tanggal_akta' => $request->akta_tanggal,
            ]),
            'npwp' => json_encode([
                'nama_pihak_memberikan' => $request->nama_pihak_memberikan,
                'nik_pihak_memberikan' => $request->nik_pihak_memberikan,
                'alamat_pihak_memberikan' => $request->alamat_pihak_memberikan,
                'nama_pihak_menerima' => $request->nama_pihak_menerima,
                'nik_pihak_menerima' => $request->nik_pihak_menerima,
                'alamat_pihak_menerima' => $request->alamat_pihak_menerima,
            ]),
            'sppt' => json_encode([
                'nop_tahun' => $request->sppt_nop_tahun,
                'njop' => $request->sppt_njop,
            ]),
            'ssp' => json_encode([
                'tanggal_ssp' => $request->ssp_tanggal_ssp,
                'harga_ssp' => $request->ssp_harga_ssp,
            ]),
            'ssb' => json_encode([
                'tanggal_ssb' => $request->ssb_tanggal_ssb,
                'harga_ssb' => $request->ssb_harga_ssb,
            ]),
            'luas' => json_encode([
                'luas_tanah' => $request->luas_tanah,
                'luas_bangunan' => $request->luas_bangunan,
            ]),
            'letak_tanah' => $request->letak_tanah,
            'harga_transaksi' => $request->harga_transaksi,
            'bentuk_perbuatan_hukum' => $request->bentuk_perbuatan_hukum,
            'ket' => $request->ket,
            'jenis_nomor' => $request->jenis_nomor,
            'laporan_id' => $id,
            'deadline' => Carbon::parse($request->deadline)->toDateString(), // Adjust if necessary
        ]);

        return redirect()->route('admin.laporan_perorangan', $id)->with('success', 'Laporan perorangan has been edited!');

    }

    public function updateByNotaris(Request $request, $id, $idPerorangan)
    {
        $laporan_perorangan = LaporanPerorangan::findOrFail($idPerorangan);

        // Validate data received from request
        // $validatedData = $request->validate([
        //     'akta_no' => 'required|string|max:255',
        //     'akta_tanggal' => 'required|date',
        //     'bentuk_perbuatan_hukum' => 'required|string|max:255',
        //     'npwp_pihak_memberikan' => 'required|string|max:255',
        //     'npwp_pihak_menerima' => 'required|string|max:255',
        //     'jenis_nomor' => 'required|string|max:255',
        //     'letak_tanah' => 'required|string|max:255',
        //     'luas_tanah' => 'required|integer|min:0',
        //     'luas_bangunan' => 'required|integer|min:0',
        //     'harga_transaksi' => 'required|numeric|min:0',
        //     'sppt_njop' => 'required|numeric|min:0',
        //     'sppt_nop_tahun' => 'required|string|max:255',
        //     'ssp_harga_ssp' => 'required|numeric|min:0',
        //     'ssp_tanggal_ssp' => 'required|date',
        //     'ssb_harga_ssb' => 'required|numeric|min:0',
        //     'ssb_tanggal_ssb' => 'required|date',
        //     'ket' => 'nullable|string|max:255',
        // ]);

        // Update laporan data
        $laporan_perorangan->update([
            'akta' => json_encode([
                'no' => $request->akta_no,
                'tanggal_akta' => $request->akta_tanggal,
            ]),
            'npwp' => json_encode([
                'nama_pihak_memberikan' => $request->nama_pihak_memberikan,
                'nik_pihak_memberikan' => $request->nik_pihak_memberikan,
                'alamat_pihak_memberikan' => $request->alamat_pihak_memberikan,
                'nama_pihak_menerima' => $request->nama_pihak_menerima,
                'nik_pihak_menerima' => $request->nik_pihak_menerima,
                'alamat_pihak_menerima' => $request->alamat_pihak_menerima,
            ]),
            'sppt' => json_encode([
                'nop_tahun' => $request->sppt_nop_tahun,
                'njop' => $request->sppt_njop,
            ]),
            'ssp' => json_encode([
                'tanggal_ssp' => $request->ssp_tanggal_ssp,
                'harga_ssp' => $request->ssp_harga_ssp,
            ]),
            'ssb' => json_encode([
                'tanggal_ssb' => $request->ssb_tanggal_ssb,
                'harga_ssb' => $request->ssb_harga_ssb,
            ]),
            'luas' => json_encode([
                'luas_tanah' => $request->luas_tanah,
                'luas_bangunan' => $request->luas_bangunan,
            ]),
            'letak_tanah' => $request->letak_tanah,
            'harga_transaksi' => $request->harga_transaksi,
            'bentuk_perbuatan_hukum' => $request->bentuk_perbuatan_hukum,
            'ket' => $request->ket,
            'jenis_nomor' => $request->jenis_nomor,
            'laporan_id' => $id,
            'deadline' => Carbon::parse($request->deadline)->toDateString(), // Adjust if necessary
        ]);

        return redirect()->route('notaris.laporan_perorangan', $id)->with('success', 'Laporan perorangan has been edited!');

    }

    public function destroy($id, $idPerorangan)
    {
        $laporan = LaporanPerorangan::findOrFail($idPerorangan);
        $laporan->delete();

        return redirect()->route('admin.laporan_perorangan', $id)->with('success', 'Laporan Perorangan has been deleted!');
    }

    public function detailByAdmin($id, $idPerorangan)
    {
        return view('admin.master-data.laporan_perorangan.show', [
            'title' => 'Laporan',
            'subtitle' => 'Edit Laporan',
            'active' => 'pelaporan',
            'data' => LaporanPerorangan::findOrFail($idPerorangan),
            'laporan' => Laporan::findOrFail($id),
        ]);
    }

    public function detailByNotaris($id, $idPerorangan)
    {
        return view('notaris.master-data.laporan_perorangan.show', [
            'title' => 'Laporan',
            'subtitle' => 'Edit Laporan',
            'active' => 'pelaporan',
            'data' => LaporanPerorangan::findOrFail($idPerorangan),
            'laporan' => Laporan::findOrFail($id),
        ]);
    }

    public function showByVerificator($idLaporan)
    {
        $laporan = Laporan::findOrFail($idLaporan);
        $laporan_perorangan = LaporanPerorangan::where('laporan_id', $idLaporan)->get();
        return view('verificator.master-data.laporan_perorangan.index', [
            'title' => 'Laporan Perorangan ',
            'subtitle' => 'laporan perorangan',
            'active' => 'pelaporan',
            'datas' => $laporan_perorangan,
            'laporan' => $laporan,
        ]);
    }

    public function detailByVerificator($id, $idPerorangan)
    {
        return view('verificator.master-data.laporan_perorangan.show', [
            'title' => 'Laporan',
            'subtitle' => 'Edit Laporan',
            'active' => 'pelaporan',
            'data' => LaporanPerorangan::findOrFail($idPerorangan),
            'laporans' => Laporan::findOrFail($id),
        ]);
    }

    public function verifikasiByVerificator($id, $idPerorangan)
    {

        $laporan = LaporanPerorangan::find($idPerorangan);
        // Update laporan data
        $laporan->update([
            'status' => 'selesai',
        ]);

        return redirect()->route('verificator.laporan_perorangan', $id)->with('success', 'Laporan perorangan has been updated!');
    }

    public function tolakByVerificator($id, $idPerorangan)
    {

        $laporan = LaporanPerorangan::find($idPerorangan);
        // Update laporan data
        $laporan->update([
            'status' => 'tolak',
        ]);

        return redirect()->route('verificator.laporan_perorangan', $id)->with('success', 'Laporan Perorangan has been updated!');
    }


}
