
<td style="width:47%; overflow:hidden; ">                        
    <div>
        <table>
            <tr>
                <td>
                     <h1 style='font-size: 1rem; font-weight:bold; display:inline; line-height:normal'>
                            {{$product->product->name}} {{$product->name}} .- Cod.{{$product->code}}
                    </h1>
                    
                    <br>
                    
                    <div style="width:150px; margin:auto;">
                            @if (isset($product->images[0]))
                       
                                <img style="width:150px; "  src="{{public_path().$product->images[0]->url}}"> 
                            @endif
                            @if (!isset($product->images[0]))
                                <img style="width:150px; "  src="{{public_path().'/storage/images/app/no-image.png'}}"> 
                            @endif
                    </div>
                </td>

            </tr>
        </table>
</td>