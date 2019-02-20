'use strict';
$(document).ready(function () {
    var numbday = 0;
    var startdate = '2016-12-31';
    var enddate = '2021-12-31';
    var province = 0;
    var day = 0;
    var status = 0;
    var numbevent = 20;

        // setup map
        var map = L.map('map', {
            zoomControl: false
        }).setView(['13.736717', '100.523186'], 6);
        
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
        
        var markers = new L.FeatureGroup();
        
        filtermap(numbday, startdate, enddate, province, day, status, numbevent);
        
        L.tileLayer('https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://wikimediafoundation.org/wiki/Maps_Terms_of_Use">Wikimedia</a>',
            subdomains: ['a', 'b', 'c']
        }).addTo(map);
        
        // refersh
        setTimeout(function () {
            map.invalidateSize()
        }, 500);
        
            $(document).on('click', '.mfilter', function () {
                numbday = $('input[name="c_day"]:checked').val();
                startdate = $('#date_start').val();
                enddate = $('#date_end').val();
                province = $('.states').val();
                day = $('.daylist').val();
                numbevent = $('#numbevent').val();
                status = $('input[name="status"]:checked').val();
                map.removeLayer(markers);
                markers.clearLayers();
                if(province != ''){
                L.esri.Geocoding.geocode().text('จังหวัด' + province).run(function (err, results, response) {
        
                    var lat_loc = results.results[0].latlng.lat;
                    var lng_loc = results.results[0].latlng.lng;
        
                    map.setView([lat_loc, lng_loc], 11.5)
                });
                }else{
                map.setView(['13.736717', '100.523186'], 6)
                }
                filtermap(numbday, startdate, enddate, province, day, status, numbevent);
                });
        
        
            function filtermap(numbday, startdate, enddate, province, day, status, numbevent) {
                $.ajax({
                    type: "POST",
                    url: "/map/filter",
                    data: {
                        numbday: numbday,
                        startdate: startdate,
                        enddate: enddate,
                        province: province,
                        day: day,
                        status:status,
                        numbevent:numbevent
                    },
                    cache: false,
                    success: function (data) {
                        var obj = data.map;
                        var totalLocations = obj.length;
            
                        // var greenIcon = L.icon({
                        //     iconUrl: '/images/icon.png',
                        // });
            
                        for (var i = 0; i < totalLocations; i++) {
            
                            var marker = new L.marker([obj[i].lat, obj[i].lon],{
                                // icon: greenIcon
                            });
                            marker.bindPopup("<div class='row'><div class='col-md-6'><img height='80px' width='100px' src=/upload/images/event/" + obj[i].picture + "></div><div class='col-md-6'><div class='text-short f-15' data-toggle='tooltip' title='" + obj[i].name + "'><a class='text-pink' target='_blank' href='/event/detail/" + obj[i].ueid + "'># " + obj[i].name + "</a></div><div class='text-info text-short' data-toggle='tooltip' title='" + obj[i].day + "'> : " + obj[i].day + "</div><div class='text-info text-short' data-toggle='tooltip' title='" + obj[i].place_name + "'> : " + obj[i].place_name + "<div class='text-info text-short' data-toggle='tooltip' title='วันที่เริ่ม'> : " + obj[i].start + "<div class='text-info text-short' data-toggle='tooltip' title='วันที่สิ้นสุด'> : " + obj[i].end + "</div></div>",{
                                showOnMouseOver: true
                            });
                            
                            markers.addLayer(marker);
                        }
                      
                        map.addLayer(markers);
                        
                    }
                    
                });
            }

            setTimeout(function(){

                $('[data-toggle="tooltip"]').tooltip();
                
                },50); 
});

    
    