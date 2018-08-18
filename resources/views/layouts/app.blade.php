<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta-description')">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="width:100vw">
        <div id="app" class="container">
            <div class="row">
                <app-navbar class="col-12"></app-navbar>
                <app-side-menu class="col-3" 
                                v-if="$mq =='lg'" 
                                style="margin-left:-6%">
                </app-side-menu>

                    <div class="col-12 col-lg-9 w-100 row" style="margin-left:0.2%">
                                <main class="py-4 w-100">
                                    @yield('contentA')
                                </main>
                    
                    </div> 
    
            </div>
            <div class="row">
                @yield('contentB')
            </div>
            <app-footer></app-footer>
        </div>
    </div>

    <script>
        @yield('structured-data')
    </script>
</body>
</html>
