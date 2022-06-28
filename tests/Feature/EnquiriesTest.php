<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EnquiriesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateEnquiries()
    {
        $params = [
            'unique_code'   => '8iujahd',
            'subject'       => 'Hello world Testing',
            'sender_email'  => 'admin@orlmy.com',
            'receipient'    => 'David Adebayo',
            'receipient_email'  => 'david.adebayo@phynixmedia.co.uk',
            'phone'         => '07340960948',
            'message'       => 'Testing message delivery',
            'attachment'    => 'nil',
            'status'        => 1,
        ];

        $response = $this->json('POST', '/web/enquiry/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testDeleteEnquiries(){

        $response = $this->json('GET', '/web/enquiry/remove/1', []);

        $response->assertStatus(200)->assertJson([
            'deleted' => true,
        ]);
    }
}
