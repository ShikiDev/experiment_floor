@extends('admin.layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Post create</h3>
        </div>
        <form class="form-horizontal" action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('admin.layouts.messages')
            <div class="row justify-content-md-center">
                <div class="col-md-10">
                    {{-- post form include --}}
                    @include('admin.posts.post_form')
                </div>
                <div class="col-md-2">
                    {{-- post status form--}}
                        @include('admin.posts.post_form_status')
                </div>
            </div>
        </form>
    </div>
@endsection