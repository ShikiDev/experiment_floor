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
<div class="col">
    <div class="card">
        <div class="card-body">
            <blockquote class="blockquote">
                <p class="mb-0">< :end_post_shortcut > - это для создания шортката.</p>
                <p class="mb-0">< :post_n_n > - это для вставки медиа, где n - цифра.</p>
                <footer class="blockquote-footer">Hint for you,<cite title="Source Title"> Alan</cite></footer>
            </blockquote>
        </div>
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