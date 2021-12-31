<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\User;
use Carbon\Carbon;
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
            $kategori = Kategori::orderBy('id', 'DESC')->get();
            return DataTables::of($kategori)
                ->addIndexColumn()
                ->editColumn('created_at', function($data){
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('admin.editkategori',$row->id).'" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>';
                     $btn = $btn.   '<a href="#" data-toggle="modal" data-target="#modalHapus" data-id="' . $row->id . '" class="open-hapus btn btn-danger mr-1"><i class="fas fa-trash"></i></a>';

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

    /** route:admin.editkategori */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.formkategori',array(
            'judul' => "Edit Kategori | MILISENSI v.1.0",
            'aktifTag' => "admin",
            'tagSubMenu' => "kategori",
            'userName' => $this->users,
            'roleUser' => $this->role->name,
            'tag' => 'edit',
            'kategori' => $kategori->name,
            'id' => $id,
        ));
    }

    /** route:admin.savekategori */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|max:255|unique:kategoris,name',
        ]);
        $kategori = new Kategori();
        $kategori->name = $request->kategori;
        $kategori->save();
        notify()->success('Data Kategori berhasil ditambahkan!');
        return redirect()->route('admin.kategori');
    }

    /**  route:admin.updatekategori */
    public function update(Request $request)
    {
        $request->validate([
            'kategori' => 'required|max:255',
            'id' => 'required|numeric',
        ]);
        $kategori = Kategori::find($request->id);
        $kategori->update([
           'name' => $request->kategori,
        ]);
        notify()->success('Data Kategori berhasil diperbaharui!');
        return redirect()->route('admin.editkategori',$request->id);
    }

    /** route:admin.deletekategori */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
        ]);
        $kategori = Kategori::find($request->id);
        $kategori->delete();
        notify()->success('Data Kategori berhasil dihapus!');
        return redirect()->route('admin.kategori');
    }
}
