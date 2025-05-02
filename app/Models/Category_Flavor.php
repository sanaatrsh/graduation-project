<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_Flavor extends Model
{
    protected $guarded;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function flavor()
    {
        return $this->belongsTo(Flavor::class);
    }
}
