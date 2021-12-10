<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginCustomController extends Controller{
    public function index()
    {
        return view('auth.login');
    }  

    /**
     * Check For Login
     */
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
                return redirect('/homepage');
        }
        else{
            return redirect("login")->withSuccess('Login details are not valid');
        }
    }
}