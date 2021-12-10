<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ImageUploadController extends Controller
{
    /**
     * Sends image collection to vue component
     */
    public function getImage(){
        $data = User::find(Auth::user()->id)->image;
        return response()->json($data);
    }

    public function imageUploadPost(Request $request)
    {   
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();  
        $request->image->storeAs('images', $imageName,'public');
        /* Store $imageName name in DATABASE from HERE */
        $user = User::find(Auth::user()->id);
        $user->image = $imageName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName); 
    }
}
