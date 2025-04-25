<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model
{
    use InteractsWithMedia;
    protected $guarded;
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function category_flavor()
    {
        return $this->hasMany(Category_Flavor::class);
    }
}
