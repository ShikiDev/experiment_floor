@extends('admin.layouts.admin_app')

@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10">
                <div class="row">
                    <form class="col-md-12">
                        <div class="form-group">
                            <label for="title_post">Post title</label>
                            <input type="email" class="form-control form-control-lg" id="title_post" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <textarea id="post_editor"></textarea>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="created">Created</label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="created">Author</label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="status_list">Status</label>
                            <select id="status_list" class="form-control">
                                <option>Select</option>
                            </select>
                        </div>
                        <button type="type" class="btn btn-primary">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection