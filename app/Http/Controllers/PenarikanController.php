<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTabungan;
use App\Models\User;
use Validator;

class PenarikanController extends Controller
{
    public function get_data()
    {
        $data = Penarikan::all()->load('user');
        return view('page.penarikan', ['data'=>$data]);
    }

    public function form_penarikan()
    {
        $user = User::select('name', 'id')->where('role', 'Nasabah')->get();
        return view('form.tambahpenarikan', ['users'=>$user]);
    }

    public function store_penarikan(Request $request)
    {
        $data = $request->only('name', 'penarikan');
        $validator = Validator::make($data, [
            'name' => 'required',
            'penarikan' => 'required|numeric',
        ],[
            'name.required' => 'The Nasabah field is required.'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $saldo = BukuTabungan::select('saldo')->where('user_id', $request->name)->latest('tanggal')->first();
        // echo $saldo;
        if (empty($saldo['saldo'])) {
            return redirect()->back()->withErrors(['name'=>'Nasabah Belum Memiliki Saldo'])->withInput($request->all());
        }
        // $count = $saldo['saldo'] - $request->penarikan;
        BukuTabungan::create([
            'tanggal' => now(),
            'keterangan' => "Penarikan",
            'kredit' => $request->penarikan,
            'saldo' => $saldo['saldo'] - $request->penarikan,
            'user_id' => $request->name,
        ]);

        return redirect('/bukutabungan');
    }
}
