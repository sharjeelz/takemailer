<?php
declare(strict_types=1);

namespace App\Mailer;

use App\Mailer\MailClient;
use Mailjet\Client;

final class MailjetClient implements MailClient
{
    private $client;

    /**
     * Configure Mailjet
     *
     * @param array  $config
     */
    public function __construct(array $config)
    {
        $this->client = new Client(
            $config['api_key'],
            $config['api_secret'],
            $config['performer'],
            [
                'version' => $config['version']
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
