<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;

    protected $table = 'stadiums';
    protected $fillable = ['name','description','price','phone','is_open','long','lat','region_id','admin_id'];
    public $timestamps = false;


    /**
     * Relations
     */

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function booking(){
        return $this->hasMany(Booking::class);
    }

    public function booking_request(){
        return $this->hasMany(BookRequest::class);
    }

    public function stadium_image(){
        return $this->hasMany(StadiumImage::class,'stadium_id');
    }

    public function region(){
        return $this->belongsTo(Region::class,'region_id');
    }

    public function block_user(){
        return $this->belongsToMany(Client::class,'blocked_users','client_id','stadium_id');
    }    

    public function scopeOwner($query)
    {
        $query->where('admin_id',auth()->user()->id);
    }
}
