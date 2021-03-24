<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pogsc extends Model
{
    use HasFactory;

    protected $table = 'data_barang';
    protected $primaryKey = 'data_barang_id';
    protected $fillable = ['data_barang_id','gudang_id','nama_disti','name','no_telp','fax','alamat','no_po_gsc','ship_to','no_telp_ship','ship_name','tanggal','tgl_terima','status','noted','payment_terms'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
