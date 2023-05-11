<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    /**
     * Relations
    */

    public function book_time(){
        return $this->belongsToMany(Booking::class,'book_times','book_id','time_id');
    }
}
