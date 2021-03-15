<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan_det extends Model
{
    use HasFactory;

    protected $table = 'penjualan_det_id';
    protected $primaryKey = 'penjualan_det_id';
    protected $fillable = ['penjualan_det_id','penjualan_id','barang_id','quantity','serial'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
