'use strict';
$(document).ready(function () {

    $(document).on('click', '.edit-data', function () {
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#edit_data_Modal').modal('show');

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function fillmodalData(details) {
        $('#m_id').val(details[0]);
        $('#m_name').val(details[1]);
        $('#m_email').val(details[2]);
        $('#m_role').val(details[3]).change();
        $('#m_acc_type').val(details[4]);
        $('#m_province').val(details[5]);
        $('#m_address').val(details[6]);
        $('#m_mobile').val(details[7]);
    }

    $(document).on('click', '.m_edit', function () {

        var url = $('#users_form').attr('action');
        var method = $('#users_form').attr('method');
        $.ajax({
            type: method,
            url: url,
            data: {
                'id': $("#m_id").val(),
                'name': $('#m_name').val(),
                'email': $('#m_email').val(),
                'role': $('#m_role').val(),
                'acc_type': $('#m_acc_type').val(),
                'province': $('#m_province').val(),
                'address': $('#m_address').val(),
                'mobile': $('#m_mobile').val(),
            },
            success: function (data) {
                console.log(data.user);
                var role = '';
                if (data.user.role == '1') {
                    role = 'User';
                } else if (data.user.role == '2') {
                    role = 'Expert';
                } else {
                    role = 'Admin';
                }
                if (data.status == 1) {
                    $('.item-' + data.user.id).replaceWith("<tr class='item-" + data.user.id + "'><td class='text-center'>" + data.user.id + "</td><td>" + data.user.full_name + "</td><td>" + data.user.email + "</td><td>" + role + "</td><td>" + data.user.acc_type + "</td><td>" + data.profile.province + "</td><td>" + data.profile.address + "</td><td>" + data.profile.mobile + "</td><td class='text-center dropdown'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-cog' aria-hidden='true'></i></button><div class='dropdown-menu dropdown-menu-right b-none contact-menu' x-placement='bottom-end' style='position: absolute; transform: translate3d(81px, 52px, 0px); top: 0px; left: 0px; will-change: transform;'><a class='dropdown-item edit-data' data-info='" + data.user.id + "," + data.user.full_name + "," + data.user.email + "," + data.user.role + "," + data.user.acc_type + "," + data.profile.province + "," + data.profile.address + "," + data.profile.mobile + "'><i class='icofont icofont-edit'></i>Edit</a><a class='dropdown-item delete-data' id='" + data.user.id + "'><i class='icofont icofont-ui-delete'></i>Delete</a></div></td></tr>");
                } else {
                    $('.item-' + data.user.id).replaceWith("<tr class='item-" + data.user.id + "'><td class='text-center'>" + data.user.id + "</td><td>" + data.user.full_name + "</td><td>" + data.user.email + "</td><td>" + role + "</td><td>" + data.user.acc_type + "</td><td></td><td></td><td></td><td class='text-center dropdown'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-cog' aria-hidden='true'></i></button><div class='dropdown-menu dropdown-menu-right b-none contact-menu' x-placement='bottom-end' style='position: absolute; transform: translate3d(81px, 52px, 0px); top: 0px; left: 0px; will-change: transform;'><a class='dropdown-item edit-data' data-info='" + data.user.id + "," + data.user.full_name + "," + data.user.email + "," + data.user.role + "," + data.user.acc_type + "'><i class='icofont icofont-edit'></i>Edit</a><a class='dropdown-item delete-data' id='" + data.user.id + "'><i class='icofont icofont-ui-delete'></i>Delete</a></div></td></tr>");
                }
                swal({
                    title: (langswal[1][0]),
                    text: (langswal[1][1]),
                    icon: "success",
                    button: (langswal[1][2]),
                });
            }
        });
    });

    $(document).on('click', '.delete-data', function () {

        var id = $(this).attr("id");

        swal({
            title: (langswal[0][0]),
            text: (langswal[0][1]),
            icon: "warning",
            buttons: true,
            buttons: [langswal[0][4], langswal[0][3]],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: 'user/delete',
                        data: {
                            'id': id
                        },
                        success: function (data) {
                            $('.item-' + id).remove();
                            swal(langswal[0][2], {
                                icon: "success",
                            });
                        }
                    });
                }
            });
    });

});
