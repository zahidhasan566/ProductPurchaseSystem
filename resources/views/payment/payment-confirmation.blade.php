<form id="payment-form">
    <div id="card-element">
        <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>

    <button id="submit">Pay</button>
</form>

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('your-public-key'); // Replace with your Stripe public key
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        const {token, error} = await stripe.createToken(card);

        if (error) {
            // Handle error (e.g., display error message)
            document.getElementById('card-errors').textContent = error.message;
        } else {
            // Send the token to your server for payment confirmation
            fetch('/api/payments/confirm', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    payment_method_id: token.id, // PaymentMethod ID returned from Stripe
                    payment_intent_id: "pi_XXXXXXXXXXXXXXXXXXXXXXXX", // PaymentIntent ID
                    user_id: 1, // Example user ID
                    amount: 5000, // Amount
                    currency: "usd", // Currency code
                }),
            });
        }
    });

</script>
