<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Order extends Model
{
    use InteractsWithMedia;
    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }
    public function box(){
        return $this->belongsTo(box::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }


}
