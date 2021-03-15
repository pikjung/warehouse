<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'customers';
    protected $fillable = ['customers','nama_customers','no_telp','fax','alamat'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
