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

    $('.editor-link').on('click', function () {
        if($('.video-link-add-form').css('display') == 'none') {
            $('.video-link-add-form').slideDown();
        } else {
            $('.video-link-add-form').slideUp();
        }
    });

    $('#add_video').click(function () {
        var token = $('meta[name="csrf-token"]').attr('content');
        var video_link = $('#new_video_link').val();
        var post_uid = $('#post_uid').data('value');

        $.ajax({
            method:'POST',
            url:'/admin/posts/addVideoLink',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{video_link: video_link, post_uid: post_uid},
            success:function (response) {
                $('.video-list').html('');
                response.forEach(function (item, i, arr) {
                    $('.video-list').append('<li class="media">\n' +
                        '<a href="'+ item.filepath +'">video link</a>\n' +
                        '<div class="media-body mb-1">\n' +
                        '<div class="mb-2">\n' +
                        '<strong class="ml-2">Tag name: '+ item.media_tag +'</strong>\n' +
                        '<button type="button" class="close float-right mr-3 delete-video-link" data-type="video" data-id="'+item.id+'" aria-label="Close">\n' +
                        '<span aria-hidden="true">&times;</span>\n' +
                        '</button>\n' +
                        '</div>\n' +
                        '<hr class="mt-1 mb-1">\n' +
                        '</div>\n' +
                        '</li>');
                });

                $('#new_video_link').val('');
                $('.video-link-add-form').slideUp();
            }
        })
    });

    $('.delete-image-link, .delete-video-link').on('click', function () {
        var type = $(this).data('type');
        var id = $(this).data('id');
        var url = '';
        var token = $('meta[name="csrf-token"]').attr('content');
        if(type == 'video'){
            url = '/admin/posts/deleteVideos';
        }else if(type == 'image'){
            url = '/admin/posts/deleteImages';
        }

        $.ajax({
            method:'POST',
            url: url,
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{id:id},
            success:function (response) {
                //переделать на пересоздание списка
                window.location.reload();
            }
        });
    });

    $('.make-image-main').on('click',function () {
       var img_id = $(this).data('id');
       var post_uid = $('#post_uid').data('value');
       $.ajax({
           url:'/admin/posts/setMainImage',
           method:'POST',
           dataType:'json',
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           data:{img_id:img_id, post_uid:post_uid},
           success:function (response) {
               $('.image-list li').each(function () {
                   $(this).find('i').removeClass('fa-bookmark-o fa-bookmark').addClass('fa-bookmark-o');

                   if($(this).find('i').data('id') != undefined && $(this).find('i').data('id') == img_id){
                       $(this).find('i').removeClass('fa-bookmark-o fa-bookmark').addClass('fa-bookmark');
                   }
               });
           }
       });
    });

    $('.hashtags_selector').fastselect();

    $('#drop-area').dmUploader({ //
        url: '/admin/posts/uploadImages',
        maxFileSize: 3000000, // 3 Megs
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        extraData:{
            post_uid: $('#post_uid').data('value')
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
        },
        onFileSizeError: function(file){
        }
    });
});