<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StadiumImage extends Model
{

    protected $fillable = ['image','stadium_id'];
    public $timestamps = false;
    use HasFactory;
}
