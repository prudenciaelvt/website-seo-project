<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    // Menampilkan halaman login admin
    public function showLoginForm()
    {
        if (Session::has('admin_id')) {
            return redirect()->route('admin.beranda');
        }
        return view('admin.login');
    }

    // Proses login admin, validasi input, dan session admin
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Session::put('admin_id', $admin->id);
            return redirect()->route('admin.beranda');
        }

        return back()->withErrors(['login_error' => 'Username atau password salah']);
    }

    // Menampilkan halaman dashboard  atau beranda admin
    public function dashboard()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        return view('admin.beranda'); 
    }

    // Logout admin
    public function logout(Request $request)
    {
        
        Auth::logout(); // keluar dari sesi login
        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // buat ulang token CSRF
        return redirect()->route('admin.login'); // arahkan ke halaman login admin
        
    }

}
