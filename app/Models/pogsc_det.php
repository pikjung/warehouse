<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pogsc_det extends Model
{
    use HasFactory;

    protected $table = 'det_data_barang';
    protected $primaryKey = 'detData_barang_id';
    protected $fillable = ['detData_barang_id','data_barang_id','nama_barang','spek','pn','sku','quantity','harga_beli_satuan'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
