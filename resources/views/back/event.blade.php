@extends('layouts.master_back')
@section('Title','CreateEvent')
@section('page-style')
<!-- Load Leaflet from CDN -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
    crossorigin="" />
<!-- Load Esri Leaflet Geocoder from CDN -->
<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.13/dist/esri-leaflet-geocoder.css" integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ=="
    crossorigin="">
<!-- Map Fullscreen -->
<link href="https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css" rel='stylesheet' />
<!-- Bootstrap Tagsinput -->
<link href="{{asset('components/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel='stylesheet' />
@endsection

@section('content')
<div class="content-inner">
    <header class="page-header">
        <div class="container-fluid">
        <div class="title-page no-margin-bottom">{{__('event.creat.title')}}</div>
        </div>
    </header>
    <section>
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <form id="evnet_form" style="display:none;" autocomplete="off" method="POST" action="{{route('e_create')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card m-t-50 p-t-50">
                            <div class="card-body">
                                <img id="cevent-img" class="cevent-img" src="https://visualpharm.com/assets/54/Calendar%20Plus-595b40b65ba036ed117d4341.svg">
                                <h2 class="text-center m-t-5">{{__('event.creat.head')}}</h2>
                                <div class="row m-t-10">
                                    <div class="form-group col-md-6">
                                    <input id="txt_event" name="txt_event" type="text" class="form-control form-bg-inverse" data-toggle="tooltip" placeholder="{{__('event.creat.name')}}" title="{{__('event.creat.name')}}" maxlength="50"
                                            autofocus required>
                                        <div id="first_name_feedback" class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                    <input id="txt_short_des" name="txt_short_des" type="text" class="form-control form-bg-inverse" data-toggle="tooltip" placeholder="{{__('event.creat.description')}}" title="{{__('event.creat.description')}}"
                                            maxlength="70" required>
                                        <div id="last_name_feedback" class="invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(\Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled"></i>
                            </button>{{ \Session::get('success')}}
                        </div>
                        @elseif(\Session::has('failure'))
                        <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled"></i>
                                </button>{{ \Session::get('failure')}}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card h-custom1">
                                    <div class="card-body">
                                    <h2 class="card-title m-b-10">{{__('event.creat.location')}}</h2>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-location-pin"></i></span>
                                                    <input type="text" class="form-control" id="txt_place" name="txt_place" data-toggle="tooltip" placeholder="{{__('event.creat.place')}}" title="{{__('event.creat.place')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-external"></i></span>
                                                    <textarea class="form-control" id="txt_describe_place" name="txt_describe_place" data-toggle="tooltip" placeholder="{{__('event.creat.describe')}}" title="{{__('event.creat.describe')}}"
                                                            maxlength="520"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-stylish-down"></i></span>
                                                    <input type="text" class="form-control" style="width: 100%;" id="txt_district" name="txt_district" data-toggle="tooltip" placeholder="{{__('event.creat.district')}}"
                                                            title="{{__('event.creat.district')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-stylish-left"></i></span>
                                                    <input type="text" class="form-control" style="width: 100%;" id="txt_zipcode" name="txt_zipcode" data-toggle="tooltip" placeholder="{{__('event.creat.potalcode')}}"
                                                            title="{{__('event.creat.potalcode')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-stylish-right"></i></span>
                                                    <input type="text" class="form-control" style="width: 100%;" id="txt_province" name="txt_province" data-toggle="tooltip" placeholder="{{__('event.creat.provinc')}}"
                                                            title="{{__('event.creat.provinc')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-stylish-up"></i></span>
                                                        <input type="text" class="form-control" style="width: 100%;" id="txt_amphoe" name="txt_amphoe" data-toggle="tooltip" placeholder="{{__('event.creat.subdistrict')}}" title="{{__('event.creat.subdistrict')}}"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-road"></i></span>
                                                        <input type="text" class="form-control" id="txt_road" name="txt_road" data-toggle="tooltip" placeholder="{{__('event.creat.road')}}" title="{{__('event.creat.road')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-ui-dial-phone"></i></span>
                                                        <input type="text" class="form-control" id="txt_phone" name="txt_phone" pattern="^[0-9-+s()]*$" value="{{$profile->mobile}}"
                                                        data-toggle="tooltip" placeholder="{{__('event.creat.mobile')}}" title="{{__('event.creat.mobile')}}" maxlength="12"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-email"></i></span>
                                                        <input type="email" class="form-control" id="txt_email" name="txt_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                                            value="{{$profile->email}}" data-toggle="tooltip" placeholder="{{__('event.creat.email')}}" title="{{__('event.creat.email')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-location-arrow"></i></span>
                                                    <textarea class="form-control" id="txt_address" name="txt_address" data-toggle="tooltip" placeholder="{{__('event.creat.moreaddress')}}" title="{{__('event.creat.moreaddress')}}" maxlength="191"
                                                            required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card preview-lg m-b-0">
                                                <div class="card-header p-b-5">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-inverse">
                                                                    <span class="input-group-addon m-t-0 color-default">Lat</span>
                                                                    <input type="text" class="form-control" id="lat" name="lat" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-group input-group-inverse">
                                                                <span class="input-group-addon m-t-0 color-default">Lon</span>
                                                                <input type="text" class="form-control" id="lon" name="lon" readonly>
                                                            </div>
                                                        </div>
                                                        <a class="btn btn-sm locationmark" id="getlocation"><i class="fas fa-map-marker-alt"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-body  p-b-0" id="map">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-custom1">
                                    <div class="card-body">
                                    <h2 class="card-title m-b-10">{{__('event.creat.eventinformation')}}</h2>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-radio">
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                    <input type="radio" class="daytype" name="daytype" value="วันหยุดราชการ" checked="checked">
                                                            <i class="helper"></i>{{__('event.creat.nationalholiday')}}
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                    <input type="radio" class="daytype" name="daytype" value="วันทางศาสนา">
                                                                    <i class="helper"></i>{{__('event.creat.religiousday')}}
                                                            </label>
                                                        </div>
                                                        <div class="radio radio-inline">
                                                            <label>
                                                                    <input type="radio" class="daytype" name="daytype" value="ไม่ใช่วันหยุดราชการ">
                                                                    <i class="helper"></i>{{__('event.creat.Notpublicholiday')}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary" style="margin-top: -5px;">
                                                        <span class="input-group-addon"><i class="icofont-children-care"></i></span>
                                                        <select class="form-control daylist" id="daylist" name="daylist" required>
                                                        <option value="" selected disabled>{{__('event.creat.selectday')}}</option>
                                                                @foreach($daylists as $item)
                                                                 <option value="{{$item->name}}">{{$item->name}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-money-bag"></i></span>
                                                    <input type="text" class="form-control" id="numb_budget" name="numb_budget" data-toggle="tooltip" placeholder="{{__('event.creat.budget')}}" title="{{__('event.creat.budget')}}"
                                                            maxlength="6" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-tasks"></i></span>
                                                        <select class="form-control" id="numb_c_day" name="numb_c_day" data-toggle="tooltip" title="{{__('event.creat.howmanyday')}}" required>
                                                        <option value="0" selected disabled>{{__('event.creat.howmanyday')}}</option>
                                                        <option value="1">{{__('event.manage.1day')}}</option>
                                                        <option value="2">{{__('event.manage.2day')}}</option>
                                                        <option value="3">{{__('event.manage.3day')}}</option>
                                                        <option value="4">{{__('event.manage.4day')}}</option>
                                                        <option value="5">{{__('event.manage.5day')}}</option>
                                                        <option value="6">{{__('event.manage.6day')}}</option>
                                                        <option value="7">{{__('event.manage.7day')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <div class="input-daterange input-group" id="datepicker">
                                                        <input type="text" id="date_start" name="date_start" class="input-sm form-control" data-toggle="tooltip" placeholder="{{__('event.creat.datestart')}}" title="{{__('event.creat.datestart')}}"
                                                            required>
                                                        <span class="input-group-addon">to</span>
                                                    <input type="text" id="date_end" name="date_end" class="input-sm form-control" data-toggle="tooltip" placeholder="{{__('event.creat.dateend')}}" title="{{__('event.creat.dateend')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-clock-time"></i></span>
                                                    <input type="text" class="form-control without" id="time_start" name="time_start" data-toggle="tooltip" placeholder="{{__('event.creat.timestart')}}" title="{{__('event.creat.timestart')}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-numbered"></i></span>
                                                        <textarea class="form-control" id="txt_description" name="txt_description" data-toggle="tooltip" placeholder="{{__('event.creat.descriptionevent')}}" title="{{__('event.creat.descriptionevent')}}"
                                                            maxlength="500" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-tasks-alt"></i></span>
                                                    <input type="text" id="highlight" name="highlight[]" value="Highlight" data-toggle="tooltip" placeholder="{{__('event.creat.addtags')}}" style="display: none;" title="Highlight"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <span class="input-group-addon"><i class="icofont-tags"></i></span>
                                                        <input type="text" id="hashtag" name="hashtag[]" value="#Hashtag" data-toggle="tooltip" placeholder="{{__('event.creat.addtags')}}" style="display: none;" title="Hashtag"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group input-group-primary">
                                                        <input type="file" class="form-control" id="eimage" name="eimage" data-toggle="tooltip" title="Image Upload">
                                                        <span class="input-group-addon"><i class="icofont-image"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-center"><img id="image_preview" name="image_preview" class="upload_preview" src="{{asset('images/upload_p.png')}}"
                                                    alt="Image Preview" /></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                        <button type="submit" class="btn btn-primary btn-round btn-block">{{__('event.creat.btncreate')}}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('page-script')
<!-- Aotocomplete Thailand -->
<script type="text/javascript" src="{{asset('components/jquery.Thailand.js/dependencies/typeahead.bundle.js')}}"></script>
<script type="text/javascript" src="{{asset('components/jquery.Thailand.js/dependencies/JQL.min.js')}}"></script>
<script type="text/javascript" src="{{asset('components/jquery.Thailand.js/dist/jquery.Thailand.min.js')}}"></script>
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
<!-- Bootstrap Tagsinput -->
<script src="{{asset('components/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<!-- Maxlength -->
<script src="{{asset('components/bootstrap-maxlength/bootstrap-maxlength.js')}}"></script>
<!-- Input Mask -->
<script src="{{asset('components/Inputmask/jquery.inputmask.bundle.js')}}"></script>
<!-- event.js -->
<script type="text/javascript" src="{{asset('js/event.js')}}"></script>
<script>
    var url_db = "{{ URL::asset('components/jquery.Thailand.js/database/db.json')}}";
    var langmap=[];
    var locale = "{{ config('app.locale') }}";
        if(locale == 'th'){
        langmap = ["ค้นหาสถานที่หรือที่อยู่","การค้นหาตำแหน่ง","เปิดแบบเต็มจอ","ปิดแบบเต็มจอ","ซูมเข้า","ซูมออก"];
        $.datepicker.setDefaults($.datepicker.regional['th']);
        }else{
        langmap = ["Search for places or addresses","Location search.","View Fullscreen","Exit Fullscreen","Zoom in","Zoom out"];
        $.datepicker.setDefaults($.datepicker.regional['en']);
        }

</script>
@endsection
