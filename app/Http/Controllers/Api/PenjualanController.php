<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Setoran;
use App\Models\JenisSampah;
use Validator;

class PenjualanController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->only('jenis_id', 'berat');
        $validator = Validator::make($data, [
            'jenis_id' => 'required',
            'berat' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $total_berat = Setoran::selectRaw('sum(berat) as total')->first();
        if ($request->berat > $total_berat) {
            return response()->json(['error' => 'Berat melebihi total berat yang tercatat'], 200);
        }
        $harga_satuan = JenisSampah::select('harga')->where('id', $request->jenis_id)->first();
        $debit = 0;
            $debit = $harga_satuan['harga'] * $request->berat;
        // echo $debit;
    
        Penjualan::create([
            'tgl_penjualan' => now(),
            'jenis_id' => $request->jenis_id,
            'berat' => $request->berat,
            'debit' => $debit,
        ]);
        return response()->json(['Penjualan berhasi disimpan'], 200);
    }

    public function get_data()
    {
        $penjualan = Penjualan::all()->load('jenis');
        return response()->json($penjualan, 200);
    }
}
