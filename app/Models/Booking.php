<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['code','client_id','stadium_id','type','status','times','total','total_in_dolar','date'];
    public $timestamps = false;
    use HasFactory;

    /* Relations */
    public function user(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function stadium(){
        return $this->belongsTo(Stadium::class);
    }

    public function book_time(){
        return $this->belongsToMany(Time::class,'book_times','book_id','time_id');
    }

    public function scopeBending($query)
    {
        $query->where('status','bending');
    }


    public function scopeNotBending($query)
    {
        $query->where('status','!=','pending');
    }


    public function scopeOwner($query)
    {
        $query->where('client_id',auth('client')->user()->id);
    }


    public function getAdminStadiums()
    {
        return $this->stadium()->where('admin_id',auth()->user()->id);
    }

    // public function scopeFirst($query)
    // {
    //     $this
    // }
    public function scopeFilter($query, $params)
    {
        if(isset($params['stadium_id']))
        {
            $query->where('stadium_id',$params['stadium_id']);
        }
        if(isset($params['status']))
        {
            $query->where('status',$params['status']);
        }

        if(isset($params['client_id']))
        {
            $query->where('client_id',$params['client_id']);
        }

        if(isset($params['type']))
        {
            $query->where('type',$params['type']);
        }

        if(isset($params['from']) && isset($params['to']))
        {
            $from = Carbon::parse($params['from']);
            $to = Carbon::parse($params['to']);
            $query->whereBetween('date',[$from,$to]);
        }
        return $query;
    }
}
