@extends('admin.layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Hashtag create</h3>
        </div>
        <form class="form-horizontal" action="{{route('admin.hashtags.store')}}" method="post">
            {{csrf_field()}}
            @include('admin.layouts.messages')
            <div class="row justify-content-md-center">
                <div class="col-md-10">
                    {{-- post form include --}}
                    @include('admin.hashtag.hashtag_form')
                </div>
            </div>
        </form>
    </div>
@endsection