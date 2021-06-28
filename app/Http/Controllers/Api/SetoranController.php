<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setoran;
use Validator;
use App\Models\JenisSampah;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    public function add(Request $request)
    {
        // echo "tambah setoran";
        $data = $request->only('ketarangan', 'jenis_id', 'berat', 'user_id');
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
        $harga_satuan = JenisSampah::select('harga')->where('id', $request->jenis_id);
        $debit = 0;
        if ($request->keterangan == "dijemput") {
            $debit = $harga_satuan * 0.2;
        } else {
            $debit = $harga_satuan;
        }
        echo $debit;
        // Setoran::create([
        //     'keterangan' => 'required',
        //     'jenis_id' => 'required',
        //     'berat' => 'required',
        //     'user_id' => 'required',
        // ]);

    }
}
