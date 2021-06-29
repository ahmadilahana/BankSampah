<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setoran;
use Validator;
use App\Models\BukuTabungan;
use App\Models\JenisSampah;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    public function add(Request $request)
    {
        // echo "tambah setoran";
        $data = $request->only('keterangan', 'jenis_id', 'berat', 'user_id');
        $validator = Validator::make($data, [
            'keterangan' => 'required',
            'jenis_id' => 'required',
            'berat' => 'required',
            'user_id' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $harga_satuan = JenisSampah::select('harga')->where('id', $request->jenis_id)->first();
        $debit = 0;
        if ($request->keterangan == "dijemput") {
            $debit = ($harga_satuan['harga'] - ($harga_satuan['harga'] * 0.2)) * $request->berat;
        } else {
            $debit = $harga_satuan['harga'] * $request->berat;
        }
        // echo $debit;
    
        Setoran::create([
            'tgl_setor' => now(),
            'keterangan' => $request->keterangan,
            'jenis_id' => $request->jenis_id,
            'berat' => $request->berat,
            'debit' => $debit,
            'user_id' => $request->user_id,
        ]);
            $user = BukuTabungan::where('user_id', '=', $request->user_id)->orderBy('tanggal', 'DESC')->first();
            // echo $user;
        if ($user == '') {
            $saldo = $debit;
            // echo 'tidak ada user';
        }else {
            $saldo = $user['saldo'] + $debit;
        }

        BukuTabungan::create([
            'tanggal' => now(),
            'keterangan' => $request->keterangan,
            'jenis_id' => $request->jenis_id,
            'berat' => $request->berat,
            'debit' => $debit,
            'saldo' => $saldo,
            'user_id' => $request->user_id,
        ]);
        return response()->json('Setoran berhasil disimpan', 200);
    }

    public function get_data()
    {
        $data = Setoran::orderByDesc('tgl_setor')->get()->load(['user','jenis']);
        return response()->json(['data' => $data], 200);
    }
}
