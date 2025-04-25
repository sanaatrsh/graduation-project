<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Pay extends Model
{
    public function user(){
        return $this->belongsTo(user::class);
    }
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
}
