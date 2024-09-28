<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            "email"=>['required','email',Rule::exists(User::class,'email')]
        ]);
        Mail::to($request->email)->send();
        return redirect()->back()->with([
            'sucess'=>'cheack your mail'
        ]);
        
    }
    public function login()
    {
        return view('auth.login');
    }
}
