<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    // Handle the payment creation
    public function createPayment(Request $request)
    {
        $paymentAmount = 5000; // Fixed amount of $50 in cents
        $productName = "Laravel Book";

        // Set up Stripe API
        $stripeSecret = env('STRIPE_SECRET');
        Stripe::setApiKey($stripeSecret);

        try {
            // Create a PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $paymentAmount,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);

            // Save the payment record with status "pending"
            $payment = Payment::create([
                'product_name' => $productName,
                'amount' => $paymentAmount / 100, // Store in dollars
                'status' => 'pending',
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id,
                'payment_id' => $payment->id,
                'message' => 'Payment created successfully, please proceed to payment.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Payment failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Confirm the payment status after user completes payment
    public function confirmPayment(Request $request)
    {
        $paymentId = $request->input('payment_id');
        $paymentIntentId = $request->input('payment_intent_id');

        // Set up Stripe API
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Retrieve the payment intent status
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            if ($paymentIntent->status == 'succeeded') {
                // Update the payment record to "completed"
                $payment = Payment::find($paymentId);
                $payment->update([
                    'status' => 'completed',
                ]);

                return response()->json([
                    'message' => 'Payment successfully completed.',
                    'payment' => $payment,
                ], 200);
            }

            return response()->json([
                'message' => 'Payment failed.',
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Payment confirmation failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
