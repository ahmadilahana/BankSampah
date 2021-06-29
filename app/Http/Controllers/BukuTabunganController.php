<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTabungan;
use DB;

class BukuTabunganController extends Controller
{
    public function get_data()
    {
        $data = BukuTabungan::select(['id','tanggal','keterangan','jenis_id','berat','debit','kredit', 'saldo', 'user_id', DB::raw("max(saldo) as total_saldo, sum(berat) as total_berat")])->get()->load('user', 'jenis')->groupBy('user_id');
        return View('page.bukutabungan', ['data'=>$data]);
    }
}
