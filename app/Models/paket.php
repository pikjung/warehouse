<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paket extends Model
{
    use HasFactory;

    protected $table = 'paket';
    protected $primaryKey = 'paket_id';
    protected $fillable = ['paket_id','dn_no','nama_paket','expedisi_id','no_resi','tgl_kirim','status'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
