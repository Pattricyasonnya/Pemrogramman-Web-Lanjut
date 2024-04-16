<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    //untuk menampilkan view 
    public function index(){
        return view('login');
    }


    //untuk operasi saat login yang nantinya memanggil view login class index
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = UserModel::where('username', $credentials['username'])->first();
            if($user->status == 0){
                return back()->withErrors(['status'=>'Akun belum validasi']);
            } 
        
        //auth attempt mencari dan validasi data ke usermodel yang datanya dimasukkan apakah sama dengan request yang dikirim       
        if (Auth::attempt($credentials)) {
            
            $request->session()->regenerate();
 
            return redirect()->route('dashboard');
        }
 
        return back()->withErrors([
            'autenticate' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request): RedirectResponse
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect()->route('login.index');
}

public function register(Request $request){
    $register = $request->validate([
        'nama' => 'required',
        'username'=> 'required|unique:m_user,username',
        'password' => 'required',
        'confirm_password' => 'required|same:password',
        'profil_img' => 'required|mimes:png,jpg,jpeg|max:1024',
    ]);

    //first : return 1 data, get berupa array. first tidak akses index langsung field level id
    $register['level_id']=LevelModel::where('level_nama', 'Member')->first()->level_id;

    $register['status']=0;

    try {
        //begin : menunjukkan akan adanya proses
        DB::beginTransaction();
        //dipakai simpan file request ke folder laravel
        $profilimg=$register['profil_img'];
        // membuat nama random + nama asli 
        //get : mendapatkan nama asli
        $profilname=Str::random(10).$register['profil_img']->getClientOriginalName();
        //digunakan menyimpan profil. public/profil itu path
        $profilimg->storeAs('public/profil', $profilname);
        //nama yang disimpan untuk data register
        $register['profil_img']=$profilname;

        UserModel::create($register);
        //commit: nge save perintah sql
        DB::commit();
        //membawa ke login.index jika berhasil 
        return redirect()->route('login.index')->with('success','Register berhasil');

        //cath jalan saat try error yang disimpan pada variabel th
    } catch (\Throwable $th) {
        //saat error proses dibatalkan sqlnya dan dirollback
        DB::rollBack();
        return back()->withErrors(['error'=>$th->getMessage()]);
    }
}

public function signup(){
    return view('register');
}
}
