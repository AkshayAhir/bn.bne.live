@extends('front.layout.main')
@section('title')
<title>{{env('APP_NAME')}} | Cancellation Policy</title>
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('main')
    <section class="event_list_sec" style="padding-bottom:130px !important">
        <div class="container">
            <div class="row">
                <div class="text-center pb-4">
                    <h1>Cancellation Policy</h1>
                </div>
                <div>
                    <p>
                    <b>Cancellation by Users:</b>
                    </p>
                    <ul>
                        <li> Timing: Users can request event organizers to cancel their ticket purchase via BNE Live. However, the ability to cancel and the associated penalties are subject to the event organizer's policies.</li>
                        <li> Fees: If the cancellation is permitted and processed through BNE Live, the payment gateway fees will not be refunded.</li>
                    </ul>
                    <p>
                        <b>Cancellation by Event Organizers:</b>
                    </p>
                    <ul>
                        <li>Communication: If an event is canceled, event organizers are required to notify users promptly. BNE Live will facilitate the notification process but is not responsible for the decision to cancel or postpone an event.</li>
                        <li>Refunds: In the event of cancellation by an organizer, refunds will be subject to the event organizer's refund policy. BNE Live will facilitate the refund process if requested by the organizer. Read our Refund Policy for more details.</li>
                    </ul>
                    <p>
                        <b>Failed Transactions:</b>
                    </p>
                    <p>If a ticket purchase transaction fails but the amount is deducted from the user's account, the user should notify BNE Live immediately. The refund process for failed transactions will be initiated after verification, and only the payment gateway fee will be deducted.</p>
                   
                    <p>
                        <b>Modifications:</b>
                    </p>
                    <p>Any modifications to an event, such as date or venue change, will be communicated by the event organizers. Users are advised to check the event details periodically to stay updated.</p>
                    <p>
                        <b>Amendments:</b>
                    </p>
                    <p>BNE Live may modify this Cancellation Policy from time to time. Users and event organizers are advised to revisit the policy periodically. Continued use of our platform after such changes constitutes acceptance of the updated policy. </p>
                    <p>By using BNE Live's services, clients agree to be bound by this Cancellation Policy and any modifications made to them. If clients have any questions or concerns about these Cancellation Policy, they are encouraged to contact BNE Live via email support@bne.live </p>
                   

                </div>
            </div>
        </div>
    </section>
@endsection