
<td style="width:47%; overflow:hidden; ">                        
    <div>
        <table>
            <tr>
                <td>
                    @if (isset($product->images[0]))
               
                        <img style="width:150px; "  src="{{public_path().$product->images[0]->url}}"> 
                    @endif
                    @if (!isset($product->images[0]))
                        <img style="width:150px; "  src="{{public_path().'/storage/images/app/no-image.png'}}"> 
                    @endif
                </td>
                <td>
                     <h1 style='font-size: 1rem; font-weight:bold; display:inline; line-height:normal'>
                         {{$product->name}}
                    </h1> 
                    <br>
                    </div>
                      {{--   <div style="margin-top:-16px; margin-left:10px;margin-top:10px;">  <br>
                            <span style="width:73px ; height:60px; font-size: 1.1rem  ; display:inline "> ${{number_format($product->price,2)}} </span>    
                    </div> --}}
                
                   
                </td>
            </tr>
        </table>
</td>