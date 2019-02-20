<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('Title') | Arogfaeit</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('components/bootstrap/css/bootstrap.min.css')}}">
    <!-- jq-ui -->
    <link rel="stylesheet" type="text/css" href="{{asset('components/jquery-ui/js/css/jquery-ui.theme.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('components/jquery-ui/js/css/jquery-ui.structure.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('components/jquery-ui/js/css/jquery-ui.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('icon/icofont/icofont.min.css')}}">
    <!-- fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('icon/fontawesome_5.5/css/all.min.css')}}">
    <!-- style_custom -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.back.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <!-- dataTables from CDN -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap4.min.css"> @yield('page-style')
</head>

<body>
    <div class="page">

        <!-- Main Navbar-->
        <header class="header">
            <nav class="navbar">

                <!-- Search Box-->
                {{-- <div class="search-box">
                    <button class="dismiss"><i class="icofont-ui-close"></i></button>
                    <form id="searchForm" action="#" role="search">
                        <input type="search" placeholder="What are you looking for..." class="form-control">
                    </form>
                </div> --}}
                <div class="container-fluid">
                    <div class="navbar-holder d-flex align-items-center justify-content-between">

                        <!-- Navbar Header-->
                        <div class="navbar-header">

                            <!-- Navbar Brand -->
                            <a href="{{url('/')}}" class="navbar-brand d-none d-sm-inline-block">
                                <div class="brand-text d-none d-lg-inline-block"><span>Arogfaeit </span><strong>Nomore</strong></div>
                                <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>AN</strong></div>
                            </a>

                            <!-- Toggle Button-->
                            <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                        </div>

                        <!-- Navbar Menu -->
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">

                            <!-- Search-->
                            {{-- <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="menu-bar icofont-search-2"></i></a></li> --}}

                            <!-- Notifications-->
                            {{-- <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="nav-link menu-bar"><i class="icofont-notification"></i><span
                      class="badge bg-red badge-corner">12</span></a>
                                <ul aria-labelledby="notifications" class="dropdown-menu">
                                    <li>
                                        <a rel="nofollow" href="#" class="dropdown-item">
                                            <div class="notification">
                                                <div class="notification-content"><i class="icofont-envelope"></i>You have 6 new messages </div>
                                                <div class="notification-time"><small>4 minutes ago</small></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a rel="nofollow" href="#" class="dropdown-item">
                                            <div class="notification">
                                                <div class="notification-content"><i class="icofont-twitter"></i>You have 2 followers</div>
                                                <div class="notification-time"><small>4 minutes ago</small></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>view all notifications </strong></a></li>
                                </ul>
                            </li> --}}

                            <!-- Languages dropdown    -->
                            <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" class="nav-link language dropdown-toggle"><img src=" @if(App::isLocale('en')){{asset('images/flags/16/GB.png')}} @else {{asset('images/flags/16/TH.png')}} @endif">
                                    <span class="menu-bar d-none d-sm-inline-block">{{ App::isLocale('en') ? 'English' : 'Thai' }}</span></a>
                                <ul aria-labelledby="languages" class="dropdown-menu">
                                    <li><a rel="nofollow" @if(App::isLocale( 'en')) href="{{ URL::to('change/th')}}" @else href="{{ URL::to('change/en')}}"
                                            @endif class="dropdown-item"> <img src="@if(App::isLocale('en')){{asset('images/flags/16/TH.png')}} @else {{asset('images/flags/16/GB.png')}} @endif" class="mr-2">{{ App::isLocale('en') ? 'Thai' : 'English' }}</a></li>
                                </ul>
                            </li>

                            <!-- Logout    -->
                            <li class="nav-item"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="nav-link logout"> <span class="menu-bar d-none d-sm-inline">{{__('layout.lay.back.out')}}</span><i class="menu-bar fas fa-sign-out-alt"></i></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="page-main">
            <div class="page-content d-flex align-items-stretch">
                <!-- Side Navbar -->
                <nav class="side-navbar">
                    <!-- Sidebar Header-->
                    <div class="sidebar-header d-flex align-items-center">
                        <div class="avatar"><img src="/upload/images/profile/{{ Auth::user()->base_avatar }}" class="img-fluid rounded-circle"></div>
                        <div class="title">
                            <h1 class="title-nav">{{ Auth::user()->full_name }}</h1>
                            <p>@if(Auth::user()->role == 3) Administrator @elseif(Auth::user()->role == 1) User @elseif(Auth::user()->role
                                == 2) Approver @endif</p>
                        </div>
                    </div>

                    <!-- Sidebar Navidation Menus-->
                    <span class="heading">{{__('layout.lay.back.main')}}</span>
                    <ul class="list-unstyled">
                    <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{url('home')}}"> <i class="icofont-ui-home"></i></i>{{__('layout.lay.back.home')}}</a></li>
                        @if( Gate::check('isAdmin') || Gate::check('isUser') )
                        <li class="{{ Request::is('event/view') ? 'active' : '' }}"><a href="{{route('vindex')}}"> <i class="icofont-school-bag"></i>{{__('layout.lay.back.myevent')}}</a></li>
                        <li class="{{ Request::is('event/event') ? 'active' : '' }}"><a href="{{route('eindex')}}"> <i class="icofont-paper"></i>{{__('layout.lay.back.create')}}</a></li>
                        <li class="{{ Request::is('event/myjoin') ? 'active' : '' }}"><a href="{{route('ejindex')}}"> <i class="icofont-ui-rate-blank"></i>{{__('layout.lay.back.favorites')}}</a></li>
                        @endif
                    </ul>

                    <span class="heading">{{__('layout.lay.back.management')}}</span>
                    <ul class="list-unstyled">
                        @if( Gate::check('isAdmin') || Gate::check('isExpert') )
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{url('dashboard')}}"> <i class="icofont-chart-bar-graph"></i>{{__('layout.lay.back.dashboard')}} </a></li>
                        <li class="{{ Request::is('event/management') ? 'active' : '' }}"><a href="{{route('emindex')}}"> <i class="icofont-list"></i>{{__('layout.lay.back.events')}} </a></li>
                        @endif @can('isAdmin')
                        <li class="{{ Request::is('user') ? 'active' : '' }}"><a href="{{url('user')}}"> <i class="icofont-users-alt-2"></i>{{__('layout.lay.back.users')}} </a></li>
                        @endcan
                        <li class="{{ Request::is('profile') ? 'active' : '' }}"><a href="{{url('profile')}}"> <i class="icofont-bear-face"></i>{{__('layout.lay.back.userprofile')}} </a></li>
                        <li class="{{ Request::is('help') ? 'active' : '' }}"><a href="/help"> <i class="icofont-life-ring"></i>{{__('layout.lay.back.help')}} </a></li>
                        <!--<li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bar-chart"></i>Exampledropdown </a><ul id="exampledropdownDropdown" class="collapse list-unstyled "><li><a href="#">Page</a></li><li><a href="#">Page</a></li><li><a href="#">Page</a></li></ul></li>-->
                    </ul>
                </nav>

                @yield('content')

            </div>
            <div>
            </div>

            <!-- Required Jquery -->
            <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
            <script type="text/javascript" src="{{asset('components/jquery-ui/js/jquery-ui.min.js')}}"></script>
            <script type="text/javascript" src="{{asset('components/jquery-ui/js/jui-custom.js')}}"></script>
            <script type="text/javascript" src="//unpkg.com/popper.js/dist/umd/popper.min.js"></script>
            <script type="text/javascript" src="{{asset('components/bootstrap/js/bootstrap.min.js')}}"></script>
            <!-- dataTables from CDN -->
            <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="//cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
            <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/dataTables.bootstrap4.min.js"></script>
            <script type="text/javascript" src="//cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap4.min.js"></script>
            <!-- swal from CDN-->
            <script type="text/javascript" src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <!-- master_end -->
            <script type="text/javascript" src="{{asset('js/back.js')}}"></script>

            @yield('page-script')

</body>

</html>
