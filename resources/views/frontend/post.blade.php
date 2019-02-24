@extends('layouts.app_front')

@section('content')
 {{--<post-component :post="{{$post}}"></post-component>--}}
 <div class="container">
     <div class="row justify-content-center">
         <div class="col">
             <h3>{{$post->title}}</h3>
         </div>
     </div>
     <div class="row justify-content-center">
         <div class="col">
             {!!  $post->content !!}
             {{--<div v-html="post.content"></div>--}}
         </div>
     </div>
 </div>
@endsection