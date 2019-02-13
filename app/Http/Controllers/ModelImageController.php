<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModelImageController extends Controller
{
    //

    public function create(Request $request)
    {
        return $request->all();
        $image = $request->file('image');
        $path = $image->storePublicly('/images/models');
        $path = '/storage/'.$path;
        $new = VariantImage::create([
                'variant_id' => $request->variant_id,
                'url' => $path,
                'order'=>2]);

        return $new;
    }


}
