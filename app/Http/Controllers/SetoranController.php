<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setoran;

class SetoranController extends Controller
{
    public function get_data()
    {
        $data = Setoran::orderByDesc('tgl_setor')->get()->load(['user','jenis']);
        return View('page.setoran', ['data'=>$data]);
    }
}
