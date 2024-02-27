<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user($id, $name){
        return 'IDENTITAS USER <br>
        ID : '.$id.'
        <br>Nama : '.$name;
    }
}
