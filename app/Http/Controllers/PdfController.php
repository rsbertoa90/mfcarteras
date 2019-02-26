<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use PDF;
use Carbon\Carbon;

class PdfController extends Controller
{
    public function prices()
    {
        $products = Product::where('paused',0)->whereHas('variants',function ($q){
            $q->where('paused',0);
        })->get();
        $today = Carbon::now()->format('d/m/Y');
        $logo = $this->imageEmbed(public_path('/storage/images/app/logo.png'));
        $pdf = PDF::loadView('pdf.ListaDePrecios', compact('products','today','logo'));

        return $pdf->download('Precios-MF.pdf');
    }


    public function imageEmbed($image)
    {
       

        // Read image path, convert to base64 encoding
        $imageData = base64_encode(file_get_contents($image));

        // Format the image SRC:  data:{mime};base64,{data};
        $src = 'data:'.mime_content_type($image).';base64,'.$imageData;

        // Echo out a sample image
       return $src;
    }
}
