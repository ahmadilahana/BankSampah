<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Setoran extends Model
{
    use HasFactory;

    protected $table = 'setoran';
    protected $fillable = ['tgl_setor', 'keterangan', 'jenis_id', 'berat', 'debit', 'user_id'];
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
