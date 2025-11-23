<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function index()
    {
        // Bisa ambil data gallery dari database nanti
        return view('user.gallery');
    }
}
