<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function createOrder(array $data)
    {
        $product = Product::findOrFail($data['product_id']);

        // Check stock availability
        if ($product->stock < $data['quantity']) {
            throw new \Exception('Insufficient stock for the product.');
        }
        if (!is_numeric($data['quantity']) || $data['quantity'] < 1) {
            throw new \Exception('Invalid quantity provided.');
        }

        // Calculate total price
        $totalPrice = $product->price * $data['quantity'];

        // Deduct stock
        $product->update(['stock' => $product->stock - $data['quantity']]);

        // Create order
        return Order::create([
            'user_id' => $data['user_id'],
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);
    }
}
