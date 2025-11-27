<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('user')
            ->where('role', 'user')
            ->orderBy('user_id', 'desc')
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function destroy($id)
    {
        DB::table('user')->where('user_id', $id)->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
