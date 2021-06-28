<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $table = 'setoran';
    protected $fillabel = ['tgl_setor', 'keterangan', 'jenis_id', 'berat', 'debit', 'user_id'];

    public function jenis()
    {
        return $this->belognsTo(JenisSampah::class, 'jenis_id', 'id');
    }

    public function user()
    {
        return $this->belognsTo(User::class, 'user_id', 'id');
    }
}
