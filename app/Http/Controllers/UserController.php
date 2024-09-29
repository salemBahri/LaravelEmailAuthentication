<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;




class UserController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'email'=>['required','email',Rule::exists(User::class,'email')]
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

    public function register()
    {
        return view('auth.register');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','max:255'],
            'email'=>['required','email',Rule::exists(User::class,'email')]
        ]);
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email
        ])


        Mail::to($request->email)->send();
        return redirect()->back()->with([
            'sucess'=>'cheack your mail'
        ]);
        
    }
    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('login');
    }
    public function session($email)
    {
        $user=User::whereEmail($email)->first();
        auth()->login($user);
        return redirect()->route('home');

    }
}
