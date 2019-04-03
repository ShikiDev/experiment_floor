@extends('layouts.app_front')

@section('content')
 <post-component :post="{{$post}}"></post-component>
@endsection