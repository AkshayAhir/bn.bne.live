<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public function User(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function EventTicket(){
        return $this->hasOne(EventTicket::class,'event_id','id');
    }
    public function EventTickets(){
        return $this->hasMany(EventTicket::class,'event_id','id');
    }
}
