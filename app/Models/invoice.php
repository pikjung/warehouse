<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';
    protected $primaryKey = 'invoice_id';
    protected $fillable = ['invoice_id','userReq_id','no_invoice','tgl','nama_invoice','jumlah'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
