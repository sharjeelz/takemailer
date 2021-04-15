<?php

namespace App\Jobs;

use App\Mailer\MailjetSender;
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
    public function handle(MailjetSender $sensder)
    {
        /**
         * 
         * I think here if we have an array of mail senders, then we can loop through them and if first gives false
         * we move to second, and so on.
         * 
         * But I am not able to do just that, How to get thoses mailers as an array seems out of my knowledge
         */

        $sensder->send($this->email);
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
