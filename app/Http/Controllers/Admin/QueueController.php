<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueueController extends Controller
{
    public function index()
    {
        $queues = DB::table('antrian')
            ->join('user', 'antrian.user_id', '=', 'user.user_id')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->select('antrian.*', 'user.nama as user_name', 'bengkel.nama_bengkel')
            ->where('antrian.status', '!=', 'selesai')
            ->orderBy('antrian.tanggal_pemesanan', 'asc')
            ->get();

        return view('admin.queue.index', compact('queues'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,batal',
            'tanggal_servis' => 'nullable|date',
        ]);

        $updateData = ['status' => $validated['status']];
        
        if ($request->has('tanggal_servis')) {
            $updateData['tanggal_servis'] = $validated['tanggal_servis'];
        }

        DB::table('antrian')
            ->where('antrian_id', $id)
            ->update($updateData);

        return back()->with('success', 'Antrian berhasil diupdate');
    }
}
