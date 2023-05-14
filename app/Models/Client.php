<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\BookRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Client extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name','phone','verified','password','address','image','lat','long','birth_date','is_blocked'];
    public $timestamps = false;

    /**
     * Relations
    */
    public function request(){
        return $this->hasMany(BookRequest::class);
    }

    public function booking(){
        return $this->hasMany(Booking::class);
    }

    public function block_user(){
        return $this->belongsToMany(Stadium::class,'blocked_users','stadium_id','client_id');
    }

    public function getBirthDateAttribute()
    {
        return Carbon::parse($this->attributes['birth_date'])->age;
    }

}
