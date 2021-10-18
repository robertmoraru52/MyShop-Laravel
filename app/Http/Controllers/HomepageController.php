<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    public function homepage(){
      return view('homepage', [
        'products' => DB::table('products')->paginate(6)
      ]);
    }

    public function accountView(){
      return view('account');
    }
}
