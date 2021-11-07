<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewCart(){
        return view('cart');
    }
    public function addToCart(){
        return view('cart');
    }
}
