<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\BukuTabungan;
use Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

class NasabahController extends Controller
{
    protected $token;

    public function register(Request $request)
    {
    	//Validate data
        $data = $request->only('name', 'email', 'no_telp', 'password', 'c_password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'no_telp' => 'required|numeric|unique:users',
            'password' => 'required|string|min:6|max:50',
            'c_password' => 'required|string|same:password'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new user
        $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'no_telp' => $request->no_telp,
        	'role' => "Nasabah",
        	'password' => bcrypt($request->password)
        ]);
        $token = JWTAuth::fromUser($user);
        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user,
            'token' => $token
        ], 200);
    }
 
    public function get_all()
    {
        $user = User::where('role', 'Nasabah')->get();
        return response()->json($user, 200);
    }

    public function buku_tabungan()
    {
        $tabungan = BukuTabungan::where('user_id', Auth::user()->id)->get()->load(['jenis']);
        
        return response()->json($tabungan, 200);
    }
}
