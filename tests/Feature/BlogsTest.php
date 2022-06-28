<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlogsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateBlog()
    {
        $params = [
            "title"         => "New Blog in finance",
            "url"           => "fincnace/url",
            "label"         => "Finance",
            "layout"        => "content.blade.php",
            "category"      => 1,
            "meta_title"    => "title",
            "meta_description"  => "descriptions",
            "meta_keywords"     => "meta titles",
            "status"        => 1
        ];

        $response = $this->json('POST', '/blogs/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testDeleteBlog(){

        $response = $this->json('GET', '/blog/remove/1', []);

        $response->assertStatus(200)->assertJson([
            'deleted' => true,
        ]);
    }
}
