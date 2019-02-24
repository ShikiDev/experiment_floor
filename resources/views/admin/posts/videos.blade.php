<hr>
<div class="row">
    <div class="col">
        <a href="javascript: void(0)" class="editor-link">Add new video link</a>
        <div class="video-link-add-form mt-2" style="display: none">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="new_video_link">Video link</label>
                </div>
                <input  type="text" class="form-control" id="new_video_link"/>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="add_video">Add video link</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col">
        <div class="card h-100">
            <div class="card-header">
                Video List
            </div>
            @if(!empty($video_links))
                <ul class="list-unstyled p-2 d-flex flex-column col list-scroller video-list">
                    @foreach($video_links as $video)
                    <li class="media">
                        <a href="{{asset($video->filepath)}}">video link</a>
                        <div class="media-body mb-1">
                            <div class="mb-2">
                                <strong class="ml-2">Tag name: {{$video->media_tag}}</strong>
                                <button type="button" class="close float-right mr-3 delete-video-link" data-type="video" data-id="{{$video->id}}" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <hr class="mt-1 mb-1">
                        </div>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>