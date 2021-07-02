<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setoran;
use App\Models\Penjualan;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::selectRaw('count(id) as jumlah')->where('role', 'Nasabah')->first();
        $setoran = Setoran::selectRaw('sum(berat) as jumlah')->first();
        $tabungan = Penjualan::selectRaw('sum(debit) as debit')->first();
        $penjualan = Penjualan::selectRaw('sum(berat) as jumlah')->first();
        return view('page.home', ['user'=>$user, 'setoran'=>$setoran, 'tabungan'=>$tabungan, 'penjualan'=>$penjualan]);
    }
}
