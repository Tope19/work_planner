<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TemplateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateTemplate()
    {
        $params = [
            "title" => "New Blog in finance",
            "url" => "fincnace/url",
            "label" => "Finance",
            "layout" => "content.blade.php",
            "category" => 1,
            "meta_title" => "title",
            "meta_description" => "descriptions",
            "meta_keywords" => "meta titles",
            "status" => 1,
            'parent' => 1,
            'header_position'  => 1,
            'footer_position' => 0,
            'page_order'  => 1,
        ];

        $response = $this->json('POST', '/page/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testDeleteTemplate(){

        $response = $this->json('GET', '/page/remove/1', []);

        $response->assertStatus(200)->assertJson([
            'deleted' => true,
        ]);
    }
}
