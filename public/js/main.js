if ($('#base_url').length) {
    var base_url = $('#base_url').val();
}
if ($('#ck_editor_files_path').length) {
    var ck_editor_files_path = $('#ck_editor_files_path').val();
}
/*view_uploaded_img Strat  */
function view_uploaded_img(t) {
    if ($(t).parent().children().is('div.show_images')) {
        $(t).parent().children('.show_images').html('');
    } else {
        $(t).after('<div class="show_images"></div>');
    }
    var files = t.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /image.*/;
        if (!file.type.match(imageType)) {
            continue;
        }
        var imgId = 'show_img_' + Math.random() + i;
        $(t).parent().children('.show_images').append('<img id="' + imgId + '" src="">');
        var img = document.getElementById(imgId);
        img.file = file;
        var reader = new FileReader();
        reader.onload = (function (aImg) {
            return function (e) {
                aImg.src = e.target.result;
            };
        })(img);
        reader.readAsDataURL(file);
    }
}
$(document).on('change', '.view_photo', function () {
    view_uploaded_img(this);
});



$(function () {

    /*
     * View Image In Popup
     */
    $(document).on('click', 'img.load_img', function () {
        var th = $(this);
        var html = '';
        var img = (th.attr('load-src')) ? th.attr('load-src') : th.attr('src');
        $('#img_loadModal').modal('show');
        if (th.attr('img-title')) {
            html += '<h6 class="bottom-line">' + th.attr('img-title') + '</h6>';
        }
        if (img)
            html += '<img class="img-responsive" style="display: inline;" src="' + img + '">';
        $('#img_loadModal .modal-body').html(html);
    });

    /*
     * Remove Validation error and message on input
     */
    $(document).on('keypress', '.validate_input', function () {
        $(this).removeClass('input-error');
        $(this).siblings(".message").html("");
    });


    $.validator.setDefaults({
        errorElement: 'span',
        errorPlacement: function (error, e) {
            e.parent('').addClass('has-error');
            (e.parent('.input-group').length || e.parent('.inline-group').length) ? error.insertAfter(e.parent()) : error.insertAfter(e);
        },
        unhighlight: function (e) {
            $(e).parent().removeClass('has-error').addClass('has-success');
            $(e).removeClass('error').addClass('success');
        }
    });

    $.validator.addMethod("alphanumeric", function (value, e) {
        return this.optional(e) || /^[a-zA-Z0-9]+$/.test(value);
    }, "Only letters and numbers allowed");


    $.validator.addMethod("noSpace", function (v, e) {
        return (v.indexOf(" ") < 0) ? true : false;
    }, "Space are not allowed");

    $.validator.addMethod("sizeCheck", function (v, e, size) {
        var result = true;
        var files = e.files;
        var size_byte = 1048576 * parseFloat(size);
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (file.size > size_byte) {
                result = false;
            }
        }
        return result;
    }, 'File Size must be less than fixed size');

    $.validator.addMethod("phone_number", function (value, element) {
        var result = true;
        var regx = /^[0-9-+]+$/;
        if (value != '') {
            if (regx.test(value))
                result = true;
            else
                result = false;
        }

        return result;
    }, 'Not a valid Phone Number');

    $.validator.addMethod("alphabets", function (value, element) {
        var result = true;
        var regx = /^[a-zA-Z ]+$/;
        if (value != '') {
            if (regx.test(value))
                result = true;
            else
                result = false;
        }
        return result;
    }, 'Please enter only alphabets');

    $.validator.addMethod("email", function (value, element) {
        var result = true;
        var regx = /^[a-zA-Z0-9_.-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (value != '') {
            if (regx.test(value))
                result = true;
            else
                result = false;
        }
        return result;
    }, 'Please enter a valid email address');
    
    $.validator.addMethod("currency", function (value, element) {
        var result      =   true;
        var regx        =   /^\d{0,4}(\.\d{0,2})?$/;
        if (value != '') {
            if (regx.test(value))
                result  = true;
            else
                result  = false;
        }
        return result;
    }, "Please specify a valid amount"); 

    $.validator.addMethod("required", function (value, element) {
        var result = true;
        if (!$.trim(value)) {
            var enter = ($(element).get(0).tagName == 'SELECT') ? 'select' : ($(element).attr('type') == 'file') ? 'upload' : 'enter';
            result = false;
            var label_name = ($(element).attr('label-name')) ? $(element).attr('label-name') : 'field';
            if (label_name != 'field')
                $.validator.messages.required = "Please " + enter + ' ' + label_name;
            else
                $.validator.messages.required = "Please " + enter + " in this field";
        } else
            result = true;
        return result;
    });

    $.validator.addMethod("mobile", function (value, element) {
        var result = true;
        var regx = /^[0-9]+$/;
        if (!regx.test(value))
            result = false;
        else if ($.trim(value).length !== 10)
            result = false;
        return result;
    }, 'Please enter 10 digit mobile number');

    /*Only Numeric keypress */
    $(document).on('keyup', '.onlyNumeric', function () {
        if (/\D/g.test(this.value)) {
            this.value = this.value.replace(/\D/g, "")
        }
    });
    /*Only Numeric keypress */

    var text = '';
    $.fn.loading = function (r) {
        var d = 'disabled';
        var th = $(this);
        if (r == 'set') {
            text = th.html();
            th.prop(d, d).addClass(d).html(text + ' <i class="fa fa-spinner fa-spin"></i>');
            return th;
        } else if (r == 'reset')
            th.prop(d, false).removeClass(d).html(text);
    };




    if ($('.select2').length)
        $('.select2').select2({theme: "classic"});


    if ($('.captcha').length) {
        $.get(base_url + 'captcha', function (o) {
            $('.captcha').html(o);
        });
        $(document).on('click', '.captcha_new', function () {
            $.get(base_url + 'captcha', function (o) {
                $('.captcha').html(o);
            });
        });
    }
//    var base_url = $('#base_url').val();

});
function alpha_numeric(i) {
    var regx = /^[A-Za-z0-9]+$/;
    return (regx.test(i)) ? true : false;
}
function check_valid_alphaUnderscore(i) {
    var rexp = /^[0-9a-z_]+$/;
    return (!rexp.test(i)) ? false : true;
}
function check_valid_alpha(i) {
    var rexp = /^[A-Za-z ]+$/;
    return (!rexp.test(i)) ? false : true;
}
function check_valid_username(input) {
    var rexp = /^[0-9a-z_]+$/;
    return (!rexp.test(input)) ? false : true;
}

$('.confirm_a').confirm();
$(document).on('click', '.overlay_link', function () {
    $('.load-overlay').show();
});

if ($('.date_picker').length) {
    /**
     * data-max_date Format :: YYYY,MM,DD  || number  :::: Ex : 2016,09,19  ::or:: 5
     * data-min_date Format :: YYYY,MM,DD  || number  :::: Ex : 2016,09,19 ::or:: 6
     * data-date_format :: dd/mm/yy  this format will be the js date format
     * 
     * Example :- 
     * <input type="text" data-max_date="2011,10,25" class="date_picker" name="dob" placeholder="dd/mm/yyyy" >
     */
    $(document).on('focus', '.date_picker', function () {
        var th = $(this);
        var maxDate = (th.attr('data-max_date')) ? (($.isNumeric(th.attr('data-max_date'))) ? th.attr('data-max_date') : new Date(th.attr('data-max_date'))) : null;
        var minDate = (th.attr('data-min_date')) ? (($.isNumeric(th.attr('data-min_date'))) ? th.attr('data-min_date') : new Date(th.attr('data-min_date'))) : null;
        var dateFormat = (th.attr('data-date_format')) ? th.attr('data-date_format') : 'dd/mm/yy';
        th.datepicker({
            changeMonth: true,
            changeYear: true,
            maxDate: maxDate,
            minDate: minDate,
            dateFormat: dateFormat,
            yearRange: "-90:+20",
        });
    }); 
}