<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MotorController extends Controller
{
    // 🔹 Menampilkan list motor
    public function index()
    {
        $motors = DB::table('kendaraan')
            ->orderBy('nama_kendaraan', 'asc')
            ->get();

        return view('user.motor', compact('motors'));
    }

    // 🔹 Menyimpan data motor
    public function store(Request $request)
    {
        $request->validate([
            'nama_kendaraan' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:5000',
        ]);

        // Baca file dan simpan sebagai BLOB
        $foto = file_get_contents($request->file('foto'));

        DB::table('kendaraan')->insert([
            'nama_kendaraan' => $request->nama_kendaraan,
            'foto' => $foto,
        ]);

        return back()->with('success', 'Motor berhasil ditambahkan!');
    }
}
