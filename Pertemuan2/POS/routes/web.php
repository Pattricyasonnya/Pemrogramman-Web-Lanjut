<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/hello', [WelcomeController::class,'hello']);

Route::get('/world', function(){
    return 'World';
});

Route::get('/index', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('articles/{id}', [PageController::class, 'articles']);


Route::get('/Home', [HomeController::class, 'Home']);
Route::get('/about', [AboutController::class, 'About']);
Route::get('article/{id}', [ArticleController::class, 'article']);


//Route::resource('photos', PhotoController::class);
Route::resource('photos', PhotoController::class)
->only(['index', 'show']);
//Route::resource('photos', PhotoController::class)
//->except(['create', 'store', 'update', 'destroy']);


//Route::get('/greeting', function(){
    //return view('hello', ['name'=> 'Sonnya']);
//});

//Route::get('/greeting', function(){
    //return view('blog.hello', ['name' => 'Sonnya']);
//});

Route::get('greeting', [WelcomeController::class, 'greeting']);








//Route::get('/about', function(){
    //return '2141762060 , Pattricya Sonnya Fridayanti'; 
//});

Route::get('/user/{name}', function($name){
    return 'Nama saya '.$name;
});

Route::get('posts/{post}/comments/{comment}', function
($postId, $commentId){
    return 'Pos ke-'.$postId. " Komentar ke-".$commentId;
});

//Route::get('articles/{article}/ids/{id}',function
//($postArticle, $id){
    //return 'Artikel '.$postArticle. " dengan id ".$id;
//});

//optional route
Route::get('/user/{name?}', function($name='John'){
    return 'Nama saya '.$name;
});

//ROUTE NAME
//Route::get('/user/profile', function(){
    //
//})->name('profile');

//Route::get('/user/profile',
//[UserProfileController::class, 'show']
//)->name('profile');

//generate url
//$url=route('profile');

//generate redirects
//return redirect()->route('profile');


//ROUTE GROUP
//Route::middleware(['first', 'second'])->group(function () { 
    //Route::get('/', function () { 
        // Uses first & second middleware... 
    //}); 
 
//Route::get('/user/profile', function () { 
        // Uses first & second middleware... 
    //}); 
//}); 
 
//Route::domain('{account}.example.com')->group(function () { 
    //Route::get('user/{id}', function ($account, $id) { 
        // 
    //}); 
//}); 
 
//Route::middleware('auth')->group(function () { 
 //Route::get('/user', [UserController::class, 'index']); 
 //Route::get('/post', [PostController::class, 'index']); 
 //Route::get('/event', [EventController::class, 'index']); 
  
//});

//ROUTE PREFIXES
//Route::prefix('admin')->group(function () { 
    //Route::get('/user', [UserController::class, 'index']); 
    //Route::get('/post', [PostController::class, 'index']); 
    //Route::get('/event', [EventController::class, 'index']); 
   //});

//REDIRECTS ROUTES
Route::redirect('/here', '/there'); 

//VIEW ROUTES
Route::view('/welcome', 'welcome'); 
Route::view('/welcome', 'welcome', ['name' => 'Taylor']);

//CONTROLLER


//FUNGSI VAR_DUMP
//Route::get('/hello', function(){
    //$hello = 'Hello World';
    //var_dump($hello);
    //die();

    //return $hello;
//});

//FUNGSI DD
//Route::get('hello', function(){
    //$hello = ['Hello World', 2 => ['Hello Jakarta', 'Hello Medan']];
    //dd($hello);

    //return $hello;
//});

//Route::get('/mahasiswa', function(){
    //$arrMahasiswa = ["Rossi", "Ereen", "Andika","Ima", "Neddy"];

    //return view('polinema.mahasiswa',['mahasiswa' => $arrMahasiswa]);
//});

//Route::get('/dosen', function(){
    //$arrDosen = ["Atiqah", "Annisa Taufika", "Dimas","Milyun", "Sofyan"];

    //return view('polinema.dosen',['dosen' => $arrDosen]);
//});