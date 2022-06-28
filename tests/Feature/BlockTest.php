<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlockTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateBlock()
    {
        $params = [
            'template_id'   => 1,
            'block_name'    => 'Slideshow',
            'multiple'      => 1,
            'item_max'      => 3,
            'status'        => 1,
        ];

        $response = $this->json('POST', '/page/blocks/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testDeleteBlock(){

        $response = $this->json('GET', '/page/blocks/remove/1', []);

        $response->assertStatus(200)->assertJson([
            'deleted' => true,
        ]);
    }
}
