<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MotorcycleController extends Controller
{
    public function index()
    {
        $motorcycles = DB::table('kendaraan')->get();
        return view('admin.motorcycles.index', compact('motorcycles'));
    }

    public function edit($id)
    {
        $motorcycle = DB::table('kendaraan')->where('kendaraan_id', $id)->first();
        return view('admin.motorcycles.edit', compact('motorcycle'));
    }

    public function update(Request $request, $id)
    {
        $data = ['nama_kendaraan' => $request->nama_kendaraan];

        if ($request->hasFile('foto')) {
            $data['foto'] = file_get_contents($request->file('foto'));
        }

        DB::table('kendaraan')->where('kendaraan_id', $id)->update($data);

        return redirect()->route('admin.motorcycles.index')->with('success', 'Motorcycle updated successfully.');
    }

    public function destroy($id)
    {
        DB::table('kendaraan')->where('kendaraan_id', $id)->delete();
        return redirect()->route('admin.motorcycles.index')->with('success', 'Motorcycle deleted successfully.');
    }

    public function create()
{
    return view('admin.motorcycles.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama_kendaraan' => 'required',
        'foto' => 'nullable|image|max:2048'
    ]);

    $data = [
        'nama_kendaraan' => $request->nama_kendaraan
    ];

    if ($request->hasFile('foto')) {
        $data['foto'] = file_get_contents($request->file('foto'));
    }

    DB::table('kendaraan')->insert($data);

    return redirect()->route('admin.motorcycles.index')->with('success', 'Motorcycle added successfully.');
}

}
