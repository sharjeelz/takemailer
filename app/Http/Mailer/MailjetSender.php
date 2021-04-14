<?php
declare(strict_types=1);

namespace App\Mailer;


use App\Models\Email;
use Mailjet\Resources;
use App\Mailer\MailSender;
use App\Mailer\MailjetClient;

final class MailjetSender implements MailSender
{

    private $client;
    private $message = [];
    private $email;

    /**
     * Config Mailjet Client
     *
     * @param MailjetClient  $client
     */
    public function __construct(MailjetClient $client)
    {
        $this->client = $client->getClient();
    }

    /**
     * Send email via Mailjet
     *
     * @param Email  $email
     * @return bool
     */
    public function send(Email $email): bool
    {
        try {
     echo 'mailjet';
         dd($email);
exit;
            $messageBody = [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => "$SENDER_EMAIL",
                            'Name' => "Me"
                        ],
                        'To' => [
                            [
                                'Email' => "$RECIPIENT_EMAIL",
                                'Name' => "You"
                            ]
                        ],
                        'Subject' => "My first Mailjet Email!",
                        'TextPart' => "Greetings from Mailjet!",
                        'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href=\"https://www.mailjet.com/\">Mailjet</a>!</h3>
                        <br />May the delivery force be with you!"
                    ]
                ]
            ];
            $response = $this->client->post(Resources::$Email, ['body' => $this->messageBody]);

            return $response->success();
        } catch (\Exception $exception) {
            
            dd($exception->getMessage());

            return false;
        }
    }
}
