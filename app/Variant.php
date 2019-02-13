<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\VariantImage;
use App\ModelImage;

class Variant extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images()
    {
        return $this->hasMany(VariantImage::class);
    }

    public function modelImages(){
        return $this->hasMany(ModelImage::class)->orderBy('order');
    }
    //
}
