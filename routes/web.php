<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,UserController as UserAdmin,KategoriController as KategoriAdmin,ProdukController as ProdukAdmin};
use App\Http\Controllers\User\{DashboardController as DashUser};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::group(['middleware' => ['web','auth','roles']],function() {
    Route::group(['roles' => 'admin'], function () {
        Route::get('/admin/dashboard', [DashAdmin::class,'index'])->name('admin.dashboard');
        Route::get('/admin/user', [UserAdmin::class,'index'])->name('admin.user');

        Route::get('/admin/kategori', [KategoriAdmin::class,'index'])->name('admin.kategori');
        Route::post('/admin/kategori', [KategoriAdmin::class,'store'])->name('admin.savekategori');
        Route::patch('/admin/kategori', [KategoriAdmin::class,'update'])->name('admin.updatekategori');
        Route::delete('/admin/kategori', [KategoriAdmin::class,'destroy'])->name('admin.deletekategori');
        Route::get('/admin/kategori/add', [KategoriAdmin::class,'create'])->name('admin.addkategori');
        Route::get('/admin/kategori/{id}/edit', [KategoriAdmin::class,'edit'])->name('admin.editkategori');

        Route::get('/admin/produk', [ProdukAdmin::class,'index'])->name('admin.produk');
        Route::post('/admin/produk', [ProdukAdmin::class,'store'])->name('admin.saveproduk');
        Route::patch('/admin/produk', [ProdukAdmin::class,'update'])->name('admin.updateproduk');
        Route::delete('/admin/produk', [ProdukAdmin::class,'destroy'])->name('admin.deleteproduk');
        Route::get('/admin/produk/add', [ProdukAdmin::class,'create'])->name('admin.addproduk');
        Route::get('/admin/produk/{id}/edit', [ProdukAdmin::class,'edit'])->name('admin.editproduk');
        Route::get('/admin/produk/{id}/detail', [ProdukAdmin::class,'detail'])->name('admin.detailproduk');
        Route::post('/admin/produk/detail', [ProdukAdmin::class,'savedetail'])->name('admin.savedetailproduk');
        Route::patch('/admin/produk/detail', [ProdukAdmin::class,'updatedetail'])->name('admin.updatedetailproduk');
        Route::delete('/admin/produk/detail', [ProdukAdmin::class,'deletedetail'])->name('admin.deletedetailproduk');
    });
    Route::group(['roles' => 'user'], function () {
        Route::get('/user/dashboard', [DashUser::class,'index'])->name('user.dashboard');
    });
});

require __DIR__.'/auth.php';
