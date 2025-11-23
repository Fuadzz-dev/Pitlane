<?php

// ========================================
// app/Http/Controllers/User/HomeController.php
// ========================================

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil antrian aktif user
        $active_queue = DB::table('antrian')
            ->where('user_id', Auth::id())
            ->whereIn('status', ['menunggu', 'diproses'])
            ->count();

        return view('user.home', compact('user', 'active_queue'));
    }
}