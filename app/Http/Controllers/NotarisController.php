<?php

namespace App\Http\Controllers;
use App\Models\Notaris;
use App\Models\User;
use Illuminate\Http\Request;

class NotarisController extends Controller
{
    //
    public function index()
    {
        return view('admin.master-data.notaris.index', [
            'title' => 'Notaris',
            'subtitle' => '',
            'active' => 'notaris',
            'datas' => Notaris::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.master-data.notaris.create', [
            'title' => 'Notaris',
            'subtitle' => 'Add Notaris',
            'active' => 'notaris',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'notaris_name' => 'required|max:255',
            'notaris_no_ijin' => 'required|max:255',
            'notaris_alamat' => 'required',
            'notaris_no_telp' => 'required|numeric', 
            'notaris_email' => 'required||unique:users,email', 
            'notaris_password' => 'required|min:8', 
            'notaris_jabatan' => 'required', 
            'notaris_wilayah' => 'required|max:255',
            'notaris_ijin_terbit' => 'required|date',
        ]);

        $user = User::create([
            'name' => $request->notaris_name,
            'email' => $request->notaris_email,
            'password' => bcrypt($request->notaris_password), // Pastikan menggunakan field yang benar
            'role_id' => 2, // Sesuaikan dengan kebutuhan
        ]);

        Notaris::create([
            'user_id' => $user->id, // Menggunakan ID pengguna yang baru dibuat
            'nomor_ijin' => $request->notaris_no_ijin,
            'alamat' => $request->notaris_alamat,
            'telepon' => $request->notaris_no_telp,
            'jabatan' => $request->notaris_jabatan,
            'wilayah_kerja' => $request->notaris_wilayah,
            'tanggal_ijin' => $request->notaris_ijin_terbit,
        ]);

        return redirect()->route('admin.notaris')->with('success', 'Notaris has been added!');
    }

    public function edit($id)
    {
        return view('admin.master-data.notaris.edit', [
            'title' => 'Notaris',
            'subtitle' => 'Edit Notaris',
            'active' => 'notaris',
            'data' => Notaris::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $notaris = Notaris::findOrFail($id);
        $user = $notaris->user;
    
        // Validasi input
        $validatedData = $request->validate([
            'notaris_name' => 'required|max:255',
            'notaris_no_ijin' => 'required|max:255',
            'notaris_alamat' => 'required',
            'notaris_no_telp' => 'required|numeric',
            'notaris_email' => [
                'required',
                'email',
                // Validasi email unik hanya jika email diubah
                function($attribute, $value, $fail) use ($user) {
                    if ($value !== $user->email && User::where('email', $value)->exists()) {
                        $fail('The email has already been taken.');
                    }
                },
            ],
            'notaris_password' => 'nullable|min:8|confirmed',
            'notaris_jabatan' => 'required',
            'notaris_wilayah' => 'required|max:255',
            'notaris_ijin_terbit' => 'required|date',
        ]);
    
        // Update user data
        $user->name = $request->notaris_name;
        $user->email = $request->notaris_email;
    
        // Update password hanya jika diisi
        if ($request->filled('notaris_password')) {
            $user->password = bcrypt($request->notaris_password);
        }
    
        $user->save();
    
        // Update notaris data
        $notaris->update([
            'nomor_ijin' => $request->notaris_no_ijin,
            'alamat' => $request->notaris_alamat,
            'telepon' => $request->notaris_no_telp,
            'jabatan' => $request->notaris_jabatan,
            'wilayah_kerja' => $request->notaris_wilayah,
            'tanggal_ijin' => $request->notaris_ijin_terbit,
        ]);
    
        return redirect()->route('admin.notaris')->with('success', 'Notaris has been updated!');
    }

    public function destroy($id)
    {
        $notaris = Notaris::findOrFail($id);
        $notaris->delete();

        return redirect()->route('admin.notaris')->with('success', 'Notaris has been deleted!');
    }
    
}
