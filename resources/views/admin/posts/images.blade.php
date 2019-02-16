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
            <ul class="list-unstyled p-2 d-flex flex-column col" id="img_files">
                <li class="text-muted text-center empty">No files uploaded.</li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card h-100">
            <div class="card-header">
                Debug Messages
            </div>
            <ul class="list-group list-group-flush" id="debug">
                <li class="list-group-item text-muted empty" style="display: none;">Loading plugin....</li>
            </ul>
        </div>
    </div>
</div>