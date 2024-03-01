<?php

use App\Http\Controllers\CategoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\UserController;
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


//Route::prefix('products')->group(function(){
    Route::get('/category/food-beverage', [CategoriController::class, 'food_beverage']);
    Route::get('/category/beauty-health', [CategoriController::class, 'beauty_health']);
    Route::get('/category/home-care', [CategoriController::class, 'home_care']);
    Route::get('/category/baby-kid', [CategoriController::class, 'baby_kid']);
//});

Route::get('/products', [CategoriController::class, 'products']);

Route::get('/user/{id}/name/{name}', [UserController::class, 'user']);

Route::get('/penjualan', [PenjualanController::class, 'penjualan']);
