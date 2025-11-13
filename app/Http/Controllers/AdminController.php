<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah user adalah admin
        if (!Auth::user()->isAdmin()) {
            return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('dashboard');
    }
}