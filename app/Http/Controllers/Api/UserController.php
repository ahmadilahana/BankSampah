<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $token;
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
            return response()->json(['error' => $validator->messages()], 200);
        }

        try {
            if (! $this->token = JWTAuth::attempt($credentials)) {
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
            'token' => $this->token,
        ]);
    }
 
    public function get_user(Request $request)
    {
        try {
            // dd(JWTAuth::parseToken());
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function edit_user(Request $request)
    {
        $data = $request->only('name', 'email', 'no_telp');
        $user = Auth::user();
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email',
            'no_telp' => 'required|numeric',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
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
            return response()->json(['error' => $validator->messages()], 200);
        }
        
        User::find($user->id)->update([
            'name' => $request->name,
            'email' => $email,
            'no_telp' => $no_telp,
        ]);

        return response()->json('update data success', 200);
    }

    public function reset_password(Request $request)
    {
        $data = $request->only('new_password', 'c_password', 'old_password');
        $user = Auth::user();
        $validator = Validator::make($data, [
            'new_password' => 'required|string',
            'c_password' => 'required|string|same:new_password',
            'old_password' => 'required|string',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        if (! Hash::check($request['old_password'], $user['password'])) {
            return response()->json('password invalid', 400);
        }else {
            User::find($user->id)->update([
                'password' => $request['new_password'],
            ]);
            return response()->json('change password success', 200);
        }
    }

    public function add_user(Request $request)
    {
        $user = Auth::user();
        $data = $request->only('name', 'email', 'no_telp', 'role', 'password', 'c_password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'no_telp' => 'required|numeric|unique:users',
            'role' => 'required|string',
            'password' => 'required|string|min:6|max:50',
            'c_password' => 'required|string|same:password'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'no_telp' => $request->no_telp,
        	'role' => $request->role,
        	'password' => bcrypt($request->password)
        ]);
        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user,
        ], 200);
    }

    public function edit_user_byadmin(Request $request)
    {
        $data = $request->only('name', 'email', 'no_telp');
        $user = Auth::user();
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email',
            'no_telp' => 'required|numeric',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
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
            return response()->json(['error' => $validator->messages()], 200);
        }
        
        User::find($user->id)->update([
            'name' => $request->name,
            'email' => $email,
            'no_telp' => $no_telp,
        ]);

        return response()->json('update data success', 200);
    }
}
