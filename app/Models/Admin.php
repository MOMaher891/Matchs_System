<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = ['name','phone','email','password','image','is_blocked'];
    public $timestamps = false;
    use HasFactory;

    /**
     * Relations
    */

    public function stadium(){
        return $this->hasMany(Stadium::class);
    }

    public function booking(){
        return $this->hasManyThrough(Booking::class,Stadium::class);
    }
    public function booking_request(){
        return $this->hasManyThrough(BookRequest::class,Stadium::class);
    }

 
}
