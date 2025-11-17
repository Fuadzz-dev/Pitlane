<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized access');}
            
        return view('dashboard');
    }
}