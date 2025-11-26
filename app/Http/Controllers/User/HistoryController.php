<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
{
    $riwayat = DB::table('riwayat')
        ->join('bengkel', 'riwayat.bengkel_id', '=', 'bengkel.bengkel_id')
        ->join('antrian', 'riwayat.antrian_id', '=', 'antrian.antrian_id')
        ->leftJoin('mekanik', 'riwayat.mekanik_id', '=', 'mekanik.mekanik_id')
        ->leftJoin('layanan', 'antrian.layanan_id', '=', 'layanan.layanan_id')
        ->where('riwayat.user_id', Auth::id())
        ->select(
            'riwayat.riwayat_id',
            'riwayat.tanggal_selesai',
            'riwayat.total_biaya',
            'riwayat.keterangan',
            'mekanik.nama_mekanik',
            'bengkel.nama_bengkel',
            'antrian.tipe',
            'antrian.plat',
            'antrian.status',
            'layanan.nama_layanan'
        )
        ->orderBy('riwayat.tanggal_selesai', 'desc')
        ->get();

    return view('user.history', compact('riwayat'));
}
}