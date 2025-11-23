<?php

// ========================================
// AdminController.php (Updated)
// ========================================

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        // Ambil statistik
        $stats = [
            'total_users' => DB::table('user')->where('role', 'user')->count(),
            'total_services' => DB::table('antrian')->count(),
            'active_queue' => DB::table('antrian')->where('status', 'menunggu')->count(),
            'total_workshops' => DB::table('bengkel')->count(),
        ];

        // Antrian terbaru
        $recent_queues = DB::table('antrian')
            ->join('user', 'antrian.user_id', '=', 'user.user_id')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->select('antrian.*', 'user.nama as user_name', 'bengkel.nama_bengkel')
            ->orderBy('antrian.tanggal_pemesanan', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_queues'));
    }

    /**
     * Daftar Users
     */
    public function users()
    {
        $users = DB::table('user')
            ->where('role', 'user')
            ->orderBy('user_id', 'desc')
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Daftar Services
     */
    public function services()
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

    /**
     * Kelola Antrian
     */
    public function queue()
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

    /**
     * Daftar Workshops
     */
    public function workshops()
    {
        $workshops = DB::table('bengkel')
            ->orderBy('nama_bengkel', 'asc')
            ->get();

        return view('admin.workshops.index', compact('workshops'));
    }

    /**
     * Settings
     */
    public function settings()
    {
        return view('admin.settings');
    }
}

// ========================================
// HomeController.php (Updated)
// ========================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Homepage User
     */
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

    /**
     * Gallery
     */
    public function gallery()
    {
        return view('user.gallery');
    }

    /**
     * Daftar Motor
     */
    public function motor()
    {
        return view('user.motor');
    }

    /**
     * Daftar Bengkel
     */
    public function bengkel()
    {
        $workshops = DB::table('bengkel')
            ->orderBy('nama_bengkel', 'asc')
            ->get();

        return view('user.bengkel', compact('workshops'));
    }
}

// ========================================
// ServiceController.php (Updated)
// ========================================

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Form Servis
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        $bengkel = DB::table('bengkel')
            ->select('bengkel_id', 'nama_bengkel', 'alamat')
            ->orderBy('nama_bengkel', 'asc')
            ->get();

        return view('user.service.form', compact('bengkel'));
    }

    /**
     * Simpan Data Servis
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bengkel' => 'required|exists:bengkel,bengkel_id',
            'tipe' => 'required|string|max:100',
            'plat' => 'required|string|max:20',
            'jenis' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        try {
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

            return redirect()->route('service.create')
                ->with('success', 'Pendaftaran servis berhasil! Nomor antrian Anda: #' . $antrianId);

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal mendaftarkan servis: ' . $e->getMessage());
        }
    }

    /**
     * Antrian Saya
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
}