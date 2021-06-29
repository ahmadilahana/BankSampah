<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTabungan extends Model
{
    use HasFactory;

    protected $table = 'buku_tabungan';
    protected $fillable = [
        'tanggal', 'keterangan', 'jenis_id', 'berat', 'debit', 'kredit', 'saldo', 'user_id',
    ];

    public $timestamps = false;

    public function jenis()
    {
        return $this->belongsTo(JenisSampah::class, 'jenis_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
