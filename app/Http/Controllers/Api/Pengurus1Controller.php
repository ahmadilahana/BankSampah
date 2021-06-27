<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisSampah;
use Illuminate\Http\Request;

class Pengurus1Controller extends Controller
{
    public function get_jenis_sampah()
    {
        $jenis = JenisSampah::all();
        return response()->json($jenis, 200);
    }
}
