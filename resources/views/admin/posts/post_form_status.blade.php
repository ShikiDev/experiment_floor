<div class="card" style="width: 22rem;">
    <div class="card-body">
        <div class="hashtag_list">

        </div>
        <div class="form-group">
            <label for="created">Created</label>
            <input type="text" id="created" class="form-control" readonly @if (!isset($post->id)) value="now" @else value="{{$post->created_at->format('d.m.Y H:i:s')}}" @endif>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" id="author" class="form-control" readonly @if (!isset($post->id)) value="Someone" @else value="{{$post->author['name']}}" @endif>
        </div>
        <div class="form-group">
            <label for="status_list">Status {{--@if(isset($post->status)){{$post->status}}@else None @endif--}}</label>
            <select id="status_list" name="status" class="form-control">
                <option value="">No selected</option>
                <option value="published" @if (isset($post->status) and $post->status == 'published') selected @endif>Published</option>
                <option value="noted" @if (isset($post->status) and $post->status == 'notecdd') selected @endif>A note</option>
                <option value="deleted" @if (isset($post->status) and $post->status == 'deleted') selected @endif>Deleted</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Apply</button>
    </div>
</div>
<div class="card mt-3" style="width: 22rem;">
    <div class="card-header">Adding tag to post</div>
    <div class="card-body">
        <label for="tag_search">Search Tag :</label>
        <select id="tag_search" name="hashtag_setted[]" multiple="multiple" class="hashtags_selector">
            @if (isset($hashtag_list))
                @foreach($hashtag_list as $hash)
                    <option value="{{$hash->id}}" @if(isset($selected_hashtags) and in_array($hash->id,$selected_hashtags)) selected @endif>{{$hash->name}}</option>
                @endforeach
            @else
                <option  value="">Choose status</option>
            @endif
        </select>
    </div>
</div>