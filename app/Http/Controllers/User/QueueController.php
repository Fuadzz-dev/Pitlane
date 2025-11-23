<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QueueController extends Controller
{
    /**
     * Tampilkan antrian saya
     */
    public function myQueue()
    {
        $antrians = DB::table('antrian')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->where('antrian.user_id', Auth::id())
            ->select('antrian.*', 'bengkel.nama_bengkel')
            ->orderBy('antrian.tanggal_pemesanan', 'desc')
            ->get();

        return view('user.queue.my-queue', compact('antrians'));
    }

    /**
     * Detail antrian
     */
    public function detail($id)
    {
        $antrian = DB::table('antrian')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->join('layanan', 'antrian.layanan_id', '=', 'layanan.layanan_id')
            ->where('antrian.antrian_id', $id)
            ->where('antrian.user_id', Auth::id())
            ->select('antrian.*', 'bengkel.nama_bengkel', 'bengkel.alamat', 
                     'bengkel.no_hp as bengkel_no_hp', 'layanan.nama_layanan')
            ->first();

        if (!$antrian) {
            abort(404);
        }

        return view('user.queue.detail', compact('antrian'));
    }
}
