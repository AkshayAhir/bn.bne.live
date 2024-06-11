@extends('front.layout.main')
@section('title')
<title>{{env('APP_NAME')}} | Return & Refund Policy</title>
@endsection
@section('footer')
    @include('front.includes.footer')
@endsection
@section('main')
    <section class="event_list_sec">
        <div class="container">
            <div class="row">
                <div class="text-center pb-4">
                    <h1>Return & Refund Policy</h1>
                </div>
                <div>
                    <p><b>BNE Live</b> shall not be held responsible for the loss or damage of the physical or digital tickets and any of the losses or 
                    damages suffered by the holder of the ticket that arise from or in connection with the loss or damage of the tickets.</p>
                    <p>Unless otherwise specified, any form of tickets physical or digital purchased into the customer’s account is neither refundable nor exchangeable. 
                    However, refund or exchange requests in exceptional cases will be considered if the ticket is deemed faulty. The customer is required to submit a 
                    request on bne.live within 2 days from the date of purchase of any faulty tickets. Customers cannot exchange an order more than one time. 
                    Failure to do so will automatically forfeit the customer’s right to make any refund or exchange. If you do not comply with any of the above 
                    conditions, We reserve the right to refuse the return or exchange or impose different or additional conditions. Bne reserves the right to amend 
                    any of the terms and conditions above without prior notice.</p>
                    <p>
                      <b>Processing Refunds:</b>  
                    </p>
                    <ul>
                        <li>Should an event organizer decide to issue a refund through Bne, the refund will be processed minus the payment gateway fees. 
                        There are no additional charges from <b>BNE Live</b> for this service.</li>
                        <li>Refunds are typically credited back to the original mode of payment, unless specified otherwise.</li>
                        <li>The processing time for refunds can vary based on the payment method and the policies of the associated banks or providers.</li>
                        <li>For any physical ticket or merchandise returns, customers bear the return shipping costs to our facility.</li>
                    </ul>
                    
                    
                    <p>
                      <b>Requesting Refunds:</b>  
                    </p>
                    <p>To request a refund, customers can contact us via one of the following methods:</p>
                    <ul>
                        <li>Contact Form: <a href="http://bne.to/bnVCfY7" target="_blank">http://bne.to/bnVCfY7</a></li>
                        <li>Email: support@bne.live</li>
                    </ul>
                    <p>Customers must provide their invoice number and contact us within 24 hours of receiving the item. Our team will provide instructions on how to proceed with the refund process, which may vary depending on the shipping location.</p>
                    <p>
                      <b>Disputes:</b>  
                    </p>
                    <p>If you believe that a refund is warranted and the event organizer is not responsive, please reach out to us. 
                    While the final decision lies with the organizer, we will do our best to mediate the situation.</p>
                    
                </div>
            </div>
        </div>
    </section>
@endsection