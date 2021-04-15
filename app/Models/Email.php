<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model

{
    use HasFactory;
    public const MJ_EMAIL_SUCCESS = 'Email Sent Via Mailjet';
    public const MJ_EMAIL_FAIL = 'Email Failed Via Mailjet';

    public const SG_EMAIL_SUCCESS = 'Email Sent Via SendGrid';
    public const SG_EMAIL_FAIL = 'Email Failed Via SendGrid';

    public const SG_SUCCESSFUL_HTTP_CODE = 202;

    public const CONSLE_SEND_EMAIL = 'Lets Send Email';
    public const CONSOLE_RECIPIENT = 'Enter Recipient';
    public const CONSOLE_SUBJECT = 'Enter Subject';
    public const CONSOLE_MESSAGE = 'Enter Message';
    public const CONSOLE_EMAIL_SENT = 'Email Sent';
    public const CONSOLE_MESSAGE_FAILED_VALIDATION = 'validation of data failed';


    

    
    protected $table= 'emails';
    protected $fillable = [
        'to',
        'subject',
        'message',
    ];



}


    