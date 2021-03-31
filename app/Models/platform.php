<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class platform extends Model
{
    use HasFactory;

    protected $table = 'platform';
    protected $primaryKey = 'platform_id';
    protected $fillable = ['platform_id','nama','logo'];
    protected $casts = [
        'id' => 'string'
    ];
    public $incrementing = false;
}
