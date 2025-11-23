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

// ========================================
// app/Http/Controllers/User/ServiceController.php
// ========================================

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

            return redirect()->route('user.service.create')
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

// ========================================
// app/Http/Controllers/User/QueueController.php
// ========================================

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

// ========================================
// app/Http/Controllers/User/GalleryController.php
// ========================================

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        // Bisa ambil data gallery dari database nanti
        return view('user.gallery');
    }
}

// ========================================
// app/Http/Controllers/User/MotorController.php
// ========================================

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MotorController extends Controller
{
    public function index()
    {
        // Ambil data motor dari database
        $motors = DB::table('kendaraan')
            ->orderBy('merk', 'asc')
            ->get();

        return view('user.motor', compact('motors'));
    }
}

// ========================================
// app/Http/Controllers/User/BengkelController.php
// ========================================

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BengkelController extends Controller
{
    public function index()
    {
        $workshops = DB::table('bengkel')
            ->orderBy('nama_bengkel', 'asc')
            ->get();

        return view('user.bengkel', compact('workshops'));
    }

    public function show($id)
    {
        $workshop = DB::table('bengkel')
            ->where('bengkel_id', $id)
            ->first();

        if (!$workshop) {
            abort(404);
        }

        // Ambil mekanik di bengkel ini
        $mechanics = DB::table('mekanik')
            ->where('bengkel_id', $id)
            ->get();

        return view('user.bengkel-detail', compact('workshop', 'mechanics'));
    }
} 