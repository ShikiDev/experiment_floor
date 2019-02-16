@extends('layouts.app_front')

@section('content')
<projects-component :projects="{{$projects}}"></projects-component>
@endsection