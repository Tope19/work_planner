<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateContacts()
    {
        $params = [
            'company_id'    => 1,
            'email'         => 'david.adebayo@phynixmedia.co.uk',
            'phone'         => '07340960948',
            'address'       => '43, Banockburn road',
            'country'       => 'United Kingdom',
            'postcode'      => 'FK70BU',
            'latlon'        => '5.3456,-4.54654',
            'keywords'      => 'log keywords',
            'status'        => 1,
        ];

        $response = $this->json('POST', '/company/contacts/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testDeleteContacts(){

        $response = $this->json('GET', '/company/contacts/remove/1', []);

        $response->assertStatus(200)->assertJson([
            'deleted' => true,
        ]);
    }
}
