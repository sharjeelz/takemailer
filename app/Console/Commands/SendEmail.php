<?php

namespace App\Console\Commands;


use App\Models\Email;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email Via Console';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info(Email::CONSLE_SEND_EMAIL);
        $to = $this->ask(Email::CONSOLE_RECIPIENT);
        $subject = $this->ask(Email::CONSOLE_SUBJECT);
        $message = $this->ask(Email::CONSOLE_MESSAGE);

        $email = new Email();
        $email->to = $to;
        $email->subject = $subject;
        $email->message = $message;

        if ($this->validateData($email)) {
            $email->save();
            dispatch(new \App\Jobs\SendEmail($email));
            Log::info("Sending Via Console");
            $this->info(Email::CONSOLE_EMAIL_SENT);
        } else {
            $this->error(Email::CONSOLE_MESSAGE_FAILED_VALIDATION);
        }
    }
    private function validateData($email)
    {

        $validator = Validator::make($email->toArray(), [
            'to'            => 'required|string|email|max:255',
            'subject'       => 'required|string|max:150',
            'message'       => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return false;
        }
        return true;
    }
}
