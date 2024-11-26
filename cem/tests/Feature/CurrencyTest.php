<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class CurrencyTest extends TestCase
{
    use RefreshDatabase;

    // test store currency with valid data
    public function testStoreCurrencyWithValidData()
    {
         // Create a user
        $user = User::factory()->create();
        

        // Log in the user using Sanctum
        $response = $this->actingAs($user, 'api')->postJson('/api/currencies', [
            'name' => 'US Dollar',
            'symbol' => 'USD',
        ]);

        // Assert response status
        $response->assertStatus(201)
                ->assertJson([
                    'name' => 'US Dollar',
                    'symbol' => 'USD',
                ]);

    }

    // test store currency with invalid data
    public function testStoreCurrencyWithInvalidData()
    {
        // Create a user
        $user = User::factory()->create();
        
        // Log in the user using Sanctum
        $response = $this->actingAs($user, 'api')->postJson('/api/currencies', [
            'name' => 'US Dollar',
            'symbol' => 'USD',
        ]);

        // Assert response status
        $response->assertStatus(201)
                ->assertJson([
                    'name' => 'US Dollar',
                    'symbol' => 'USD',
                ]);

        // Log in the user using Sanctum
        $response = $this->actingAs($user, 'api')->postJson('/api/currencies', [
            'name' => 'US Dollar',
            'symbol' => 'USD',
        ]);

        // Assert response status
        $response->assertStatus(422)
                ->assertJson([
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'symbol' => [
                            'The symbol has already been taken.'
                        ]
                    ]
                ]);

    }
}
