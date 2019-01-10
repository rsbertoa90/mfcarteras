  @extends('pdf.base')

  @section('content')

 
  <main>
      
       <div style="width:100% ; text-align : center;">
        <img src="{{$logo}}}" alt="Redlimp">
        </div>

     
       {{-- <div class="breakNow"></div> --}}
         
          <hr>                 
          
              <table class="table table-bordered table-striped"  >
                  <thead>
                      <tr>
                          <td>Codigo</td>
                          <td>Producto</td>
                          <td>Precio</td>
                      </tr>
                    
                  </thead>
                  
                  <tbody>
                      
                      @foreach ($products as $key => $product)
                            @foreach ($product->variants as $variant)
                                <tr>
                                    <td> {{$product->code}} </td>
                                    <td> {{$product->name}} - {{$variant->name}} </td>
                                    <td> ${{number_format($product->price,2)}} </td>
                                </tr>
                            @endforeach
                      @endforeach
                    </tbody>
                </table>
                <div class="breakNow"></div>
      
  </main>
      
     
  @endsection