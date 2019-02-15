<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelImage;
use App\Variant;

class ModelImageController extends Controller
{
    //

    public function get($variant_id)
    {
        return ModelImage::where('variant_id',$variant_id)->orderBy('order')->get();
    }

    public function create(Request $request)
    {
        $files = $request->attachments;
       
        $this->destroyModel($request->variant_id);

        foreach ($files as $key => $file) {
            # code...
            $image = $file;
            $name=$request->variant_id.'-'.$key.'.'.$image->getClientOriginalExtension();
            $path = $image->storePubliclyAs('/images/models',$name);
            $path = '/storage/'.$path;
            ModelImage::create([
                    'variant_id' => $request->variant_id,
                    'url' => $path,
                    'order'=>$key]);
            }

       return 'ok';
    }

    public function destroyModel($id)
    {
        $variant = Variant::find($id);

        if ($variant->modelImages){
            foreach ($variant->modelImages as $image) {
                if(\File::exists(public_path($image->url))){
                    \File::delete(public_path($image->url));
                }
            ModelImage::destroy($image->id);
            }
        }
    }


}
