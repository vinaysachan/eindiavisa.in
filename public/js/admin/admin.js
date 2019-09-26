$(function () {
    $(".enq_sts").click(function () {
        var th = $(this);
        var sts = (th.prop('checked')) ? 1 : 0;
        $.post(base_url + 'admin/home/change_sts', {sts: sts, id: th.attr('data-enq_id')}, function (o) {
            if (o.sts == 'success') {
                $.alert({
                    title: 'Congratulations!',
                    content: o.msg,
                    confirm: function () {
                        window.location.reload();
                    }
                });
            } else {
                $.alert({title: 'Sorry!', content: o.msg});
            }
        }, 'json');
    });
    
    $(".c_sts").click(function () {
        var th = $(this);
        var sts = (th.prop('checked')) ? 1 : 0;
        $.post(base_url + 'admin/setting/change_country_sts', {sts: sts, id: th.attr('data-id')}, function (o) {
            if (o.sts == 'success') {
                $.alert({
                    title: 'Congratulations!',
                    content: o.msg,
                    confirm: function () {
                        window.location.reload();
                    }
                });
            } else {
                $.alert({title: 'Sorry!', content: o.msg});
            }
        }, 'json');
    });

    $("#app_status").click(function () {
        var th = $(this);
        var sts = (th.prop('checked')) ? 1 : 0;
        if (sts == 1) {
            $.post(base_url + 'admin/home/close_sts', {app_id: th.attr('data-app_id')}, function (o) {
                if (o.sts == 'success') {
                    $.alert({
                        title: 'Congratulations!',
                        content: o.msg,
                        confirm: function () {
                            window.location.reload();
                        }
                    });
                } else {
                    $.alert({title: 'Sorry!', content: o.msg});
                }
            }, 'json');
        }
    });


});



