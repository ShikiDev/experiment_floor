<div class="col">
    <div class="form-group">
        <input type="text" class="form-control form-control-lg" id="title_post" name="title" placeholder="Enter title" value="{{$post->title or ""}}">
    </div>
</div>
<div class="col">
    <div class="form-group">
        <textarea id="post_editor" name="content">{{$post->content or ""}}</textarea>
    </div>
</div>
@if(!empty($post->id))
<div class="col">
    @include('admin.posts.images')
</div>
<div class="col">
    @include('admin.posts.videos')
</div>
@endif
<div class="col"></div>