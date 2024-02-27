<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriController extends Controller
{
    public function products(){
        return view('Products');
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
