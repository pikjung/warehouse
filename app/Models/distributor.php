<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class distributor extends Model
{
    use HasFactory;

    protected $table = 'distributor';
    protected $primaryKey = 'disti_id';
    protected $fillable = ['disti_id','nama_disti','alamat_disti','no_telp_disti'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
