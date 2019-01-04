<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Variant;
use App\VariantImage;


class VariantController extends Controller
{
    //

    public function update(Request $request)
    {
      
        $field = $request->field;
        $variant = Variant::find($request->id);
        $variant->$field = $request->value;
        $variant->save();
        return $variant;
    }

    public function create(Request $request)
    {
        return Variant::create($request->only([
                                                'product_id',
                                                'name',
                                                'description'
                                              ]));
    }


     public function destroy($id)
    {
        Variant::destroy($id);
        return;
    }
}
