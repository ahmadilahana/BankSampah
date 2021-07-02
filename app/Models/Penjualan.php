<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $fillable = ['tgl_penjualan', 'jenis_id', 'berat', 'debit'];

    public $timestamps = false;

    public function jenis()
    {
        return $this->belongsTo(JenisSampah::class, 'jenis_id', 'id');
    }
}
