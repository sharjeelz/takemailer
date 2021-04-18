<?php

namespace Tests\Unit\Web;

use App\Jobs\SendEmail;
use App\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class SendEmailTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     *
     * @return void
     * @test
     */
    public function test_that_an_http_api_call_can_send_a_valid_email()
    {
        //$this->withoutExceptionHandling();
        $email_data = [
            'to' => 'szubair01@gmail.com',
            'subject' => 'Hello',
            'message' => 'Hello from emailer'
        ];

        $response = $this->post('/api/email', $email_data);
        return $response->assertStatus(201);
    }

    /**
     *
     *
     * @return void
     * @test
     */
    public function test_that_an_http_api_call_can_send_a_invalid_email()
    {
        //$this->withoutExceptionHandling();
        $email_data = [
            'to' => 'szubair01',
            'subject' => 'Hello',
            'message' => 'Hello from emailer'
        ];

        $response = $this->post('/api/email', $email_data);
        return $response->assertStatus(302);
    }
    /**
     *
     *
     * @return void
     * @test
     */
    public function test_that_an_http_api_call_can_send_a_empty_subject()
    {
        //$this->withoutExceptionHandling();
        $email_data = [
            'to' => 'szubair01@gmail.com',
            'subject' => null,
            'message' => 'Hello from emailer'
        ];

        $response = $this->post('/api/email', $email_data);
        return $response->assertStatus(302);
    }
    /**
     *
     *
     * @return void
     * @test
     */
    public function test_that_an_http_api_call_can_send_a_empty_message()
    {
        //$this->withoutExceptionHandling();
        $email_data = [
            'to' => 'szubair01@gmail.com',
            'subject' => 'Hello',
            'message' => null
        ];

        $response = $this->post('/api/email', $email_data);
        return $response->assertStatus(302);
    }

    /**
     *
     *
     * @return void
     * @test
     */
    public function test_that_an_http_api_call_can_send_a_valid_data_with_queue()
    {
        Queue::fake();
        $this->withoutExceptionHandling();
        $email_data = [
            'to' => 'szubair01@gmail.com',
            'subject' => 'Hello',
            'message' => 'Hello from emailer'
        ];

        $this->post('/api/email', $email_data);
        Queue::assertPushed(SendEmail::class);
    }

    public function test_send_email_with_valid_data()
    {
        $this->withoutExceptionHandling();
        $this->artisan('send:email')
            ->expectsOutput(Email::CONSLE_SEND_EMAIL)
            ->expectsQuestion(Email::CONSOLE_RECIPIENT, 'szubair01@gmail.com')
            ->expectsQuestion(Email::CONSOLE_SUBJECT, 'From Console Test')
            ->expectsQuestion(Email::CONSOLE_MESSAGE, 'Hello this is laravel console email testing')
            ->expectsOutput(Email::CONSOLE_EMAIL_SENT);
    }

    public function test_send_email_with_invalid_email()
    {
        $this->withoutExceptionHandling();
        $this->artisan('send:email')
            ->expectsOutput(Email::CONSLE_SEND_EMAIL)
            ->expectsQuestion(Email::CONSOLE_RECIPIENT, 'szubair01')
            ->expectsQuestion(Email::CONSOLE_SUBJECT, 'From Console Test')
            ->expectsQuestion(Email::CONSOLE_MESSAGE, 'Hello this is laravel console email testing')
            ->expectsOutput(Email::CONSOLE_MESSAGE_FAILED_VALIDATION);
    }
    public function test_send_email_with_empty_recipient()
    {
        $this->withoutExceptionHandling();
        $this->artisan('send:email')
            ->expectsOutput(Email::CONSLE_SEND_EMAIL)
            ->expectsQuestion(Email::CONSOLE_RECIPIENT, 'szubair01')
            ->expectsQuestion(Email::CONSOLE_SUBJECT, null)
            ->expectsQuestion(Email::CONSOLE_MESSAGE, 'Hello this is laravel console email testing')
            ->expectsOutput(Email::CONSOLE_MESSAGE_FAILED_VALIDATION);
    }
    public function test_send_email_with_empty_message()
    {
        $this->withoutExceptionHandling();
        $this->artisan('send:email')
            ->expectsOutput(Email::CONSLE_SEND_EMAIL)
            ->expectsQuestion(Email::CONSOLE_RECIPIENT, 'szubair01')
            ->expectsQuestion(Email::CONSOLE_SUBJECT, 'From Console Test')
            ->expectsQuestion(Email::CONSOLE_MESSAGE, null)
            ->expectsOutput(Email::CONSOLE_MESSAGE_FAILED_VALIDATION);
    }
    public function test_send_email_with_valid_data_and_queue()
    {
        Queue::fake();
        $this->withoutExceptionHandling();
        $this->artisan('send:email')
            ->expectsOutput(Email::CONSLE_SEND_EMAIL)
            ->expectsQuestion(Email::CONSOLE_RECIPIENT, 'szubair01@gmail.com')
            ->expectsQuestion(Email::CONSOLE_SUBJECT, 'From Console Test')
            ->expectsQuestion(Email::CONSOLE_MESSAGE, 'Hello this is laravel console email testing')
            ->expectsOutput(Email::CONSOLE_EMAIL_SENT);
        Queue::assertPushed(SendEmail::class);
    }
}
