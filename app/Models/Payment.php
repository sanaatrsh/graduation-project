<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{

    public function user_pays(){
        return $this->hasMany(User_Pay::class);
    }
}
