<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        if (Auth::check()) {
        return redirect('/dashboard');
        }
        return view('auth.login',['title'=>'Login']);
    }
    public function login(Request $request){
        $auth= $request->validate([
            'email'=>['required','email:dns'],
            'password'=>['required']
        ]);
        if(Auth::attempt($auth)){
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        };
        return back()->with('loginError','Login failed');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
