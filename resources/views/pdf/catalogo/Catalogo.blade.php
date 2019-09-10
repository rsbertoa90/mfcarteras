  @extends('pdf.base')

  @section('content')

 
  <main>
      
    @if ($categories)
         
   

      @foreach ($categories as $category)
      
         @if (count($category->variants)>0)
             
            <table>
                <tr>
                    <div style="width:100%;height:40px;"></div>
                </tr>
            </table>

            
          <div style="text-align: center ; width : 780px; text-decoration:underline">
          <h4> {{strtoupper($category->name)}} Cod.{{$category->code}}</h4>
          </div>
                         
            <table>
                <tr>
                    <div style="width:100%;height:40px;"></div>
                </tr>
            </table>
              <table class="table table-bordered " style="width:800px ;" >

                  <tbody >
                    @php
                        $max = count($category->variants) / 2 ;
                    @endphp      
                      @for ($i = 0; $i < $max; $i++)
                            @php
                            $products = $category->variants;
                            if (isset($products[$i*2+0])){ $product1 = $category->variants[($i*2)+0];} else {$product1 = null;};
                            if (isset($products[$i*2+1])) {   $product2 = $category->variants[($i*2)+1];} else {$product2 = null;};
                          
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
        @endforeach

    @endif
  </main>
      
     
  @endsection