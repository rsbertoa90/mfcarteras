@extends('mails.base')

@section('content')
    <div>
        <p>
            {{$order->client}}, Recibimos tu pedido!
        </p>
        <p>
            Uno de  nuestros representantes se comunicara con vos a la brevedad para confirmar disponibilidad y darte los detalles para el pago.
        </p>
        <p> Si queres descargar una copia de tu presupuesto podes hacerlo en el siguiente enlace: </p>
        <p>
            <a href="https://mfcarteras.com/pdf/{{$order->id}}"> <span> --> Descargar tu presupuesto en PDF <-- </span>  </a>
        </p>
        <p>Gracias por elegir MF!</p>

        

    </div>
@endsection