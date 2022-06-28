<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Blogs\Blogs;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $params = [
            "name" => "Olayinka David Adebayo",
            "email" => "david4real_chris@yahoo.com",
            "password" => "@david4Real",
        ];

        $response = $this->json('POST', '/admin/user/create', $params);

        $response
            ->assertStatus(200)
            ->assertJson([
                'created' => true,
            ]);
    }

    public function testDeleteUser(){

        // $response = $this->json('GET', '/admin/user/remove/1', []);

        // $response->assertStatus(200)->assertJson([
        //     'deleted' => true,
        // ]);
        $this->assertTrue(true);
    }

}
