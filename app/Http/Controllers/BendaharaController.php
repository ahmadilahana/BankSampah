<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class BendaharaController extends Controller
{
    public function get_user()
    {
        $user = User::where('role', 'Bendahara')->get();
        return View('page.bendahara', ['users'=>$user]);
    }
    public function add_user(Request $request)
    {
        $data = $request->only('nama', 'email', 'no_telp', 'password', 'c_password');

        $validator = Validator::make($data, [
            'nama' => 'required|string',
            'email' => 'required|email|unique:users',
            'no_telp' => 'required|numeric|unique:users',
            'password' => 'required|string|min:6|max:50',
            'c_password' => 'required|string|same:password'
        ], [
            'c_password.same' => 'Confirmation Password invalid.',
            'c_password.required' => 'The Confirmation Password field is required.'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $user = User::create([
        	'name' => $request->nama,
        	'email' => $request->email,
        	'no_telp' => $request->no_telp,
        	'role' => "Bendahara",
        	'password' => bcrypt($request->password)
        ]);

        return redirect('/user/bendahara')->with("success", "Bendahara berhasil ditambahkan");
    }

    public function delete_user($id)
    {
        User::destroy($id);
        return redirect()->back()->with("success", "Bendahara berhasil dihapus");
    }

    public function edit_user($id)
    {
        $user = User::find($id);
        return view('form.editbendahara', ['user' => $user]);
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

        return redirect('/user/bendahara')->with("success", "Nasabah berhasil diubah");
    }
}
