<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gudang extends Model
{
    use HasFactory;

    protected $table = 'gudang';
    protected $primaryKey = 'gudang_id';
    protected $fillable = ['gudang_id','nama_gudang','alamat_gudang','no_telp'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
