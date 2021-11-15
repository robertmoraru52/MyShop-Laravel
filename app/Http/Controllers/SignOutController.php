<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SignOutController extends Controller
{    
    /*
    *Sings out current user
    */
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return redirect()->route('login');
    }
}
