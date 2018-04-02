<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\EmployeeСlient;
use App\ProjectEmployee;
//use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use WithoutMiddleware;

    public function testDataBase()
    {

        $this->assertDatabaseHas('employeeсlients',
            ['id'=>'1']);
        $this->assertDatabaseHas('project_employees', ['id' =>'1']);
    }

    public function testReturnTimesEmployeeClientTest()
    {
        $employee_id = rand(1, 5);
        $client_id = rand(1,5);
        $response = $this->get('/api/exportCsv/employee/'. $employee_id . '/'. $client_id);
        $response->assertStatus(200);
    }

    public function testCurrentlyAssignedEmployee()
    {
        $project_id = rand(1,4);
        $response = $this->get('/api/current-employee/' . $project_id);
        $response->assertStatus(200);
        //$response->assertJsonStructure(['data']);
    }
}
