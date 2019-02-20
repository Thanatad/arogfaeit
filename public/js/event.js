'use strict';

$(document).ready(function () {


    //setup thailand
    $.Thailand.setup({
        database: url_db
    });

    $.Thailand({

        $province: $('#evnet_form [name="txt_province"]'),
        $district: $('#evnet_form [name="txt_district"]'),
        $amphoe: $('#evnet_form [name="txt_amphoe"]'),
        $zipcode: $('#evnet_form [name="txt_zipcode"]'),

        onDataFill: function (data) {
            var address = 'ที่อยู่ : แขวง/ตำบล ' + data.district + ' เขต/อำเภอ ' + data.amphoe + ' จังหวัด' + data.province + ' ' + data.zipcode;
            $('#txt_address').val(address);
        },

        onLoad: function () {
            $('#evnet_form').toggle();
        }

    });

    // setup map
    var marker;
    var map = L.map('map', {
        zoomControl: false
    }).setView(['13.736717', '100.523186'], 7);

    // location mobile
    $('#getlocation').on('click', function () {
        map.locate({ setView: true, maxZoom: 16 });
        map.on('locationfound', onLocationFound);
    });

    function onLocationFound(e) {
        if (marker) { // check
            map.removeLayer(marker); // remove
        }
        marker = new L.marker([e.latlng.lat, e.latlng.lng]).addTo(map).bindPopup("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
        $('#lat').val(e.latlng.lat);
        $('#lon').val(e.latlng.lng);
    }

    //set marker on edit modal
    $('#modal-edit').on('shown.bs.modal', function () {
        if (marker) { // check
            map.removeLayer(marker); // remove
        }
        marker = new L.marker([$('#lat').val(), $('#lon').val()]).addTo(map);
        map.setView([$('#lat').val(), $('#lon').val()], 14.5);
    });


    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href");
        if (target == "#step3") {
            setTimeout(function () {
                map.invalidateSize()
            }, 500);
        }
    });

    //clearinputtag
    $('#modal-edit').on('hidden.bs.modal', function () {
        $("#hashtag").tagsinput('removeAll');
        $("#highlight").tagsinput('removeAll');
    });

    //modal
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        //update progress
        var step = $(e.target).data('step');
        var percent = (parseInt(step) / 5) * 100;
        $('.progress-bar').css({
            width: percent + '%'
        });
        $('.progress-bar').text(section + step + " of 5");
        //e.relatedTarget // previous tab
    })
    $('.first').click(function () {
        $('#section-edit a:first').tab('show')
    })

    //modal-edit
    $(document).on('click', '.edit-data', function () {
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(';');
        fillmodalData(stuff)
        $('#modal-edit').modal('show');
        $('#eimage').val("");
        $('.upload_preview').attr("src", $('.upload_preview').attr("src") + "?timestamp=" + new Date().getTime());
    });



    function fillmodalData(details) {
        $('#pcurrent').val($(location).attr("href").split("?page=")[1]);
        $('#id_uevent').val(details[0]);
        $('#id_location').val(details[1]);
        $('#id_event').val(details[2]);
        $('#txt_event').val(details[3]);
        $('#txt_short_des').val(details[4]);
        $('#txt_description').val(details[5]);
        $('#numb_budget').val(details[6]);
        $('#numb_c_day').val(details[7]).change();
        $('#date_start').val(details[8]);
        $('#date_end').val(details[9]);
        $('#time_start').val(details[10]);
        $('#txt_phone').val(details[11]);
        $('#txt_email').val(details[12]);
        $('#highlight').tagsinput('add', details[13]);
        $('#hashtag').tagsinput('add', details[14]);
        $('#image_preview').attr('src', '/upload/images/event/' + details[15]);
        $('#txt_place').val(details[16]);
        $('#txt_describe_place').val(details[17]);
        $('#txt_district').val(details[18]);
        $('#txt_zipcode').val(details[19]);
        $('#txt_province').val(details[20]);
        $('#txt_amphoe').val(details[21]);
        $('#txt_road').val(details[22]);
        $('#txt_address').val(details[23]);
        $('#lat').val(details[24]);
        $('#lon').val(details[25]);
        $('#daylist').val(details[26]).change();
    }


    $(document).on('click', '#m_edit', function () {

        var data = new FormData($("#evnet_form")[0]);
        var url = $('#evnet_form').attr('action');
        var method = $('#evnet_form').attr('method');

        $.ajax({
            type: method,
            url: url,
            data: data,
            contentType: false,
            processData: false,
            success: function (data) {
                swal({
                    title: (langswal[1][0]),
                    text: (langswal[1][1]),
                    icon: "success",
                    button: (langswal[1][2]),
                });
                console.log(data.event);
                if (data.status == 'view') {
                    //$('.myevets-card').hide().html(data.html).fadeIn(1000);
                    $('.myevets-card').html(data.html);
                    $('.img-event-' + $('#id_event').val()).attr("src", $('.img-event-' + $('#id_event').val()).attr("src") + "?timestamp=" + new Date().getTime());
                    $('[data-toggle="tooltip"]').tooltip();
                } else if (data.status == 'manage') {
                    updateitem(data);
                }

            }
        });
    });

    //modal-delete
    $(document).on('click', '.delete-data', function () {

        var id = $(this).attr("id");
        var page = $('#page').val();

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
                        url: '/event/delete',
                        data: {
                            'id': id,
                            'page': page
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

    //assign destroy selection
    $(document).on('change', 'select[name="assign"]', function () {

        var id = $(this).attr("id");
        var status = $(this).attr("name");
        var statusval = $(this).children("option:selected").val();
        var s_assign;
        $.ajax({
            type: 'POST',
            url: '/event/change',
            data: {
                'id': id,
                'status': status,
                'data': statusval
            },
            success: function (data) {

                if (statusval == 0) {
                    s_assign = "<select size='1' class='form-control' id='" + id + "'name='assign'><option value='0' selected='selected'>"+ pending +"</option><option value='1'>"+ approve +"</option></select>";
                } else {
                    s_assign = "<select size='1' class='form-control' id='" + id + "'name='assign'><option value='0'>"+ pending +"</option><option value='1' selected='selected'>"+ approve +"</option></select>";
                }
                
                $('#events_table').dataTable().fnUpdate(s_assign , $('.item-' + id)[0], 7 );

                swal({
                    title: (langswal[1][0]),
                    text: (langswal[1][1]),
                    icon: "success",
                    button: (langswal[1][2]),
                });
            }

        });
    });

    $(document).on('change', 'select[name="destroy"]', function () {

        var id = $(this).attr("id");
        var status = $(this).attr("name");
        var statusval = $(this).children("option:selected").val();
        var s_destroy;
        $.ajax({
            type: 'POST',
            url: '/event/change',
            data: {
                'id': id,
                'status': status,
                'data': statusval
            },
            success: function (data) {
                
                if (statusval == 0) {
                    s_destroy = "<select size='1' class='form-control' id='" + id + "'name='destroy'><option value='0' selected='selected'>"+ normal +"</option><option value='1'>"+ deleted +"</option></select>";
                } else {
                    s_destroy = "<select size='1' class='form-control' id='" + id + "'name='destroy'><option value='0' >"+ normal +"</option><option value='1' selected='selected'>"+ deleted +"</option></select>";
                }
                
                $('#events_table').dataTable().fnUpdate(s_destroy , $('.item-' + id)[0], 8 );

                swal({
                    title: (langswal[1][0]),
                    text: (langswal[1][1]),
                    icon: "success",
                    button: (langswal[1][2]),
                });
            }
        });

    });

    // dom
    function updateitem(data) {
        var s_assign;
        var s_destroy;
        var button = "<button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-cog' aria-hidden='true'></i></button><div class='dropdown-menu dropdown-menu-right b-none contact-menu' x-placement='bottom-end' style='position: absolute; transform: translate3d(81px, 52px, 0px); top: 0px; left: 0px; will-change: transform;'><a class='dropdown-item view-data' href='/event/detail/" + data.event.ueid + "' target='_blank' id='" + data.event.ueid + "'><i class='icofont-eye-alt'></i>View</a><a class='dropdown-item edit-data first' data-info='" + data.event.ueid + ";" + data.event.lid + ";" + data.event.eid + ";" + data.event.name + ";" + data.event.short_des + ";" + data.event.description + ";" + data.event.budget + ";" + data.event.count_day + ";" + data.event.start + ";" + data.event.end + ";" + data.event.timestart + ";" + data.event.mobile + ";" + data.event.email + ";" + data.event.highlight + ";" + data.event.hashtag + ";" + data.event.picture + ";" + data.event.place_name + ";" + data.event.place_des + ";" + data.event.district + ";" + data.event.zipcode + ";" + data.event.province + ";" + data.event.amphoe + ";" + data.event.road + ";" + data.event.more_address + ";" + data.event.lat + ";" + data.event.lon + ";" + data.event.day + "'><i class='icofont icofont-edit'></i>Edit</a><a class='dropdown-item delete-data' id='" + data.event.ueid + "'><i class='icofont icofont-ui-delete'></i>Delete</a></div>";
        
        if (data.event.assign == 0) {
            s_assign = "<select size='1' class='form-control' id='" + data.event.eid + "'name='assign'><option value='0' selected='selected'>"+ pending +"</option><option value='1'>"+ approve +"</option></select>";
        } else {
            s_assign = "<select size='1' class='form-control' id='" + data.event.eid + "'name='assign'><option value='0'>"+ pending +"</option><option value='1' selected='selected'>"+ approve +"</option></select>";
        }
        if (data.event.destroy == 0) {
            s_destroy = "<select size='1' class='form-control' id='" + data.event.eid + "'name='destroy'><option value='0' selected='selected'>"+ normal +"</option><option value='1'>"+ deleted +"</option></select>";
        } else {
            s_destroy = "<select size='1' class='form-control' id='" + data.event.eid + "'name='destroy'><option value='1' selected='selected'>"+ deleted +"</option><option value='0'>"+ normal +"</option></select>";
        }
        if(data.event.count_day == 7){
           data.event.count_day = '>7'
        }
        $('#events_table').dataTable().fnUpdate( [data.event.ueid, data.event.name, data.event.place_name, data.event.start, data.event.count_day + " " + tablelang[1][0], data.event.province,data.event.full_name,s_assign,s_destroy,data.event.created_at,button,],$('.item-' + data.event.ueid) );
 
        // $('.item-' + data.event.ueid).replaceWith("<tr class='item-" +
        //     data.event.ueid + "'><td class='text-center'>" + data.event.ueid +
        //     "</td><td>" + data.event.name +
        //     "</td><td>" + data.event.place_name +
        //     "</td><td>" + data.event.start +
        //     "</td><td class='text-center'>" + data.event.count_day +
        //     " " + tablelang[1][0] + "</td><td>" + data.event.province +
        //     "</td><td>" + data.event.full_name +
        //     "</td><td>" + s_assign +
        //     "</td><td>" + s_destroy +
        //     "</td><td>" + data.event.created_at +
        //     "</td><td class='text-center dropdown'><button type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-cog' aria-hidden='true'></i></button><div class='dropdown-menu dropdown-menu-right b-none contact-menu' x-placement='bottom-end' style='position: absolute; transform: translate3d(81px, 52px, 0px); top: 0px; left: 0px; will-change: transform;'><a class='dropdown-item view-data' id='" + data.event.ueid + "'><i class='icofont-eye-alt'></i>View</a><a class='dropdown-item edit-data first' data-info='" + data.event.ueid + ";" + data.event.lid + ";" + data.event.eid + ";" + data.event.name + ";" + data.event.short_des + ";" + data.event.description + ";" + data.event.budget + ";" + data.event.count_day + ";" + data.event.start + ";" + data.event.end + ";" + data.event.timestart + ";" + data.event.mobile + ";" + data.event.email + ";" + data.event.highlight + ";" + data.event.hashtag + ";" + data.event.picture + ";" + data.event.place_name + ";" + data.event.place_des + ";" + data.event.district + ";" + data.event.zipcode + ";" + data.event.province + ";" + data.event.amphoe + ";" + data.event.road + ";" + data.event.more_address + ";" + data.event.lat + ";" + data.event.lon + ";" + data.event.day + "'><i class='icofont icofont-edit'></i>Edit</a><a class='dropdown-item delete-data' id='" + data.event.ueid + "'><i class='icofont icofont-ui-delete'></i>Delete</a></div></td></tr>");
        }

    // get listdays
    $('input:radio').change(function(){
        var type = $(this).val();
        $.ajax({
            type: 'POST',
            url: '/event/event/daylist',
            data: {type:type},
            success: function (response){
            $('.daylist').html(response.html);
            }
        });
    });

    // add control Zoom
    map.addControl(new L.Control.Zoom({
        zoomInTitle: (langmap[4]),
        zoomOutTitle: (langmap[5])
    }));

    // add control fullscreen
    map.addControl(new L.Control.Fullscreen({
        title: {
            'false': (langmap[2]),
            'true': (langmap[3])
        }
    }));

    $('#lat').val('');
    $('#lon').val('');

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a', 'b', 'c']
    }).addTo(map);

    // refersh
    setTimeout(function () {
        map.invalidateSize()
    }, 500);

    $("#txt_place").focusout(function () {
        getwiki();
    });

    $("#txt_district,#txt_province,#txt_amphoe,#txt_zipcode").focusout(function () {
        $('#lon').val('');

        var province = 'จังหวัด' + $('#txt_province').val();
        var district = 'ตำบล' + $('#txt_district').val();
        var amphoe = 'อำเภอ' + $('#txt_amphoe').val();

        if (province == "จังหวัดกรุงเทพมหานคร") {
            district = 'แขวง' + $('#txt_district').val();
            amphoe = 'เขต' + $('#txt_amphoe').val();
        }

        L.esri.Geocoding.geocode().text(province + ',' + district + ',' + amphoe).run(function (err, results, response) {

            var lat_loc = results.results[0].latlng.lat;
            var lng_loc = results.results[0].latlng.lng;

            if (marker) { // check
                map.removeLayer(marker); // remove
            }

            marker = new L.marker([lat_loc, lng_loc]).addTo(map).bindPopup("Lat, Lon : " + lat_loc + ", " + lng_loc)
            $('#lat').val(lat_loc);
            $('#lon').val(lng_loc);

            map.setView([lat_loc, lng_loc], 14.5)
        });

    });

    // search
    var searchControl = L.esri.Geocoding.geosearch({
        position: 'topright',
        useMapBounds: true,
        placeholder: (langmap[0]),
        title: (langmap[1]),
        zoomToResult: true
    }).addTo(map);

    var results = L.layerGroup().addTo(map);

    searchControl.on('results', function (data) {

        results.clearLayers();

        if (marker) { // check
            map.removeLayer(marker); // remove
        }

        for (var i = data.results.length - 1; i >= 0; i--) {
            results.addLayer(marker = new L.marker(data.results[i].latlng).bindPopup("ตำแหน่ง : " + data.latlng.lat + ", " + data.latlng.lng));
            $('#lat').val(data.latlng.lat);
            $('#lon').val(data.latlng.lng);
        }
    });

    // get lat lon marker popup
    map.on('click', function (e) {

        if (marker) { // check
            map.removeLayer(marker); // remove
        }

        marker = new L.marker([e.latlng.lat, e.latlng.lng]).addTo(map).bindPopup("ตำแหน่ง : " + e.latlng.lat + ", " + e.latlng.lng).openPopup();

        $('#lat').val(e.latlng.lat);
        $('#lon').val(e.latlng.lng);
    });

    // wikipedia
    function getwiki() {
        var page_title = $('#txt_place').val();
        var url = 'https://th.wikipedia.org/w/api.php?format=json&action=query&prop=extracts|pageimages|coordinates&pithumbsize=250&exchars=500&exintro=&explaintext=&titles=' + page_title;
        url += '&callback=?';

        $.getJSON(url, function (data) {
            console.log(data);
            $.each(data.query.pages, function (i, item) {
                var page = 'https://th.m.wikipedia.org/?curid=' + item.pageid;

                $('#txt_describe_place').val(item.extract);

            });
        });
    };

    // disabled enter key
    $(document).on("keypress", 'form', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            e.preventDefault();
            return false;
        }
    });

    //datepicker
    $("#date_start").datepicker({
        dateFormat: "yy-mm-dd"
    });
    $("#date_end").datepicker({
        dateFormat: "yy-mm-dd"
    });

    //tagsinput
    $('#hashtag').tagsinput({
        maxTags: 5
    });
    $('#highlight').tagsinput({
        maxTags: 5
    });

    //mask
    $('#txt_phone').inputmask({
        mask: '999-999-9999'
    });
    $('#numb_budget').inputmask('decimal', {
        rightAlign: false
    });
    $("#time_start").inputmask("hh:mm", {
        placeholder: "++:++",
        insertMode: false,
        showMaskOnHover: false,
        alias: "datetime",

    });

    //maxlength
    $('#txt_short_des,#txt_event,#txt_address,#txt_describe_place,#txt_description,#numb_budget').maxlength({
        alwaysShow: true,
        validate: false,
        allowOverMax: true

    });

    //preview image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#eimage").change(function () {
        readURL(this);
    });



}),
    $(document).ready(function () {
      /* data table */
      
        table = $('#events_table').DataTable({
        "language": {
            "url": (tablelang[0][0])
        },
        responsive: true,
        order: [],
        columnDefs: [
            {
                targets: [7, 8],
                render: function (data, type, full, meta) {
                    if (type === 'filter' || type === 'sort') {
                        var api = new $.fn.dataTable.Api(meta.settings);
                        var td = api.cell({ row: meta.row, column: meta.col }).node();
                        var $input = $('select, input', td);
                        if ($input.length && $input.is('select')) {
                            data = $('option:selected', $input).text();
                        } else {
                            data = $input.val();
                        }
                    }
                    return data;
                }
            }
        ],
        initComplete: function () {
            this.api().columns([4, 5]).every(function () {
                var column = this;
                var select = $('<select class="form-control form-control-sm"><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
                column.data().unique().sort().each(function (d, j) {
                    if (column.search() === '^' + d + '$') {
                        select.append('<option value="' + d + '" selected="selected">' + d + '</option>')
                    } else {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    }
                });
            });
        }
    });
    
    $('.-filter').on('change', function () {
        table.search(this.value).draw();
    });
    
    $('tbody select, tbody input', table.table().node()).on('change', function () {
        table.row($(this).closest('tr')).invalidate();
    });

    }),
        $(document).ready(function () {
                     //delete-favorite
                     $(document).on('click', '.delete-favorite', function () {
                        var fid = $(this).attr("id");
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
                                        url: '/event/myjoin/delete',
                                        data: {
                                            'fid': fid
                                        },
                                        success: function (data) {
                                            $('.item-' + fid).remove();
                                            swal(langswal[0][2], {
                                                icon: "success",
                
                                            });
                                        }
                                    });
                                }
                            });
                    });
         });

