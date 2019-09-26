$(function () {
    /* form validate*/
    $("#adminLogin").validate({
        rules: {},
        messages: {},
        submitHandler: function (form) {
            var $btn = $('#adminLogin button').loading('set');
            $.post($(form).attr('action'), $(form).serialize(), function (o) {
                if (o.sts == 'success') {
                    window.location.href = o.url;
                } else {
                    $.alert({title: 'Sorry!', content: o.msg});
                }
            }, 'json').always(function () {
                $btn.loading('reset');
            });
            ;


//            $('#login_profile_frm button').attr('disabled', true).html('<i class="fa fa-spinner fa-pulse"></i>');
//            $.ajax({
//                url: base_url + 'xhr/e_login',
//                type: "POST",
//                data: $(form).serialize(),
//                dataType: "json",
//                success: function (d) {
//                    if (d.sts == 'success') {
////			window.location.reload();
//                        window.location.href = $(form).attr('action');
//                    } else if (d.sts == 'error') {
//                        $('#login_profile_frm button').before('<div class="error">' + d.msg + '</div>');
//                        $('#login_profile_frm button').attr('disabled', false).html('Login');
//                    }
//                },
//                error: function (d) {
//                    console.log(d);
//                }
//            });
            return false;
        }
    });
});