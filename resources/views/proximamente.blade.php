<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="image_src" href="{{asset('/storage/images/app/logo.png')}}">
    <link rel="canonical" href="{{URL::current()}}">
   
        <title> MF Carteras</title>
        <meta name="description" content="MF Carteras. Marroquineria y accesorios">
    



    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    {{-- fontawesome --}}
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"> --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/animate.css') }}" rel="stylesheet"> --}}

    {{-- PRECONECTS --}}
    <link rel="preconnect" href="https://use.fontawesome.com">
    <link rel="preconnect" href="https://maps.google.com">
    <link rel="preconnect" href="https://www.google.com">

    {{-- Google search panel --}}
    <meta name="google-site-verification" content="smzaENmPlGZUDIeDWcF_W2ia0jxFtoc_3Pai2bhWHKA" />

    
   <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132230957-1"></script>
<script>
 window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());

 gtag('config', 'UA-132230957-1');
</script>
</head>
<body>
     <div id="app" >

        <app-proximamente></app-proximamente>
        <div class="row">
            <div class="d-flex justify-content-center w-100">
                <p style="font-size:1.4rem ; font-weight:bold ; padding:50px">
                    Pronto: Febrero 2019  MF, importadores directos de carteras abre sus puertas. Vas a poder hacer tu pedido online o acercarte a nuestro local. Oportunidad para revendedoras, comercios. Tenemos calidad y precios unicos.
                </p>
            </div>
        </div>

     </div>
</body>
</html>
