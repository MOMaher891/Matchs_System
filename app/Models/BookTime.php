<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTime extends Model
{
    protected $fillable = ['book_id','time_id','date'];
    public $timestamps = false;
}
