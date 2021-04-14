<?php

namespace App\Jobs;

use App\Mailer\MailClient;
use App\Mailer\MailjetClient;
use App\Mailer\MailjetSender;
use App\Mailer\MailSender;
use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmail implements ShouldQueue
{
    protected $email;
    protected $sender;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Email $email, MailjetSender $sender)
    {
       $this->email= $email;
       $this->sender= $sender;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    
       
        $this->sender->send($this->email);

        
        
    }
}
