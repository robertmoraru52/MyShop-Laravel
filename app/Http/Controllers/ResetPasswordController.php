<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;

class ResetPasswordController extends Controller
{
    public function resetPasswordRoute ($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    //Changing password in DB after email
    public function resetPassword (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        try{
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
        
                    $user->save();
        
                    event(new PasswordReset($user));
                }
            );
        
            return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
            }
        catch(\Exception $e){
                return 'Error Password did not change';
            }
    }

    public function changePassword(Request $request)
    {
      if(Auth::Check())
      {
          $request_data = $request->All();
          $current_password = Auth::User()->password;           
          if(Hash::check($request_data['current-password'], $current_password))
          {           
            $user_id = Auth::User()->id;                       
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request_data['password']);
            $obj_user->save(); 
            return back()->withSuccess('Password Changed!');
          }
          else
          {           
            $error = array('current-password' => 'Please enter correct current password');
            return back()->withErrors($error['current-password']);   
          }
        }        
      else
      {
        return redirect()->to('/');
      }    
    }
}
