@extends('layouts.master_back') 
@section('Title', 'Profile') 
@section('content')
<div class="content-inner">
    <header class="page-header">
        <div class="container-fluid">
            <div class="title-page no-margin-bottom">{{__('user.pro.title')}}</div>
        </div>
    </header>
    <section>
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cover-profile">
                                <div class="profile-bg-img">
                                    <img class="profile-bg-img img-fluid img-hidden" src="{{asset('images/cover.png')}}" alt="bg-img">
                                    <div class="card-block user-info">
                                        <div class="col-md-12">
                                            <div class="media-left">
                                                <a href="#" class="profile-image">
                                                 <img class="user-img img-radius" src="/upload/images/profile/{{ Auth::user()->base_avatar }}" alt="user-img"></a>
                                            </div>
                                            <div class="media-body row">
                                                <div class="col-lg-12">
                                                    <div class="user-title">
                                                        <h2>{{ Auth::user()->full_name }}</h2>
                                                        <span class="text-white">{{ Auth::user()->email }}</span>
                                                    </div>
                                                </div>
                                                <div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- tab header start -->
                            <!--
                                    <div class="tab-header card">
                                        <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#1" role="tab">1</a>
                                                <div class="slide"></div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#2" role="tab">2</a>
                                                <div class="slide"></div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#3" role="tab">3</a>
                                                <div class="slide"></div>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#4" role="tab">4</a>
                                                <div class="slide"></div>
                                            </li>
                                        </ul>
                                    </div>
                                    -->
                            @foreach($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                            @endforeach 
                            @if(\Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont icofont-close-line-circled"></i>
                                                    </button>{{ \Session::get('success')
                                }}
                            </div>
                            @endif
                            <div class="tab-content">
                                <div class="tab-pane active" id="personal" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-header-text">{{__('user.pro.about')}}</h5>
                                            <button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light f-right">
                                                <i class="icofont icofont-edit"></i>
                                            </button>
                                        </div>
                                        <div class="card-block">
                                            <div class="view-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="general-info">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="table-responsive">
                                                                        <table class="table m-0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">{{__('user.pro.fullname')}}</th>
                                                                                    <td>{{$profile->full_name}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">{{__('user.pro.gender')}}</th>
                                                                                    <td>@if($profile->sex == 0){{__('user.pro.male')}}
                                                                                        @else {{__('user.pro.female')}} @endif
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">{{__('user.pro.birtdate')}}</th>
                                                                                    <td>{{$profile->dob}}</td>
                                                                                </tr>
                                                                                <th scope="row">{{__('user.pro.email')}}</th>
                                                                                <td>{{$profile->email}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">{{__('user.pro.mobile')}}</th>
                                                                                    <td>{{$profile->mobile}}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-xl-6">
                                                                    <div class="table-responsive">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">{{__('user.pro.province')}}</th>
                                                                                    <td>{{$profile->province}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <tr>
                                                                                        <th scope="row">{{__('user.pro.location')}}</th>
                                                                                        <td>{{$profile->address}}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">{{__('user.pro.permission')}}</th>
                                                                                        <td>@if($profile->role == 1) USER @elseif($profile->role
                                                                                            == 3) ADMINISTRATOR @elseif($profile->role
                                                                                            == 2) APPROVER @endif
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">{{__('user.pro.website')}}</th>
                                                                                        <td><a href="http://{{$profile->site}}">{{$profile->site}}</a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">{{__('user.pro.create')}}</th>
                                                                                        <td>{{$profile->created_at}}</td>
                                                                                    </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="edit-info">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="general-info">
                                                            <form id="update_profile" style="display:none;" autocomplete="off" method="POST" action="{{ route('p_update', $profile->id ) }}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                                                                            <input id="full_name" name="full_name" type="text" class="form-control" data-toggle="tooltip" title="{{__('user.pro.fullname')}}"
                                                                                                value="{{$profile->full_name}}"
                                                                                                maxlength="100" required>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="form-radio">
                                                                                            <div class="group-add-on">
                                                                                                <div class="radio radio-matrial radio-primary radio-inline">
                                                                                                    <label>
                                                                                                    <input id="sex" type="radio" name="sex" value="0" @if($profile->sex == '0') checked @elseif($profile->sex == '') checked @endif><i class="helper"></i> {{__('user.pro.male')}}
                                                                                                </label>
                                                                                                </div>
                                                                                                <div class="radio radio-matrial radio-primary radio-inline">
                                                                                                    <label>
                                                                                                    <input id="sex" type="radio" name="sex" value="1" @if($profile->sex == '1') checked @endif><i class="helper"></i> {{__('user.pro.female')}}
                                                                                                </label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="icofont-wall-clock"></i></span>
                                                                                            <input id="dob" name="dob" class="form-control" type="text" data-toggle="tooltip" title="{{__('user.pro.selectbirtdate')}}"
                                                                                                value="{{$profile->dob}}" />
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="icofont icofont-mobile-phone"></i></span>
                                                                                            <input id="mobile" name="mobile" type="text" class="form-control" data-toggle="tooltip" placeholder="{{__('user.pro.mobile')}}"
                                                                                                title="{{__('user.pro.mobile')}} "
                                                                                                value="{{$profile->mobile}}"
                                                                                                maxlength="12">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <table class="table">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                                                                            <input id="province" name="province" type="text" class="form-control tt-width" data-toggle="tooltip" placeholder="{{__('user.pro.oraddress')}}"
                                                                                                title="{{__('user.pro.oraddress')}}"
                                                                                                value="{{$profile->province}}"
                                                                                                style="width: 100%;">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="icofont-search-map"></i></span>
                                                                                            <input id="address" name="address" type="text" class="form-control thresold-i" data-toggle="tooltip" placeholder="{{__('user.pro.location')}}"
                                                                                                title="{{__('user.pro.location')}}"
                                                                                                value="{{$profile->address}}"
                                                                                                maxlength="200">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="icofont icofont-earth"></i></span>
                                                                                            <input id="site" name="site" type="text" class="form-control" data-toggle="tooltip" placeholder="{{__('user.pro.website')}}"
                                                                                                title="{{__('user.pro.website')}}"
                                                                                                value="{{$profile->site}}">
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="icofont-image"></i></span>
                                                                                            <input id="avatar" name="avatar" type="file" class="form-control " data-toggle="tooltip" title="Avatar" {{Auth::user()->acc_type
                                                                                            == 'email' ? '':'disabled'}}>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="text-center">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20 ">{{__('user.pro.update')}}</button>
                                                                    <a href="#!" id="edit-cancel" class="btn btn-danger">{{__('user.pro.cancel')}}</a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    <!-- Aotocomplete Thailand -->
    <script type="text/javascript" src="{{asset('components/jquery.Thailand.js/dependencies/typeahead.bundle.js')}}"></script>
    <script type="text/javascript" src="{{asset('components/jquery.Thailand.js/dependencies/JQL.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('components/jquery.Thailand.js/dist/jquery.Thailand.min.js')}}"></script>
    <!-- Input Mask -->
    <script src="{{asset('components/Inputmask/jquery.inputmask.bundle.js')}}"></script>
    <!-- profile.js -->
    <script type="text/javascript" src="{{asset('js/profile.js')}}"></script>
    <script>
        var url_db = "{{ URL::asset('components/jquery.Thailand.js/database/db.json') }}";
    </script>
@endsection