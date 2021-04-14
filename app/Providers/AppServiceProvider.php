<?php

namespace App\Providers;

use App\Http\Controllers\EmailController;
use App\Jobs\SendEmail;
use App\Mailer\MailClient;
use App\Mailer\MailjetClient;
use App\Mailer\MailjetSender;
use App\Mailer\MailSender;
use App\Models\Email;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MailClient::class, MailjetClient::class);
        $this->app->bind(MailSender::class, MailjetSender::class);

        

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
