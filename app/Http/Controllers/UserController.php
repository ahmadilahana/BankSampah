<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Modesl\User;

class UserController extends Controller
{
    public function formLogin()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        Auth::attempt($credentials);
        if (! Auth::check()) {
            return redirect()->back()->with("error", "Email or Password invalid")->withInput($request->all());

        }

        if (Auth::user()->role != "Admin") {
            Auth::logout();
            return redirect()->back()->with("error", "Your account doesn't have Login Access")->withInput($request->all());
        }
 	
 		//Token created, return with success response and jwt token
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
