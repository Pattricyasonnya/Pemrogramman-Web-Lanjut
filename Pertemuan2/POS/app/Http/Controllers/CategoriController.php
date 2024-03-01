<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriController extends Controller
{
    public function products(){
        return 'Berbagai macam produk yang tersedia yaitu : 
        <br>1. Food Beverage
        <br>2. Baby Kid
        <br>3. Beauty Health
        <br>4. Home Care';
    }

    public function food_beverage(){
        return view('category.foodbeverage');
    }

    public function beauty_health(){
        return view('category.beautyhealth');
    }

    public function baby_kid(){
        return view('category.babykid');
    }

    public function home_care(){
        return view('category.homecare');
    }
    
}
