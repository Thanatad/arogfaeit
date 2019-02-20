<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('Title') | Arogfaeit</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('components/bootstrap/css/bootstrap.min.css')}}">
    <!-- jq-ui -->
    <link rel="stylesheet" type="text/css" href="{{asset('components/jquery-ui/js/css/jquery-ui.theme.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('components/jquery-ui/js/css/jquery-ui.structure.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('components/jquery-ui/js/css/jquery-ui.min.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('icon/icofont/icofont.min.css')}}">
    <!-- fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('icon/fontawesome_5.5/css/all.min.css')}}">
    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- Slider-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.0/css/bootstrap-slider.min.css" rel="stylesheet"
    />

    <!-- style_custom -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.front.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}"> @yield('page-style')
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="{{asset('images/logo.png')}}" width="100%" height="30" alt="">
              </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{url('/')}}" class="nav-link">{{__('layout.lay.front.nav.event')}}</a>
                </li>
                <li class="nav-item {{ Request::is('event/map') ? 'active' : '' }}">
                    <a href="{{url('event/map')}}" class="nav-link">{{__('layout.lay.front.nav.map')}}</a>
                </li>
                <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                    <a href="/about" class="nav-link">{{__('layout.lay.front.nav.about')}}</a>
                </li>
                <!-- Languages dropdown    -->
                <li class="nav-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link language dropdown-toggle"><img src=" @if(App::isLocale('en')){{asset('images/flags/16/GB.png')}} @else {{asset('images/flags/16/TH.png')}} @endif">
                                                <span class="menu-bar d-none d-sm-inline-block">{{ App::isLocale('en') ? 'English' : 'Thai' }}</span></a>
                    <ul aria-labelledby="languages" class="dropdown-menu">
                        <li><a rel="nofollow" @if(App::isLocale( 'en')) href="{{ URL::to('change/th')}}" @else href="{{ URL::to('change/en')}}"
                                @endif class="dropdown-item"> <img src="@if(App::isLocale('en')){{asset('images/flags/16/TH.png')}} @else {{asset('images/flags/16/GB.png')}} @endif" class="mr-2">{{ App::isLocale('en') ? 'Thai' : 'English' }}</a></li>
                    </ul>
                </li>
                @if (Route::has('login'))
                <li class="nav-item top-right links">
                    @auth
                    <a href="{{ url('/home') }}" class="nav-link">{{__('layout.lay.front.nav.home')}}</a>
                </li>
                @else
                <a href="{{ route('login') }}" class="nav-link">{{__('layout.lay.front.nav.login')}}</a> @endauth
                </li>
                @endif
            </ul>
        </div>
    </nav>

    @yield('content')

    <!-- Required Jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('components/jquery-ui/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('components/jquery-ui/js/jui-custom.js')}}"></script>
    <script type="text/javascript" src="//unpkg.com/popper.js/dist/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{asset('components/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Slider-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.0/bootstrap-slider.min.js"></script>
    <!-- Input Mask -->
    <script src="{{asset('components/Inputmask/jquery.inputmask.bundle.js')}}"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- swal from CDN-->
    <script type="text/javascript" src="//unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- TweenMax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js"></script>
    <!-- Custom js-->
    <script src="{{asset('js/front.js')}}"></script>
    <script>
        var langs2=[];
       var locale = "{{ config('app.locale') }}";
       if(locale == 'th'){
        langs2 = ["ไม่สามารถโหลดผลลัพธ์","กรุณาลบ","สัญลักษณ์","กรุณากรอก "," หรือมากกว่าตัวอักษร","กำลังโหลดเพิ่มเติม ...","อย่าใส่เกิน "," ยังกากๆอยู่","ไม่พบสิ่งที่ต้องการ","ค้นหา..."];
       }else{
        langs2 = ["Unable to load results","Please delete","symbol","Please enter "," Or more characters","Loading more ...","Do not put more than "," Item","Did not find what wanted","Searching for..."];
       }
    </script>
    @yield('page-script')
</body>

</html>