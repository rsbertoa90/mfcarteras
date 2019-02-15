<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Variant;
use App\Metadata;
class ProductController extends Controller
{


  public function changeImage(Request $request)
  {
      $product = Product::find($request->product_id);
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $wich='image';
    
        if ($request->selected == 'costado'){
          $wich ='side_image';
        }

        $path = $file->storeAs('/images/products',$product->slug.$wich.'.'.$ext);
        
        $product->$wich = '/storage/'.$path;
        $product->save();
        return $product;
  }


  public function getAll(){
    return Product::with('variants.images')->with('variants.product')->get();
  }

  public function get($id){
    return Product::with('variants.images')->with('variants.modelImages')->with('variants.product')->find($id);
  }

    public function searchResults(Request $request)
    {
    
      // user can provide double space by accident, or on purpose:
      $search = $request->input('search');

      // so with explode you get this:
      $array = explode(' ', $search);

      $products = Product::where('paused',0)->where(function ($q) use ($array) {
      foreach ($array as $value) {
        $q->orWhere('name', 'like', "%{$value}%");
      }
    })->pluck('id')->toArray();
      
      $variantSearch =  Variant::where('paused',0)->where(function ($q) use ($array) {
      foreach ($array as $value) {
        $q->orWhere('name', 'like', "%{$value}%");
      }
    })->pluck('product_id')->toArray();

      if($variantSearch)
      {
        $products = array_merge($products,$variantSearch);
      }

      return view('search-results',compact('products','search'));
    

    }

      public static function detail($productSlug)
    {
           $slug = '/'.$productSlug;
           $product = Product::where('slug',$slug)->get()->first();
           if($product){
               $meta = new Metadata();
               $meta->metatitle = $product->name;
               $meta->metadescription = $product->description;
               return view('product',compact('product','meta'));
           } 
           return redirect('/');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Product::create($request->only(['price',
                                                'category_id',
                                                'name',
                                                'code'
                                              ]));
    }

    



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      
        $field = $request->field;
        $product = Product::find($request->product);
        $product->$field = $request->value;
        $product->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return;
    }
}
