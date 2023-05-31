<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedUser extends Model
{
    use HasFactory;
    protected $table = 'blocked_users';
    protected $fillable = [
        'client_id',
        'admin_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class,'admin_id');
    }


}
