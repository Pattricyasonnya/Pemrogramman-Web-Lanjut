<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // public function index(){
    //     // kita ambil data user lalu simpan pada variabel $user
    //     $user = Auth::user();

    //     // kondisi jika usernya ada 
    //     if ($user) {
    //      // jika usernya memiliki level admin 
    //      if ($user->level_id == '1') {
    //         return redirect()->intended('admin');
    //      }   
    //      else if($user -> level_id == '2'){
    //         return redirect()->intended('manager');
    //      }
    //     }
    //     return view('login');
    // }
    
    // public function proses_login(Request $request){
    //     // kita buat validasi pada saat tombol login di klik 
    //     //validasinya username dan password wajib di isi
    //     $request->validate([
    //         'username'=>'required',
    //         'password'=> 'required'
    //     ]);

    //     // ambil data request username dan password 
    //     $credentials = $request->only('username', 'password');
    //     if (Auth::attempt($credentials)) {

    //         // kalau berhasil simpan data user di variabel $user
    //         $user = Auth::user();

    //         // cek lagi jika level usernya admin maka arahkan ke halaman admin
    //         if ($user->level_id == '1') {
    //             return redirect()->intended('admin');
    //         }

    //         // cek lagi jika level usernya biasa maka arahkan ke halaman user

    //         else if($user -> level_id == '2'){
    //             return redirect()->intended('manager');
    //          }

    //          // jika belum ada role maka ke halaman /
    //             return redirect()->intended('/');
    //     }

    //     // jika ga ada data user yang valid maka kembalikan lagi ke halam login 
    //     // pastikan kirim pesan error
    //     return redirect('login')
    //     ->withInput()
    //     ->withErrors(['login gagal' => 'Pastikan kembali username dan password yang dimasukkan sudah benar']);

    // }

    // public function register(){
    //     // tampilan view register 
    //     return view('register');
    // }

    // public function proses_register(Request $request){
    //     // validasi semua field wajib di isi 
    //     // validasi username unique
    //     $validator = FacadesValidator::make($request->all(),[
    //         'nama'=> 'required',
    //         'username'=>'required|unique:m_user',
    //         'password'=>'required'
    //     ]);

    //     // kalau gagal kembali ke halaman register dan muncul pesna error 
    //     if ($validator ->fails()) {
    //         return redirect('/regsiter')
    //         ->withErrors($validator)
    //         ->withInput();
    //     }

    //     // kalau berhasil isi level dan hash passwordnya biar secure
    //     $request['level_id']='2';
    //     $request['password'] = Hash::make($request -> password);

    //     // masukkan semua data pada request ke tabel m_user
    //     UserModel::create($request->all());

    //     // kalo berhasil arahkan ke halaman login 
    //     return redirect()->route('login');
    // }

    // public function logout(Request $request){
    //     //logout itu harus menghapus sessionnya 
    //     $request->session()->flush();

    //     // jalankan fungsi logout pada auth
    //     Auth::logout();

    //     // kembali ke halaman login 
    //     return redirect('login');
    // }





    
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
        if(isset($user)){
            if($user->status == 0){
                return back()->withErrors(['status'=>'Akun belum validasi']);
            }
        }
        
        else{
        return back()->withErrors([
            'username' => $request->username .' username tidak sesuai'
        ])->withInput();
        }

        //auth attempt : mencari dan validasi data ke usermodel, yang datanya dimasukkan apakah sama dengan request yang dikirim       
        if (Auth::attempt($credentials)) {
            
            $request->session()->regenerate();
 
            return redirect()->route('dashboard');
        }
       
        return back()->withErrors([
            'password' => $request->password .' password tidak sesuai'
        ])->withInput();
    }


    //LOG OUT - menampilkan view logout
    public function logout(Request $request): RedirectResponse
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    //menampilkan halaman login kembali
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
