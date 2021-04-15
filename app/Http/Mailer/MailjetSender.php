<?php
declare(strict_types=1);

namespace App\Mailer;


use App\Models\Email;
use Mailjet\Resources;
use App\Mailer\MailSender;
use App\Mailer\MailjetClient;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

final class MailjetSender implements MailSender
{

    private $client;
    private $messageBody = [];

    /**
     * Inject Client
     *
     * @param MailjetClient  $client
     */
    public function __construct(MailjetClient $client)
    {
        $this->client = $client->getClient();
    }

    /**
     * Send email
     *
     * @param Email  $email
     * @return bool
     */
    public function send(Email $email): bool
    {

        $this->messageBody = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => Config::get('services.sendgrid.from'),
                        'Name' => "Me"
                    ],
                    'To' => [
                        [
                            'Email' => $email->to,
                            'Name' => "You"
                        ]
                    ],
                    'Subject' => $email->subject,
                    'TextPart' => $email->message,
                ]
            ]
        ];

        try {
    
            $response = $this->client->post(Resources::$Email, ['body' => $this->messageBody]);
            Log::info(Email::MJ_EMAIL_SUCCESS.['email.to'=>$email->to,'email.message'=>$email->message,'email.subject'=>$email->subject,'email.date'=>date('y-m-d h:i:s')]);
            return $response->success();
        } catch (\Exception $exception) {
            
            Log::debug(Email::MJ_EMAIL_FAIL.$exception->getMessage());
            return false;

           
        }
    }
}
