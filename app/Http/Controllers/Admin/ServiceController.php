<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        $services = DB::table('antrian')
            ->join('user', 'antrian.user_id', '=', 'user.user_id')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->join('layanan', 'antrian.layanan_id', '=', 'layanan.layanan_id')
            ->select('antrian.*', 'user.nama as user_name', 'bengkel.nama_bengkel', 'layanan.nama_layanan')
            ->orderBy('antrian.tanggal_pemesanan', 'desc')
            ->paginate(20);

        return view('admin.services.index', compact('services'));
    }

    public function show($id)
    {
        $service = DB::table('antrian')
            ->join('user', 'antrian.user_id', '=', 'user.user_id')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->join('layanan', 'antrian.layanan_id', '=', 'layanan.layanan_id')
            ->where('antrian.antrian_id', $id)
            ->select('antrian.*', 'user.nama as user_name', 'user.email', 'user.no_hp', 
                    'bengkel.nama_bengkel', 'bengkel.alamat', 'layanan.nama_layanan')
            ->first();

        if (!$service) {
            abort(404);
        }

        return view('admin.services.show', compact('service'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,batal',
        ]);

        DB::table('antrian')
            ->where('antrian_id', $id)
            ->update(['status' => $validated['status']]);

        return back()->with('success', 'Status berhasil diupdate');
    }
}
