<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Variant;

class VariantImage extends Model
{
    //
    protected $guarded =[];
    protected $table = 'variant_images';

    public function  variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
