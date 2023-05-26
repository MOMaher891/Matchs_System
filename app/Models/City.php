<?php

namespace App\Models;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable =['name','country_id'];
    public $timestamps = false;
    use HasFactory;

    /**
     * Relations
    */

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function region(){
        return $this->hasMany(Region::class);
    }
}
