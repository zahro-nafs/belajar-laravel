<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register',['title'=>'Register']);
    }
    public function register(Request $request){
        $validateData = $request->validate([
            'name'=>['required','min:3','max:100'],
            'email'=>['required','email:dns','unique:users'],
            'password'=>['required','min:5','max:100'],
        ]);
        $valedateData['role']='user';
        User::create($validateData);
        return redirect('/login')->with('success','Register Successful');
    }
}