<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        /*return 'IDENTITAS USER <br>
        ID : '.$id.'
        <br>Nama : '.$name;*/

        //Menambahkan data user
       /*$data= [
        'username' => 'customer-1',
        'nama' => 'Pelanggan',
        'password' => Hash::make('12344'),
        'level_id' => 4
       ];
       UserModel::insert($data);*/

       //Menambahkan data user 
       $data = [
        'nama' => 'Pelanggan Pertama',
       ];

       UserModel::where('username', 'customer-1')->update($data);

        //akses model usermodel
        $user = UserModel::all();
        return view('user', ['data' => $user]);
    }
}
