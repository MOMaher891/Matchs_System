<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;
    use HasFactory;

    /**
     * Relations
     */

    public function city(){
        return $this->belongsTo(City::class);
    }
}
