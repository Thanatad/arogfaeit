@extends('layouts.master_auth') 
@section('Title', 'Sign In') 
@section('content')

<!-- Pre-loader end -->
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->
                <form class="md-float-material form-material" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center">
                        <a href="{{ config('app.url') }}"><img src="{{asset('images/logo.png')}}" alt="logo.png"></a>
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">{{ __('auth.sign_in.title') }}</h3>
                                </div>
                            </div>
                            <div class="row m-b-20" style="text-align:center; margin-top: -15px;">
                                <div class="col-md-6" style="padding:0.5rem">
                                    <div class="btn-group">
                                        <div class="row">
                                            <a class="btn btn-info disabled" style="width: 40px;"><i class="fab fa-facebook-f fa-lg" style="width:5px; height:15px"></i></a>
                                            <a class="btn btn-info loading" onclick="change();" href="/login/facebook" style="width:9.5rem;">{{ __('auth.sign_in.facebook') }}</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding:0.5rem">
                                    <div class="btn-group">
                                        <div class="row">
                                            <a class="btn btn-danger disabled" style="width: 40px;"><i class="fab fa-google" style="width:5px; height:15px"></i></a>
                                            <a class="btn btn-danger loading" onclick="change();" href="/login/google" style="width:9.5rem;">{{ __('auth.sign_in.google') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="or-seperator text-muted text-center p-b-10"><i>{{ __('auth.sign_in.or') }}</i></div>
                            <!--<p class="text-muted text-center p-b-5">{{ __('auth.sign_in.or') }}</p>-->

                            <div class="form-group form-primary">
                                <input id="email" type="email" placeholder="{{ __('auth.sign_in.email-input') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ old('email') }}" required autofocus>
                                <input id="acc_type" type="hidden" name="acc_type" value="email"> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong> </span>                                @endif
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary">
                                <input id="password" type="password" placeholder="{{ __('auth.sign_in.password-input') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" required> @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>                                @endif
                                <span class="form-bar"></span>
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old( 'remember') ? 'checked' : '' }}>
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <span class="text-inverse">{{ __('auth.sign_in.remember') }}</span>
                                            </label>
                                    </div>
                                    <div class="forgot-phone text-right f-right">
                                        @if (Route::has('password.request'))
                                        <a class="text-right f-w-600" href="{{ route('password.request') }}">{{ __('auth.sign_in.forgot') }}</a>                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-20">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-mat btn-primary btn-md btn-block waves-effect text-center m-b-20">{{ __('auth.sign_in.submit') }}</button>
                                </div>
                            </div>
                            <p class="text-inverse text-left" style="margin-bottom:0;">{{ __('auth.sign_in.register.1') }}<a href="{{ route('register') }}"> <b class="f-w-600">{{ __('auth.sign_in.register.2') }}</b></a></p>
                            <hr/>
                            <div class="row">
                                @if(App::isLocale('en'))
                                <a href="{{ URL::to('change/th')}}" class="toggle toggle-on"></a> @elseif(App::isLocale('th'))
                                <a href="{{ URL::to('change/en')}}" class="toggle toggle-off"></a> @endif
                            </div>
                        </div>
                    </div>
                </form>
                <!-- end of form -->
            </div>
            <!-- Authentication card end -->
        </div>
        <!-- end of col-sm-12 -->
    </div>
    <!-- end of row -->
    </div>
    <!-- end of container-fluid -->

</section>
@endsection
 
@section('page-script')
<script>
    var locale = "{{ config('app.locale') }}";
 if(locale == 'th'){
    var l ='กำลังเข้าสู่ระบบ..';
 }else{
    var l ='Sign in..';
 }

$('.loading').click(function(){
$(this).html("<i class='fas fa-circle-notch fa-spin'></i>" + l).prop('disabled',true); 
});

</script>
@endsection