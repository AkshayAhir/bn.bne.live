@extends('front.layout.main')
@section('title')
    <title>{{env('APP_NAME')}} | Event-detail</title>
@endsection
@section('main')
    <section>
        <div class="container">
            <div class="row">
{{--                <p>--}}
{{--                    We appreciate your business! If you have any questions, please email--}}
{{--                    <a href="mailto:orders@example.com">orders@example.com</a>.--}}
{{--                </p>--}}

            <?php
                $stripe_key = env('STRIPE_KEY');
                $stripe = new \Stripe\StripeClient($stripe_key);
                try {
                    $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);
                    $customer = $stripe->customers->retrieve($session->customer);
                    echo "<h5 class='success-massage'>Thanks for your order, $customer->name!</h5>";
                    http_response_code(200);
                } catch (Error $e) {
                    http_response_code(500);
                    echo json_encode(['error' => $e->getMessage()]);
                }
                ?>
            </div>
        </div>
    </section>
@endsection
