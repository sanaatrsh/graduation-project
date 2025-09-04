<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Order extends Model
{
    use HasFactory;
    protected $guarded;

    public function quantities()
    {
        return $this->hasMany(Quantity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
