<?php

namespace App\Mailer;

interface MailClient
{
    /**
     * Get client connection.
     *
     */
    public function getClient();
}
