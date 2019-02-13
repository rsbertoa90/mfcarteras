@extends('layouts.app')


    
@section('breadcrumb')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('content')
   <app-model-upload></app-model-upload>
@endsection
