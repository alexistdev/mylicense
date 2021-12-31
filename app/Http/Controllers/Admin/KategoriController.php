<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
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

    /** route:admin.kategori */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kategori = Kategori::all();
            return DataTables::of($kategori)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="#" class="edit btn btn-primary btn-sm m-1"><i class="fas fa-eye"></i> View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.kategori',array(
            'judul' => "Kategori | MILISENSI v.1.0",
            'aktifTag' => "admin",
            'tagSubMenu' => "kategori",
            'userName' => $this->users,
            'roleUser' => $this->role->name,
        ));
    }

    /** route:admin.addkategori */
    public function create()
    {
        return view('admin.formkategori',array(
            'judul' => "Tambah Kategori | MILISENSI v.1.0",
            'aktifTag' => "admin",
            'tagSubMenu' => "kategori",
            'userName' => $this->users,
            'roleUser' => $this->role->name,
            'tag' => 'add',
        ));
    }

    public function store(Request $request)
    {
        $rules = array(
            'kategori' => 'required|max:1',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect(route('admin.addkategori'));
        } else {
            echo "okay";
        }
    }
}
