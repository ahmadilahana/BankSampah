<?php

namespace App\Http\Controllers;

use App\Models\Setoran;
use Illuminate\Http\Request;

class SetoranController extends Controller
{
    public function get_data()
    {
        $data = Setoran::all();
        return View('page.setoran', ['data'=>$data]);
    }
}
