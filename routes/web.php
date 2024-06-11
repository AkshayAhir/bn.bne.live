<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ScanTicketController;
use App\Http\Controllers\admin\BneSettingController;
use App\Http\Controllers\admin\AdminLoginRegisterController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\EventTicketController;
use App\Http\Controllers\admin\EventCouponController;
use App\Http\Controllers\admin\BookingHistoryController;
use App\Http\Controllers\front\LoginController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\front\FrontDashboadController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\front\DynamicController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('admin/login', [AdminLoginRegisterController::class, 'index'])->name('login');
Route::post('admin/login_data', [AdminLoginRegisterController::class, 'loginUser']);
Route::get('admin/register', [AdminLoginRegisterController::class, 'register']);
Route::get('admin/logout', [AdminLoginRegisterController::class, 'logout']);



Route::group(['prefix'=>'admin', 'middleware' => 'auth:admin'], function () {
//    Route::get('dashboard', function () {
//        return "Admin Dashboard";
//    });
//    Route::get('event',[EventController::class,'index']);
    Route::get('dashboard',[DashboardController::class,'index']);
    Route::post('dateChange',[DashboardController::class,'dateChange']);

    Route::get('event',[EventController::class,'index'])->name('admin.event');
    Route::post('allevent',[EventController::class,'allevent']);
    Route::post('add_event',[EventController::class,'addEvent']);
    Route::post('delete_event/{id}',[EventController::class,'deleteEvent']);
    Route::post('view_event/{id}',[EventController::class,'viewEvent']);
    Route::post('edit_event/{id}',[EventController::class,'editEvent']);
    Route::post('approve_change',[EventController::class,'eventApproved']);
    Route::get('delete-event',[EventController::class,'deleteEvents'])->name('delete-event');
    Route::post('alldeletedevent',[EventController::class,'alldeletedevent']);
    Route::post('restore_event',[EventController::class,'restoreEvent'])->name('restore_event');
    Route::get('export/{id}',[EventController::class,'export']);
    
    Route::get('send-ticket/{id}',[EventController::class,'sendTicket'])->name('send-ticket');
    Route::post('send_event_ticket',[EventController::class,'sendEventTicket'])->name('send_event_ticket');

    Route::get('event_ticket',[EventTicketController::class,'index']);
    Route::post('allticket',[EventTicketController::class,'allticket']);
    Route::post('add_event_ticket',[EventTicketController::class,'addEventTicket']);
    Route::post('delete_event_ticket/{id}',[EventTicketController::class,'deleteEventTicket']);
    Route::post('view_event_ticket/{id}',[EventTicketController::class,'viewEventTicket']);
    Route::post('edit_event_ticket/{id}',[EventTicketController::class,'editEventTicket']);

    Route::get('event_coupons',[EventCouponController::class,'index'])->name('event_coupon');
    Route::post('alleventcoupon',[EventCouponController::class,'alleventcoupon']);
    Route::get('view_add_event_coupon',[EventCouponController::class,'addViewEventCoupon'])->name('add_coupon');
    Route::get('autocomplete',[EventCouponController::class,'autocomplete'])->name('autocomplete');
    Route::post('add_event_coupon',[EventCouponController::class,'addEventCoupon']);
    Route::get('view_event_coupon/{id}',[EventCouponController::class,'viewEventCoupon']);
    Route::post('edit_event_coupon',[EventCouponController::class,'editEventCoupon'])->name('edit_event_coupon');
    Route::post('delete_event_coupon/{id}',[EventCouponController::class,'deleteEventCoupon']);

    Route::get('booking_history',[BookingHistoryController::class,'index']);
    Route::post('allbookinghistory',[BookingHistoryController::class,'allbookinghistory']);
    Route::get('view-history-details/{id}',[BookingHistoryController::class,'viewHistoryDetails'])->name('view-history-details');
    Route::get('history/{id}',[BookingHistoryController::class,'history'])->name('history');
    Route::post('eventBookingHistory',[BookingHistoryController::class,'eventBookingHistory'])->name('eventBookingHistory');
    
    Route::get('user',[UserController::class,'index']);
    Route::post('alluser',[UserController::class,'alluser']);
    Route::post('view_user/{id}',[UserController::class,'viewUser']);
    Route::post('edit_user/{id}',[UserController::class,'editUser']);
    Route::post('user_status_change',[UserController::class,'userStatusChange']);
    Route::post('request-accept',[UserController::class,'requestAccept'])->name('request-accept');
    Route::post('scan_permission',[UserController::class,'scanPermission']);
    
    Route::get('scan-ticket',[ScanTicketController::class,'index']);
    Route::post('scanTicket',[ScanTicketController::class,'scanTicket']);
    
    Route::get('bne-settings',[BneSettingController::class,'index']);
    Route::post('allpermission',[BneSettingController::class,'allpermission']);
    Route::post('add_permission',[BneSettingController::class,'addPermission']);
    Route::post('view_permission',[BneSettingController::class,'viewPermission'])->name('view_permission');
    Route::post('edit_permission',[BneSettingController::class,'editPermission'])->name('edit_permission');
    Route::post('delete_permission',[BneSettingController::class,'deletePermission'])->name('delete_permission');
    
    
    Route::get('bne-payment',[PaymentController::class,'index']);
    Route::post('bne-payment',[PaymentController::class,'bnePayment'])->name('bne-payment');
    
    Route::get('pages',[PagesController::class,'pages'])->name('pages');
    Route::post('allpage',[PagesController::class,'allpage'])->name('allpage');
    Route::get('add-page',[PagesController::class,'addPages'])->name('admin.add-page');
    Route::post('add_page',[PagesController::class,'addPage']);
    Route::post('delete_page/{id}',[PagesController::class,'deletePage']);
    Route::get('view_page/{id}',[PagesController::class,'viewPage']);
    Route::post('edit_page',[PagesController::class,'editPage']);
    
    Route::post('check_permalink',[PagesController::class,'checkPermalink']);
    Route::post('edit_permalink',[PagesController::class,'editPermalink']);
});


Route::get('login', [LoginController::class, 'login'])->name('user.login');
Route::post('checkout-user-login', [LoginController::class, 'checkOutLogin']);
Route::get('register', [LoginController::class, 'register'])->name('user_register');
Route::post('user-register', [LoginController::class, 'RegisterUser'])->name('RegisterUser');
Route::post('user-login', [LoginController::class, 'userLogin'])->name('userLogin');
Route::get('user-logout', [LoginController::class, 'LogoutUser'])->name('LogoutUser');
Route::post('guest-user-login', [LoginController::class, 'guestUserLogin'])->name('guestUserLogin');




Route::get('/', [HomeController::class, 'index'])->name('eventList');
Route::post('transaction', [HomeController::class, 'transaction']);
//Route::get('event-list', [HomeController::class, 'index']);
Route::get('event-details/{id}', [HomeController::class, 'eventDetails']);
Route::get('buy-ticket/{id}', [HomeController::class, 'buyTicket']);
Route::post('event-like/{id}', [HomeController::class, 'eventLike']);
Route::post('event-dislike/{id}', [HomeController::class, 'eventDislike']);
Route::get('booking', [HomeController::class, 'booking'])->name('booking');
Route::get('scanBooking/{id}', [HomeController::class, 'scanBooking']);
Route::post('check_coupon_code', [HomeController::class, 'checkCouponCode']);

Route::post('checkout',[HomeController::class, 'checkout']);
Route::post('get-qr-code', [HomeController::class, 'getQrCode'])->name('get-qr-code');
//Route::get('success',[HomeController::class, 'index']);
Route::get('cancel',[HomeController::class, 'cancel']);
//Route::middleware('auth')->group( function () {
//    Route::get('event-list', [HomeController::class, 'index']);
//    Route::get('event-details/{id}', [HomeController::class, 'eventDetails']);
//    Route::get('buy-ticket/{id}', [HomeController::class, 'buyTicket']);
//    Route::post('event-like/{id}', [HomeController::class, 'eventLike']);
//    Route::post('event-dislike/{id}', [HomeController::class, 'eventDislike']);
//});

Route::get('dashboard',[FrontDashboadController::class, 'index'])->name('dashboard');
Route::post('dateChange',[FrontDashboadController::class, 'dateChange'])->name('dateChange');

Route::get('hosted/{name}',[HomeController::class, 'hosted']);
Route::get('request-access',[HomeController::class, 'requestAccess'])->name('request-access');
Route::post('check-request-admin-access',[HomeController::class, 'checkRequestAccess'])->name('check-request-admin-access');
Route::post('request-admin-access',[HomeController::class, 'requestAdminAccess'])->name('request-admin-access');

Route::get('event',[HomeController::class,'event'])->name('event');
Route::post('allmyevent',[HomeController::class,'allmyevent'])->name('allmyevent');
Route::get('add-event',[HomeController::class,'addevent'])->name('addevent');
Route::post('add_event',[HomeController::class,'add_event'])->name('add_event');
Route::post('add_event_ticket',[HomeController::class,'addEventTicket'])->name('addEventTicket');
Route::get('view_event/{id}',[HomeController::class,'viewEvent'])->name('viewEvent');
Route::post('edit_event',[HomeController::class,'editEvent'])->name('editEvent');
Route::post('edit_event_ticket',[HomeController::class,'editEventTicket'])->name('editEventTicket');
Route::post('delete_event',[HomeController::class,'deleteEvent'])->name('deleteEvent');
Route::post('delete_event_ticket',[HomeController::class,'deleteEventTicket'])->name('deleteEventTicket');


Route::get('edit_profile',[LoginController::class,'Profile'])->name('edit_profile');
Route::post('update_profile',[LoginController::class,'editUser'])->name('update_profile');


//forgot password
Route::get('forgot',[LoginController::class, 'forgot'])->name('forgot');
Route::post('forgot-password',[LoginController::class, 'forgotPassword']);
Route::post('resetpassword',[LoginController::class, 'ResetPass']);
Route::get('change-password/{token}',[LoginController::class, 'changepassword']);


// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
// Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

// Route::post('pay', [SslCommerzPaymentController::class, 'index']);
// Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [HomeController::class, 'success'])->name('success');
Route::post('/fail', [HomeController::class, 'fail'])->name('fail');
Route::post('/cancel', [HomeController::class, 'cancel'])->name('cancel');

Route::post('/ipn', [HomeController::class, 'ipn']);


Route::get('about-us',[HomeController::class,'aboutUs'])->name('aboutUs');
Route::get('privacy-policy',[HomeController::class,'privacyPolicy'])->name('privacyPolicy');
Route::get('refund-policy',[HomeController::class,'refundPolicy'])->name('refundPolicy');
Route::get('terms-conditions',[HomeController::class,'termsConditions'])->name('termsConditions');
Route::get('cancellation-policy',[HomeController::class,'cancellationPolicy'])->name('cancellationPolicy');


Route::get('page/{slug}',[DynamicController::class,'getPage']);