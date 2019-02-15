@extends('layouts.app')


    
@section('breadcrumb')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-lg-4">
        <variant-model :variant_id={{$id}}></variant-model>
    </div>
</div>
@endsection
