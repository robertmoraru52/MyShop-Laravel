<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class RegisterCustomController extends Controller
{
    public function registration()
    {
        return view('auth.registration');
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        $data = $request->all();
        $user = $this->create($data);
        if($user != 'Error'){
          return redirect("login")->withSuccess('Register Successfull');
        }
        else{
          return $user;
        }
    }

    public function create(array $data)
    {
      try{
        $dataUser = [
          'email' => $data['email'],
          'password' => Hash::make($data['password']),
        ];

        return User::create($dataUser);
      }
      catch(\Exception $e){
        Log::info($e->getMessage());

        return 'Error';
      }
    }    
}