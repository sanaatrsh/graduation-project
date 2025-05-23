<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Flavor extends Model
{
    protected $guarded;

    public function category_flavors()
    {
        return $this->hasMany(Category_Flavor::class);
    }
}
