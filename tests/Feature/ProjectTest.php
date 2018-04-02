<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Given a project, implement an operation that returns the number of hours that were tracked
     * on that project.
     *
     * @return void
     */
    public function testCanReturnTimesProjectTest()
    {
        $id = rand(1, 100);

        $response = $this->get('/api/spent-time/project/' . $id);

        //dd($response->json());

        $response->assertStatus(200);
        $response->assertJsonStructure( [
            "name",
            "state"
        ]);
    }
}
