<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StadiumImage extends Model
{
    protected $table = 'stadium_images';
    protected $fillable = ['image','stadium_id'];
    public $timestamps = false;
    use HasFactory;

    // public function setImageAttribute($value){
    //     $this->attributes['image'] = json_encode($value);
    // }
}
