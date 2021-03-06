<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    use HasFactory;

    protected $table = 'inventorie';
    protected $primaryKey = 'inventory_id';
    protected $fillable = ['inventory_id','gudang_id','nama_disti','tanggal','note','status','nama_barang','spek','pn','sku','quantity','quantity_awal','harga_barang_satuan','harga_beli_satuan'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
