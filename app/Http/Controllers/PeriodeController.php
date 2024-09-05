<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    //
    public function show()
    {
        return view('admin.master-data.periode.index', [
            'title' => 'Periode',
            'subtitle' => 'periode',
            'active' => 'periode',
            'datas' => Periode::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.master-data.periode.create', [
            'title' => 'Periode',
            'subtitle' => 'Add Periode',
            'active' => 'periode',
            'periode' => Periode::orderBy('id', 'ASC')->get(),
        ]);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'tahun' => 'required',
        ]);

        Periode::create([
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('admin.periode')->with('success', 'Periode has been added!');
    }

    public function edit($id)
    {
        return view('admin.master-data.periode.edit', [
            'title' => 'Periode',
            'subtitle' => 'Edit Periode',
            'active' => 'periode',
            'data' => Periode::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $periode = Periode::findOrFail($id);

        // Validate data received from request
        $validatedData = $request->validate([
            'tahun' => 'required',
        ]);

        // Update laporan data
        $periode->update([
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('admin.periode')->with('success', 'Periode has been updated!');
    }


}
