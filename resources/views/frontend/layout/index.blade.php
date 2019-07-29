@extends('frontend.layout.app')

@section('content')
@include ("frontend.layout.slider")

@include('frontend.products.latest')

<!--            sale big ad -->
@if(App\Sale::EndedAT() > 0)
    @include('frontend.layout.sale')
@endif
<!-- sale big ad -->



@include('frontend.products.mostSoldToIndex')

@endsection