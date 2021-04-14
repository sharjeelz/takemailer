<?php

namespace Tests\Unit\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SendHttpEmailRequestTest extends TestCase
{
    
    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function test_that_an_http_api_call_can_send_email()
    {
        //$this->withoutExceptionHandling();
        $email_data = [
            'to' => 'szubair01@gmail.com',
            'subject'=> 'Hello',
            'message' => 'Hello from emailer'
        ];
        
        $response = $this->post('/api/email',$email_data);
        return $response->assertStatus(201);
    }
}
