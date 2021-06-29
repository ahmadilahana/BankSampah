<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BukuTabunganController extends Controller
{
    public function get_data()
    {
        $data = Setoran::all();
        return View('page.setoran', ['data'=>$data]);
    }
}
