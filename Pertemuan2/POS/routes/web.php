<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Models\KategoriModel;
use Database\Seeders\LevelSeeder;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Catch_;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('login', [AuthController::class, 'index'])->name('login.index'); //route untuk view login atau tampilan 
Route::post('autentifikasi', [AuthController::class, 'authenticate'])->name('autentifikasi'); //route untuk operasi login
Route::get('tampil_register', [AuthController::class, 'signup'])->name('signup'); // route tampilan register
Route::get('logout',[AuthController::class, 'logout'])->name('logout'); //route logout
Route::post('register', [AuthController::class, 'register'])->name('proses_register');


// Route::group(['middleware'=> ['auth']], function(){
//     Route::group(['middleware'=>['cek_login:1']], function(){
//         Route::resource('admin', AdminController::class);
//     });
//     Route::group(['middleware'=>['cek_login:2']], function(){
//         Route::resource('admin', ManagerController::class);
//     });

// });

// //PERTEMUAN 5
//middleware untuk membungkus agar tidak bisa langsung diakses sebelum login 
Route::middleware(['auth'])->group(function(){
    //HALAMAN BERANDA SETELAH LOGIN UNTUK ADMIN
    Route::group(['prefix' => 'dashboard'], function(){
        Route::post('/list', [WelcomeController::class, 'list'])->name('list_member');
        Route::get('/', [WelcomeController::class, 'index'] )->name('dashboard');
        Route::get('/{id}/validasi_member', [WelcomeController::class, 'validasiMember'] )->name('validasiMember');
        Route::delete('/{id}', [WelcomeController::class, 'destroy']); //menghapus data user
        Route::get('{id}', [WelcomeController::class, 'show']); //menampilkan halaman detail user
    });

    Route::get('/exportPDF', [WelcomeController::class, 'exportPDF'])->name('PDF');
    Route::get('/exportExcel', [WelcomeController::class, 'exportExcel'])->name('EXCEL');


// Route::get('/kategori', [KategoriController::class, 'index']);
// Route::get('/kategori/create', [KategoriController::class, 'create']);
// Route::post('/kategori', [KategoriController:: class, 'store']);

// Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
// Route::post('/kategori/update/{id}', [KategoriController::class, 'update']);

// Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete']);

// //PERTEMUAN 6
// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/level/create_level', [LevelController::class, 'create']);
// Route::post('/level', [LevelController:: class, 'store']);

// Route::get('/user', [UserController::class, 'index']);
// Route::get('/user/create_user', [UserController::class, 'create']);
// Route::post('/user', [UserController:: class, 'store']);

// Route::resource('m_user', POSController::class);

//PERTEMUAN 7
Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function(){
    Route::get('/', [UserController::class, 'index']); //menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']); //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']); //menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']); //menampilkan data user baru
    Route::get('{id}', [UserController::class, 'show']); //menampilkan halaman detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); //menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']); //menampilkan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); //menghapus data user

    Route::get('/login', [UserController::class, 'login']);
});

Route::group(['prefix' => 'level'], function(){
    Route::get('/', [LevelController::class, 'index']);
    Route::post('/list', [LevelController::class, 'list']); //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']); //menampilkan halaman form tambah user
    Route::post('/', [LevelController::class, 'store']); //menampilkan data user baru
    Route::get('{id}', [LevelController::class, 'show']); //menampilkan halaman detail user
    Route::get('/{id}/edit', [LevelController::class, 'edit']); //menampilkan halaman form edit user
    Route::put('/{id}', [LevelController::class, 'update']); //menampilkan perubahan data user
    Route::delete('/{id}', [LevelController::class, 'destroy']); //menghapus data user
});

Route::group(['prefix' => 'barang'], function(){
    Route::get('/', [BarangController::class, 'index']);
    Route::post('/list', [BarangController::class, 'list']); //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']); //menampilkan halaman form tambah user
    Route::post('/', [BarangController::class, 'store']); //menampilkan data user baru
    Route::get('{id}', [BarangController::class, 'show']); //menampilkan halaman detail user
    Route::get('/{id}/edit', [BarangController::class, 'edit']); //menampilkan halaman form edit user
    Route::put('/{id}', [BarangController::class, 'update']); //menampilkan perubahan data user
    Route::delete('/{id}', [BarangController::class, 'destroy']); //menghapus data user
});

Route::group(['prefix' => 'kategori'], function(){
    Route::get('/', [KategoriController::class, 'index']);
    Route::post('/list', [KategoriController::class, 'list']); //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']); //menampilkan halaman form tambah user
    Route::post('/', [KategoriController::class, 'store']); //menampilkan data user baru
    Route::get('{id}', [KategoriController::class, 'show']); //menampilkan halaman detail user
    Route::get('/{id}/edit', [KategoriController::class, 'edit']); //menampilkan halaman form edit user
    Route::put('/{id}', [KategoriController::class, 'update']); //menampilkan perubahan data user
    Route::delete('/{id}', [KategoriController::class, 'destroy']); //menghapus data user
});

Route::group(['prefix' => 'stok'], function () {
    Route::get('/', [StokController::class, 'index']);
    Route::post('/list', [StokController::class, 'list']);
    Route::get('/create', [StokController::class, 'create']);
    Route::put('/{id}', [StokController::class, 'update']);
    Route::get('/{id}/edit', [StokController::class, 'edit']);
    Route::get('/{id}', [StokController::class, 'show']);
    Route::post('/', [StokController::class, 'store']);
    Route::put('/{id}', [StokController::class, 'update']);
    Route::delete('/{id}', [StokController::class, 'destroy']);
});

Route::group(['prefix' => 'penjualan'], function () {
    Route::get('/', [PenjualanController::class, 'index']);
    Route::post('/list', [PenjualanController::class, 'list']);
    Route::get('/create', [PenjualanController::class, 'create']);
    Route::put('/{id}', [PenjualanController::class, 'update']);
    Route::get('/{id}/edit', [PenjualanController::class, 'edit']);
    Route::get('/{id}', [PenjualanController::class, 'show']);
    Route::post('/', [PenjualanController::class, 'store']);
    Route::put('/{id}', [PenjualanController::class, 'update']);
    Route::delete('/{id}', [PenjualanController::class, 'destroy']);
});
});






Route::get('/home', [HomeController::class, 'home']);


Route::prefix('products')->group(function(){
    Route::get('/category/food-beverage', [KategoriController::class, 'food_beverage']);
    Route::get('/category/beauty-health', [KategoriController::class, 'beauty_health']);
    Route::get('/category/home-care', [KategoriController::class, 'home_care']);
    Route::get('/category/baby-kid', [KategoriController::class, 'baby_kid']);
});

Route::get('/products', [KategoriController::class, 'products']);

Route::get('/user/{id}/name/{name}', [UserController::class, 'user']);

// Route::get('/penjualan', [PenjualanController::class, 'penjualan']);


//Pertemuan 3
Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);

Route::get('/user', [UserController::class, 'index']);

Route::get('/user/tambah', [UserController::class, 'tambah']);

Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);



// //UJIAN TENGAH SEMESTER


