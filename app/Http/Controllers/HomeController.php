<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
     // Method untuk menampilkan halaman home
    public function index()
    {

        // Ambil data user yang login
        $user = Auth::user();

        // Kirim data ke view
        return view('home', compact('user'));
    }

    // Method untuk menampilkan dashboard (optional)
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        return view('dashboard');
    }

    // Method untuk profile (optional)
    public function profile()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        return view('profile', compact('user'));
    }
}
