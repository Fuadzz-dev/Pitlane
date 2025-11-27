<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = DB::table('layanan')->paginate(10);
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'harga' => 'required|numeric',
        ]);

        DB::table('layanan')->insert([
            'nama_layanan' => $request->nama_layanan,
            'harga'        => $request->harga,
        ]);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambah.');
    }

    public function edit($id)
{
    $layanan = DB::table('layanan')->where('layanan_id', $id)->first();

    if (!$layanan) {
        return redirect()->route('admin.layanan.index')
            ->with('error', 'Layanan tidak ditemukan.');
    }

    return view('admin.layanan.edit', compact('layanan'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'harga' => 'required|numeric',
        ]);

        DB::table('layanan')->where('layanan_id', $id)->update([
            'nama_layanan' => $request->nama_layanan,
            'harga'        => $request->harga,
        ]);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('layanan')->where('layanan_id', $id)->delete();
        return back()->with('success', 'Layanan berhasil dihapus.');
    }
}
