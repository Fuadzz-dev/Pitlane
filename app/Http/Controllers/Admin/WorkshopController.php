<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkshopController extends Controller
{
    public function index()
    {
        $workshops = DB::table('bengkel')
            ->orderBy('nama_bengkel', 'asc')
            ->get();

        return view('admin.workshops.index', compact('workshops'));
    }

    public function create()
    {
        return view('admin.workshops.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bengkel' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'jam_operasional' => 'nullable|string|max:50',
        ]);

        DB::table('bengkel')->insert($validated);

        return redirect()->route('admin.workshops.index')
            ->with('success', 'Bengkel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $workshop = DB::table('bengkel')->where('bengkel_id', $id)->first();
        
        if (!$workshop) {
            abort(404);
        }

        return view('admin.workshops.edit', compact('workshop'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_bengkel' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'jam_operasional' => 'nullable|string|max:50',
        ]);

        DB::table('bengkel')
            ->where('bengkel_id', $id)
            ->update($validated);

        return redirect()->route('admin.workshops.index')
            ->with('success', 'Bengkel berhasil diupdate');
    }

    public function destroy($id)
    {
        DB::table('bengkel')->where('bengkel_id', $id)->delete();

        return redirect()->route('admin.workshops.index')
            ->with('success', 'Bengkel berhasil dihapus');
    }
}
