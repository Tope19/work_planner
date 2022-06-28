<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewslettersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateNewsletter()
    {
        $params = [
            'email'     => 'david.adebayo@phynixmedia.co.uk',
            'latlon'    => '9876,9879',
            'state'     => 'Ondo',
            'country'   => 'Nigeria',
            'status'    => 1,
        ];

        $response = $this->json('POST', '/web/newsletters/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
        //$this->assertTrue(true);
    }

    public function testDeleteNewsletter(){

        $response = $this->json('GET', '/web/newsletters/remove/1', []);

        $response->assertStatus(200)->assertJson([
            'deleted' => true,
        ]);
    }
}
