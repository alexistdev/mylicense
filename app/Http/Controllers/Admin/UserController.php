<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class UserController extends Controller
{
    /**
     * Mylicense v.1.0
     * created: 18-12-2021
     * Author: AlexistDev
     * Email: Alexistdev@gmail.com
     * phone: 0813-7982-3241
     */

    protected $users;
    protected $role;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users=Auth::user();
            $this->role=User::with('role')->find($this->users->id)->role;
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::all();
            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="#" class="edit btn btn-primary btn-sm m-1"><i class="fas fa-eye"></i> View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.user',array(
            'judul' => "Dashboard Administrator | SIBEL V.2.0",
            'aktifTag' => "admin",
            'tagSubMenu' => "user",
            'userName' => $this->users,
            'roleUser' => $this->role->name,
        ));
    }
}
