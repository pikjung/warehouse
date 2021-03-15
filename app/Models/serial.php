<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class serial extends Model
{
    use HasFactory;

    protected $table = 'serial';
    protected $primaryKey = 'sn_id';
    protected $fillable = ['sn_id','inventory_id','paket_det_id','no_serial','barang_keluar_id','userReq_det_id','status'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
