<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nft extends Model
{
    use HasFactory;

    protected $table = 'TabelNFT';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'description', 'image_link', 'owner_uid'
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'owner_uid');
    }
}
