'use strict';
$(document).ready(function () {

    // for responsive all datatable
    $('#simpletable').DataTable({
        "paging": true,
        "ordering": true,
        "bLengthChange": true,
        "info": true,
        "searching": true
    });

    $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });

    // Edit information of user-profile
    $('#edit-cancel').on('click', function () {

        var c = $('#edit-btn').find("i");
        c.removeClass('icofont-close');
        c.addClass('icofont-edit');
        $('.view-info').show();
        $('.edit-info').hide();

    });

    $('.edit-info').hide();

    $('#edit-btn').on('click', function () {
        var b = $(this).find("i");
        var edit_class = b.attr('class');
        if (edit_class == 'icofont icofont-edit') {
            b.removeClass('icofont-edit');
            b.addClass('icofont-close');
            $('.view-info').hide();
            $('.edit-info').show();
        } else {
            b.removeClass('icofont-close');
            b.addClass('icofont-edit');
            $('.view-info').show();
            $('.edit-info').hide();
        }
    });

    $.Thailand.setup({
        database: url_db
    });

    $.Thailand({

        $search: $('#update_profile [name="province"]'),
        $province: $('#update_profile [name="province"]'),

        onDataFill: function (data) {
            console.log(data)
            var address = 'ที่อยู่ : แขวง/ตำบล ' + data.district + ' เขต/อำเภอ ' + data.amphoe + ' จังหวัด' + data.province + ' ' + data.zipcode;
            $('#address').val(address);
        },

        onLoad: function () {
            $('#update_profile').toggle();
        }
    });

    $("#dob").datepicker({
        dateFormat: "yy-mm-dd"
    });

    $('#mobile').inputmask({
        mask: '999-999-9999'
    });
});
