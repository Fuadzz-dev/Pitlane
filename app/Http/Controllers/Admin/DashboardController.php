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
        ];

        $recent_queues = DB::table('antrian')
            ->join('user', 'antrian.user_id', '=', 'user.user_id')
            ->join('bengkel', 'antrian.bengkel_id', '=', 'bengkel.bengkel_id')
            ->select('antrian.*', 'user.nama as user_name', 'bengkel.nama_bengkel')
            ->orderBy('antrian.tanggal_pemesanan', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_queues'));
    }
}

