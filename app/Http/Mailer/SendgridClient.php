<?php
declare(strict_types=1);

namespace App\Mailer;

use App\Mailer\MailClient;
use SendGrid;

final class SendgridClient implements MailClient
{
    private $client;

    /**
     * Configure Sengdrid
     *
     * @param array  $config
     */
    public function __construct(array $config)
    {
        $this->client = new SendGrid($config['api_key']);
    }

    /**
     * Get senggrid client
     *
     * @return Client
     */
    public function getClient(): SendGrid
    {
        return $this->client;
    }
}
