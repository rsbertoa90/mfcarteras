@extends('layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('cotizador') }}
@endsection

@section('content')
    @if (App\Config::find(1)->hide_prices)
        <div class="d-flex flex-column text-center w-100">
             
            <h1>Pronto tendremos disponible para que puedas hacer tu pedido Online.</h1>
            <h2> En Marzo : nuestro local abrira sus puertas en Pasteur 410, Once</h2>
        </div>
    @else
     <h1>test</h1>
    @endif
@endsection