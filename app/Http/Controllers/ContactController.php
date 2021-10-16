<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function viewContact(){
        return view('contact');
    }

    public function sendEmail(Request $request){
        $request->validate([
            'email' => 'required',
            'comment' => 'required',
            'name' => 'required',
        ]);
        Mail::send('mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'comment' => $request->get('comment'),
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('digambersingh126@gmail.com', 'Admin')->subject($request->get('comment'));
        });

        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');    
    }
}
