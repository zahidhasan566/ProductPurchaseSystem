<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderCreationTest extends TestCase
{
    use RefreshDatabase;
    public function test_order_can_be_created()
    {
        //Create a user and authenticate
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        // Create a product
        $product = Product::factory()->create([
            'name' => 'Laravel Book',
            'price' => 50.00,
            'stock' => 100,
        ]);

        //Send a POST request to create an order
        $response = $this->postJson('/api/orders', [
            'product_id' => $product->id,
            'quantity' => 1,
            'total_price' => $product->price,
        ]);

        //Check response and database
        $response->assertStatus(201);
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'total_price' => $product->price,
        ]);
    }

}

