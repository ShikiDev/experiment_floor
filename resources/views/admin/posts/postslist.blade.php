@extends('admin.layouts.admin_app')

@section('content')
    <div class="container-fluid">

        <div class="row justify-content-md-center">
            <div class="col-md-7">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th scope="col" colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $key => $post)
                            <tr>
                                <td scope="row">{{$key+1}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->author}}</td>
                                <td>{{$post->status}}</td>
                                <td>{{$post->created}}</td>
                                <td>{{$post->updated}}</td>
                                <td><i class="fa fa-pencil"></i></td>
                                <td><i class="fa fa-remove"></i></td>
                            </tr>
                            @empty
                            <tr>
                                <td scope="row">1</td>
                                <td colspan="6">Not found any posts. Add new one or check server side</td>
                            </tr>
                        @endforelse
                        <tr>

                        </tr>
                    </tbody>
                    <tfoot>
                        <tr colspan="7">
                            <ul class="pagination pull-right">
                                {{$posts->links()}}
                            </ul>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{route('admin.post_add')}}">Add new post</a></li>
                    <li class="list-group-item"><a href="#">See hashtag list</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection