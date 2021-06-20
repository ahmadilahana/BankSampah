<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nasabah;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Config;

class AdminController extends Controller
{
    public function __contruct()
    {
        Config::set('jwt.user', 'App\Models\Admin'); 
        Config::set('auth.providers.users.model', \App\Models\Admin::class);
    }

    public function login(Request $request)
    {
        Config::set('jwt.user', 'App\Models\Admin'); 
        Config::set('auth.providers.users.model', \App\Models\Admin::class);

        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated
        //Crean token
        $token = JWTAuth::attempt($credentials);
        try {
            if (! $token) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	return $credentials;
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }
 	
 		//Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
}
