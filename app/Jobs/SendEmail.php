<?php

namespace App\Jobs;

use App\Mailer\MailjetSender;
use App\Mailer\MailSender;
use App\Mailer\SendgridSender;
use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendEmail implements ShouldQueue
{
    protected $email;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(MailjetSender $sender1, SendgridSender $sender2)
    {
        /**
         * 
         * I think here if we have an array of mail senders, then we can loop through them and if first gives false
         * we move to second, and so on. without having if else
         * 
         * But I am not able to do just that, How to get thoses mailers as an array seems out of my knowledge
         * 
         * We can bind multiple implementations to same interface in this context the Mailsender interface
         * 
         * I believe ther is sometthing we can do with appservice provider to bind classes with interfaces
         */

         
       if ( $sender1->send($this->email) ) {
           return true;
       }
       else {
        $sender2->send($this->email);
       }
    }
    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(\Exception $exception)
    {
        Log::debug('Send Email Job Failed.' . $exception->getMessage());
    }
}
