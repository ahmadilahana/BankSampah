<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Setoran;
use App\Models\JenisSampah;
use Validator;

class PenjualanController extends Controller
{
    public function get_data()
    {
        $penjualan = Penjualan::all()->load('jenis');
        return view('page.penjualan',['penjualan'=>$penjualan]);
    }
}
