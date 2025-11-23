<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Tampilkan form servis
     */
    public function create()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Ambil semua data bengkel dari database
        $bengkel = DB::table('bengkel')
            ->select('bengkel_id', 'nama_bengkel', 'alamat')
            ->orderBy('nama_bengkel', 'asc')
            ->get();

        return view('form', compact('bengkel'));
    }

    /**
     * Simpan data servis ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'bengkel' => 'required|exists:bengkel,bengkel_id',
            'tipe' => 'required|string|max:100',
            'plat' => 'required|string|max:20',
            'jenis' => 'required|string',
            'catatan' => 'nullable|string',
        ], [
            'bengkel.required' => 'Pilih bengkel terlebih dahulu',
            'bengkel.exists' => 'Bengkel tidak valid',
            'tipe.required' => 'Tipe motor harus diisi',
            'plat.required' => 'Nomor plat harus diisi',
            'jenis.required' => 'Pilih jenis perbaikan',
        ]);

        try {
            // Ambil atau buat layanan_id berdasarkan jenis perbaikan
            $layanan = DB::table('layanan')
                ->where('nama_layanan', $request->jenis)
                ->first();

            // Jika layanan belum ada, buat baru dengan harga default
            if (!$layanan) {
                $layananId = DB::table('layanan')->insertGetId([
                    'nama_layanan' => $request->jenis,
                    'deskripsi' => 'Layanan ' . $request->jenis,
                    'harga' => 0,
                ]);
            } else {
                $layananId = $layanan->layanan_id;
            }

            // Insert data antrian
            $antrianId = DB::table('antrian')->insertGetId([
                'user_id' => Auth::id(),
                'bengkel_id' => $request->bengkel,
                'layanan_id' => $layananId,
                'tipe' => $request->tipe,
                'plat' => strtoupper($request->plat),
                'tanggal_pemesanan' => now(),
                'tanggal_servis' => now()->addDays(1),
                'status' => 'menunggu',
                'catatan' => $request->catatan,
            ]);

            // ✅ REDIRECT KE FORM DENGAN SUCCESS MESSAGE
            return redirect()->route('service.create')
                ->with('success', 'Pendaftaran servis berhasil! Nomor antrian Anda: #' . $antrianId);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal mendaftarkan servis: ' . $e->getMessage());
        }
    }

    /**
     * Lihat semua antrian user yang sedang login
     * (Opsional - jika tetap ingin ada fitur ini)
     */
    public function myQueue()
    {
        $antrians = DB::table('antrian')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->where('antrian.user_id', Auth::id())
            ->select('antrian.*', 'bengkel.nama_bengkel')
            ->orderBy('antrian.tanggal_pemesanan', 'desc')
            ->get();

        return view('my-queue', compact('antrians'));
    }
}