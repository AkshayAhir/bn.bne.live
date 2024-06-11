<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    use HasFactory;
    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function Transaction(){
        return $this->hasOne(Transaction::class,'id','transaction_id');
    }
    public function Event(){
        return $this->hasOne(Event::class,'id','event_id');
    }
    public function EventTicket(){
        return $this->hasOne(EventTicket::class,'id','ticket_id');
    }
    public function Coupon(){
        return $this->hasOne(Coupon::class,'id','coupon_id');
    }
    public function EventBooking(){
        return $this->hasMany(Event::class,'id','event_id');
    }
}
