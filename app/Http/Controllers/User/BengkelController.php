<?php

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