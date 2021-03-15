<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    protected $primaryKey = 'penjualan_id';
    protected $fillable = ['penjualan_id','no_transaksi','toko_id','nama_pembeli','expedisi','no_telp','alamat','tanggal_beli','inv_pembelian'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
