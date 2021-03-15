<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expedisi extends Model
{
    use HasFactory;

    protected $table = 'expedisi';
    protected $primaryKey = 'expedisi_id';
    protected $fillable = ['expedisi_id','nama_expedisi','alamat_expedisi','no_telp'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
