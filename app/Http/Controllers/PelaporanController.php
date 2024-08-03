<?php

namespace App\Http\Controllers;
use App\Models\Pelaporan;
use App\Models\Laporan;
use Carbon\Carbon;
use App\Models\Notaris;
use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    //
    public function index()
    {
        return view('admin.master-data.pelaporan.index', [
            'title' => 'Pelaporan',
            'subtitle' => '',
            'active' => 'pelaporan',
            'datas' => Pelaporan::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.master-data.pelaporan.create', [
            'title' => 'Pelaporan',
            'subtitle' => 'Add Pelaporan',
            'active' => 'pelaporan',
            'notarises' => Notaris::orderBy('id', 'ASC')->get(),
        ]);

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pelaporan_notaris' => 'required',
        ]);

        $notaris = Notaris::FindOrFail($request->pelaporan_notaris);

        $pelaporan = Pelaporan::create([
            'user_id' => $notaris->user_id,
            'nomor_ijin' => $notaris->nomor_ijin,
        ]);

        for ($i = 0; $i < 12; $i++) {
            Laporan::create([
                'deadline' => Carbon::now()->addMonths($i)->endOfMonth()->toDateString(),
                'pelaporan_id' => $pelaporan->id,
            ]);
        }

        return redirect()->route('admin.pelaporan')->with('success', 'Pelaporan has been added!');
    }

    public function edit($id)
    {
        return view('admin.master-data.pelaporan.edit', [
            'title' => 'Pelaporan',
            'subtitle' => 'Edit Pelaporan',
            'active' => 'pelaporan',
            'data' => Pelaporan::findOrFail($id),
            'notarises' => Notaris::orderBy('id', 'ASC')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'pelaporan_notaris' => 'required',
        ]);

        $notaris = Notaris::findOrFail($request->pelaporan_notaris);
        $pelaporan = Pelaporan::findOrFail($id);

        $pelaporan->update([
            'user_id' => $notaris->user_id,
            'nomor_ijin' => $notaris->nomor_ijin,
        ]);

        return redirect()->route('admin.pelaporan')->with('success', 'Pelaporan has been updated!');
    }


    public function destroy($id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->delete();

        return redirect()->route('admin.pelaporan')->with('success', 'Pelaporan has been deleted!');
    }
}
