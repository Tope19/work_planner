<?php

namespace  Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimetableTest extends TestCase
{

    // test get all timetables
    public function testGetAllTimetable()
    {
       $response = $this->get('/api/v1/timetables');
        $response->assertStatus(200);
    }

    // test create timetable with valid params
    public function testCreateTimetableMethod(){
        $params = [
            'name' => 'Second Shift',
            'start_time' => '16:00:00',
            // 8 hours
            'end_time' => '24:00:00',
        ];

       $response = $this->json('POST','/api/v1/timetables', $params, ['Accept' => 'application/json']);
       $response
         ->assertStatus(Response::HTTP_CREATED,$response->status())
         ->assertJson([
            'success' => true,
        ]);
    }

    // test get single timetable
    public function testGetSingleTimetableMethod()
    {
        $response = $this->json('GET','/api/v1/timetables/1', ['Accept' => 'application/json']);
        $response
         ->assertStatus(Response::HTTP_OK,$response->status())
         ->assertJson([
            'success' => true,
        ]);
    }
}
