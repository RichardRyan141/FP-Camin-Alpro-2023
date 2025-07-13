<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'TabelPengguna';
    protected $primaryKey = 'uid';
    protected $fillable = [
        'uid', 'name', 'password'
    ];

    public function nft()
    {
        return $this->hasMany(nft::class, 'owner_uid');
    }
}
