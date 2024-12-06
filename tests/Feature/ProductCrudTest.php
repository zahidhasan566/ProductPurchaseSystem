<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_can_be_created()
    {
        // User Creation and authenticate
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        // Authenticate the user (using Sanctum)
        $this->actingAs($user, 'sanctum');

        // Send a POST request to create the product
        $response = $this->postJson('/api/products/create', [
            'name' => 'Laravel Book',
            'description' => 'A comprehensive guide to Laravel.',
            'price' => 50.00,
            'stock' => 100,
        ]);
        // Assert the response status is 201 (Created)
        $response->assertStatus(201);

        // Assert that the product was created in the database
        $this->assertDatabaseHas('products', [
            'name' => 'Laravel Book',
        ]);
    }

    public function test_product_can_be_updated()
    {

        // User Creation and authenticate
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user, 'sanctum');

        //Create a product
        $product = Product::factory()->create([
            'name' => 'Laravel Book',
            'description' => 'A guide to Laravel.',
            'price' => 50.00,
            'stock' => 100,
        ]);

        // Act: Send a PUT request to update the product
        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => 'Updated Laravel Book',
            'description' => 'Updated guide to Laravel.',
            'price' => 60.00,
            'stock' => 50,
        ]);

        // Check response and database
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', [
            'name' => 'Updated Laravel Book',
        ]);
    }

    public function test_product_can_be_deleted()
    {
        // User Creation and authenticate
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        // Authenticate the user (assuming Sanctum for API authentication)
        $this->actingAs($user, 'sanctum');

        // Create a product using the factory
        $product = Product::factory()->create();

        // Perform the delete operation
        $response = $this->deleteJson('/api/products/' . $product->id);

        // Assert the product was deleted
        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}

