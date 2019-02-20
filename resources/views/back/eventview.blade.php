@extends('layouts.master_back')
@section('Title', 'MyEvent')
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
<link href='{{asset("components/bootstrap-tagsinput/bootstrap-tagsinput.css")}}' rel='stylesheet' />
@endsection

@section('content')
<div class="content-inner">
    <header class="page-header">
        <div class="container-fluid">
            <div class="title-page no-margin-bottom">{{__('event.my.title')}}</div>
        </div>
    </header>
    <!-- Page Header-->
    <section>
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="text-right">{{ $events->links() }}</div>
                    <div class="row myevets-card">
                        @foreach ($events as $item)
                        <div class="col-lg-6 col-xl-3 col-md-6 item-{{$item->ueid}}">
                            <div class="card rounded-card myevent-card">
                                <div class="card-myevent">
                                    <img id="vevent-img" class="vevent-img text-center" src="https://visualpharm.com/assets/54/Calendar%20Plus-595b40b65ba036ed117d4341.svg">
                                    <div class="img-hover">
                                        <img class="img-fluid img-radius" src="{{ asset('upload/images/event/'.$item->picture)}}" alt="round-img">
                                        <div class="img-overlay img-radius">
                                            <span>
                                                <a class="btn btn-sm btn-inverse" href="{{ route('e_detail', $item->ueid) }}" target="_blank" data-popup="lightbox"><i class="icofont-eye-alt"></i></a>
                                                <button type="button" class="btn btn-inverse btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i></button>
                                                <div class="dropdown-menu dropdown-menu-right b-none contact-menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(81px, 52px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item edit-data first" data-info="{{$item->ueid}};{{$item->lid}};{{$item->eid}};{{$item->name}};{{$item->short_des}};{{$item->description}};{{$item->budget}};{{$item->count_day}};{{$item->start}};{{$item->end}};{{$item->timestart}};{{$item->mobile}};{{$item->email}};{{$item->highlight}};{{$item->hashtag}};{{$item->picture}};{{$item->place_name}};{{$item->place_des}};{{$item->district}};{{$item->zipcode}};{{$item->province}};{{$item->amphoe}};{{$item->road}};{{$item->more_address}};{{$item->lat}};{{$item->lon}};{{$item->day}}"><i class="icofont icofont-edit"></i>{{__('event.manage.edit')}}</a>
                                                <a class="dropdown-item delete-data" id="{{$item->ueid}}"><i class="icofont icofont-ui-delete"></i>{{__('event.favorites.delete')}}</a></div>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="event-content">
                                        <div class="text-center">
                                            <h4 class="text-default text-short" data-toggle="tooltip" title="{{$item->name}}">{{__('event.my.name')}} : {{$item->name}}</h4>
                                        </div>
                                        <p class="m-b-0 text-muted text-short" data-toggle="tooltip" title="{{$item->place_name}}">{{__('event.manage.place')}} : {{$item->place_name}}</p>
                                        <p class="m-b-0 text-Rasp">-----------------</p>
                                        @if (($item->assign == 0) AND ($item->end >= date('Y-m-d')))
                                        <div><span class="label-status label-inverse">{{__('event.my.status')}} :  {{__('event.my.wait')}} </span></div>
                                        @elseif(($item->assign == 1) AND ($item->end >= date('Y-m-d')))
                                        <div><span class="label-status label-success">{{__('event.my.status')}} :  {{__('event.my.publish')}} </span></div>
                                        @else
                                        <div><span class="label-status label-danger">{{__('event.my.status')}} :  {{__('event.my.end')}} </span></div>
                                        @endif
                                        <p class="m-b-0 text-Rasp">-----------------</p>
                                        @if($item->end >= date('Y-m-d'))
                                        <p class="m-b-0 text-muted">{{__('event.my.schedule')}} : {{$item->start}} - {{$item->end}}</p>
                                        @else
                                        <p class="m-b-0 text-danger">{{__('event.my.schedule')}} : {{$item->start}} - {{$item->end}}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- start modal -->
                    <div id="modal-edit" class="modal fade" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true" style="padding-right: 0px;">
                        <div class="modal-dialog modal-ee">
                            <div class="modal-content">
                                <form id="evnet_form" style="display:none;" autocomplete="off" method="POST" action="{{ route('e_update') }}" enctype="multipart/form-data"
                                    role="form">
                                    <div class="modal-header">
                                        <h4 id="modal-title">{{__('event.manage.editevent')}}</h4>
                                    </div>
                                    <div class="modal-body" id="section-edit">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-pink progress-bar-striped" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="4"
                                                style="width: 20%;">
                                                {{__('event.section')}} 1 of 5
                                            </div>
                                        </div>
                                        <div class="m-t-10">
                                            <ul class="nav nav-tabs">
                                            <li class="nav-item active"><a class="nav-link" href="#step1" data-toggle="tab" data-step="1">{{__('event.manage.sec1')}}</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#step2" data-toggle="tab" data-step="2">{{__('event.manage.sec2')}}</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#step3" data-toggle="tab" data-step="3">{{__('event.manage.sec3')}}</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#step4" data-toggle="tab" data-step="4">{{__('event.manage.sec4')}}</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#step5" data-toggle="tab" data-step="5">{{__('event.manage.sec5')}}</a></li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="step1">
                                                <div class="well">
                                                    <label>{{__('event.manage.eventname')}}</label>
                                                    <input id="pcurrent" name="pcurrent" type="hidden" class="form-control">
                                                    <input id="page" name="page" value="view" type="hidden" class="form-control">
                                                    <input id="id_uevent" name="id_uevent" type="hidden" class="form-control">
                                                    <input id="id_event" name="id_event" type="hidden" class="form-control">
                                                    <input id="id_location" name="id_location" type="hidden" class="form-control">
                                                    <input id="txt_event" name="txt_event" type="text" class="form-control form-bg-inverse" data-toggle="tooltip" placeholder="{{__('event.creat.name')}}" title="{{__('event.creat.name')}}" maxlength="50"
                                                        autofocus="" required="">
                                                    <br>
                                                    <label>{{__('event.manage.shortdes')}}</label>
                                                    <input id="txt_short_des" name="txt_short_des" type="text" class="form-control form-bg-inverse" data-toggle="tooltip" placeholder="{{__('event.creat.description')}}" title="{{__('event.creat.description')}}"
                                                        maxlength="70" required="">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="step2">
                                                <div class="well p-t-20 p-l-20 p-r-20 p-b-0">
                                                    <div class="row m-b-0">
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
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="icofont-stylish-down"></i></span>
                                                                    <input type="text" class="form-control" style="width: 100%;" id="txt_district" name="txt_district"data-toggle="tooltip" placeholder="{{__('event.creat.district')}}"
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
                                                                    <input type="text" class="form-control" style="width: 100%;" id="txt_amphoe" name="txt_amphoe"data-toggle="tooltip" placeholder="{{__('event.creat.subdistrict')}}" title="{{__('event.creat.subdistrict')}}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="icofont-road"></i></span>
                                                                    <input type="text" class="form-control" id="txt_road" name="txt_road" data-toggle="tooltip" placeholder="{{__('event.creat.road')}}" title="{{__('event.creat.road')}}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="icofont-ui-dial-phone"></i></span>
                                                                    <input type="text" class="form-control" id="txt_phone" name="txt_phone" pattern="^[0-9-+s()]*$" value="" data-toggle="tooltip" placeholder="{{__('event.creat.mobile')}}" title="{{__('event.creat.mobile')}}" maxlength="12" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="icofont-email"></i></span>
                                                                    <input type="email" class="form-control" id="txt_email" name="txt_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                                                        value="" data-toggle="tooltip" placeholder="{{__('event.creat.email')}}" title="{{__('event.creat.email')}}" required>
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
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="step3">
                                                <div class="well">
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
                                                                </div>
                                                            </div>
                                                            <div class="card-body  p-b-0" id="map">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="step4">
                                                <div class="well p-t-20 p-l-20 p-r-20 p-b-0">
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
                                                                    <input type="text" class="form-control" id="numb_budget" name="numb_budget" name="numb_budget" data-toggle="tooltip" placeholder="{{__('event.creat.budget')}}" title="{{__('event.creat.budget')}}" title="Budget"
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
                                                                    <span class="input-group-addon">{{__('event.my.to')}}</span>
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
                                                                    <input type="text" id="highlight" name="highlight[]" data-toggle="tooltip" placeholder="{{__('event.creat.addtags')}}" style="display: none;" title="Highlight" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="input-group input-group-primary">
                                                                    <span class="input-group-addon"><i class="icofont-tags"></i></span>
                                                                    <input type="text" id="hashtag" name="hashtag[]" data-toggle="tooltip" placeholder="{{__('event.creat.addtags')}}" style="display: none;" title="Hashtag" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="step5">
                                                <div class="well">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="input-group input-group-primary">
                                                                            <input type="file" class="form-control" id="eimage" name="eimage" title="Image Upload">
                                                                            <span class="input-group-addon"><i class="icofont-image"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 text-center">
                                                                    <img id="image_preview" name="image_preview" class="upload_preview" src="{{asset('images/upload_p.png')}}" alt="Image Preview"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">{{__('event.manage.close')}}</button>
                                            <button class="btn btn-primary" id="m_edit" data-dismiss="modal">{{__('event.manage.savechanges')}}</button>
                                        </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->
                    </div>
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
        var langmap=[]; var langswal=[]; var section;
        var locale = "{{ config('app.locale') }}";
        if(locale == 'th'){
        section = 'ขั้นตอนที่ ';
        langmap = ["ค้นหาสถานที่หรือที่อยู่","การค้นหาตำแหน่ง","เปิดแบบเต็มจอ","ปิดแบบเต็มจอ","ซูมเข้า","ซูมออก"];
        langswal = [["คุณแน่ใจไหม?","เมื่อลบแล้วคุณจะไม่สามารถกู้คืนได้!","งานกิจกรรมถูกลบแล้ว!","ตกลง","ยกเลิก"],["แก้ไขข้อมูลงานกิจกรรมสำเร็จ!!","ข้อมูลมีการเปลี่ยนแปลงคลิกที่ปุ่ม!","ตกลง"]];
        $.datepicker.setDefaults($.datepicker.regional['th']);
        }else{
        section = 'Section ';
        langmap = ["Search for places or addresses","Location search.","View Fullscreen","Exit Fullscreen","Zoom in","Zoom out"];
        langswal = [["Are you sure? Once deleted", "you will not be able to recover this!","Event has been deleted!","OK","Cancel"],["Updated Successfully!!","Data has changed. Click the button!","OK"]];
        $.datepicker.setDefaults($.datepicker.regional['en']);
        }

</script>
@endsection
