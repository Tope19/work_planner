<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WebVisitTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVisits()
    {
        $params = [
            'ip'        => '67.98.09.78',
            'region'    => 'Stirlingshire',
            'country_name'      => 'United Kingdom',
            'continent_code'    => 'GB',
            'currency'          => 'GBP',
            'latlon'            => '87.9087,76.8976',
            'state'     => 'Stirling',
            'country'   => 'United Kingdom',
            'status'    => 1
        ];

        $response = $this->json('POST', '/web/visits/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testVisitCount()
    {
        $params = [
            'ip'    => '87.67.09.78',
            'url'   => 'www.google.com',
            'click_count'   => 90,
            'region'        => 'Europe',
            'country_name'  => 'United Kingdom',
            'continent_code' => 'GBP',
            'latlon'        => '90.9876,90.7865',
            'state'         => 'Wales',
            'country'       => 'United Kingdom',
            'status'        => 1,
        ];

        $response = $this->json('POST', '/web/pagevisit/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testVisitClick()
    {
        $params = [
            'ip'    => '87.67.09.78',
            'url'   => 'www.google.com',
            'device'        => 'mobile',
            'agents'        => 'safari/mobile',
            'region'        => 'Europe',
            'country_name'  => 'United Kingdom',
            'continent_code' => 'GBP',
            'latlon'        => '90.9876,90.7865',
            'state'         => 'Wales',
            'country'       => 'United Kingdom',
            'status'        => 1, 
        ];

        $response = $this->json('POST', '/web/pageclicks/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }
}
