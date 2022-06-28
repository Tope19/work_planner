<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ElementTest extends TestCase
{
     /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateElements()
    {
        $params = [
            'group_id'  => 1,
            'name'      => 'Input Name',
            'value'     => 'Input Value',
            'type'      => 'Input Type',
        ];

        $response = $this->json('POST', '/page/elements/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testDeleteElements(){

        $response = $this->json('GET', '/page/elements/remove/1', []);

        $response->assertStatus(200)->assertJson([
            'deleted' => true,
        ]);
    }
}
