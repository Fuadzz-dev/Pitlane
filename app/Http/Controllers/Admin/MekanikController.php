<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mekanik;
use App\Models\Workshop;
use Illuminate\Http\Request;

class MekanikController extends Controller
{
    // INDEX — Menampilkan list mekanik
    public function index()
    {
        $mekanik = Mekanik::with('workshop')->get(); // Relasi ke Workshop
        return view('admin.mekanik.index', compact('mekanik'));
    }

    // CREATE — Form tambah mekanik
    public function create()
    {
        $workshops = Workshop::all();   // Untuk dropdown nama bengkel
        return view('admin.mekanik.create', compact('workshops'));
    }

    // STORE — Simpan mekanik baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
            'workshop_id' => 'required|exists:workshops,id'
        ]);

        Mekanik::create([
            'nama' => $request->nama,
            'nomor_hp' => $request->nomor_hp,
            'workshop_id' => $request->workshop_id
        ]);

        return redirect()->route('admin.mekanik.index')->with('success', 'Data mekanik berhasil ditambahkan');
    }

    // EDIT — Form edit mekanik
    public function edit($id)
    {
        $mekanik = Mekanik::where('mekanik_id', $id)->firstOrFail();
        $workshops = Workshop::all();
        return view('admin.mekanik.edit', compact('mekanik', 'workshops'));
    }

    // UPDATE — Proses update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
            'workshop_id' => 'required|exists:workshops,id'
        ]);

        $mekanik = Mekanik::where('mekanik_id', $id)->firstOrFail();

        $mekanik->update([
            'nama_mekanik' => $request->nama,
            'no_hp' => $request->nomor_hp,
            'bengkel_id' => $request->workshop_id
        ]);

        return redirect()->route('admin.mekanik.index')->with('success', 'Data mekanik berhasil diupdate');
    }

    // DELETE — Hapus mekanik
    public function destroy($id)
    {
        $mekanik = Mekanik::where('mekanik_id', $id)->firstOrFail();
        $mekanik->delete();

        return redirect()->route('admin.mekanik.index')->with('success', 'Data mekanik berhasil dihapus');
    }
}
