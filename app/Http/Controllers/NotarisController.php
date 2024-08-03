<?php

namespace App\Http\Controllers;
use App\Models\Notaris;
use App\Models\User;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Video;
use App\Models\Information;
use Illuminate\Http\Request;

class NotarisController extends Controller
{
    //
    public function index()
    {
        $count_catalog = Catalog::count();
        $count_category = Category::count();
        $count_video = Video::count();
        $count_information = Information::count();

        $latest_products = Catalog::orderBy('created_at', 'desc')->take(5)->get();
        $latest_video = Video::orderBy('created_at', 'desc')->take(1)->first();
        $latest_informations = Information::orderBy('created_at', 'desc')->take(3)->get();

        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'subtitle' => '',
            'active' => 'dashboard',
            'count_catalog' => $count_catalog,
            'count_category' => $count_category,
            'count_video' => $count_video,
            'count_information' => $count_information,
            'latest_products' => $latest_products,
            'latest_video' => $latest_video,
            'latest_informations' => $latest_informations,
        ]);
    }

    public function accountSetting()
    {
        return view('admin.settings.account-setting.index', [
            'title' => 'Account Setting',
            'subtitle' => '',
            'active' => 'account-setting',
        ]);
    }

    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|same:new_password',
        ], [
            'current_password.required' => 'Current Password is required',
            'new_password.required' => 'New Password is required',
            'new_password.min' => 'New Password must be at least 8 characters',
            'confirm_new_password.required' => 'Confirm New Password is required',
            'confirm_new_password.same' => 'Confirm New Password must be same with New Password',
        ]);

        $user = User::findOrFail($id);

        if (password_verify($request->current_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->new_password),
            ]);

            return redirect()->back()->with('success', 'Password has been changed');
        } else {
            return redirect()->back()->with('error', 'Current Password is wrong');
        }
    }

    public function changeInformation(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Information has been changed');
    }

    public function show()
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
