<div class="col">
    <div class="form-group">
        <label for="hashtag_name">Name</label>
        <input type="text" class="form-control form-control-lg" id="hashtag_name" name="name" placeholder="Enter name" value="{{$hashtag->name or ""}}">
    </div>
</div>
<div class="col">
    <div class="form-group">
        <label for="color_hex">Color hex code</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">#</div>
            </div>
            <input class="color-setter form-control" id="color_hex" type="text" name="color"  value="{{$hashtag->color or ""}}" maxlength="6">
        </div>
    </div>
</div>
<div class="col">
    <div class="color-exampler"></div>
</div>
<div class="col">
    <button type="submit" class="btn btn-primary">Save</button>
</div>