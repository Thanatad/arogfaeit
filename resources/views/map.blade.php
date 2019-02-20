@extends('layouts.master_front') 
@section('Title', 'MapService') 
@section('page-style')
<!-- Load Leaflet from CDN -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin="" />
<!-- Load Esri Leaflet Geocoder from CDN -->
<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.13/dist/esri-leaflet-geocoder.css" integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ=="
   crossorigin="">
<!-- Map Fullscreen -->
<link href="https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css" rel='stylesheet' />
@endsection
 
@section('content')

<div id="demo" class="carousel slide" data-ride="carousel">

   <!-- Indicators -->
   <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
   </ul>

     <!-- The slideshow -->
     <div class="carousel-inner">
      <div class="carousel-item active">
         <img  large-class="carousel-loaded" src-compress="{{asset('upload/images/event/bg1.jpg')}}" src="{{asset('images/Double Ring-1.3s-200px.gif')}}" alt="Event1" title="ref:streetwill.co">
      </div>
      <div class="carousel-item">
         <img large-class="carousel-loaded"  src-compress="{{asset('upload/images/event/bg2.jpg')}}" src="{{asset('images/Double Ring-1.3s-200px.gif')}}" alt="Event2" title="ref:streetwill.co">
      </div>
      <div class="carousel-item">
         <img large-class="carousel-loaded" src-compress="{{asset('upload/images/event/bg3.jpg')}}" src="{{asset('images/Double Ring-1.3s-200px.gif')}}" alt="Event3" title="ref:streetwill.co">
      </div>
   </div>

   <!-- Left and right controls -->
   <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
   <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a>

</div>


<div class="row m-t-20">
   <div class="col-md-3 layoutF-1">
      <h2 class="m-l-10"> {{__('event.map.title')}}</h2>
      <div class="card h-custom1">
         <div class="card-body">
            <div class="row">
               <div class="col-md-12">
                  <h4 class="sub-title">{{__('event.index.schedule')}}</h4>
                  <div class="form-group input-group-inverse">
                     <div class="form-radio">
                        <div class="radio radio-matrial radio-inverse radio-inline">
                           <label>
                           <input type="radio" class="daytype" name="c_day" value="0" checked="checked">
                           <i class="helper"></i>{{__('event.index.all')}}
                           </label>
                        </div>
                        <div class="radio radio-matrial radio-inverse radio-inline">
                           <label>
                          <input type="radio" class="daytype" name="c_day" value="1">
                          <i class="helper"></i>{{__('event.manage.1day')}}
                          </label>
                        </div>
                        <div class="radio radio-matrial radio-inverse radio-inline">
                           <label>
                          <input type="radio" class="daytype" name="c_day" value="2">
                          <i class="helper"></i>{{__('event.manage.2day')}}
                          </label>
                        </div>
                        <div class="radio radio-matrial radio-inverse radio-inline">
                           <label>
                          <input type="radio" class="daytype" name="c_day" value="3">
                          <i class="helper"></i>{{__('event.manage.3day')}}
                          </label>
                        </div>
                        <div class="radio radio-matrial radio-inverse radio-inline">
                           <label>
                          <input type="radio" class="daytype" name="c_day" value="4">
                          <i class="helper"></i>{{__('event.index.3')}}
                          </label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
                  <div class="col-md-12">
                     <h4 class="sub-title">{{__('event.map.numb')}}</h4>
                     <div class="form-group input-group-inverse">
                          
                        <input id="numbevent" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="20"
                        />
                     </div>
                  </div>
               </div>
            <div class="row">
               <div class="col-md-12">
                  <h4 class="sub-title">{{__('event.index.days')}}</h4>
                  <div class="form-group input-group-inverse">
                     <div class="input-daterange input-group" id="datepicker">
                        <input type="text" id="date_start" name="date_start" class="input-sm form-control" placeholder="{{__('event.creat.datestart')}}" data-toggle="tooltip" title="{{__('event.creat.datestart')}}">
                        <span class="input-group-addon ">{{__('event.my.to')}}</span>
                        <input type="text" id="date_end" name="date_end" class="input-sm form-control" placeholder="{{__('event.creat.datestart')}}" data-toggle="tooltip" title="{{__('event.creat.datestart')}}">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <h4 class="sub-title">{{__('event.index.provinc')}}</h4>
                  <div class="form-group input-group-inverse">
                     <div class="input-group input-group-primary" style="margin-top: -5px;">

                        <select class="states" name="states[]" multiple="multiple">
                          <optgroup label="ภาคเหนือ">
                          <option value="เชียงใหม่">เชียงใหม่ </option>
                          <option value="เชียงราย">เชียงราย </option>
                          <option value="น่าน">น่าน </option>
                          <option value="พะเยา">พะเยา </option>
                          <option value="แพร่">แพร่ </option>
                          <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
                          <option value="ลำปาง">ลำปาง </option>
                          <option value="ลำพูน">ลำพูน </option>
                          <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
                          <optgroup label="ภาคอีสาน">
                          <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
                          <option value="ขอนแก่น">ขอนแก่น</option>
                          <option value="ชัยภูมิ">ชัยภูมิ </option>
                          <option value="นครพนม">นครพนม </option>
                          <option value="นครราชสีมา">นครราชสีมา </option>
                          <option value="บึงกาฬ">บึงกาฬ</option>
                          <option value="บุรีรัมย์">บุรีรัมย์</option>
                          <option value="มหาสารคาม">มหาสารคาม </option>
                          <option value="มุกดาหาร">มุกดาหาร </option>
                          <option value="ยโสธร">ยโสธร </option>
                          <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
                          <option value="เลย">เลย </option>
                          <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                          <option value="สกลนคร">สกลนคร</option>
                          <option value="สุรินทร์">สุรินทร์ </option>
                          <option value="หนองคาย">หนองคาย </option>
                          <option value="หนองบัวลำภู">หนองบัวลำภู </option>
                          <option value="อำนาจเจริญ">อำนาจเจริญ </option>
                          <option value="อุบลราชธานี">อุบลราชธานี</option>
                          <option value="อุดรธานี">อุดรธานี </option>
                          <optgroup label="ภาคตะวันตก">
                          <option value="กาญจนบุรี">กาญจนบุรี </option>
                          <option value="ตาก">ตาก </option>
                          <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
                          <option value="เพชรบุรี">เพชรบุรี </option>
                          <option value="ราชบุรี">ราชบุรี</option>
                          <optgroup label="ภาคกลาง">
                          <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                          <option value="กำแพงเพชร">กำแพงเพชร </option>
                          <option value="ชัยนาท">ชัยนาท </option>
                          <option value="นครนายก">นครนายก </option>
                          <option value="นครปฐม">นครปฐม </option>
                          <option value="นครสวรรค์">นครสวรรค์ </option>
                          <option value="นนทบุรี">นนทบุรี </option>
                          <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
                          <option value="ปทุมธานี">ปทุมธานี </option>
                          <option value="พิจิตร">พิจิตร </option>
                          <option value="พิษณุโลก">พิษณุโลก </option>
                          <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
                          <option value="ลพบุรี">ลพบุรี </option>
                          <option value="สมุทรปราการ">สมุทรปราการ </option>
                          <option value="สมุทรสงคราม">สมุทรสงคราม </option>
                          <option value="สมุทรสาคร">สมุทรสาคร </option>
                          <option value="สระบุรี">สระบุรี </option>
                          <option value="สิงห์บุรี">สิงห์บุรี </option>
                          <option value="สุโขทัย">สุโขทัย </option>
                          <option value="สุพรรณบุรี">สุพรรณบุรี </option>
                          <option value="อุทัยธานี">อุทัยธานี </option>
                          <option value="อ่างทอง">อ่างทอง </option>
                          <optgroup label="ภาคตะวันออก">
                          <option value="จันทบุรี">จันทบุรี</option>
                          <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
                          <option value="ชลบุรี">ชลบุรี </option>
                          <option value="ตราด">ตราด </option>
                          <option value="ปราจีนบุรี">ปราจีนบุรี </option>
                          <option value="ระยอง">ระยอง </option>
                          <option value="สระแก้ว">สระแก้ว </option>
                          <optgroup label="ภาคตะวันออก">
                          <option value="กระบี่">กระบี่ </option>
                          <option value="ชุมพร">ชุมพร </option>
                          <option value="ตรัง">ตรัง </option>
                          <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
                          <option value="นราธิวาส">นราธิวาส </option>
                          <option value="ปัตตานี">ปัตตานี </option>
                          <option value="พังงา">พังงา </option>
                          <option value="พัทลุง">พัทลุง </option>
                          <option value="ภูเก็ต">ภูเก็ต </option>
                          <option value="ยะลา">ยะลา </option>
                          <option value="ระนอง">ระนอง </option>
                          <option value="สงขลา">สงขลา </option>
                          <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
                          <option value="สตูล">สตูล </option>
                       </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <h4 class="sub-title">{{__('event.favorites.imday')}}</h4>
                  <div class="form-group input-group-inverse">
                     <div class="input-group input-group-primary" style="margin-top: -5px;">

                        <select class="daylist" name="daylist[]" multiple="multiple" style="width: 50%">
                          <optgroup label="วันหยุดราชการ">
                          <option value="วันขึ้นปีใหม่">วันขึ้นปีใหม่</option>
                          <option value="วันสงกรานต์">วันสงกรานต์</option>
                          <option value="วันผู้สูงอายุ">วันผู้สูงอายุ</option>
                          <option value="วันครอบครัว">วันครอบครัว</option>
                          <option value="วันเถลิงศก">วันเถลิงศก</option>
                          <option value="วันพืชมงคล">วันพืชมงคล</option>
                          <option value="วันเฉลิมพระชนมพรรษาของสมเด็จพระเจ้าอยู่หัวมหาวชิราลงกรณ บดินทรเทพยวรางกูร">วันเฉลิมพระชนมพรรษาของสมเด็จพระเจ้าอยู่หัวมหาวชิราลงกรณ บดินทรเทพยวรางกูร</option>
                          <option value="วันแม่แห่งชาติ">วันแม่แห่งชาติ</option>
                          <option value="วันคล้ายวันสวรรคตของพระบาทสมเด็จพระปรมินทรมหาภูมิพลอดุลยเดช บรมนาถบพิตร">วันคล้ายวันสวรรคตของพระบาทสมเด็จพระปรมินทรมหาภูมิพลอดุลยเดช บรมนาถบพิตร</option>
                          <option value="วันปิยมหาราช">วันปิยมหาราช</option>
                          <option value="วันคล้ายวันเฉลิมพระชนมพรรษาของพระบาทสมเด็จพระปรมินทรมหาภูมิพลอดุลยเดช บรมนาถบพิตร">วันคล้ายวันเฉลิมพระชนมพรรษาของพระบาทสมเด็จพระปรมินทรมหาภูมิพลอดุลยเดช บรมนาถบพิตร</option>
                          <option value="วันชาติ">วันชาติ</option>
                          <option value="วันพ่อแห่งชาติ">วันพ่อแห่งชาติ</option>
                          <option value="วันดินโลก">วันดินโลก</option>
                          <option value="วันรัฐธรรมนูญ">วันรัฐธรรมนูญ</option>
                          <option value="วันสิ้นปี">วันสิ้นปี</option>
                          <optgroup label="วันทางศาสนา">
                          <option value="วันมาฆบูชา">วันมาฆบูชา</option>
                          <option value="วันวิสาขบูชา">วันวิสาขบูชา</option>
                          <option value="วันอาสาฬหบูชา">วันอาสาฬหบูชา</option>
                          <option value="วันเข้าพรรษา">วันเข้าพรรษา</option>
                          <option value="วันปวารณาออกพรรษา">วันปวารณาออกพรรษา</option>
                          <option value="วันเทโวโรหณะ">วันเทโวโรหณะ</option>
                          <optgroup label="ไม่ใช่วันหยุดราชการ ">
                          <option value="วันเด็กแห่งชาติ">วันเด็กแห่งชาติ</option>
                          <option value="วันครู">วันครู</option>
                          <option value="วันแรงงานแห่งชาติ">วันแรงงานแห่งชาติ</option>
                          <option value="วันสุนทรภู่">วันสุนทรภู่</option>
                          <option value="วันลอยกระทง">วันลอยกระทง</option>
                          <option value="วันประชาธิปไตย">วันประชาธิปไตย</option>
                          <option value="วันวิทยาศาสตร์แห่งชาติ">วันวิทยาศาสตร์แห่งชาติ</option>
                       </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <h4 class="sub-title">{{__('event.map.status')}}</h4>
                  <div class="form-group input-group-inverse">
                     <div class="form-radio">
                        <div class="radio radio-matrial radio-inverse radio-inline">
                           <label>
                              <input type="radio" class="" name="status" value="0" checked="checked">
                              <i class="helper"></i>{{__('event.index.all')}}
                              </label>
                        </div>
                        <div class="radio radio-matrial radio-inverse radio-inline">
                           <label>
                             <input type="radio" class="" name="status" value="1" >
                             <i class="helper"></i>{{__('event.map.status.1')}}
                             </label>
                        </div>
                        <div class="radio radio-matrial radio-inverse radio-inline">
                           <label>
                             <input type="radio" class="" name="status" value="2">
                             <i class="helper"></i>{{__('event.map.status.2')}}
                             </label>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <h4 class="sub-title"></h4>
                  <center>
                     <button class="btn btn-grd-inverse mfilter" style="width:100%">{{__('event.index.submit')}}</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-9 m-t-45 layoutF-2">

      <div class="card h-custom1">
         <div class="card-body">
            <div class="row" id="map">

            </div>

         </div>
      </div>
   </div>
</div>
@endsection
 
@section('page-script')
<!-- Load Leaflet from CDN -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>
<!-- Load Esri Leaflet from CDN -->
<script src="https://unpkg.com/esri-leaflet@2.2.3/dist/esri-leaflet.js" integrity="sha512-YZ6b5bXRVwipfqul5krehD9qlbJzc6KOGXYsDjU9HHXW2gK57xmWl2gU6nAegiErAqFXhygKIsWPKbjLPXVb2g=="
   crossorigin=""></script>
<!-- Load Esri Leaflet Geocoder from CDN -->
<script src="https://unpkg.com/esri-leaflet-geocoder@2.2.13/dist/esri-leaflet-geocoder.js" integrity="sha512-zdT4Pc2tIrc6uoYly2Wp8jh6EPEWaveqqD3sT0lf5yei19BC1WulGuh5CesB0ldBKZieKGD7Qyf/G0jdSe016A=="
   crossorigin=""></script>
<!-- Map Fullscreen from mapbox-->
<script src="https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js"></script>
<!-- Mapservice js-->
<script src="{{asset('js/mapservice.js')}}"></script>
<script>
   var langmap=[];
   var locale = "{{ config('app.locale') }}";
       if(locale == 'th'){
       langmap = ["ค้นหาสถานที่หรือที่อยู่","การค้นหาตำแหน่ง","เปิดแบบเต็มจอ","ปิดแบบเต็มจอ","ซูมเข้า","ซูมออก"];
       $.datepicker.setDefaults($.datepicker.regional['th']);
       }else{
       langmap = ["Search for places or addresses","Location search.","View Fullscreen","Exit Fullscreen","Zoom in","Zoom out"];
       $.datepicker.setDefaults($.datepicker.regional['en']);
       }
       $('img[src-compress]').each(function() {
        var img = $(this);
        var newimg = new Image();
        newimg.src = img.attr('src-compress');
        newimg.setAttribute('class', img.attr('large-class'));
        newimg.onload = function() {
        img.replaceWith(newimg);
    };
   });
</script>
@endsection