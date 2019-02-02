@extends('admin.layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Edit {{$user->name}} user</h3>
        </div>
        <form class="form-horizontal" action="{{route('admin.users.update',$user)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <div class="row justify-content-md-center">
                @include('admin.users.user_form')
            </div>
        </form>
    </div>
@endsection
