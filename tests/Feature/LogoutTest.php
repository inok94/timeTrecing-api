<?php

namespace Tests\Feature;

use App\User;
use App\EmployeeСlient;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use WithoutMiddleware;
    public function testUserIsLoggedOutProperly()
    {
        $user = factory(User::class)->create(['email' => 'user@test.com']);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $this->json('get', '/api/employee-client', [], $headers)->assertStatus(200);
        $this->json('post', '/api/logout', [], $headers)->assertStatus(200);
        $user = User::find($user->id);
        $this->assertEquals(null, $user->api_token);
    }

    public function testUserWithNullToken()
    {
        // Simulating login
        $user = factory(User::class)->create(['email' => 'user@test.com']);
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        // Simulating logout
        $user->api_token = null;
        $user->save();
        $this->json('get', '/api/employee-client', [], $headers)->assertStatus(401);
    }

}
