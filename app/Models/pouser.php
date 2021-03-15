<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pouser extends Model
{
    use HasFactory;

    protected $table = 'user_req';
    protected $primaryKey = 'userReq_id';
    protected $fillable = ['userReq_id','po_customer','dn_no','tanggal','status','customer','penerima','no_telp','payment_terms','alamat','no_invoice','no_resi','paket_id','tgl_inv','tgl_resi','tgl_payment','noted'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
