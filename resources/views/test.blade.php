@extends('layouts.app')


    
@section('breadcrumb')
    {{ Breadcrumbs::render('home') }}
@endsection

@section('content')
<div class="row">
    <div class="col-12 col-lg-4">
        <variant-model :variant_id={{$id}} alt="360 test"></variant-model>
    </div>
</div>
@endsection
