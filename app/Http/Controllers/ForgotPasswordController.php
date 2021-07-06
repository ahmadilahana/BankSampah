<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Carbon\Carbon;
use Str;
use DB;
use Mail; 
use Hash;

class ForgotPasswordController extends Controller
{
    public function postEmail(Request $request)
    {
        $data = $request->only('email');
        $validator = Validator::make($data, [
            'email' => 'required|email|exists:users',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
        $token = Str::random(64);

      DB::table('password_resets')->insert(
          ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
      );

      Mail::send('customauth.verify', ['token' => $token], function($message) use($request){
          $message->to($request->email);
          $message->subject('Reset Password Notification');
      });

      return redirect()->back()->with('We have e-mailed your password reset link!');
    }

    public function getEmail($token)
    {
        return view('auth.resetpassword', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $data = $request->only('new_password', 'c_password', 'token');
        $validator = Validator::make($data, [
            'new_password' => 'required|string',
            'c_password' => 'required|string|same:new_password',
            'token' => 'required',
        ],[
            'c_password.required' => 'The confirmation password field is required.',
            'c_password.same' => 'The confirmation password invalid.'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $updatePassword = DB::table('password_resets')
                      ->where(['token' => $request->token])
                      ->first();

        if(!$updatePassword){
            return redirect()->back()->withErrors('token', 'Invalid token!');
        }
        $user = User::where('email', $updatePassword->email)
                    ->update(['password' => Hash::make($request->new_password)]);

        DB::table('password_resets')->where(['email'=> $updatePassword->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');

    }
}
