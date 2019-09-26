$(function () {
    $("#profile_form").validate({
        rules: {
            mobile: {mobile: true, }
        },
        submitHandler: function (form) {
            return true;
        }
    });
    $("#profile_passwordform").validate({
        rules: {
            old_password: {noSpace: true},
            new_password: {noSpace: true},
            new_password_repeat: {equalTo: "#new_password"},
        },
        messages: {
            old_password: {minlength: "Your Old password must be at least 5 characters long"},
            new_password: {minlength: "Your password must be at least 5 characters long"},
            new_password_repeat: {equalTo: "Please enter the same password as above"},
        },
        submitHandler: function (form) {
            var btn = $(".change_pass").loading('set');
            $.post($(form).attr('action'), $(form).serialize(), function (o) {
                if (o.sts == 'success') {
                    $.alert({title: 'Congratulations!', content: o.msg, confirm: function () {
                            window.location.reload();
                        }});
                } else
                    $.alert({title: 'Sorry!', content: o.msg});
            }, 'json').always(function () {
                btn.loading('reset');
            }); 
            return false;
        }
    });



});