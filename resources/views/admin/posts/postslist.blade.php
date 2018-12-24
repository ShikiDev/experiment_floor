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
                                <td>{{$post->author['name']}}</td>
                                <td>{{$post->status}}</td>
                                <td>{{$post->created_at->format('d.m.Y H:i:s')}}</td>
                                <td>{{$post->updated_at->format('d.m.Y H:i:s')}}</td>
                                <td><a href="{{route('admin.posts.edit',$post)}}"><i class="fa fa-pencil"></i></a></td>
                                <td><form action="{{route('admin.posts.destroy',$post)}}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">{{csrf_field()}}
                                        <i class="delete-post fa fa-remove"></i></form>
                                </td>
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
                    <li class="list-group-item"><a href="{{route('admin.posts.create')}}">Add new post</a></li>
                    <li class="list-group-item"><a href="{{route('admin.hashtags.index')}}">See hashtag list</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection