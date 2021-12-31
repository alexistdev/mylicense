<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{DashboardController as DashAdmin,UserController as UserAdmin,KategoriController as KategoriAdmin};

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
    });
});

require __DIR__.'/auth.php';
