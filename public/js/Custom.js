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
    if(hex != undefined && hex != '' && hex != null) {
        $('.color-exampler').css('background-color', '#' + hex);
    }

    $('.hashtags_selector').fastselect();
});