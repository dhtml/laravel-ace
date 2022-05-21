<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetCustomerTest extends TestCase
{
    public $email = "admin@laravel.com";
    public $password = "password";

    /** @test */
    public function get_single_customer()
    {
        $token = $this->getAuthToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', route('get-customer', ['id' => 1]));

        $response->assertStatus(200);
    }

    public function getAuthToken()
    {
        // Simulated landing
        $response = $this->json('POST', route('login'), [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        return $response->json()['token'] ?? null;
    }

    /** @test */
    public function get_customers()
    {
        $token = $this->getAuthToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', route('get-customers'));
        $response->assertStatus(200);
    }

}
