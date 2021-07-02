<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuTabungan;
use DB;

class BukuTabunganController extends Controller
{
    public function get_data()
    {
        $tanggal = BukuTabungan::selectRaw('max(tanggal) as max_tgl')->groupBy('user_id');
        $data = BukuTabungan::select('buku_tabungan.user_id', 'buku_tabungan.saldo')->whereIn('tanggal', $tanggal)->get();
        $berat = BukuTabungan::selectRaw('sum(berat) as total_berat')->groupBy('user_id')->get();
        $buku = BukuTabungan::orderBy('tanggal', 'DESC')->get()->load('jenis');
        return View('page.bukutabungan', ['data'=>$data, 'buku'=>$buku, 'berat'=>$berat]);
    }
}
