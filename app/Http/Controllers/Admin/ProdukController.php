<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
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
            $this->users = Auth::user();
            $this->role = User::with('role')->find($this->users->id)->role;
            return $next($request);
        });
    }

    /** route:admin.kategori */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $produk = Produk::with('kategori')->orderBy('id', 'DESC')->get();
            return DataTables::of($produk)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->editColumn('updated_at', function ($data) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.editproduk', $row->id) . '" class="btn btn-success mr-1"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . '<a href="#" data-toggle="modal" data-target="#modalHapus" data-id="' . $row->id . '" class="open-hapus btn btn-danger mr-1"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.produk', array(
            'judul' => "Kategori | MILISENSI v.1.0",
            'aktifTag' => "admin",
            'tagSubMenu' => "produk",
            'userName' => $this->users,
            'roleUser' => $this->role->name,
        ));
    }

    /** route:admin.addproduk */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.formproduk', array(
            'judul' => "Tambah Produk | MILISENSI v.1.0",
            'aktifTag' => "admin",
            'tagSubMenu' => "produk",
            'userName' => $this->users,
            'roleUser' => $this->role->name,
            'tag' => 'add',
            'kategori' => $kategori,
        ));
    }

    /** route:admin.editproduk */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.formproduk',array(
            'judul' => "Edit Produk | MILISENSI v.1.0",
            'aktifTag' => "admin",
            'tagSubMenu' => "produk",
            'userName' => $this->users,
            'roleUser' => $this->role->name,
            'tag' => 'edit',
            'kategori' => $kategori,
            'kategori_id' => $produk->kategori_id,
            'produkname' => $produk->name,
            'price' => $produk->price,
            'id' => $id,
        ));
    }

    /** route: admin.saveproduk */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|numeric',
            'produk' => 'required|max:255',
            'harga' => 'required|numeric'
        ]);
        $produk = new Produk();
        $produk->kategori_id = $request->kategori_id;
        $produk->name = $request->produk;
        $produk->price = $request->harga;
        $produk->save();
        notify()->success('Data Produk berhasil ditambahkan!');
        return redirect()->route('admin.produk');
    }

    /**  route:admin.updateproduk */
    public function update(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|numeric',
            'produk' => 'required|max:255',
            'harga' => 'required|numeric',
            'id' => 'required|numeric',
        ]);
        $produk = Produk::find($request->id);
        $produk->update([
            'kategori_id' => $request->kategori_id,
            'name' => $request->produk,
            'price' => $request->harga,
        ]);
        notify()->success('Data Produk berhasil diperbaharui!');
        return redirect()->route('admin.editproduk',$request->id);
    }

    /** route:admin.deleteproduk */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
        ]);
        $produk = Produk::find($request->id);
        $produk->delete();
        notify()->success('Data Produk berhasil dihapus!');
        return redirect()->route('admin.produk');
    }
}
