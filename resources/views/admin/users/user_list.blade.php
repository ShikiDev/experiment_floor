@extends('admin.layouts.admin_app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-7">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Created</th>
                        <th scope="col">Updated</th>
                        <th scope="col">Confirmed</th>
                        <th scope="col" colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($user_list as $key => $user)
                        <tr>
                            <td scope="row">{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->format('d.m.Y H:i:s')}}</td>
                            <td>{{$user->updated_at->format('d.m.Y H:i:s')}}</td>
                            <td>@if($user->confirmed) <i class="fa fa-thumbs-o-up" style="color:#06D212"></i> @else
                                    <i class="fa fa-thumbs-o-down" style="color:#F7412B"></i> @endif</td>
                            <td><a href="{{route('admin.users.edit',$user)}}"><i class="fa fa-pencil"></i></a></td>
                            <td><form action="{{route('admin.users.destroy',$user)}}" method="post">
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
                            {{$user_list->links()}}
                        </ul>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{route('admin.users.create')}}">Add new user</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
