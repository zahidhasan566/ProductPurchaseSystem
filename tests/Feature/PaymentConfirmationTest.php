<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Payment;
use Stripe\Stripe;
use Illuminate\Support\Facades\Config;

class PaymentConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_can_be_confirmed()
    {
        // Arrange: Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        // Act: Send a POST request to confirm the payment
        $response = $this->postJson('/api/payments/confirm', [
            'payment_method_id' => 'pm_card_visa', // Stripe test payment method ID
            'amount' => 5000, // Amount in cents ($50)
            'currency' => 'usd',
        ]);

        // Assert: Check response and database
        $response->assertStatus(200);

        $this->assertDatabaseHas('payments', [
            'user_id' => $user->id,
            'amount' => 50.00,
            'status' => 'succeeded',
        ]);
    }
}
