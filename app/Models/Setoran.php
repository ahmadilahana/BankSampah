<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $table = 'setoran';
    protected $fillabel = ['tgl_setor', 'keterangan', 'jenis_id', 'berat', 'debit'];
}
