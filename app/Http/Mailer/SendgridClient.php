<?php

declare(strict_types=1);

namespace App\Mailer;

use App\Mailer\MailClient;
use Illuminate\Support\Facades\Config;
use SendGrid;

final class SendgridClient implements MailClient
{
    private $client;

    /**
     * Configure Sengdrid
     *
     * 
     */
    public function __construct(array $Config)
    {

        $this->client = new SendGrid($Config['api_key']);
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
