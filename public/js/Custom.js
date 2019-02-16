tinymce.init({
    selector: '#post_editor'
});

$('.delete-post').on('click',function () {
   var parent = $(this).parent();
   console.log('here');
   if(parent !== undefined)
    {
        if(confirm('Удалить пост?')){
            parent.submit();
        }
    }
});

$('.color-setter').on('change',function () {
    var hex = $(this).val();
    console.log(hex);
    var reg_exp = /[0-9A-F]{6}/gi;

    if(hex.length > 2 && (reg_exp.test(hex))) {
        $('.color-exampler').css('background-color', '#' + hex);
    } else {
        $('.color-exampler').css('background-color', '#f8fafc');
    }

    reg_exp.lastIndex = 0;
});

$(document).ready(function () {
    var hex = $('#color_hex').val();
    if (hex != undefined && hex != '' && hex != null) {
        $('.color-exampler').css('background-color', '#' + hex);
    }

    $('.hashtags_selector').fastselect();

    $('#drop-area').dmUploader({ //
        url: '/admin/posts/uploadImages',
        maxFileSize: 3000000, // 3 Megs
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        extFilter: ["jpg", "jpeg", "png", "gif"],
        onDragEnter: function(){
            // Happens when dragging something over the DnD area
            this.addClass('active');
        },
        onDragLeave: function(){
            // Happens when dragging something OUT of the DnD area
            this.removeClass('active');
        },
        onInit: function(){
        },
        onComplete: function(){
        },
        onNewFile: function(id, file){
            // When a new file is added using the file selector or the DnD area
            ui_multi_add_file(id, file);
        },
        onBeforeUpload: function(id){
            // about tho start uploading a file
            ui_multi_update_file_status(id, 'uploading', 'Uploading...');
            ui_multi_update_file_progress(id, 0, '', true);
        },
        onUploadCanceled: function(id) {
            // Happens when a file is directly canceled by the user.
            ui_multi_update_file_status(id, 'warning', 'Canceled by User');
            ui_multi_update_file_progress(id, 0, 'warning', false);
        },
        onUploadProgress: function(id, percent){
            // Updating file progress
            ui_multi_update_file_progress(id, percent);
        },
        onUploadSuccess: function(id, data){
            // A file was successfully uploaded
            ui_multi_update_file_status(id, 'success', 'Upload Complete');
            ui_multi_update_file_progress(id, 100, 'success', false);
        },
        onUploadError: function(id, xhr, status, message){
            ui_multi_update_file_status(id, 'danger', message);
            ui_multi_update_file_progress(id, 0, 'danger', false);
        },
        onFallbackMode: function(){
            // When the browser doesn't support this plugin :(
            ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
        },
        onFileSizeError: function(file){
            ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
        }
    });
});