<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Box extends Model
{
    protected $guarded;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
