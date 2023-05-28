<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Factories\UserFactory;

class AuthenticationTest extends TestCase
{

    public function testAccessProtectedRouteWithToken(): void
    {
         $user = UserFactory::new()->create();

         $token = $user->createToken('testToken')->plainTextToken;
 
         $response = $this->withHeaders([
             'Authorization' => 'Bearer ' . $token,
         ])->post('/api/v1/short-urls');

         $user->delete();

         $response->assertStatus(200);
    }
}
