@extends('layouts.master_front') 
@section('Title', 'E-Datail') 
@section('page-style')
<!-- Load Leaflet from CDN -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin="" />
<!-- Load Esri Leaflet Geocoder from CDN -->
<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.13/dist/esri-leaflet-geocoder.css" integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ=="
   crossorigin="">
<!-- Map Fullscreen -->
<link href="https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css" rel='stylesheet' />
<!-- Meta Facebook -->
<meta property="og:url" content="{{Request::url()}}" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Event : {{$event->name}}" />
<meta property="og:description" content="กิจกรรมที่ได้มีการจัดขึ้นในประเทศไทย" />
<meta property="og:image" content="{{asset('upload/images/event/'.$event->picture)}}" />
@endsection
 
@section('content')
<div class="container">

   <div class="s1">
      <div class="row">
         <div class="col-md-3">
            <div class="row">
               <div class="f-30 center text-short" data-toggle="tooltip" title="{{$event->name}}">{{$event->name}}</div>
            </div>
            <div class="row">
               @if ($event->count_day == 7)
               <div class="numbday"> <span style="margin-left: 14px;">>{{$event->count_day}} วัน</span> </div>
               @else
               <div class="numbday"> <span> {{$event->count_day}} วัน</span> </div>
               @endif 
               @if ($event->end < date('Y-m-d')) 
               <div class="datetext text-danger"><span> {{$event->start}} - {{$event->end}}</span></div>
               @else
               <div class="datetext"><span> {{$event->start}} - {{$event->end}}</span></div>
               @endif
         </div>
      </div>
      <div class="col-md-9">
         <div class="placeholder"></div>
      </div>
   </div>
</div>
</div>
<div class="container m-ut-30 m-b-20">
   <div class="s2 m-t-30">
      <div class="row">
         <div class="f-40">{{__('event.detail.title')}}</div>
         <div class="card">
            <div class="dot">
               <div class="p">{{__('event.detail.d')}}</div>
            </div>
            <a class="f-30 text-short" data-toggle="tooltip" title="{{$event->day}}">{{$event->day}}</a> 
            @if (Auth::check())
            @if(Auth::user()->role == 2)
            <button class="btn btn-inverse disabled" disabled>{{__('event.detail.join')}}</button> 
            @elseif(($event->end > date('Y-m-d'))&&($favorite == 0))
            <button class="btn btn-inverse join" id="{{$event->eid}}">{{__('event.detail.join')}}</button>
            @elseif($favorite == 1)
            <button class="btn btn-inverse btn-join disabled " disabled >{{__('event.detail.joined')}}</button>      
            @endif 
            @else 
            <button class="btn btn-inverse join" onclick="location.href='/login'">{{__('event.detail.join')}}</button> 
            @endif
            <div class="f-20 text-short user" data-toggle="tooltip" title="{{$event->full_name}}"><i class="fas fa-user-edit"></i> - {{$event->full_name}}</div>
         </div>
      </div>
   </div>
   <div class="s3">
      <div class="row">
         <div class="col-md-6 m-t-10">
            <div class="row">
               <div class="col-md-3">
                  <div class="f-30">{{__('event.detail.place')}}</div>
               </div>
               <div class="col-md-9">
                  <span class="f-30 text-muted text-short" data-toggle="tooltip" title="{{$event->place_name}}">{{$event->place_name}}</span>
               </div>
            </div>
            <div class="row m-b-10">
               <div class="col-md-12 desloc">
                  <div class="text-des" data-toggle="tooltip" title="{{$event->place_des}}">{{$event->place_des}}</div>
               </div>
            </div>
            <div class="row m-b-10">
               <div class="col-md-4">
                  <div class="f-20 text-warning"><i class="fas fa-piggy-bank"></i> {{__('event.detail.budget')}}</div>
               </div>
               <div class="col-md-8">
                  <div class="f-20 text-dark">{{$event->budget}} {{__('event.detail.baht')}}</div>
               </div>
            </div>
            <div class="row m-b-10">
               <div class="col-md-4">
                  <div class="f-20 text-warning"><i class="fas fa-book-dead"></i> {{__('event.detail.edesc')}}</div>
               </div>
               <div class="col-md-8">
                  <div class="f-15 text-dark text-des text-des-more" data-toggle="tooltip" title="{{$event->description}}">{{$event->description}}</div>
               </div>
            </div>
            <div class="row m-b-20">
               <div class="col-md-4">
                  <div class="f-20 text-warning"><i class="far fa-calendar-alt"></i> {{__('event.detail.create')}}</div>
               </div>
               <div class="col-md-8">
                  <div class="f-20 text-muted">{{$event->created_at}}</div>
               </div>
            </div>
            <div class="row m-b-20">
               <div class="col-md-12">
                  <div class="text-c-pink f-16"><i class="fas fa-tags"></i> @foreach ($hashtag as $item)
                     <span class="text-purple f-16"> #{{$item}}</span> @endforeach
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6 m-t-10">
            <div class="row">
               <div class="col-md-12">
                  <div class="f-30 text-c-blue text-center">{{__('event.detail.highlight')}}</div>
               </div>
            </div>
            <div class="row m-t-20">
               <div class="col-md-12">
                  <div class="row">
                  </div>
               </div>
            </div>
            @foreach ($highlight as $item)
            <div class="row m-t-20">
               <div class="col-md-12">
                  <div class="row">
                     <div class="text-c-green f-26 text-short" data-toggle="tooltip" title="{{$item}}">- {{$item}}</div>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
   <div class="s4">
      <div class="row">
         <div class="col-md-12">
            <div class="row">
               <div class="col-md-12">
                  <div class=" text-black-50 f-26">{{__('event.detail.location')}} <span><a class="btn btn-danger" href="https://www.google.com/maps/search/{{$event->lat}}+{{$event->lon}}" target="_blank"><i class="fas fa-map-marked-alt"></i></a> </span></div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4 m-b-10">
                  <div class="row">
                     <div class="col-md-12">
                        <div id="map">

                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-8 location">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-md-4">
                              <div class=" text-dark f-20">{{__('event.index.provinc')}}</div>
                           </div>
                           <div class="col-md-8">
                              <div class=" text-muted f-20"> : {{$event->province}}</div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class=" text-dark f-20">{{__('event.detail.district')}}</div>
                           </div>
                           <div class="col-md-8">
                              <div class=" text-muted f-20"> : {{$event->district}}</div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class=" text-dark f-20">{{__('event.detail.subdistrict')}}</div>
                           </div>
                           <div class="col-md-8">
                              <div class=" text-muted f-20"> : {{$event->amphoe}}</div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class=" text-dark f-20">{{__('event.detail.rd')}}</div>
                           </div>
                           <div class="col-md-8">
                              <div class=" text-muted f-20"> : {{$event->road}}</div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class=" text-dark f-20">{{__('event.detail.zipcode')}}</div>
                           </div>
                           <div class="col-md-8">
                              <div class=" text-muted f-20"> : {{$event->zipcode}}</div>
                           </div>
                        </div>

                     </div>
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-md-4">
                              <div class=" text-dark f-20">{{__('event.detail.mobileno')}}</div>
                           </div>
                           <div class="col-md-8">
                              <div class=" text-muted f-20"> : {{$event->mobile}}</div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class=" text-dark f-20">{{__('event.detail.email')}}</div>
                           </div>
                           <div class="col-md-8">
                              <div class=" text-muted f-20 text-short" data-toggle="tooltip" title="{{$event->email}}"> : {{$event->email}}</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-2">
                        <div class=" text-dark f-20">{{__('event.detail.more')}}</div>
                     </div>
                     <div class="col-md-10">
                        <div class=" text-muted f-20 text-short" data-toggle="tooltip" title="{{$event->more_address}}"> : {{$event->more_address}}</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row m-t-20">
      <div class="fb-share-button" data-href="{{Request::url()}}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
            class="fb-xfbml-parse-ignore"></a></div>
      <div class="fb-comments " data-href="{{Request::url()}}" data-numposts="5" data-width="100%"></div>
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
<!-- Event Detail js-->
<script src="{{asset('js/e-detail.js')}}"></script>

<script>
   var langmap=[];var langswal=[]; var langfb; var join;
   var locale = "{{ config('app.locale') }}";
       if(locale == 'th'){
       join = 'เข้าร่วมแล้ว';
       langfb = 'th_TH';
       langmap = ["ค้นหาสถานที่หรือที่อยู่","การค้นหาตำแหน่ง","เปิดแบบเต็มจอ","ปิดแบบเต็มจอ","ซูมเข้า","ซูมออก"];
       langswal=["งานกิจกรรมที่สนใจเข้าร่วม","ได้รับการบันทึกข้อมูลเรียบร้อย","ตกลง"];
       }else{
       join = 'Already';
       langfb = 'en_US';
       langmap = ["Search for places or addresses","Location search.","View Fullscreen","Exit Fullscreen","Zoom in","Zoom out"];
       langswal= ["Add to join successfully !!","Received record data successfully","OK"];
       }
       var lat = '{{$event->lat}}';
       var lon = '{{$event->lon}}';
       var image = "{{asset('upload/images/event')}}" +"/" + '{{$event->picture}}';

       var options = {
        imgSrc : image,
        containerName : "placeholder",
        rows:3,
        columns:3,
        margin:1,
        animTime: 0.3
      }

</script>
<script>
   (function(d, s, id) {
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) return;
   js = d.createElement(s); js.id = id;
   js.src = 'https://connect.facebook.net/'+ langfb +'/sdk.js#xfbml=1&version=v3.2&appId=305475013630288&autoLogAppEvents=1';
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

</script>
@endsection