<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    use HasFactory;
    public function Event(){
        return $this->hasOne(Event::class,'id','event_id');
    }
    public function BookingHistory(){
        return $this->hasMany(BookingHistory::class,'ticket_id','id');
    }
}
