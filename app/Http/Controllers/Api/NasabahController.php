<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nasabah;
use Illuminate\Support\Facades\Auth;
use Validator;

class NasabahController extends Controller
{
    public function __contruct(Type $var = null)
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'logout'
            ]
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:nasabah',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->toJson()], 401);            
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = Nasabah::create($input);
        $success['token'] =  $user->createToken('nApp')->accessToken;
        $success['user'] =  $user;

        return response()->json(['success'=>$success], 200);
    }

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('nApp')->accessToken;
            return response()->json(['success' => $success], 200);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
}
