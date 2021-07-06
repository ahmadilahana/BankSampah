<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProfile extends Model
{
    use HasFactory;

    protected $table = 'ft_profile';
    protected $fillable = ['id', 'foto', 'user_id'];

    public $timestamps = false;
    // protected $primaryKey = 'id';
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
