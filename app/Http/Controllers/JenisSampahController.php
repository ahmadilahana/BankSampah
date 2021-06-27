<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisSampah;
use Validator;

class JenisSampahController extends Controller
{
    public function get_data(Request $request)
    {
        $sampah = JenisSampah::all();
        return view('page.jenis_sampah', ['sampah' => $sampah]);
    }
    public function add_data(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'jenis' => 'required|string',
            'harga' => 'required|numeric',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        JenisSampah::create([
            'jenis' => $request->jenis,
            'harga' => $request->harga
        ]);
        return redirect('/jenis_sampah')->with("success", "Jenis Sampah berhasil ditambahkan");
    }
    public function delete_data($id)
    {
        JenisSampah::destroy($id);
        return redirect()->back()->with("success", "Jenis Sampah berhasil dihapus");
    }
    public function edit_data($id)
    {
        $sampah = JenisSampah::find($id);
        return view('form.editJenisSampah', ['sampah' => $sampah]);
    }
    public function update_data(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'jenis' => 'required|string',
            'harga' => 'required|numeric',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        
        $sampah = JenisSampah::find($id)->update([
            'jenis' => $request->jenis,
            'harga' => $request->harga,
        ]);
        return redirect('/jenis_sampah')->with("success", "Jenis Sampah berhasil diubah");
    }
}
