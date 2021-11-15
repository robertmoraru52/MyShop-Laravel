<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
     /**
     * Return Admin users page with User collection
     */
    public function viewAdminUser(){
        $user = User::paginate(5);

        return view('admin.user_admin', compact('user'));
    }

    /**
     * Soft Deleting Products Function
     */
    public function deleteUser(Request $request){
        try{
            User::where('id', '=', $request->user_id)->delete();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error', 'There was an error');
          }

        return redirect('admin-user');
    }

    /**
     * Add users to DB from Admin Product Table
     */
    public function addUser(Request $request){
        $request->validate([
            'email' => 'required|email|unique:Users',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        try{
            $data = $request->all();
            $dataUser = [
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_admin' => $data['is_admin'],
            ];
            User::create($dataUser);

            return redirect('admin-user');
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error', 'There was an error');
        }
    }

    /**
     * Edit user from Admin Users
     */
    public function editUser(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        try{
            User::where('id', '=', $request->user_id)->update([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => $request->is_admin,
            ]);

            return redirect('admin-user');
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error', 'There was an error');
        }
    }

    //Search Admin User Table
    public function searchAdminUser(Request $request){
        $request->validate([
            'search' => 'required|min:3',
        ]);
        try{
            $data = User::select()
            ->where("email","LIKE","%{$request->search}%")
            ->paginate(5);
    
            return view('admin.user_admin',['user' => $data]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error', 'There was an error');
          }

    }
}
