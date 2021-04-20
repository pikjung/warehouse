<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_transaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $primaryKey = 'detail_transaksi_id';
    protected $fillable = ['detail_transaksi_id','transaksi_id','nama_barang','harga_jual','type','qty','sn', 'gudang_id', 'deskripsi'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
