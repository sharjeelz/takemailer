<?php

declare(strict_types=1);

namespace App\Mailer;


use App\Models\Email;
use App\Mailer\MailSender;
use App\Mailer\SendgridClient;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use SendGrid\Mail\Mail;

final class SendgridSender implements MailSender
{

    private $client;
    private $sendgrid_email;

    /**
     * Inject Client
     *
     * @param SendgridClient  $client
     */
    public function __construct(SendgridClient $client)
    {
        $this->client = $client->getClient();
        $this->sendgrid_email = new Mail();
    }

    /**
     * Send email
     *
     * @param Email  $email
     * @return bool
     */
    public function send(Email $email): bool
    {
            $this->sendgrid_email->setFrom(Config::get('services.sendgrid.from'),);
            $this->sendgrid_email->addTo($email->to,'You');
            $this->sendgrid_email->setSubject($email->subject);
            $this->sendgrid_email->addContent("text/plain",$email->message);
        try {
                      
            $response = $this->client->send($this->sendgrid_email);

           Log::info(Email::SG_EMAIL_SUCCESS.['email.to'=>$email->to,'email.message'=>$email->message,'email.subject'=>$email->subject,'email.date'=>date('y-m-d h:i:s')]);

            
            return $response->statusCode() === Email::SG_SUCCESSFUL_HTTP_CODE;
            
        } catch (\Exception $exception) {
            Log::debug(Email::SG_EMAIL_FAIL);
            

            return false;
        }
    }
}
