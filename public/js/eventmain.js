'use strict';
$(document).ready(function () {
    var a = [];
    //config default
    var limit = 8;
    var start = 0;
    var numbday = 0;
    var startdate = '2016-12-31';
    var enddate = '2021-12-31';
    var province = 0;
    var day = 0;
    var action = 'inactive';
   
    a = [numbday, startdate, enddate, province, day];


    $(document).on('click', '.filter', function () {

        numbday = $('input[name="c_day"]:checked').val();
        startdate = $('#date_start').val();
        enddate = $('#date_end').val();
        province = $('.states').val();
        day = $('.daylist').val();

        limit = 8;
        start = 0;

        a = [numbday, startdate, enddate, province[0], day[0]];

        $.ajax({
            type: "POST",
            url: "event/filter",
            data: {
                limit: limit,
                start: start,
                numbday: a[0],
                startdate: a[1],
                enddate: a[2],
                province: a[3],
                day: a[4]
            },
            cache: false,
            success: function (response) {
                $('.myevets-card').hide().html(response.html).fadeIn(1000);
                $('[data-toggle="tooltip"]').tooltip();
                $('.message-loading').html("<button class='btn btn-grd-inverse' style='width:100%' disabled>"+ langload[0]+"<i class='fas fa-spinner fa-pulse'></i></button>");
                action = "inactive";
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

    });

    function load_country_data(limit, start, numbday, startdate, enddate, province, day) {

        $.ajax({
            type: "POST",
            url: "event/filter",
            data: {
                limit: limit,
                start: start,
                numbday: numbday,
                startdate: startdate,
                enddate: enddate,
                province: province,
                day: day,
            },
            cache: false,
            success: function (response) {
                $('.myevets-card').append(response.html);
                $('[data-toggle="tooltip"]').tooltip();
                if (response.html == '') {
                    $('.message-loading').html("<button class='btn btn-grd-inverse' style='width:100%' disabled>"+ langload[1]+" <i class='fas fa-check'></i></button>");
                    action = 'active';
                }
                else {
                    $('.message-loading').html("<button class='btn btn-grd-inverse' style='width:100%' disabled>"+ langload[0]+" <i class='fas fa-spinner fa-pulse'></i></button>");
                    action = "inactive";
                }

            }
        });
    }

    $(window).scroll(function () {

        if ($(window).scrollTop() + $(window).height() > $(".myevets-card").height() && action == 'inactive') {
            action = 'active';
            start = start + limit;
            console.log(start);
            setTimeout(function () {
                load_country_data(limit, start, a[0], a[1], a[2], a[3], a[4]);
            }, 1000);
        }
    });

    if (action == 'inactive') {
        action = 'active';
        load_country_data(limit, start, a[0], a[1], a[2], a[3], a[4]);
    }
});