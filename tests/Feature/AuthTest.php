<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    public $email = "admin@laravel.com";
    public $password = "password";

    public function testLogin()
    {
        // Simulated landing
        $response = $this->json('POST', route('login'), [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        // Determine whether the login is successful and receive token
        $response->assertStatus(200);

        //check if token is present
        $this->assertArrayHasKey('token', $response->json());
    }
}
