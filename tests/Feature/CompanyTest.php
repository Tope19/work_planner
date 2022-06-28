<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateCompany()
    {
        $params = [
            'title'         => 'Phynix media ltd',
            'description'   => 'Hello world Description',
            'keywords'      => 'Hello world Keyword',
            'status'        => 1,
        ];

        $response = $this->json('POST', '/company/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testDeleteCompany(){

        $response = $this->json('GET', '/company/remove/1', []);

        $response->assertStatus(200)->assertJson([
            'deleted' => true,
        ]);
    }
}
