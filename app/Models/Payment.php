<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{
    protected $guarded;

    public function user_pays()
    {
        return $this->hasMany(User_Pay::class);
    }
}
