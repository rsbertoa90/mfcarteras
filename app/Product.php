<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\ProductImage;
use App\Variant;


class Product extends Model
{
    //
        protected $guarded =[];

       

      public function variants()
      {
          return $this->hasMany(Variant::class);
      }

      public static function boot()
    {
         parent::boot();

          self::creating(function($product){
            $product->attributes['slug'] = '/'.str_slug($product->name); 
          });
    }

    public function getPriceAttribute($val)
    {
        return $val/100;
    }

    public function setPriceAttribute($val)
    {
        $this->attributes['price']= $val*100;
    }

    public function getSlugAttribute($val)
    {
        if (!$val)
        {
            $val = '/'.str_slug($this->name);
            $this->attributes['slug'] = $val;
            $this->save();
        }
        return $val;
    }

    public function getNameAttribute($name)
    {
        return ucfirst($name);
    }

    public function front()
    {
        return $this->variants()->where('isfront',1)->get()->first();
    }

      

        
}
