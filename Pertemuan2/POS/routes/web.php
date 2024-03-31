<?php

use App\Http\Controllers\CategoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'home']);


/*//Route::prefix('products')->group(function(){
    Route::get('/category/food-beverage', [KategoriController::class, 'food_beverage']);
    Route::get('/category/beauty-health', [KategoriController::class, 'beauty_health']);
    Route::get('/category/home-care', [KategoriController::class, 'home_care']);
    Route::get('/category/baby-kid', [KategoriController::class, 'baby_kid']);
//});

Route::get('/products', [KategoriController::class, 'products']);

Route::get('/user/{id}/name/{name}', [UserController::class, 'user']);

Route::get('/penjualan', [PenjualanController::class, 'penjualan']);


//Pertemuan 3
Route::get('/level', [LevelController::class, 'index']);
//Route::get('/kategori', [KategoriController::class, 'index']);

Route::get('/user', [UserController::class, 'index']);

Route::get('/user/tambah', [UserController::class, 'tambah']);

Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);*/

//PERTEMUAN 5
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::post('/kategori', [KategoriController:: class, 'store']);

Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
Route::post('/kategori/update/{id}', [KategoriController::class, 'update']);

Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete']);

//PERTEMUAN 6
Route::get('/level', [LevelController::class, 'index']);
Route::get('/level/create_level', [LevelController::class, 'create']);
Route::post('/level', [LevelController:: class, 'store']);

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/create_user', [UserController::class, 'create']);
Route::post('/user', [UserController:: class, 'store']);

Route::resource('m_user', POSController::class);
