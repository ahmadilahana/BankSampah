<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    
    protected $table = 'lokasi';
    protected $fiilable = ['jalan','kecamatan','kota','provinsi','lng','lat','user_id',];
    public $timestamps = false;
}
