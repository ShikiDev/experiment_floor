<span id="post_uid" style="display: none;" data-value="{{$post->id}}"></span>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div id="drop-area" class="dm-uploader p-5 text-center">
            <h3 class="mb-5 mt-5 text-muted">Drag & drop image</h3>
            <div class="btn btn-success btn-block mb-5">
                <span>Open file browser</span>
                <input id="img_uploader" type="file" title="img uploader" multiple>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card h-100">
            <div class="card-header">
                File List
            </div>
            <ul class="list-unstyled p-2 d-flex flex-column list-scroller col" id="img_files">
                <li class="text-muted text-center empty">No files uploaded.</li>
            </ul>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col">
        <div class="card h-100">
            <div class="card-header">
                Image List
            </div>
            @if(!empty($images))
            <ul class="list-unstyled p-2 d-flex flex-column col list-scroller image-list">
                @foreach($images as $image)
                <li class="media">
                    <img class="mr-3 mb-2 preview-img rounded" src="{{asset($image->filepath)}}" alt="Generic placeholder image">
                    <div class="media-body mb-1">
                        <div class="mb-2">
                            <strong class="ml-2">Tag name: </strong><span class="status text-success ml-3">{{$image->media_tag}}</span>
                            <i class="ml-3 fa @if($image->main_img == 'true') fa-bookmark @else fa-bookmark-o @endif fa-2x make-image-main" data-id="{{$image->id}}"></i>
                            <button type="button" class="close float-right mr-3 delete-image-link" data-type="image" data-id="{{$image->id}}" aria-label="Close">
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