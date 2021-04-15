<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    public const MJ_EMAIL_SUCCESS = 'Email Sent Via Mailjet';
    public const MJ_EMAIL_FAIL = 'Email Failed Via Mailjet';

    public const SG_EMAIL_SUCCESS = 'Email Sent Via SendGrid';
    public const SG_EMAIL_FAIL = 'Email Failed Via SendGrid';

    public const SG_SUCCESSFUL_HTTP_CODE = 202;
    
    protected $table= 'emails';
    protected $fillable = [
        'to',
        'subject',
        'message',
    ];



}


    