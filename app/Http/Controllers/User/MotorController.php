<?php
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
