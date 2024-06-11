<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\BneSetting;
use App\Models\User;
use App\Models\EventTicket;
use App\Models\Coupon;
use App\Models\UseCoupon;
use App\Models\EventLike;
use App\Models\Transaction;
use App\Models\BookingHistory;
use Session,Mail,DB;
use Illuminate\Support\Str;
use App\Models\Page;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\Auth;
use App\Library\SslCommerz\SslCommerzNotification;
use Psy\Readline\Hoa\Console;
use App\Mail\BookingEmail;
class HomeController extends Controller
{
    public function set(){
        $permission = BneSetting::get();
        Session::put('permission', $permission);
        return true;
    }
     public function index(){
        $event = Event::where('event_date', '>=', date('Y-m-d'))->where('status',0)->orderBy('event_date','asc')->where('is_approved',0)->paginate(8);
        $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
        $this->set();
        // return view('front.pages.index',compact('event'));
        return view('front.pages.index',compact('event','page'));
    }
    public function eventDetails($id){
        if(Auth::check()) {
            $login_id = Auth::user()->id;
            $event_like = EventLike::where('event_id', $id)->where('user_id', $login_id)->value('is_like'); 
        }else{
            $event_like = null; 
        }
        $event = Event::where('id', $id)->get();
        $event_ticket = EventTicket::where('event_id', $id)->get()->min('ticket_cost');
        $this->set();
        $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
        return view('front.pages.event-detail',compact('event','event_ticket','event_like','page'));
    }
    public function buyTicket($id){
        $event = Event::where('id', $id)->get();
        $event_ticket = EventTicket::where('event_id', $id)->where('status',0)->orderBy('ticket_cost', 'ASC')->get();
        $this->set();
        return view('front.pages.buy-ticket',compact('event','event_ticket'));
    }
    public function eventLike($event_id){
        $login_id = Auth::user()->id;
        if(EventLike::where('event_id', $event_id)->where('user_id', $login_id)->exists()){
            $like = EventLike::where('event_id', $event_id)->where('user_id', $login_id)->value('is_like');
            if($like == 0){
                $is_like = 1;
            }
            if($like == 1){
                $is_like = 0;
            }
            $data = EventLike::where('event_id', $event_id)->where('user_id', $login_id)->update(['is_like' => $is_like]);
            if ($data != 1) {
                return response()->json(['message'=>'fail', 'status'=>'0']);
            }
            else {
                return response()->json(['message'=>'Dislike Successfully', 'status'=>'2']);
            }
        }
        else{
            $data = EventLike::insert(['event_id'=>$event_id,'user_id'=>$login_id, 'is_like' => 1]);
            if ($data != 1) {
                return response()->json(['message'=>'fail', 'status'=>'0']);
            }
            else {
                return response()->json(['message'=>'Like Successfully', 'status'=>'1']);
            }
        }
    }
    public function checkout(Request $request){
        if($request->free_tier_ticket == 1){
             if(Auth::check()){
                $user_email = Auth::user()->user_email;
                $user_number =  Auth::user()->user_number;
                $user_name = Auth::user()->user_first_name;
                $user_id = Auth::user()->id;
            }else{
                $user = Session::get('user');
                $user_id = $user[0]['id'];
                $user_number = $user[0]['user_number'];
                $user_email = $user[0]['user_email'];
                $user_name = $user[0]['user_first_name'];
            }
            
            $avail_seats = ($request->avail_seats - $request->qty);
            EventTicket::where('id',$request->id)->update(['avail_seats'=>$avail_seats]);
            
            $str=rand();
            $transaction_order_id = sha1($str);
            
            $transaction = new Transaction;
            $transaction->transaction_order_id = $transaction_order_id;
            $transaction->amount = $request->ticket_price;;
            $transaction->payment_mode = 'SSLCommerz';
            $transaction->is_confirmed = 0;
            $transaction->status = 'Complete';
            $transaction->save();
            $transaction_id = $transaction->id;
    
            $booking_history = new BookingHistory;
            $booking_history->user_id = $user_id;
            $booking_history->transaction_id = $transaction_id;
            $booking_history->coupon_id = $request->coupon_id;
            $booking_history->amount = $request->ticket_price;
            $booking_history->event_id = $request->event_id;
            $booking_history->ticket_id = $request->id;
            $booking_history->qty = $request->qty;
            $booking_history->save();
            $booking_history_id = $booking_history->id;
            // dd($booking_history_id);
            $options = new QROptions(
                [
                    'eccLevel' => QRCode::ECC_L,
                    'outputType' => QRCode::OUTPUT_IMAGE_JPG,
                    'version' => 5,
                ]
            );
            $qrcode = new QRCode($options);
            $imageString = $qrcode->render($transaction_order_id);
            $image_path = time()."_".Str::random(8).".jpg";
            $imagePath = public_path('front/assets/images/qrcode/'.$image_path);
            file_put_contents($imagePath, file_get_contents($imageString));
            
            if(BookingHistory::where('id',$booking_history_id)->update(['ticket_booking_qr_code'=>$image_path])){
                $event = Event::where('id',$request->event_id)->get();
                $data = array(
                    'name'=>$user_name,
                    'email'=>$user_email,
                    'event_name'=>$event[0]->event_name,
                    'location'=>$event[0]->event_location,
                    'date'=>$event[0]->event_date,
                    'time'=>$event[0]->event_start_time,
                    'ticket'=>$request->qty,
                    'total'=>$request->ticket_price,
                    'qrcode'=>$image_path
                );
                $this->sendingMail($data);
                Session::put('sent', 'Your order is successfully compeleted');
                return response()->json(['message'=>'success', 'status'=>'1']);
            } 
        }else{
            if(Auth::check()){
                $user_email = Auth::user()->user_email;
                $user_number =  Auth::user()->user_number;
                $user_name = Auth::user()->user_first_name;
                $user_id = Auth::user()->id;
            }else{
                $user = Session::get('user');
                $user_id = $user[0]['id'];
                $user_number = $user[0]['user_number'];
                $user_email = $user[0]['user_email'];
                $user_name = $user[0]['user_first_name'];
            }
            // dd($user_name);
            $payment_setting = PaymentSetting::get();
            if ($payment_setting[0]->payment_gateway == 1) {
                $tran_id = "BNV_Live".rand(1111111,9999999);
                Session::put('transaction_id', $tran_id);
    
                $booking_data = array(
                    'user_id'=>$user_id,
                    'coupon_id'=>$request->coupon_id,
                    'event_id'=>$request->event_id,
                    'ticket_id'=>$request->id,
                    'qty'=>$request->qty
                );
                // dd($booking_data);
                Session::put('booking_data',$booking_data);
                $currency= "BDT"; 
                $store_id = env('STORE_ID');
                $signature_key = env('SIGNATURE_KEY');
                $merchant_id = env('MERCHANT_ID');
 
                // $url = "https://sandbox.aamarpay.com/jsonpost.php";
                $url = "https://secure.aamarpay.com/jsonpost.php";
            
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "store_id": "'.$store_id.'",
                    "tran_id": "'.$tran_id.'",
                    "success_url": "'.route('success').'",
                    "fail_url": "'.route('fail').'",
                    "cancel_url": "'.route('cancel').'",
                    "amount": "'. $request->ticket_price.'",
                    "currency": "'.$currency.'",
                    "signature_key": "'.$signature_key.'",
                    "merchant_id": "'.$merchant_id.'",
                    "desc": "Ticket booking payment",
                    "cus_name": "'.$user_name.'",
                    "cus_email": "'.$user_email.'",
                    "cus_phone": "'.$user_number.'",
                    "opt_a": "'.$request->ticket_name.'", 
                    "opt_b": "'.$request->coupon_id.'",
                    "opt_c": "'.$request->event_id.'",
                    "opt_d": "'.$request->id.'",
                    "type": "json"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $responseObj = json_decode($response);
                return $responseObj->payment_url;
            }else{
                $post_data = array();
                $post_data['total_amount'] = $request->ticket_price; # You cant not pay less than 10
                $post_data['currency'] = "BDT";
                $post_data['tran_id'] = uniqid(); // tran_id must be unique
        
                # CUSTOMER INFORMATION
                $post_data['cus_name'] = $user_name;
                $post_data['cus_email'] = $user_email;
                $post_data['cus_country'] = "Bangladesh";
                $post_data['cus_phone'] = $user_number;
                $post_data['cus_add1'] = 'Customer Address';
        
                $post_data['shipping_method'] = "NO";
                $post_data['product_name'] = "Computer";
                $post_data['product_category'] = "Goods";
                $post_data['product_profile'] = "physical-goods";
        
                # OPTIONAL PARAMETERS
                $post_data['ticket_name'] = $request->ticket_name;
                $post_data['coupon_id'] = $request->coupon_id;
                $post_data['event_id'] = $request->event_id;
                $post_data['ticket_id'] = $request->id;
                
                $booking_data = array(
                    'user_id'=>$user_id,
                    'coupon_id'=>$request->coupon_id,
                    'event_id'=>$request->event_id,
                    'ticket_id'=>$request->id,
                    'qty'=>$request->qty
                );
                // dd($booking_data);
                Session::put('booking_data',$booking_data);
                
                $sslc = new SslCommerzNotification();
                # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
                return $sslc->makePayment($post_data, 'hosted');
            }
        }
    }
    public function success(Request $request){
        $payment_setting = PaymentSetting::get();
        if ($payment_setting[0]->payment_gateway == 1){
            $request_id= $request->mer_txnid;
            $amount = $request->input('amount');
            $currency = $request->input('currency');
            $booking_data = Session::get('booking_data');

            $transaction = new Transaction;
            $transaction->transaction_order_id = $request_id;
            $transaction->amount = $amount;
            $transaction->payment_mode = 'Aamarpay';
            $transaction->is_confirmed = 0;
            $transaction->status = 'Complete';
            $transaction->save();
            $transaction_id = $transaction->id;
    
            $booking_history = new BookingHistory;
            $booking_history->user_id = $booking_data['user_id'];
            $booking_history->transaction_id = $transaction_id;
            $booking_history->coupon_id = $booking_data['coupon_id'];
            $booking_history->amount = $amount;
            $booking_history->event_id = $booking_data['event_id'];
            $booking_history->ticket_id = $booking_data['ticket_id'];
            $booking_history->qty = $booking_data['qty'];
            $booking_history->save();
            
            $order_details = Transaction::where('transaction_order_id', $request_id)->select('*')->first();
            $booking = BookingHistory::where('transaction_id',$order_details->id)->get();
            $ticket = EventTicket::where('id',$booking_data['ticket_id'])->get();
            $avail_seats = ($ticket[0]->avail_seats - $booking_data['qty']);
            EventTicket::where('id',$booking_data['ticket_id'])->update(['avail_seats'=>$avail_seats]);

            $get_coupon = Coupon::where('id',$booking[0]->coupon_id)->value('no_of_coupon');
            $total = $get_coupon - 1;
            Coupon::where('id',$booking[0]->coupon_id)->update(['no_of_coupon'=>$total]);
            $user = User::where('id',$booking[0]->user_id)->get();

            $apply_discount = Coupon::where('id',$booking[0]->coupon_id)->value('apply_discount');
           
            if($apply_discount){
                UseCoupon::insert(['user_id'=>$booking[0]->user_id,'event_id'=>$booking[0]->event_id,'coupon_id'=>$booking[0]->coupon_id]);
            }
          
            $update_product = Transaction::where('transaction_order_id', $request_id)->update(['is_confirmed'=>1,'status' => 'Complete']);
            $options = new QROptions(
            [
                'eccLevel' => QRCode::ECC_L,
                'outputType' => QRCode::OUTPUT_IMAGE_JPG,
                'version' => 5,
            ]
            );
            $qrcode = new QRCode($options);
            $imageString = $qrcode->render($request_id);
            $image_path = time()."_".Str::random(8).".jpg";
            $imagePath = public_path('front/assets/images/qrcode/'.$image_path);
            file_put_contents($imagePath, file_get_contents($imageString));
            
            if(BookingHistory::where('id',$booking[0]->id)->update(['ticket_booking_qr_code'=>$image_path])){
                $event = Event::where('id',$booking[0]->event_id)->get();
                $data = array(
                        'name'=>$user[0]->user_first_name,
                        'email'=>$user[0]->user_email,
                        'event_name'=>$event[0]->event_name,
                        'location'=>$event[0]->event_location,
                        'date'=>$event[0]->event_date,
                        'time'=>$event[0]->event_start_time,
                        'ticket'=>$booking[0]->qty,
                        'total'=>$booking[0]->amount,
                        'qrcode'=>$image_path
                    );
                $this->sendingMail($data);
                Session::put('sent', 'Your order is successfully compeleted');
                return redirect()->route('booking');
            } else {
                Session::put('notSent', 'fail');
                return redirect()->route('eventList');
            }
        }else{
            $tran_id = $request->input('tran_id');
            $amount = $request->input('amount');
            $currency = $request->input('currency');
            // Session::get('booking_data');
            $booking_data = Session::get('booking_data');
            // dd($booking_data['user_id']);
            $transaction = new Transaction;
            $transaction->transaction_order_id = $tran_id;
            $transaction->amount = $amount;
            $transaction->payment_mode = 'SSLCommerz';
            $transaction->is_confirmed = 0;
            $transaction->status = 'Complete';
            $transaction->save();
            $transaction_id = $transaction->id;
    
            $booking_history = new BookingHistory;
            $booking_history->user_id = $booking_data['user_id'];
            $booking_history->transaction_id = $transaction_id;
            $booking_history->coupon_id = $booking_data['coupon_id'];
            $booking_history->amount = $amount;
            $booking_history->event_id = $booking_data['event_id'];
            $booking_history->ticket_id = $booking_data['ticket_id'];
            $booking_history->qty = $booking_data['qty'];
            $booking_history->save();
            
            $sslc = new SslCommerzNotification();

            #Check order status in order tabel against the transaction id or order id.
            $order_details = Transaction::where('transaction_order_id', $tran_id)->select('*')->first();
            $booking = BookingHistory::where('transaction_id',$order_details->id)->get();
            $ticket = EventTicket::where('id',$booking_data['ticket_id'])->get();
            $avail_seats = ($ticket[0]->avail_seats - $booking_data['qty']);
            EventTicket::where('id',$booking_data['ticket_id'])->update(['avail_seats'=>$avail_seats]);

            $get_coupon = Coupon::where('id',$booking[0]->coupon_id)->value('no_of_coupon');
            $total = $get_coupon - 1;
            Coupon::where('id',$booking[0]->coupon_id)->update(['no_of_coupon'=>$total]);
            $user = User::where('id',$booking[0]->user_id)->get();
            // Session::put('user',$user);
            $apply_discount = Coupon::where('id',$booking[0]->coupon_id)->value('apply_discount');
            if($apply_discount){
                UseCoupon::insert(['user_id'=>$booking[0]->user_id,'event_id'=>$booking[0]->event_id,'coupon_id'=>$booking[0]->coupon_id]);
            }
    
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount,$currency);
            if ($validation) {
                $update_product = Transaction::where('transaction_order_id', $tran_id)->update(['is_confirmed'=>1,'status' => 'Complete']);
                $options = new QROptions(
                [
                    'eccLevel' => QRCode::ECC_L,
                    'outputType' => QRCode::OUTPUT_IMAGE_JPG,
                    'version' => 5,
                ]
                );
                $qrcode = new QRCode($options);
                $imageString = $qrcode->render($tran_id);
                $image_path = time()."_".Str::random(8).".jpg";
                $imagePath = public_path('front/assets/images/qrcode/'.$image_path);
                file_put_contents($imagePath, file_get_contents($imageString));
                
                if(BookingHistory::where('id',$booking[0]->id)->update(['ticket_booking_qr_code'=>$image_path])){
                    $event = Event::where('id',$booking[0]->event_id)->get();
                    $data = array(
                            'name'=>$user[0]->user_first_name,
                            'email'=>$user[0]->user_email,
                            'event_name'=>$event[0]->event_name,
                            'location'=>$event[0]->event_location,
                            'date'=>$event[0]->event_date,
                            'time'=>$event[0]->event_start_time,
                            'ticket'=>$booking[0]->qty,
                            'total'=>$booking[0]->amount,
                            'qrcode'=>$image_path
                        );
                    $this->sendingMail($data);
                    Session::put('sent', 'Your order is successfully compeleted');
                    return redirect()->route('booking');
                } else {
                    Session::put('notSent', 'fail');
                    return redirect()->route('eventList');
                }
            }
        }
    }
    public function fail(Request $request){
        Session::put('notSent', 'Your Order Falied');
        return redirect()->route('eventList');
    }
    public function cancel(Request $request){
        Session::put('notSent', 'Your Order Cancel');
        return redirect()->route('eventList');
    }
    public function ipn(Request $request){
        if ($request->input('tran_id')) {
            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = Transaction::where('transaction_order_id', $tran_id)->select('*')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    
                    $update_product = Transaction::where('transaction_order_id', $tran_id)->update(['is_confirmed'=>1,'status' => 'Complete']);
                        
                    Session::put('sent', 'Your Order successfully');
                    return redirect()->route('eventList');
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
                Session::put('sent', 'Your Order successfully');
                return redirect()->route('eventList');
            } else {
                Session::put('notSent', 'Your Order Falied');
                return redirect()->route('eventList');
            }
        } else {
            Session::put('notSent', 'Invalid Data');
            return redirect()->route('eventList');
        }
    }
    public function getQrCode(Request $request){
        $booking = BookingHistory::with('User','Event')->where('id',$request->booking_id)->get();
        $transaction_order_id = Transaction::where('id',$booking[0]->transaction_id)->value('transaction_order_id');
        $options = new QROptions(
          [
            'eccLevel' => QRCode::ECC_L,
            'outputType' => QRCode::OUTPUT_IMAGE_JPG,
            'version' => 5,
          ]
        );
        $qrcode = new QRCode($options);
        $imageString = $qrcode->render($transaction_order_id);
        $image_path = time()."_".Str::random(8).".jpg";
        $imagePath = public_path('front/assets/images/qrcode/'.$image_path);
        file_put_contents($imagePath, file_get_contents($imageString));
  
        if(BookingHistory::where('id',$request->booking_id)->update(['ticket_booking_qr_code'=>$image_path])){
            $data = array(
                'name'=>$booking[0]['user']->user_first_name,
                'email'=>$booking[0]['user']->user_email,
                'event_name'=>$booking[0]['event']->event_name,
                'location'=>$booking[0]['event']->event_location,
                'date'=>$booking[0]['event']->event_date,
                'time'=>$booking[0]['event']->event_start_time,
                'ticket'=>$booking[0]->qty,
                'total'=>$booking[0]->amount,
                'qrcode'=>$image_path
            );
            $this->sendingMail($data);
            return response()->json(['message'=>'success', 'status'=>'1']); 
        } else {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
    }
    public function sendingMail($data){
        $to_email = $data['email'];
        Mail::to($to_email)->send(new BookingEmail($data));
        return response()->json(['message'=>'success', 'status'=>'1']);
    }
    
    public function booking(){
        if(Auth::check()){
            if(Auth::check()){
                $login_user = Auth::user()->id;
            }else{
                $user = Session::get('user');
                $login_user = $user[0]['id'];
            }
            // $login_user = Auth::user()->id;
            $booking = BookingHistory::with('EventBooking','EventTicket')->where('user_id', $login_user)->orderBy('id', 'desc')->paginate(5);
            $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
            // $booking[0]['EventBooking'][0]['event_name'];
            // $booking = BookingHistory::where('booking_histories.user_id',$login_user)
            //     ->select('qty','ticket_booking_qr_code','amount','booking_histories.created_at','events.event_name','events.event_date','events.event_images','events.event_start_time' ,'events.is_feature','event_tickets.ticket_name')
            //     ->join('events', 'events.id', '=', 'booking_histories.event_id')
            //     ->join('event_tickets', 'event_tickets.id', '=', 'booking_histories.ticket_id')
            //     ->get();
    //        dd($booking);
            $this->set();
            return view('front.pages.booking',compact('booking','page'));
        }else{
            return redirect()->route('user.login');
        }
    }
    public function checkCouponCode(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }else{
            $user = Session::get('user');
            $user_id = $user[0]['id'];
        }
        $coupon =  Coupon::where('coupon_code',$request->coupon_code)->where('event_id',$request->data['event_id'])->get();
        if(!$coupon->isEmpty()){
            if($coupon[0]->apply_discount){
                if(UseCoupon::where('user_id',$user_id)->where('event_id',$request->data['event_id'])->where('coupon_id',$coupon[0]->id)->exists()){
                    return response()->json(['message'=>'fail', 'status'=>'3']);
                }else{
                    if(Coupon::where('coupon_code',$request->coupon_code)->where('event_id',$request->data['event_id'])->exists()){
                        if(Coupon::where('coupon_code',$request->coupon_code)->where('event_id',$request->data['event_id'])->where('no_of_coupon','!=','0')->exists()){
                            $coupon =  Coupon::where('coupon_code',$request->coupon_code)->where('event_id',$request->data['event_id'])->get();
                            return response()->json(['message'=>'success', 'status'=>'1','data'=>$coupon]);
                        }else{
                            return response()->json(['message'=>'fail', 'status'=>'2']);
                        }
                    }else{
                        return response()->json(['message'=>'fail', 'status'=>'0']);
                    }
                }
            }else{
                if(Coupon::where('coupon_code',$request->coupon_code)->where('event_id',$request->data['event_id'])->exists()){
                    if(Coupon::where('coupon_code',$request->coupon_code)->where('event_id',$request->data['event_id'])->where('no_of_coupon','!=','0')->exists()){
                        $coupon =  Coupon::where('coupon_code',$request->coupon_code)->where('event_id',$request->data['event_id'])->get();
                        return response()->json(['message'=>'success', 'status'=>'1','data'=>$coupon]);
                    }else{
                        return response()->json(['message'=>'fail', 'status'=>'2']);
                    }
                }else{
                    return response()->json(['message'=>'fail', 'status'=>'0']);
                }
            }
        }else{
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
    }
    public function scanBooking($id){
        $bookings = BookingHistory::with('EventBooking','EventTicket','User')->where('id', $id)->orderBy('id', 'desc')->get();
        $this->set();
        return view('front/pages/scan_booking',compact('bookings'));
    }
    
     public function aboutUs(){
        $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
        $this->set();
        return view('front.pages.about-us',compact('page'));
    }
    public function privacyPolicy(){
        $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
        $this->set();
        return view('front.pages.privacy-policy',compact('page'));
    }
    public function refundPolicy(){
        $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
        $this->set();
        return view('front.pages.refund-policy',compact('page'));
    }

    public function termsConditions(){
        $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
        $this->set();
        return view('front.pages.terms-conditions',compact('page'));
    }

    public function cancellationPolicy(){
        $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
        $this->set();
        return view('front.pages.cancellation-policy',compact('page'));
    }

    public function event(){
        $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
        if(Auth::check()) {
            $this->set();
            return view('front.pages.events.my-event',compact('page'));
        }else{
            return redirect()->route('user.login');
        }
    }
    public function allmyevent(Request $request){
        $columns_list = array(
            0 =>'id',
            1 =>'event_images',
            2 =>'event_name',
            3 =>'event_date',
            4=> 'event_location',
            5=> 'event_time',
            6=> 'action',
        );
        $totalDataRecord = Event::where('user_id',Auth::user()->id)->where('status',0)->count();
        $totalFilteredRecord = $totalDataRecord;
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');

        if(empty($request->input('search.value'))) {
            $post_data = Event::offset($start_val)
                ->where('user_id',Auth::user()->id)
                ->where('status',0)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');
            $post_data =  Event::where('event_name','LIKE',"%{$search_text}%")
                ->where('user_id',Auth::user()->id)
                ->where('status',0)
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val,$dir_val)
                ->get();

            $totalFilteredRecord = Event::where('event_name','LIKE',"%{$search_text}%")
                ->where('user_id',Auth::user()->id)
                ->where('status',0)
                ->count();
        }
//        return $post_data;
        $data_val = array();
        if(!empty($post_data)) {
            foreach ($post_data as $post_val) {
                if($post_val->event_images != ''){
                    $image = explode(',', $post_val->event_images);
                    $images = '<img class="storie_img_thumb" src="'.url('/admin/assets/images/event/'.$image[$post_val->is_feature]).'"alt="">';
                }else{
                    $images = '';
                }
                $postnestedData['id'] = $post_val->id ;
                $postnestedData['event_image'] = $images;
                $postnestedData['event_name'] = $post_val->event_name;
                $postnestedData['event_location'] = $post_val->event_address;
                $postnestedData['event_date'] = $post_val->event_date;
                $postnestedData['event_time'] = date("h:i A", strtotime($post_val->event_start_time));
                $postnestedData['action'] = '<a href="'.url('/view_event/'.$post_val->id).'" class="btn btn-sm btn-primary" id="edit_btn"  data-toggle="modal" data-target="#editEventModal"> <i class="fa fa-edit"></i></a>
                <button class="btn btn-sm btn-danger" id="delete_btn" onclick="deleteEvent('.$post_val->id.')" data-toggle="modal" data-target="#deleteEventModal"> <i class="fas fa-trash-alt"></i></button>
                <a href="'.url('admin/export/'.$post_val->id).'" class="btn btn-sm btn-success" style="color:white;">Export</a>';
                $data_val[] = $postnestedData;
            }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val
        );
        echo json_encode($get_json_data);
    }
     public function addevent(Request $request){
        $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
        if(Auth::check()){
            $this->set();
            return view('front.pages.events.add-event',compact('page'));
        }else{
            return redirect()->route('user.login');
        }
    }
    public function add_event(Request $request){
        $file_name = $request->event_images->getClientOriginalName();
        $imageFileType = $request->event_images->getClientOriginalExtension();
        $file_path = $request->event_images->getPathName();
        $image_name = "event_" . time(). "." . $imageFileType;
        $request->event_images->move(public_path('admin/assets/images/event'), $image_name);
        $images[] = $image_name;
        $data = array(
            'user_id'=>Auth::user()->id,
            'event_name' => $request->event_name,
            'event_host_by' => $request->event_host_by,
            'event_details'=>$request->event_details,
            'event_location' => $request->event_location,
            'event_address' => $request->event_address,
            'event_date' => $request->event_date,
            'event_start_time' => $request->event_start_time,
            'event_end_time' => $request->event_end_time,
            'event_images' => implode(',', $images),
//            'event_images' =>  $images,
            'is_feature'=>0,
            'is_approved'=>1
        );
        $add_mind_step = Event::insert($data);
        $id = DB::getPdo()->lastInsertId();
        $data = Event::where('id',$id)->get();
        if ($add_mind_step != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1','data'=>$data]);
        }
    }
    public function addEventTicket(Request $request){
        foreach ($request->data as $value){
            $data = array(
                'event_id' => $value['event_id'],
                'ticket_name'=>$value['ticket_name'],
                'ticket_cost' => $value['ticket_cost'],
                'total_ticket'=>$value['avail_seats'],
                'avail_seats' => $value['avail_seats'],
                // 'ticket_fee' => $value['ticket_fee'],
                'description' => $value['description'],
            );
            $add_ticket = EventTicket::insert($data);
        }
        if ($add_ticket != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
   public function viewEvent($id) {
        $event = Event::where('id', $id)->get();
        $event_ticket = EventTicket::where('event_id',$id)->get();
        $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
        $this->set();
        return view('front.pages.events.edit-event',compact('event','event_ticket','page'));
    }
    public function editEvent(Request $request){
        $get_image = Event::where('id', $request->event_id)->get();
        if($request->edit_event_images != null){
            $file_name = $request->edit_event_images->getClientOriginalName();
            $imageFileType = $request->edit_event_images->getClientOriginalExtension();
            $file_path = $request->edit_event_images->getPathName();
            $edit_image_name = "event_" . time() . "." . $imageFileType;
            $request->edit_event_images->move(public_path('admin/assets/images/event'), $edit_image_name);
            $edit_images[] = $edit_image_name;
        }
        if(empty($edit_images)){
            $edit_event_images = $get_image[0]['event_images'];
        }else{
            $edit_event_images = implode(',', $edit_images);
        }
        $edit_mind_step = Event::where('id', $request->event_id)
            ->update(['event_name' => $request->event_name,
                'event_host_by'=>$request->event_host_by,
                'event_details'=>$request->event_details,
                'event_location' => $request->event_location,
                'event_address' => $request->event_address,
                'event_date' => $request->event_date,
                'event_start_time' => $request->event_start_time,
                'event_end_time' => $request->event_end_time,
                'event_images' => $edit_event_images,
                'is_feature'=>0]);
        if ($edit_mind_step != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function editEventTicket(Request $request){
        foreach ($request->data as $value){
            if (array_key_exists("id",$value))
            {
                $data = array(
                    'event_id' => $value['event_id'],
                    'ticket_name'=>$value['ticket_name'],
                    'ticket_cost' => $value['ticket_cost'],
                    // 'total_ticket'=>$value['avail_seats'],
                    'avail_seats' => $value['avail_seats'],
                    // 'ticket_fee' => $value['ticket_fee'],
                    'description' => $value['description'],
                );
                $add_ticket = EventTicket::where('id',$value['id'])->update($data);
            }
            else
            {
                $data = array(
                    'event_id' => $value['event_id'],
                    'ticket_name'=>$value['ticket_name'],
                    'ticket_cost' => $value['ticket_cost'],
                    'total_ticket'=>$value['avail_seats'],
                    'avail_seats' => $value['avail_seats'],
                    // 'ticket_fee' => $value['ticket_fee'],
                    'description' => $value['description'],
                );
                $add_ticket = EventTicket::insert($data);
            }
        }
        if ($add_ticket != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function deleteEvent(Request $request){
        $delete = Event::where('id', $request->delete_id)->update(['status'=>1]);
        if ($delete != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function deleteEventTicket(Request $request){
        $delete = EventTicket::where('id', $request->delete_id)->delete();
        if ($delete != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
    public function hosted($name){
        if(Auth::check()){
            $event = Event::where('event_date', '>=', date('Y-m-d'))->where('status',0)->where('is_approved',0)->where('event_host_by',$name)->paginate(8);
            $this->set();
            return view('front.pages.index',compact('event'));
        }else{
            return redirect()->route('user.login');
        }
    }
    public function requestAccess(){
        $page = Page::where('status',0)->orderBy('order_no', 'asc')->orderBy('page_title', 'asc')->get();
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $access = User::where('id',$user_id)->get();
            $this->set();
            return view('front.pages.request-hosted',compact('access','page'));
        }else{
            return redirect()->route('user.login');
        }
    }
    public function checkRequestAccess(Request $request){
        $user_id = Auth::user()->id;
        $access = User::where('id',$user_id)->value('access_request');
        if($access == 1){
            return response()->json(['message'=>'fail', 'status'=>'0']);

        }else{
            return response()->json(['message'=>'success', 'status'=>'1']);
        }

    }
    public function requestAdminAccess(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
        }else{
            $user = Session::get('user');
            $user_id = $user[0]['id'];
        }
        $user = User::where('id',$user_id)->update(['set_host_name'=>$request->event_host_by,'events_plan'=>$request->events_plan,'access_request'=>1]);
        if ($user != 1) {
            return response()->json(['message'=>'fail', 'status'=>'0']);
        }
        else {
            return response()->json(['message'=>'success', 'status'=>'1']);
        }
    }
}