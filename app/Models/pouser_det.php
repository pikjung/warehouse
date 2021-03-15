<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pouser_det extends Model
{
    use HasFactory;

    protected $table = 'user_req_det';
    protected $primaryKey = 'userReq_det_id';
    protected $fillable = ['userReq_det_id','userReq_id','nama_barang','spek','pn','sku','quantity','harga_barang_satuan'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
