<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function postEmail(Request $request)
    {
        $data = $request->only('email');
        $validator = Validator::make($data, [
            'email' => 'required|email|exists:users',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        
        $token = Str::random(64);
        // echo $token;
        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => now()]
        );

        Password::sendResetLink($request);

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
}
