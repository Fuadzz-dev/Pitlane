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

        // Debug: cek apakah data bengkel ada
        // dd($bengkel); // Uncomment untuk debug

        return view('service.form', compact('bengkel'));
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
            // Insert data ke tabel antrian
            $antrianId = DB::table('antrian')->insertGetId([
                'user_id' => Auth::id(),
                'bengkel_id' => $request->bengkel,
                'tipe' => $request->tipe,
                'plat' => strtoupper($request->plat), // Convert plat ke uppercase
                'tanggal_pemesanan' => now(),
                'tanggal_servis' => null,
                'status' => 'menunggu',
                'catatan' => $request->catatan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Ambil nama bengkel untuk notifikasi
            $bengkel = DB::table('bengkel')->where('bengkel_id', $request->bengkel)->first();

            return redirect()->route('service.success', ['id' => $antrianId])
                ->with('success', 'Pendaftaran servis berhasil! Nomor antrian Anda: #' . $antrianId);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal mendaftarkan servis. Silakan coba lagi.');
        }
    }

    /**
     * Halaman sukses setelah pendaftaran
     */
    public function success($id)
    {
        $antrian = DB::table('antrian')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->join('users', 'antrian.user_id', '=', 'users.user_id')
            ->where('antrian.antrian_id', $id)
            ->where('antrian.user_id', Auth::id())
            ->select(
                'antrian.*',
                'bengkel.nama_bengkel',
                'bengkel.alamat',
                'bengkel.no_hp as bengkel_hp',
                'users.nama'
            )
            ->first();

        if (!$antrian) {
            return redirect()->route('home')->with('error', 'Data antrian tidak ditemukan');
        }

        return view('service.success', compact('antrian'));
    }

    /**
     * Lihat semua antrian user yang sedang login
     */
    public function myQueue()
    {
        $antrians = DB::table('antrian')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->where('antrian.user_id', Auth::id())
            ->select('antrian.*', 'bengkel.nama_bengkel')
            ->orderBy('antrian.tanggal_pemesanan', 'desc')
            ->get();

        return view('service.my-queue', compact('antrians'));
    }
}