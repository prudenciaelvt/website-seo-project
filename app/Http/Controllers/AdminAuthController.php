<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    // Halaman login
    public function showLoginForm()
    {
        if (Session::has('admin_id')) {
            return redirect()->route('admin.beranda');
        }

        return view('admin.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_id', $admin->id);
            return redirect()->route('admin.beranda');
        }

        return back()->withErrors(['login_error' => 'Username atau password salah']);
    }

    // Dashboard / beranda admin
    public function beranda()
    {
        // Cek session manual
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        return view('admin.beranda'); 
    }

    // Logout admin
    public function logout(Request $request)
    {
        Session::forget('admin_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
