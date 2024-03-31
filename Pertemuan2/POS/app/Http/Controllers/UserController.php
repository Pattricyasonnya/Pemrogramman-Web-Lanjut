<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class UserController extends Controller
{
    /*public function index(){
        $user = UserModel::with('level')->get();
        return view('user', ['data' => $user]);
    }*/
    public function index(){
        $user = UserModel::all();
        return view('user.index', ['data' => $user]);
    }

    public function create(): View
    {
        return view('level.create_user');
    }

    public function store(Request $request) : RedirectResponse {
        $validate = $request->validate([
            'username' => 'required',
            'namaLevel' => 'required',
        ]);

        $request->validate([
            'title'=> 'bail|required|unique:posts|max:255',
            'body'=> 'required',
        ]);

        /*$validateData = $request->validate([
            'title' => ['required', 'unique:posts', 'max:255'],
            'body' => ['required'],
        ]);*/

        /*$validateData = $request->validateWithBag('post', [
            'title' => ['required', 'unique:posts', 'max:255'],
            'body' => ['required'],
        ]);*/

        UserModel::create([
            'level_kode' => $request->kodeLevel,
            'level_nama' => $request->namaLevel,
        ]);
        return redirect('/user');
    }
    
    /*public function create(){
        return view('level.create_level');
    }

    public function store(Request $request){
        LevelModel::create([
            'level_kode' => $request->kodeLevel,
            'level_nama' => $request->namaLevel,
        ]);
        return redirect('/level');
    }*/

    /*public function store(Request $request){
        UserModel::create([
            'username' => $request->username,
            'level_nama' => $request->namaLevel,
        ]);
        return redirect('/user');
    }*/

    /*public function tambah(){
        return view('user_tambah');
    }

    public function tambah_simpan(Request $request){
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make('$request->password'),
            'level_id' => $request->level_id
        ]);

        return redirect('/user');
    }

    public function ubah($id){
        $user=UserModel::find($id);
        return view('user_ubah', ['data' => $user]);
    }

    public function ubah_simpan($id, Request $request){
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->password = Hash::make('$request -> password');
        $user->level_id = $request->level_id;

        $user->save();

        return redirect('/user');
    }

    public function hapus($id){
        $user = UserModel::find($id);
        $user->delete();

        return redirect('/user');
    }

    /*public function index(){
        $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);

        $user -> username = 'manager12';

        $user -> save();

        $user->wasChanged(); // true
        $user->wasChanged('username'); // true
        $user->wasChanged(['username', 'level_id']); // true
        $user->wasChanged('nama'); // false
        dd($user->wasChanged(['nama', 'username'])); // true
    }*/
    /*public function index(){
        $user = UserModel::create(
            [
                'username' => 'manager55',
                'nama' => 'Manager55',
                'password' => Hash::make('12345'),
                'level_id' => 2,
            ]);

            $user -> username = 'manager56';

            $user->isDirty(); //true
            $user->isDirty('username'); //true
            $user->isDirty('nama'); //false
            $user->isDirty(['nama', 'username']); //true

            $user -> isClean(); //false
            $user -> isClean('username'); //false
            $user -> isClean('nama'); //true
            $user -> isClean(['nama', 'username']);//false

            $user -> save();

            $user->isDirty(); //false
            $user -> isClean(); //true
            dd($user->isDirty());
    }*/
    /*public function index(){
        $user = UserModel::firstOrNew(
            [
                'username' => 'manager33',
                'nama' => 'Manager Tiga Tiga',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ],
        );
        $user->save();
        return view('user', ['data' => $user]);
        
    }*/
}
