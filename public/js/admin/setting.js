
$(function () {
    if ($('#page_content').length) {
        CKEDITOR.replace('page_content', {
            height: '410px',
            'extraPlugins': 'imgbrowse',
            'filebrowserImageBrowseUrl': base_url + '/public/plugins/ckeditor/plugins/imgbrowse/imgbrowse.html?imgroot=uploads/ck_editor_files/',
            "filebrowserImageUploadUrl": base_url + "/public/plugins/ckeditor/plugins/imgupload/iaupload.php?imgroot=uploads/ck_editor_files/"
        });
    }

    $("#banner_aeFrm").validate({
    });

    $("#fbanner_aeFrm").validate({
        rules: {
            img: {sizeCheck: "1"}
        },
        messages: {
            img: {accept: "Only JPG/PNG Allowed", sizeCheck: "Image Size must be less than 1 MB"}
        },
        submitHandler: function (form) {
            var btn = $('#fbanner_aeFrm button[name="submit"]').loading('set');
            $.ajax({
                url: $(form).attr('data-url'),
                dataType: "json",
                type: "POST",
                data: new FormData($('#fbanner_aeFrm')[0]),
                contentType: false,
                cache: false,
                processData: false,
                success: function (d) {
                    if (d.sts == 'success') {
                        window.location.reload();
                    } else if (d.sts == 'error') {
                        $.alert({title: 'Sorry!', content: d.msg});
                    }
                }
            }).always(function () {
                btn.loading('reset');
            });
            return false;
        }
    });

    $("#pageForm").validate({
        ignore: [],
        rules: {
            page_content: {
                required: function () {
                    CKEDITOR.instances.page_content.updateElement();
                }
            }
        },
        messages: {
            page_content: {required: "Please enter Page Content"}
        }
    });

    $("#applicatin_typeForm").validate({
        rules: {
            amount: {required: true, currency: 'amount'}
        }
    });
    
    $("#visa_typeForm").validate({
        rules: {
            amount: {required: true, currency: 'amount'}
        }
    });

    $("#arrivalPortForm").validate({});
    
        $("#blog_form").validate({
        submitHandler: function (form) {
            var btn = $('#blog_form button[name="save_blog"]').loading('set');
            $.ajax({
                url: $(form).attr('data-url'),
                dataType: "json",
                type: "POST",
                data: new FormData($('#blog_form')[0]),
                contentType: false,
                cache: false,
                processData: false,
                success: function (d) {
                    if (d.sts == 'success') {
                        $.alert({title: 'Congratulations!', content: d.msg, confirm: function () {
                                window.location.href = d.url;
                            }});
                    } else if (d.sts == 'error') {
                        $.alert({title: 'Sorry!', content: d.msg});
                    }
                }
            }).always(function () {
                btn.loading('reset');
            });
            return false;
        }
    });

    $("#blog_content_form").validate({
        ignore: [],
        submitHandler: function (form) {
            var btn = $('#blog_content_form button[name="save_blog_content"]').loading('set');
            for (var i in CKEDITOR.instances) {
                CKEDITOR.instances[i].updateElement()
            }
            $.ajax({
                url: $(form).attr('data-url'),
                dataType: "json",
                type: "POST",
                data: new FormData($('#blog_content_form')[0]),
                contentType: false,
                cache: false,
                processData: false,
                success: function (d) {
                    if (d.sts == 'success') {
                        $.alert({title: 'Congratulations!', content: d.msg, confirm: function () {
                                window.location.href = d.url;
                            }});
                    } else if (d.sts == 'error') {
                        $.alert({title: 'Sorry!', content: d.msg});
                    }
                }
            }).always(function () {
                btn.loading('reset');
            });
            return false;
        }
    });

    $('#blog_form #blog_name').keyup(function () {
        if ($('#blog_form #blog_id').val() == '') {
            $('#blog_form #slug').val($('#blog_form #blog_name').val().trim().replace(/ /g, "-").replace(/[^0-9a-zA-Z-_]+/g, '').toLowerCase());
        }
    });


    function blog_ae_content(type,blog_content_id=null,content=null) {
        varckedior_id   =  'blogtextarea' + (blog_content_id==null ? '0' : blog_content_id) ;
        $('#blogPageContent').show();
        $('html, body').animate({scrollTop: $("body").height()}, 800);

        var text_content = '<input type="hidden" name="type" value="'+type+'"><input type="hidden" name="blog_content_id" value="'+blog_content_id+'">' ;
        if(type == 'content') {
            $('#blogPageContent #blogContentLabel').text('Add Blog Content');
            text_content += '<textarea name="page_content" id="'+varckedior_id+'" required="" label-name="Page Content">'+content+'</textarea>';
            $('#blogPageContent .boxBody').html(text_content);
            CKEDITOR.replace(varckedior_id, {
                height: '250px',
                toolbar: 'Basic',
                toolbar_Basic: [['newplugin', 'Bold', 'Italic', 'Underline', 'button-pre', 'abbr', 'Source', 'blockquote', 'inserthtml'], ['PasteText', 'SpellChecker'], ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'], ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'], ['Link', 'Unlink', 'Anchor'], ['Styles', 'Format', 'Font', 'FontSize']]
            });

        } else if(type == 'image') {
            $('#blogPageContent #blogContentLabel').text('Add Blog Image');
            text_content += '<input type="file" name="page_content" class="view_photo mt10" accept="image/.jpe,.jpg,.jpeg,.png" required="" label-name="Banner" />';
            if(content) {
                text_content += '<input type="hidden" name="old_img" value="'+content+'" >';
                text_content += '<div class="show_images"><img src="'+content+'"></div>';
            }
            $('#blogPageContent .boxBody').html(text_content);
        }
    }

    $(document).on('click','.btnContentBoxClose',function(){
        $('#blogPageContent').hide();
        $('html, body').animate({scrollTop: 100}, 800);
        $('#blogPageContent .boxBody').html('');
    });


    $('#add_img').click(function () {
        blog_ae_content('image','','');
    });

    $('#add_content').click(function () {
        blog_ae_content('content','','');
    });

    $('.delete_bcd').click(function(){
        var blog_content_id = $(this).attr('data-bcid');
        var btn = $(this).loading('set');
        $.post("", { 'blog_content_id': blog_content_id, 'action' :'delete_bcd'},function(d){
            if (d.sts == 'success') {
                $.alert({title: 'Congratulations!', content: d.msg, confirm: function () {
                    window.location.reload();
                }});
            } else if (d.sts == 'error') {
                $.alert({title: 'Sorry!', content: d.msg});
            }
        },"json").always(function() {
            btn.loading('reset');
        });
    });

    $('.update_bcd').click(function () {
        var content_type = $(this).attr('data-content_type');
        var blog_content_id = $(this).attr('data-bcid');
        var content = $(this).attr('data-content');
        blog_ae_content(content_type,blog_content_id,content);
    });

    $('#btn_meta_update').click(function () {
        $('#blogMeta').modal('show');
        //get_seo_data 
        $('#blog_meta_form textarea[name="description"], #blog_meta_form textarea[name="title"], #blog_meta_form input[name="heading"],#blog_meta_form textarea[name="keywords"]').val('');
        var url = $(this).attr('blog_meta_url');
        $.ajax({
            url: url,
            dataType: "json",
            type: "GET",
            cache: false,
            success: function (data) {
                if(data.data && data.data.heading) {
                    var d = data.data ;
                    $('#blog_meta_form input[name="heading"]').val(d.heading);
                    $('#blog_meta_form textarea[name="title"]').val(d.title);
                    $('#blog_meta_form textarea[name="description"]').val(d.description);
                    $('#blog_meta_form textarea[name="keywords"]').val(d.keywords);
                }
            }
        }).always(function () {

        });
    });

    $("#blog_meta_form").validate({
        submitHandler: function (form) {
            var btn = $('#blog_meta_form button[name="save_blog_meta"]').loading('set');
            $.ajax({
                url: $(form).attr('action'),
                dataType: "json",
                type: "POST",
                data: new FormData($('#blog_meta_form')[0]),
                contentType: false,
                cache: false,
                processData: false,
                success: function (d) {
                    if (d.sts == 'success') {
                        $.alert({title: 'Congratulations!', content: d.msg, confirm: function () {
                            window.location.reload();
                        }});
                    } else if (d.sts == 'error') {
                        $.alert({title: 'Sorry!', content: d.msg});
                    }
                }
            }).always(function () {
                btn.loading('reset');
            });
            return false;
        }
    });
 
});