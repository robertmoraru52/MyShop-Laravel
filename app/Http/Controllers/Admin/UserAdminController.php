<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function __construct(Request $request, User $user)
    {   
        $this->request = $request;
        $this->user = $user;
    }

    public function viewAdminUser(){
        return view('admin.user_admin')->with('user', $this->user->paginate(5));
    }

    /**
     * Soft Deleting Products Function
     */
    public function deleteUser(){
        try{
        $this->user->where('id', '=', $this->request->user_id)->delete();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
          }

        return redirect('admin-user');
    }

    /**
     * Add users to DB from Admin Product Table
     */
    public function addUser(){
        $this->request->validate([
            'email' => 'required|email|unique:Users',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        try{
            $data = $this->request->all();
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
    
            return back()->with('error',$e);
        }
    }

    public function editUser(){
        $this->request->validate([
            'email' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        try{
            $data = $this->request->all();
            $dataUser = [
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_admin' => $data['is_admin'],
            ];
            $this->user->where('id', '=', $data['user_id'])->update($dataUser);

            return redirect('admin-user');
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
        }
    }

    //Search Admin User Table
    public function searchAdminUser(){
        $this->request->validate([
            'search' => 'required|min:3',
        ]);
        try{
            $data = User::select()
            ->where("email","LIKE","%{$this->request->search}%")
            ->paginate(5);
    
            return view('admin.user_admin',['user' => $data]);
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
    
            return back()->with('error',$e);
          }

    }
}
