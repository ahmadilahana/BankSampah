<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSampah extends Model
{
    use HasFactory;

    protected $table = 'jenis_sampah';

    protected $fillable = ['jenis', 'harga'];

    public $timestamps = false;

    public function setoran()
    {
        return $this->hasMany(Setoran::class, 'jenis_id', 'id');
    }

    public function tabungan()
    {
        return $this->hasMany(BukuTabungan::class, 'jenis_id', 'id');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'jenis_id', 'id');
    }
}
