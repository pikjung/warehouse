<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toko extends Model
{
    use HasFactory;

    protected $table = 'toko';
    protected $primaryKey = 'toko_id';
    protected $fillable = ['toko_id','platform_id','nama_toko','alamat','logo'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
