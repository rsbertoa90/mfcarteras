  @extends('pdf.base')

  @section('content')

 
  <main>
      
    @if ($variants)
         
   

      
             
            <table>
                <tr>
                    <div style="width:100%;height:40px;"></div>
                </tr>
            </table>

            
         
                         
            <table>
                <tr>
                    <div style="width:100%;height:40px;"></div>
                </tr>
            </table>
              <table class="table table-bordered " style="width:800px ;" >

                  <tbody >
                    @php
                        $max = count($variants) / 2 ;
                    @endphp      
                      @for ($i = 0; $i < $max; $i++)
                            @php
                            $products = $variants;
                            if (isset($products[$i*2+0])){ $product1 = $variants[($i*2)+0];} else {$product1 = null;};
                            if (isset($products[$i*2+1])) {   $product2 = $variants[($i*2)+1];} else {$product2 = null;};
                          
                            @endphp
                          <tr>
                              @if ($product1)
                                  
                                    @include('pdf.catalogo.product',['product'=>$product1])
                              @endif
                              @if ($product2)
                                  
                                @include('pdf.catalogo.product',['product'=>$product2])
                              @endif
                            
                          </tr>
                      @endfor
                  </tbody>
              </table>
              <hr>
        

    @endif
  </main>
      
     
  @endsection