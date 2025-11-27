<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => DB::table('user')->where('role', 'user')->count(),
            'total_services' => DB::table('antrian')->count(),
            'active_queue' => DB::table('antrian')->where('status', 'menunggu')->count(),
            'total_workshops' => DB::table('bengkel')->count(),
            'total_history_services' => DB::table('riwayat')->count(),
        ];

        $recent_queues = DB::table('antrian')
    ->join('user', 'antrian.user_id', '=', 'user.user_id')
    ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
    ->join('layanan', 'antrian.layanan_id', '=', 'layanan.layanan_id') // join layanan
    ->select(
        'antrian.antrian_id', 
        'antrian.tanggal_pemesanan', 
        'antrian.status', 
        'user.nama as user_name', 
        'bengkel.nama_bengkel',
        'layanan.nama_layanan as service_type' // ambil nama layanan
    )
    ->whereIn('antrian.status', ['menunggu', 'diproses'])
    ->orderBy('antrian.tanggal_pemesanan', 'desc')
    ->limit(10)
    ->get();


        return view('admin.dashboard', [
    'totalUsers' => $stats['total_users'],
    'activeServices' => $stats['active_queue'],
    'totalWorkshops' => $stats['total_workshops'],
    'totalServis' => $stats['total_history_services'],
    'recent_queues' => $recent_queues
]);
    }
}

