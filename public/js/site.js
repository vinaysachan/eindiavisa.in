$("#enqFrm").validate({
    rules: {email: {require_from_group: [1, ".cntgrp"]},
        mobile: {
            require_from_group: [1, ".cntgrp"]
        }
    },
    messages: {
        email: {
            require_from_group: "Either Mobile or Email Id"
        },
        mobile: {
            require_from_group: "Either Mobile or Email Id"
        }
    },
    submitHandler: function (form) {
        var btn = $("#enqFrm button[type='submit']").loading('set');
        $.post($(form).attr('action'), $(form).serialize(), function (o) {
            if (o.sts == 'success') {
                $.alert({title: o.title, content: o.msg, onClose: function () {
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
$(document).ready(function () {
    $('input:radio[name=visitedbefore]').change(function () {

        if (this.value == 'yes') {

            $('#visitedbefore_form').show();
        } else if (this.value == 'no') {

            $('#visitedbefore_form').hide();
        }
    });
    $('input:radio[name=extendstay]').change(function () {

        if (this.value == 'yes') {

            $('#extendstaydetails').show();
        } else if (this.value == 'no') {

            $('#extendstaydetails').hide();
        }
    });
    $('input:checkbox[name=agreement]').change(function () {

        if (this.checked == true) {

            $('#payment').show();
        } else {

            $('#payment').hide();
        }
    });
});
function agrement() {
    if ($('#agreement').checked == true) {

        $('#payment').show();
    } else {

        $('#payment').hide();
    }
}
function sameaddress(f) {
    if (f.sameAddress.checked == true) {
        f.phouseno.value = f.houseno.value;
        f.pcity.value = f.city.value;
        f.pdistrict.value = f.district.value;
    }
}
function maritalStatus(val) {
    if (val == 'Married') {
        $('#spouse_form').show();
    } else {
        $('#spouse_form').hide();
    }
}

$(document).ready(function () {
    $('input:radio[name=grand_pak]').change(function () {
        if (this.value == 'yes') {

            $('#pak_details').show();
        } else if (this.value == 'no') {

            $('#pak_details').hide();
        }
    });
    $('input:radio[name=military]').change(function () {
        if (this.value == 'yes') {
            $('#military_form').show();
        } else if (this.value == 'no') {

            $('#military_form').hide();
        }
    });
});
$("#applyVisaFrm").validate({
    // onkeyup: function (element) {
    //     if ((element.name == 'v_code'))
    //         return false;
    //     else
    //         $(element).valid();
    // },
    rules: {
        re_email: {equalTo: "#email"},
    },
    messages: {
        re_email: {equalTo: "Please enter the same Email as above"},
    },
    submitHandler: function (form) {
        var btn = $("#applyVisaFrm button[type='submit']").loading('set');
        $.post($(form).attr('data-action'), $(form).serialize(), function (o) {
            if (o.sts == 'success') {
                $.alert({title: o.title, content: o.msg, onClose: function () {
                        location.href = o.url;
                    }});
            } else
                $.alert({title: 'Sorry!', content: o.msg});
        }, 'json').always(function () {
            btn.loading('reset');
        });
        // return false;
    }
});
$("#searchAppFrm").validate({
    submitHandler: function (form) {
        var btn = $("#searchAppstsFrm button[type='submit']").loading('set');
        $.post($(form).attr('action'), $(form).serialize(), function (o) {
            if (o.sts == 'success') {
                $.alert({title: o.title, content: o.msg, onClose: function () {
                        window.location.href = o.url;
                    }});
            } else if (o.sts == 'pending') {
                $.alert({title: o.title, content: o.msg, onClose: function () {
                        window.location.reload();
                    }});
            } else if (o.sts == 'complete') {
                $.alert({title: o.title, content: o.msg, onClose: function () {
                        window.location.reload();
                    }});
            } else
                $.alert({title: o.title, content: o.msg, onClose: function () {
                        window.location.reload();
                    }});
        }, 'json').always(function () {
            btn.loading('reset');
        });
        return false;
    }
});
$("#searchAppstsFrm").validate({
    submitHandler: function (form) {
        var btn = $("#searchAppstsFrm button[type='submit']").loading('set');
        $.post($(form).attr('action'), $(form).serialize(), function (o) {
            if (o.sts == 'success') {
                $.alert({title: o.title, content: o.msg, onClose: function () {
                        window.location.href = o.url;
                    }});
            } else if (o.sts == 'pending') {
                $.alert({title: o.title, content: o.msg, onClose: function () {
                        window.location.reload();
                    }});
            } else if (o.sts == 'complete') {
                $.alert({title: o.title, content: o.msg, onClose: function () {
                        window.location.reload();
                    }});
            } else
                $.alert({title: o.title, content: o.msg, onClose: function () {
                        window.location.reload();
                    }});
        }, 'json').always(function () {
            btn.loading('reset');
        });
        return false;
    }
});
$("#visa_regFrm").validate({
    submitHandler: function (form) {
        return true;
    }
});
$("#step3").validate({
    submitHandler: function (form) {
        return true;
    }
});
$("#step4Form").validate({
    rules: {
        image: {sizeCheck: "2"}
    },
    messages: {
        image: {accept: "Only JPG/PNG Allowed", sizeCheck: "Image Size must be less than 2 MB"}
    },
    submitHandler: function (form) {
        var btn = $('#step4Form button[name="step4"]').loading('set');
        $.ajax({
            url: $(form).attr('data-url'),
            dataType: "json",
            type: "POST",
            data: new FormData($('#step4Form')[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function (d) {
                if (d.sts == 'success') {
                    window.location.href = d.url;
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
$("#passport_uploadFrm").validate({
    rules: {
        passport: {sizeCheck: "2"}
    },
    messages: {
        passport: {accept: "Only JPG/PNG Allowed", sizeCheck: "Image Size must be less than 2 MB"}
    },
    submitHandler: function (form) {
        var btn = $('#passport_uploadFrm button[name="step4"]').loading('set');
        $.ajax({
            url: $(form).attr('data-url'),
            dataType: "json",
            type: "POST",
            data: new FormData($('#passport_uploadFrm')[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function (d) {
                if (d.sts == 'success') {
                    window.location.href = d.url;
                } else if (d.sts == 'error') {
                    $.alert({title: 'Sorry!', content: d.msg});
                }
            }
        }).always(function () {
            btn.loading('reset');
        });
        return false;
    }
//    submitHandler: function (form) {
//        return true;
//    }
});
function acquire_naturalization(val) {
    if (val == 'Naturalization') {
        $('#prev_nationality').show();
    } else {
        $('#prev_nationality').hide();
    }
}
$(document).ready(function () {
    $('input:radio[name=ic]').change(function () {
        if (this.value == 'yes') {
            $('#ic_form').show();
        } else if (this.value == 'no') {
            $('#ic_form').hide();
        }
    });
    $('select[name=religion]').change(function () {
        var v = $(this).val();
        if (v == 'Others') {
            $('#other_relation').prop('disabled', false).attr('placeholder', 'Please specify your Religion');
        } else {
            $('#other_relation').prop('disabled', true).attr('placeholder', '');
        }
    });
});
$(document).on('click', "[name='have_previous_name']", function () {
    var th = $(this);
    if (th.prop('checked')) {
        $('#previous_name').show();
    } else {
        $('#previous_name').hide();
    }
});

if ($('#after_apply_visa_link').length)  {
    var link = $('#after_apply_visa_link').attr('link');
    window.setTimeout(window.location.href = link,3000);
}


if ($('#applyVisaFrm').length && visa_types.length)  {
    $('#app_type').change(function () {
        $('.selected_app_type').text('');
        var selected_app_type    =   $('#app_type').val();
        var visa_type_select         =   $('#visa_type');
        visa_type_select.find('option').remove();
        if (selected_app_type != '') {
            $('.selected_app_type').text($('#app_type option:selected').text());
            var selected_visa_types =   visa_types.filter(function(visa_type) { return visa_type.application_type_id == selected_app_type; });
            visa_type_select.append(new Option('Select Visa Type', ''));
            $.each(selected_visa_types, function(index, item) {
                var opt = item.name + ' ('+item.validitiy+' days)' ;
                visa_type_select.append(new Option(opt, item.id));
            });
        } else {
            visa_type_select.append(new Option('Please Select Application Type First', ''));
        }
    });
}

if ($('#step4Form').length && visa_types.length)  {
    $('#app_type').change(function () {
        var selected_app_type    =   $('#app_type').val();
        var visa_type_select         =   $('#visa_type');
        visa_type_select.find('option').remove();
        if (selected_app_type != '') {
            var selected_visa_types =   visa_types.filter(function(visa_type) { return visa_type.application_type_id == selected_app_type; });
            visa_type_select.append(new Option('Select Visa Type', ''));
            $.each(selected_visa_types, function(index, item) {
                var opt = item.name + ' ('+item.validitiy+' days)';
                var nop = new Option(opt, item.id);
                nop.setAttribute("data-validitiy",item.validitiy);
                nop.setAttribute("data-entry",item.entry);
                visa_type_select.append(nop);
            });
        } else {
            visa_type_select.append(new Option('Please Select Application Type First', ''));
        }
    });
    $(document).on('change', '#visa_type', function () {
        var obj = $("#visa_type");
        if(obj.val() !='') {
            $('.visa_validitiy').html(obj.find('option:selected').attr('data-validitiy') + ' days');
            $('.visa_entry').html(obj.find('option:selected').attr('data-entry') + ' Entries');
        } else {
            $('.visa_validitiy').html('-');
            $('.visa_entry').html('-');
        }
    });
}














