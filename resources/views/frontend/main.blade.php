@extends('layouts.app_front')

@section('content')
    <main-component :post_list="{{$posts}}"></main-component>
@endsection
