<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShiftTest extends TestCase
{

     // test get all shifts
     public function testShiftsGetAllMethod()
     {
        $response = $this->get('/api/v1/shifts');
         $response->assertStatus(200);
     }

     // test create shift with valid params
     public function testCreateShiftMethod(){
         $params = [
             'worker_id' => 1,
             'timetable_id' => 1,
         ];

        $response = $this->json('POST','/api/v1/shifts', $params, ['Accept' => 'application/json']);
        $response
          ->assertStatus(Response::HTTP_CREATED,$response->status())
          ->assertJson([
             'success' => true,
         ]);
     }


     // test get single shift
     public function testGetSingleShiftMethod()
     {
         $response = $this->json('GET','/api/v1/shifts/1', ['Accept' => 'application/json']);
         $response
          ->assertStatus(Response::HTTP_OK,$response->status())
          ->assertJson([
             'success' => true,
         ]);
     }
}
