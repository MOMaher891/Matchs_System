<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['code','client_id','stadium_id','type'];
    protected $timestamps = false;

    use HasFactory;

    /**
     * Relations
     */

    public function user(){
        return $this->belongsTo(Client::class);
    }
    public function stadium(){
        return $this->belongsTo(Stadium::class);
    }

    public function book_time(){
        return $this->belongsToMany(Time::class,'book_times','time_id','book_id');
    }
}
