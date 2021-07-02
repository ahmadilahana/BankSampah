<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Session;
use App\Models\User;

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

        if (Auth::user()->role == "Admin" || Auth::user()->role == "Bendahara") {
            return redirect('/');
        }else {
            Auth::logout();
            return redirect()->back()->with("error", "Your account doesn't have Login Access")->withInput($request->all());
        }
 	
 		//Token created, return with success response and jwt token
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function update_user(Request $request, $id)
    {
        // echo "update";
        $data = $request->only('nama', 'email', 'no_telp');
        $user = User::find($id);
        // var_dump($user);
        $validator = Validator::make($data, [
            'nama' => 'required|string',
            'email' => 'required|email',
            'no_telp' => 'required|numeric',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        if ($request['email'] != $user['email'] && $request['no_telp'] != $user['no_telp']) {
            $validator = Validator::make($data, [
                'email' => 'unique:users',
                'no_telp' => 'unique:users',
            ]);

            $no_telp = $request['no_telp'];
            $email = $request['email'];

        }elseif ($request['email'] != $user['email']) {
            $validator = Validator::make($data, [
                'email' => 'unique:users',
            ]);

            $email = $request['email'];
            $no_telp = $user['no_telp'];

        }elseif ($request['no_telp'] != $user['no_telp']) {
            $validator = Validator::make($data, [
                'no_telp' => 'unique:users',
            ]);

            $no_telp = $request['no_telp'];
            $email = $user['email'];

        }else {

            $no_telp = $user['no_telp'];
            $email = $user['email'];

        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $user->update([
            'name' => $request->nama,
            'email' => $email,
            'no_telp' => $no_telp,
        ]);

        return redirect('/profile')->with("success", "Profile berhasil diubah");
    }

    public function reset_password(Request $request)
    {
        $data = $request->only('new_password', 'c_password', 'old_password');
        $user = Auth::user();
        $validator = Validator::make($data, [
            'new_password' => 'required|string',
            'c_password' => 'required|string|same:new_password',
            'old_password' => 'required|string',
        ],[
            'c_password.required' => 'The confirmation password field is required.',
            'c_password.same' => 'The confirmation password invalid.'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        if (! Hash::check($request['old_password'], $user['password'])) {
            return redirect()->back()->withErrors(['old_password'=>'Old Password Invalid'])->withInput($request->all());
        }else {
            User::find($user->id)->update([
                'password' => Hash::make($request['new_password']),
            ]);
            return redirect()->back()->with(['success'=>'Password Berhasil diubah']);
        }
    }
}
