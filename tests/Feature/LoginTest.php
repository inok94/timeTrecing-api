<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithoutMiddleware;

    public function testRequiresEmailAndLogin()
    {
        $data = ['email' => 'The email field is required.',
            'password' => 'The password field is required.'
        ];

        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJsonStructure([
                    'email' => 'The email field is required.',
                    'password' => 'The password field is required.',
            ]);
    }

    public function testUserLoginsSuccessfully()
    {
        $payload = ['email' => 'adrian@noreply.com', 'password' => 'secret'];
        $response =$this->postJson('api/login',$payload)->assertStatus(200)->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
                'remember_token',
            ],
        ]);
    }
}
