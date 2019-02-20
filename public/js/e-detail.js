'use strict';
$(document).ready(function () {
    

    // setup map
    var map = L.map('map', {
        zoomControl: false
    }).setView([lat, lon], 16);
    
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
    })
    );

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a', 'b', 'c']
    }).addTo(map);

            // refersh
            setTimeout(function () {
                map.invalidateSize()
            }, 500);

    L.marker([lat, lon]).addTo(map);
 
    $(document).on('click', '.join', function () {
        var eid = $(this).attr("id");

    $.ajax({
        type: "POST",
        url: "/event/join",
        data: {
            'eID': eid
        },
        success: function (response) {
            $('.join').removeClass('join').addClass('disabled btn-join').text(join);
            swal({
                title: (langswal[0]),
                text: (langswal[1]),
                icon: "success",
                button: (langswal[2]),
            });
        }
    });
    });
});