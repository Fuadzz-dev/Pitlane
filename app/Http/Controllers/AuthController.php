<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Routing\Controller as BaseController;


class AuthController extends Controller
{
     // Tampilkan halaman login 
    public function showLogin()
    {
        if (Auth::check()) {
            // Cek role saat sudah login
            return Auth::user()->isAdmin() 
                ? redirect('/admin/dashboard') 
                : redirect('/home');
        }
        return view('login');
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        if (Auth::check()) {
            return Auth::user()->isAdmin() 
                ? redirect('/admin/dashboard') 
                : redirect('/home');
        }
        return view('register');
    }

    // Proses login dengan redirect berdasarkan role
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role
            if (Auth::user()->isAdmin()) {
                return redirect()->route('dashboard');
            }
            
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }


    // Proses register - HANYA SATU METHOD
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user',
            'phone' => 'required|string|max:15',
            'password' => 'required|min:8|confirmed'
        ], [
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.required' => 'No HP harus diisi.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password'])
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Anda berhasil logout');
    }

    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
}