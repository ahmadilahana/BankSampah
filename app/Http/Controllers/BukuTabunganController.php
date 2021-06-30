<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTabungan;
use DB;

class BukuTabunganController extends Controller
{
    public function get_data()
    {
        $data = BukuTabungan::select(DB::raw('max(buku_tabungan.saldo) as total_saldo, sum(berat) as total_berat'), 'user_id')->groupBy('user_id')->get()->load('user');
        $buku = BukuTabungan::orderBy('tanggal', 'DESC')->get()->load('jenis');
        return View('page.bukutabungan', ['data'=>$data, 'buku'=>$buku]);
    }
}
