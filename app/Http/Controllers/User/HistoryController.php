<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        // Ambil riwayat servis berdasarkan user yang login
        $riwayat = DB::table('riwayat')
            ->join('bengkel', 'riwayat.bengkel_id', '=', 'bengkel.bengkel_id')
            ->join('mekanik', 'riwayat.mekanik_id', '=', 'mekanik.mekanik_id')
            ->where('riwayat.user_id', Auth::id())
            ->select(
                'riwayat.riwayat_id',
                'mekanik.nama_mekanik',
                'bengkel.nama_bengkel',
                'riwayat.tanggal_selesai',
                'riwayat.total_biaya',
                'riwayat.keterangan'
            )
            ->orderBy('riwayat.tanggal_selesai', 'desc')
            ->get();

        return view('user.history', compact('riwayat'));
    }
}
