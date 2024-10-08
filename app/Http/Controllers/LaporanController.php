<?php

namespace App\Http\Controllers;

use App\Exports\PelaporanExport;
use App\Models\Laporan;
use App\Models\LaporanPerorangan;
use Carbon\Carbon;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class LaporanController extends Controller
{
    //
    public function show($id)
    {
        $pelaporan = Pelaporan::find($id);
        $laporan = Laporan::where('pelaporan_id', $id)->get();
        return view('admin.master-data.laporan.index', [
            'title' => 'Laporan ' . $pelaporan->nomor_ijin,
            'subtitle' => 'laporan',
            'active' => 'pelaporan',
            'datas' => $laporan,
            'pelaporan' => $pelaporan,
        ]);
    }

    public function create()
    {
        // $laporan = Laporan::where('pelaporan_id', $id)->get();
        return view('admin.master-data.laporan.create', [
            'title' => 'Laporan',
            'subtitle' => 'Add Laporan',
            'active' => 'laporan',
            'pelaporans' => Pelaporan::orderBy('user_id', 'ASC')->get(),
        ]);
    }

    public function export($id)
    {
        // Find the pelaporan record by its ID and load its 'laporan' relationship
        $pelaporan = Pelaporan::find($id);
    
        if (!$pelaporan) {
            return redirect()->back()->withErrors(['Pelaporan not found.']);
        }
    
        // Assuming 'laporan' is a relationship on the 'Pelaporan' model
        $laporan = $pelaporan->laporan;
    
        $data = [];
    
        // Iterate through each 'laporan'
        foreach ($laporan as $laporanItem) {
            // Assuming 'LaporanPerorangan' is a relationship on the 'laporan' model
            foreach ($laporanItem->LaporanPerorangan as $perorangan) {
                // Append the $perorangan object to the $data array
                $data[] = $perorangan;
            }
        }
    
        // Load the view and pass the 'data' variable, specifying the paper size as A4 and landscape orientation
        $pdf = PDF::loadView('pelaporan_pdf', ['laporan' => $data])
            ->setPaper('a4', 'landscape');
    
        // Return the generated PDF as a download
        return $pdf->download('pelaporan.pdf');
    }
    


    public function ocr(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $pelaporan = Pelaporan::find($id);

        if (!$pelaporan) {
            return response()->json(['error' => 'Pelaporan not found'], 404);
        }

        $file = $request->file('file');
        $response = Http::attach(
            'image',
            file_get_contents($file),
            $file->getClientOriginalName()
        )->post('https://ocr.api.noctdev.tech/ocr/process/');

        if ($response->successful()) {
            $data = $response->json();
            $data = array_slice($data, 2); // This gets the array starting from index 2

            foreach ($data as $index => $row) {
                $dateString = $row['Tanggal'] ?? null;

                if ($dateString) {
                    $date = \DateTime::createFromFormat('j-M-y', $dateString);

                    if ($date) {
                        $month = $date->format('m');  // Numeric month
                        $monthName = $date->format('F');  // Full month name
                    } else {
                        continue; // Skip if date parsing fails
                    }
                } else {
                    continue; // Skip if date is not provided
                }

                // Check if laporan exists with the deadline month
                $laporans = $pelaporan->laporan;
                foreach ($laporans as $laporan) {
                    $date = Carbon::parse($laporan->deadline);
                    if ($date->format('m') == $month) {
                        LaporanPerorangan::create([
                            'akta' => json_encode([
                                'no' => $row['No. URUT'] ?? null,
                                'tanggal_akta' => $row['Tanggal'] ?? null
                            ]),
                            'npwp' => json_encode([
                                'pihak_memberikan' => $row['Pihak Yang Mengalihkan/Memberikan'] ?? null,
                                'pihak_menerima' => $row['Pihak Yang Menerima'] ?? null,
                            ]),
                            'sppt' => json_encode([
                                'nop_tahun' => $row['NOP TAHUN'] ?? null,
                                'njop' => $row['NJOP (Rp.000)'] ?? null,
                            ]),
                            'ssp' => json_encode([
                                'tanggal_ssp' => $row['SSP TGL'] ?? null,
                                'harga_ssp' => $row['SSP (Rp.000)'] ?? null,
                            ]),
                            'ssb' => json_encode([
                                'tanggal_ssb' => $row['SSB TGL'] ?? null,
                                'harga_ssb' => $row['SSB (Rp.000)'] ?? null,
                            ]),
                            'luas' => json_encode([
                                'luas_tanah' => $row['Tanah'] ?? null,
                                'luas_bangunan' => $row['Bgn'] ?? null,
                            ]),
                            'letak_tanah' => $row['Letak Tanah dan Bangunan'] ?? null,
                            'harga_transaksi' => $row['Harga Transaksi Perolehan/Pengalihan'] ?? null,
                            'bentuk_perbuatan_hukum' => $row['Bentuk Perbuatan Hukum'] ?? null,
                            'ket' => $row['Ket'] ?? null,
                            'jenis_nomor' => $row['Jenis dan Nomor Hak'] ?? null,
                            'laporan_id' => $laporan->id,
                            'status' => 'proses',
                        ]);
                    }

                }


            }

            return redirect()->back()->with('success', 'Laporan has been added!');
        } else {
            return response()->json(['error' => 'Failed to process file'], 500);
        }
    }



    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'laporan_pelaporan' => 'required',
            'laporan_no_akta' => 'required|string|max:255',
            'laporan_tanggal' => 'required|date',
            'laporan_bentuk' => 'required|string|max:255',
            'laporan_pihak_memberikan' => 'required|string|max:255',
            'laporan_pihak_menerima' => 'required|string|max:255',
            'laporan_jenis_hak' => 'required|string|max:255',
            'laporan_letak_tanah' => 'required|string|max:255',
            'laporan_tanah' => 'required|integer|min:0',
            'laporan_bangunan' => 'required|integer|min:0',
            'laporan_harga' => 'required|numeric|min:0',
            'laporan_nop' => 'required|string|max:255',
            'laporan_njop' => 'required|numeric|min:0',
            'laporan_tanggal_ssp' => 'required|date',
            'laporan_harga_ssp' => 'required|numeric|min:0',
            'laporan_tanggal_ssb' => 'required|date',
            'laporan_harga_ssb' => 'required|numeric|min:0',
            'laporan_keterangan' => 'nullable|string|max:255',
        ]);

        Laporan::create([
            'akta' => json_encode([
                'no' => $request->laporan_no_akta,
                'tanggal_akta' => $request->laporan_tanggal
            ]),
            'npwp' => json_encode([
                'pihak_memberikan' => $request->laporan_pihak_memberikan,
                'pihak_menerima' => $request->laporan_pihak_menerima,
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
            'pelaporan_id' => $request->laporan_pelaporan,
            'deadline' => Carbon::now()->addYear()->toDateString(),
        ]);

        return redirect()->route('admin.laporan')->with('success', 'Laporan has been added!');
    }

    public function edit($id)
    {
        return view('admin.master-data.laporan.edit', [
            'title' => 'Laporan',
            'subtitle' => 'Edit Laporan',
            'active' => 'pelaporan',
            'data' => Laporan::findOrFail($id),
            'pelaporans' => Pelaporan::orderBy('id', 'ASC')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        // Validate data received from request
        $validatedData = $request->validate([
            'akta_no' => 'required|string|max:255',
            'akta_tanggal' => 'required|date',
            'bentuk_perbuatan_hukum' => 'required|string|max:255',
            'npwp_pihak_memberikan' => 'required|string|max:255',
            'npwp_pihak_menerima' => 'required|string|max:255',
            'jenis_nomor' => 'required|string|max:255',
            'letak_tanah' => 'required|string|max:255',
            'luas_tanah' => 'required|integer|min:0',
            'luas_bangunan' => 'required|integer|min:0',
            'harga_transaksi' => 'required|numeric|min:0',
            'sppt_njop' => 'required|numeric|min:0',
            'sppt_nop_tahun' => 'required|string|max:255',
            'ssp_harga_ssp' => 'required|numeric|min:0',
            'ssp_tanggal_ssp' => 'required|date',
            'ssb_harga_ssb' => 'required|numeric|min:0',
            'ssb_tanggal_ssb' => 'required|date',
            'ket' => 'nullable|string|max:255',
        ]);

        // Update laporan data
        $laporan->update([
            'akta' => json_encode([
                'no' => $request->akta_no,
                'tanggal_akta' => $request->akta_tanggal,
            ]),
            'npwp' => json_encode([
                'pihak_memberikan' => $request->npwp_pihak_memberikan,
                'pihak_menerima' => $request->npwp_pihak_menerima,
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
            'deadline' => Carbon::parse($request->deadline)->toDateString(), // Adjust if necessary
        ]);

        return redirect()->route('admin.laporan')->with('success', 'Laporan has been updated!');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.pelaporan')->with('success', 'Laporan has been deleted!');
    }

    public function showByNotaris($id)
    {
        $pelaporan = Pelaporan::find($id);
        $laporan = Laporan::where('pelaporan_id', $id)->get();
        return view('notaris.master-data.laporan.index', [
            'title' => 'Laporan ' . $pelaporan->nomor_ijin,
            'subtitle' => 'laporan',
            'active' => 'pelaporan',
            'datas' => $laporan,
            'pelaporan' => $pelaporan,
        ]);
    }

    public function editByNotaris($id)
    {
        return view('notaris.master-data.laporan.edit', [
            'title' => 'Laporan',
            'subtitle' => 'Edit Laporan',
            'active' => 'pelaporan',
            'data' => Laporan::findOrFail($id),
            'pelaporans' => Pelaporan::orderBy('id', 'ASC')->get(),
        ]);
    }

    public function updateByNotaris(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);

        // Validate data received from request
        $validatedData = $request->validate([
            'akta_no' => 'required|string|max:255',
            'akta_tanggal' => 'required|date',
            'bentuk_perbuatan_hukum' => 'required|string|max:255',
            'npwp_pihak_memberikan' => 'required|string|max:255',
            'npwp_pihak_menerima' => 'required|string|max:255',
            'jenis_nomor' => 'required|string|max:255',
            'letak_tanah' => 'required|string|max:255',
            'luas_tanah' => 'required|integer|min:0',
            'luas_bangunan' => 'required|integer|min:0',
            'harga_transaksi' => 'required|numeric|min:0',
            'sppt_njop' => 'required|numeric|min:0',
            'sppt_nop_tahun' => 'required|string|max:255',
            'ssp_harga_ssp' => 'required|numeric|min:0',
            'ssp_tanggal_ssp' => 'required|date',
            'ssb_harga_ssb' => 'required|numeric|min:0',
            'ssb_tanggal_ssb' => 'required|date',
            'ket' => 'nullable|string|max:255',
        ]);

        // Update laporan data
        $laporan->update([
            'akta' => json_encode([
                'no' => $request->akta_no,
                'tanggal_akta' => $request->akta_tanggal,
            ]),
            'npwp' => json_encode([
                'pihak_memberikan' => $request->npwp_pihak_memberikan,
                'pihak_menerima' => $request->npwp_pihak_menerima,
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
            'status' => 'proses',
            'deadline' => Carbon::parse($request->deadline)->toDateString(), // Adjust if necessary
        ]);

        return redirect()->route('notaris.pelaporan')->with('success', 'Laporan has been updated!');
    }

    public function detailByNotaris($id)
    {
        return view('notaris.master-data.laporan.show', [
            'title' => 'Laporan',
            'subtitle' => 'Edit Laporan',
            'active' => 'pelaporan',
            'data' => Laporan::findOrFail($id),
            'pelaporans' => Pelaporan::orderBy('id', 'ASC')->get(),
        ]);
    }

    public function showByVerificator($id)
    {
        $pelaporan = Pelaporan::find($id);
        $laporan = Laporan::where('pelaporan_id', $id)->get();
        return view('verificator.master-data.laporan.index', [
            'title' => 'Laporan ' . $pelaporan->nomor_ijin,
            'subtitle' => 'laporan',
            'active' => 'pelaporan',
            'datas' => $laporan,
            'pelaporan' => $pelaporan,
        ]);
    }

    public function detailByVerificator($id)
    {
        return view('verificator.master-data.laporan.show', [
            'title' => 'Laporan',
            'subtitle' => 'Edit Laporan',
            'active' => 'pelaporan',
            'data' => Laporan::findOrFail($id),
            'pelaporans' => Pelaporan::orderBy('id', 'ASC')->get(),
        ]);
    }

    public function verifikasiByVerificator($id)
    {

        $laporan = Laporan::find($id);
        // Update laporan data
        $laporan->update([
            'status' => 'selesai',
        ]);

        return redirect()->route('verificator.pelaporan')->with('success', 'Laporan has been updated!');
    }

    public function tolakByVerificator($id)
    {

        $laporan = Laporan::find($id);
        // Update laporan data
        $laporan->update([
            'status' => 'tolak',
        ]);

        return redirect()->route('verificator.pelaporan')->with('success', 'Laporan has been updated!');
    }



}
