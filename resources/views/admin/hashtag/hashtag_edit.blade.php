@extends('admin.layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Hashtag edit</h3>
        </div>
        <form class="form-horizontal" action="{{route('admin.hashtags.update',$hashtag)}}" method="post">
            @include('admin.layouts.messages')
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <div class="row justify-content-md-center">
                <div class="col-md-10">
                    {{-- post form include --}}
                    @include('admin.hashtag.hashtag_form')
                </div>
            </div>
        </form>
    </div>
@endsection