<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public const ID_KEY = '124';
    protected $table= 'emails';
    protected $fillable = [
        'to',
        'subject',
        'message',
    ];

   
    
    public static $getConstant = [
        self::ID_KEY => '124',
       
    ];


}


    