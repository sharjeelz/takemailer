<?php

namespace App\Providers;

use App\Http\Controllers\EmailController;
use App\Jobs\SendEmail;
use App\Mailer\MailClient;
use App\Mailer\MailjetClient;
use App\Mailer\MailjetSender;
use App\Mailer\MailSender;
use App\Mailer\SendgridClient;
use App\Mailer\SendgridSender;
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
      
       // $this->app->bind('App\Mailer\MailSender.mailjet', MailjetSender::class);
        //$this->app->bind('App\Mailer\MailSender.sendgrid', SendgridSender::class);
        

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
