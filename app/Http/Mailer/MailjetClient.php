<?php
declare(strict_types=1);

namespace App\Mailer;

use App\Mailer\MailClient;
use Illuminate\Support\Facades\Config;
use Mailjet\Client;

final class MailjetClient implements MailClient
{
    private $client;

    /**
     * Configure Mailjet
     *
     * 
     */
    public function __construct(array $Config)
    {
        $this->client = new Client(
            $Config['api_key'],
            $Config['api_secret'],
            $Config['performer'],
            [
                'version' =>$Config['version']

            ]

        );
    }

    /**
     * Get Mailjet client
     *
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
