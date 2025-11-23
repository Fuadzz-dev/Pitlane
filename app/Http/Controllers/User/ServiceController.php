<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
        $bengkel = DB::table('bengkel')
            ->select('bengkel_id', 'nama_bengkel', 'alamat')
            ->orderBy('nama_bengkel', 'asc')
            ->get();

        return view('user.service.form', compact('bengkel'));
    }

    /**
     * Simpan data servis
     */
    public function store(Request $request)
    {
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
            // Ambil atau buat layanan
            $layanan = DB::table('layanan')
                ->where('nama_layanan', $request->jenis)
                ->first();

            if (!$layanan) {
                $layananId = DB::table('layanan')->insertGetId([
                    'nama_layanan' => $request->jenis,
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

            return redirect()->route('service')
                ->with('success', 'Pendaftaran servis berhasil! Nomor antrian Anda: #' . $antrianId);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal mendaftarkan servis: ' . $e->getMessage());
        }
    }

    /**
     * Success page
     */
    public function success($id)
    {
        $antrian = DB::table('antrian')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->where('antrian.antrian_id', $id)
            ->where('antrian.user_id', Auth::id())
            ->select('antrian.*', 'bengkel.nama_bengkel')
            ->first();

        if (!$antrian) {
            abort(404);
        }

        return view('user.service.success', compact('antrian'));
    }
}