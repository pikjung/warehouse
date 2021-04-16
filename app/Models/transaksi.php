<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';
    protected $fillable = ['transaksi_id','toko_id','no_transaksi','no_inv_platform','customer','alamat','kurir','plat_kendaraan_kurir','label'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
