@extends('admin.layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>User create</h3>
        </div>
        <form class="form-horizontal" action="{{route('admin.users.store')}}" method="post">
            {{csrf_field()}}
            <div class="row justify-content-md-center">
                @include('admin.users.user_form')
            </div>
        </form>
    </div>
@endsection
