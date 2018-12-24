@extends('admin.layouts.admin_app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-7">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Color</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th scope="col" colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($hashtags as $key => $hashtag)
                        <tr>
                            <td scope="row">{{$key+1}}</td>
                            <td>{{$hashtag->name}}</td>
                            <td><div class="circle-block" style="background:#{{$hashtag->color}}"></div></td>
                            <td>{{$hashtag->created_at->format('d.m.Y H:i:s')}}</td>
                            <td>{{$hashtag->updated_at->format('d.m.Y H:i:s')}}</td>
                            <td><a href="{{route('admin.hashtags.edit',$hashtag)}}"><i class="fa fa-pencil"></i></a></td>
                            <td><form action="{{route('admin.hashtags.destroy',$hashtag)}}" method="post">
                                    <input type="hidden" name="_method" value="DELETE">{{csrf_field()}}
                                    <i class="delete-post fa fa-remove"></i></form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="row">1</td>
                            <td colspan="6">Not found any hashtags. Add new one or check server side</td>
                        </tr>
                    @endforelse
                    <tr>

                    </tr>
                    </tbody>
                    <tfoot>
                    <tr colspan="7">
                        <ul class="pagination pull-right">
                            {{$hashtags->links()}}
                        </ul>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{route('admin.hashtags.create')}}">Create Hashtag</a></li>
                    <li class="list-group-item"><a href="{{route('admin.posts.index')}}">Back to posts list</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection