<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Catalog;
use App\Models\Category;
use App\Models\Video;
use App\Models\Information;
use Illuminate\Http\Request;

class VerificatorController extends Controller
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

        return view('verificator.dashboard', [
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
        return view('admin.master-data.verificator.index', [
            'title' => 'Verificator',
            'subtitle' => '',
            'active' => 'verificator',
            'datas' => User::where('role_id', 4)->get(),
        ]);
    }

    public function create()
    {
        return view('admin.master-data.verificator.create', [
            'title' => 'Verificator',
            'subtitle' => 'Add Verificator',
            'active' => 'verificator',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'verificator_name' => 'required|max:255',
            'verificator_email' => 'required||unique:users,email',
            'verificator_password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->verificator_name,
            'email' => $request->verificator_email,
            'password' => bcrypt($request->verificator_password), // Pastikan menggunakan field yang benar
            'role_id' => 4, // Sesuaikan dengan kebutuhan
        ]);

        return redirect()->route('admin.verificator')->with('success', 'Verificator has been added!');
    }

    public function edit($id)
    {
        return view('admin.master-data.verificator.edit', [
            'title' => 'Verificator',
            'subtitle' => 'Edit Verificator',
            'active' => 'verificator',
            'data' => User::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $verificator = User::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'verificator_name' => 'required|max:255',
            'verificator_email' => [
                'required',
                'email',
                // Validasi email unik hanya jika email diubah
                function ($attribute, $value, $fail) use ($verificator) {
                    if ($value !== $verificator->email && User::where('email', $value)->exists()) {
                        $fail('The email has already been taken.');
                    }
                },
            ],
            'verificator_password' => 'nullable|min:8|confirmed',
        ]);

        // Update user data
        $verificator->name = $request->verificator_name;
        $verificator->email = $request->verificator_email;

        // Update password hanya jika diisi
        if ($request->filled('verificator_password')) {
            $verificator->password = bcrypt($request->verificator_password);
        }

        $verificator->save();

        // Update notaris data

        return redirect()->route('admin.verificator')->with('success', 'Notaris has been updated!');
    }

    public function destroy($id)
    {
        $notaris = Notaris::findOrFail($id);
        $notaris->delete();

        return redirect()->route('admin.notaris')->with('success', 'Notaris has been deleted!');
    }

}
