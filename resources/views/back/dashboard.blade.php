@extends('layouts.master_back')
@section('Title', 'Dashboard')
@section('content')

<div class="content-inner">
    <header class="page-header">
        <div class="container-fluid">
            <div class="title-page no-margin-bottom">{{__('dashboard.dash.title')}}</div>
        </div>
    </header>
    <section>
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row dashboard">

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-yellow update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white"><i class="far fa-user-circle"></i> {{$users}}</h4>
                                            <h6 class="text-white m-b-0">{{__('dashboard.dash.alluser')}}</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="user-chart" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>{{__('dashboard.dash.update')}} : {{date('H:i:s')}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-lite-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white"><i class="far fa-calendar-check"></i> {{$events}}</h4>
                                            <h6 class="text-white m-b-0">{{__('dashboard.dash.allevent')}}</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="events-chart" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>{{__('dashboard.dash.update')}} : {{date('H:i:s')}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">{{$eactive}}</h4>
                                            <h6 class="text-white m-b-0">{{__('dashboard.dash.active')}}</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="active-chart" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>{{__('dashboard.dash.update')}} : {{date('H:i:s')}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-pink update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">{{$eexp}}</h4>
                                            <h6 class="text-white m-b-0">{{__('dashboard.dash.expired')}}</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="exp-chart" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>{{__('dashboard.dash.update')}} : {{date('H:i:s')}}</p>
                                </div>
                            </div>
                        </div>


                        <div class="col-xl-9 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>{{__('dashboard.dash.analytics')}}</h5>
                                    <span class="text-muted">{{__('dashboard.dash.analyticsdetail')}} {{date('Y')}}</span>
                                </div>
                                <div class="card-block">
                                    <div style="position: relative; height: 240px"><canvas id="event-analytics"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-12">
                            <div class="card user-card2">
                                <div class="card-block text-center">
                                    <h6 class="m-b-15">{{__('dashboard.dash.join')}}</h6>
                                    <div class="risk-rate">
                                        <span><b>{{$join}}</b></span>
                                    </div>
                                    <h6 class="m-b-10 m-t-10">{{__('dashboard.dash.all')}}</h6>
                                    <a href="#!" class="text-c-yellow b-b-warning">{{__('dashboard.dash.mostevent')}}</a>
                                    <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                                        <div class="col m-t-15 b-r-default w-m-120">
                                            <h6 class="text-muted">{{__('dashboard.dash.user')}}</h6>
                                            <h6 class="text-short"  data-toggle="tooltip" title="{{$userjoin}}">{{$userjoin}}</h6>
                                        </div>
                                        <div class="col m-t-15 w-m-120">
                                            <h6 class="text-muted">{{__('dashboard.dash.event')}}</h6>
                                            <h6 class="text-short" data-toggle="tooltip" title="{{$eventjoin}}">{{$eventjoin}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-warning btn-block p-t-15 p-b-15">.</button>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('page-script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script type="text/javascript" src="{{asset('js/dashboard.js')}}"></script>
<script>

var monthth = ['"ม.ค."', '"ก.พ."', '"มี.ค."','"เม.ย."', '"พ.ค."', '"มิ.ย."','"ก.ค."',' "ส.ค."', '"ก.ย."','"ต.ค."', '"พ.ย."', '"ธ.ค."'];

var locale = '{{ config('app.locale') }}';
    var langswal =[];
        if(locale == 'th'){
            var month = ['"ม.ค."', '"ก.พ."', '"มี.ค."','"เม.ย."', '"พ.ค."', '"มิ.ย."','"ก.ค."',' "ส.ค."', '"ก.ย."','"ต.ค."', '"พ.ย."', '"ธ.ค."'];
        }else{
            var month = ['"Jan."', '"Feb."', '"Mar."','"Apr."', '"May"', '"Jun."','"Jul."',' "Aug."', '"Sept."','"Oct."', '"Nov."', '"Dec."'];
        }
</script>
@endsection
