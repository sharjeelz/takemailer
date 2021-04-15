<?php

namespace App\Providers;

use App\Mailer\MailjetClient;
use App\Mailer\SendgridClient;
use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        /**
         * Create singleton for Mailers to be used across the application
         */
        $this->app->singleton(SendgridClient::class, function ($app) {
            $config = $app->make('config');
            $Config = $config->get('services.sendgrid', []);

            return new SendgridClient($Config);
        });

        $this->app->singleton(MailjetClient::class, function ($app) {
            $config = $app->make('config');
            $Config = $config->get('services.mailjet', []);

            return new MailjetClient($Config);
        });

        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
