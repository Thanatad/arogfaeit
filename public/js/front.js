'use strict';
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('[data-toggle="tooltip"]').tooltip();
    //Slider
    var mySlider = $("#numbevent").bootstrapSlider();

    //datepicker
    $("#date_start,#date_end").datepicker({
        dateFormat: "yy-mm-dd"
    });
    //nav
    $(window).scroll(function() {
        var scrollTop = $(this).scrollTop();
      
        $('.navbar').css({
            
          opacity: function() {
            var elementHeight = $(this).height(),
                opacity = ((1 - (elementHeight - scrollTop) / elementHeight) * 0.1) + 0.7;
               
            return opacity;
          }
        });
      });
      

    //select2
    $.fn.select2.amd.define('select2/i18n/lang', [], function () {
        return {
            errorLoading: function () {
                return langs2[0];
            },
            inputTooLong: function (args) {
                var overChars = args.input.length - args.maximum;
                var message = langs2[1] + overChars + langs2[2];
                if (overChars >= 2 && overChars <= 4) {
                    message += 'а';
                } else if (overChars >= 5) {
                    message += 'ов';
                }
                return message;
            },
            inputTooShort: function (args) {
                var remainingChars = args.minimum - args.input.length;

                var message = langs2[3] + remainingChars + langs2[4];

                return message;
            },
            loadingMore: function () {
                return langs2[5];
            },
            maximumSelected: function (args) {
                var message = langs2[6] + args.maximum + langs2[7];

                if (args.maximum >= 2 && args.maximum <= 4) {
                    message += 'а';
                } else if (args.maximum >= 5) {
                    message += 'ов';
                }

                return message;
            },
            noResults: function () {
                return langs2[8];
            },
            searching: function () {
                return langs2[9];
            }
        };
    });

    $('.states,.daylist').select2({
        language: "lang",
        maximumSelectionLength: 1
    });

    function ImageGrid(defaults)
    {
      var r = defaults.rows;
      var c = defaults.columns;
      var margin = defaults.margin;
        
      var placeholder = document.getElementsByClassName(defaults.containerName)[0];
      var container = document.createElement('div');
      container.className = "gridContainer";
      placeholder.appendChild(container); 
        
      var gridTile;  
    
      var w = (container.offsetWidth / c) -margin;
      var h = (container.offsetHeight / r) -margin;
      var arr = [];
        
      for (var i=0, l=r*c; i < l; i++)
      {    
        gridTile = document.createElement('div');
        gridTile.className = "gridTile";
        gridTile.style.backgroundImage = "url("+defaults.imgSrc+")";
        
           
        arr = [(w+margin)*(i%c), (h+margin)*Math.floor(i/c), ((w+margin)*(i%c)+w-margin), (h+margin)*Math.floor(i/c), ((w+margin)*(i%c)+w-margin), ((h+margin)*Math.floor(i/c) + h-margin), (w+margin)*(i%c), ((h+margin)*Math.floor(i/c) + h-margin)];
            
       // console.log(i + " ====>>> " + arr + " ||||| " + i%c  + " |||||| " + i/c);  
        
            
        TweenMax.set(gridTile, {webkitClipPath:'polygon('+arr[0]+'px '+ arr[1]+'px,'+arr[2]+'px '+arr[3]+'px, '+arr[4]+'px '+ arr[5] +'px, '+arr[6]+'px '+ arr[7] +'px)', clipPath:'polygon('+arr[0]+'px '+ arr[1]+'px,'+arr[2]+'px '+arr[3]+'px, '+arr[4]+'px '+ arr[5] +'px, '+arr[6]+'px '+ arr[7] +'px)'});
           
        container.appendChild(gridTile);    
        
        fixTilePosition(gridTile, i);
      }
      
      placeholder.addEventListener("mouseover", function(e){
        var allTiles = e.currentTarget.querySelectorAll(".gridTile");
        for (var t=0, le = allTiles.length; t < le; t++)
          {
            TweenMax.to(allTiles[t], defaults.animTime, {css:{backgroundPosition:"0px 0px"}, ease:Power1.easeOut});
          }
      })
                                 
      placeholder.addEventListener("mouseleave", function(e){
        var allTiles = e.currentTarget.querySelectorAll(".gridTile");
        for (var ti=0, len = allTiles.length; ti < len; ti++)
          {
            fixTilePosition(allTiles[ti], ti, defaults.animTime);
          }
      })
      
      function fixTilePosition(tile, ind, time)
      {
        if(time==null)time=0;
        var centr, centrCol, centrRow, offsetW, offsetH, left, top;
        
        centr = Math.floor(c * r / 2);
        centrCol = Math.ceil(centr/c);
        centrRow = Math.ceil(centr/r);
            
        offsetW = w/centrCol;
        offsetH = h/centrRow;
        
        left = (Math.round((ind % c - centrCol + 1) * offsetW));
        top = (Math.round((Math.floor(ind/c) - centrRow + 1) * offsetH));
        
        //console.log(left, top)
        
        TweenMax.to(tile, time, {css:{backgroundPosition:left+"px "+top+"px"}, ease:Power1.easeOut});
      }
    }
    
    ImageGrid(options);
});
