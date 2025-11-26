<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QueueController extends Controller
{
    public function index()
    {
        $queues = DB::table('antrian')
            ->join('user', 'antrian.user_id', '=', 'user.user_id')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->select('antrian.*', 'user.nama as user_name', 'bengkel.nama_bengkel')
            ->where('antrian.status', '!=', 'selesai')
            ->where('antrian.status', '!=', 'batal')
            ->orderBy('antrian.tanggal_pemesanan', 'asc')
            ->get();

        return view('admin.queue.index', compact('queues'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,batal',
            'tanggal_servis' => 'nullable|date',
            'mekanik_id' => 'nullable|exists:mekanik,mekanik_id',
            'total_biaya' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            // Ambil data antrian
            $antrian = DB::table('antrian')->where('antrian_id', $id)->first();
            
            if (!$antrian) {
                return back()->with('error', 'Data antrian tidak ditemukan');
            }

            // Update status antrian
            $updateData = ['status' => $validated['status']];
            
            if ($request->has('tanggal_servis')) {
                $updateData['tanggal_servis'] = $validated['tanggal_servis'];
            }

            DB::table('antrian')
                ->where('antrian_id', $id)
                ->update($updateData);

            // Jika status selesai atau batal, pindahkan ke riwayat
            if (in_array($validated['status'], ['selesai', 'batal'])) {
                $this->moveToHistory($antrian, $validated);
            }

            DB::commit();
            
            $message = $validated['status'] === 'selesai' 
                ? 'Antrian berhasil diselesaikan dan dipindahkan ke riwayat' 
                : ($validated['status'] === 'batal' 
                    ? 'Antrian berhasil dibatalkan dan dipindahkan ke riwayat'
                    : 'Antrian berhasil diupdate');

            return back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal mengupdate antrian: ' . $e->getMessage());
        }
    }

    /**
     * Pindahkan data antrian ke tabel riwayat
     */
    private function moveToHistory($antrian, $validated)
    {
        // Cek apakah sudah ada di riwayat
        $existingHistory = DB::table('riwayat')
            ->where('antrian_id', $antrian->antrian_id)
            ->first();

        if ($existingHistory) {
            // Update jika sudah ada
            DB::table('riwayat')
                ->where('antrian_id', $antrian->antrian_id)
                ->update([
                    'mekanik_id' => $validated['mekanik_id'] ?? null,
                    'tanggal_selesai' => $validated['status'] === 'selesai' ? Carbon::now() : null,
                    'total_biaya' => $validated['total_biaya'] ?? 0,
                    'keterangan' => $validated['keterangan'] ?? ($validated['status'] === 'batal' ? 'Dibatalkan oleh admin' : 'Servis selesai')
                ]);
        } else {
            // Insert baru jika belum ada
            DB::table('riwayat')->insert([
                'antrian_id' => $antrian->antrian_id,
                'user_id' => $antrian->user_id,
                'bengkel_id' => $antrian->bengkel_id,
                'mekanik_id' => $validated['mekanik_id'] ?? null,
                'tanggal_selesai' => $validated['status'] === 'selesai' ? Carbon::now() : null,
                'total_biaya' => $validated['total_biaya'] ?? 0,
                'keterangan' => $validated['keterangan'] ?? ($validated['status'] === 'batal' ? 'Dibatalkan oleh admin' : 'Servis selesai')
            ]);
        }
    }
}