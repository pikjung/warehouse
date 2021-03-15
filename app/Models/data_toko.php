<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_toko extends Model
{
    use HasFactory;

    protected $table = 'data_toko';
    protected $primaryKey = 'toko_id';
    protected $fillable = ['toko_id','nama_toko','platform_toko','alamat_toko','no_telp_toko','logo_toko'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
