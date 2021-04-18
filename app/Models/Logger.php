<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    protected $table = ['logs'];
    protected $fillable = [
        'payload',
        'status',
        'origin',
    ];
   

}
