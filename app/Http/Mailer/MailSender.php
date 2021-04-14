<?php
declare(strict_types=1);

namespace App\Mailer;

use App\Models\Email;

interface MailSender
{
    /**
     * Send email interface method
     *
     * @param Email  $email
     * @return bool
     */
    public function send(Email $email): bool;
}
