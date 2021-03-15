<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang_toko extends Model
{
    use HasFactory;

    protected $table = 'barang_toko';
    protected $primaryKey = 'barang_id';
    protected $fillable = ['barang_id','nama_barang','spek','pn','sku','quantity','quantity_awal', 'tanggal_masuk'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
