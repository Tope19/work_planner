<?php

namespace  Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkersTest extends TestCase
{

     // test get all workers
    public function testWorkersGetAllMethod()
    {
       $response = $this->get('/api/v1/workers');
        $response->assertStatus(200);
    }

    // test create workers with valid params
    public function testCreateWorkerMethod(){
        $params = [
            'name' => 'Test Worker',
            'email' => 'name@gmail.com',
        ];

       $response = $this->json('POST','/api/v1/workers', $params, ['Accept' => 'application/json']);
       $response
         ->assertStatus(Response::HTTP_CREATED,$response->status())
         ->assertJson([
            'success' => true,
        ]);
    }

    // test get single worker
    public function testGetSingleWorkerMethod()
    {
        $response = $this->json('GET','/api/v1/workers/1', ['Accept' => 'application/json']);
        $response
         ->assertStatus(Response::HTTP_OK,$response->status())
         ->assertJson([
            'success' => true,
        ]);
    }
}
