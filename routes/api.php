<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\BookingHistoryController;
use App\Http\Controllers\BneApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user-login', [BneApiController::class, 'userLogin']);
Route::post('admin-login', [BneApiController::class, 'adminLogin']);
Route::post('admin-scan-ticket', [BneApiController::class, 'adminScanTicket']);
Route::post('user-scan-ticket', [BneApiController::class, 'userScanTicket']);
Route::post('event-list', [BneApiController::class, 'eventList']);
Route::post('booking-history', [BneApiController::class, 'bookingHistory']);
Route::post('user-access', [BneApiController::class, 'userAccess']);
Route::post('user_list', [BneApiController::class, 'userList']);