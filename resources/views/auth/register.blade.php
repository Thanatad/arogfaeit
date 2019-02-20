@extends('layouts.master_auth')
@section('Title', 'Sign Up')
@section('content')

<!-- Pre-loader end -->
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="md-float-material form-material" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="text-center">
                        <a href="{{ config('app.url') }}"><img src="{{asset('images/logo.png')}}" alt="logo.png"></a>
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">{{ __('auth.sign_up.title') }}</h3>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <input id="full_name" type="text" placeholder="{{ __('auth.sign_up.name-input') }}" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}"
                                    name="full_name" value="{{ old('full_name') }}" required autofocus>                                @if ($errors->has('full_name'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('full_name') }}</strong></span>                                @endif
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary">
                                <input id="email" type="email" placeholder="{{ __('auth.sign_up.email-input') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ old('email') }}" required> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>                                @endif
                                <span class="form-bar"></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-primary">
                                        <input id="password" type="password" placeholder="{{ __('auth.sign_up.password-input') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" required> @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>                                        @endif
                                        <span class="form-bar"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-primary">
                                        <input id="password-confirm" type="password" placeholder="{{ __('auth.sign_up.c-password-input') }}" class="form-control" name="password_confirmation"
                                            required>
                                        <span class="form-bar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-10 text-left">
                                <div class="col-md-12">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                                 <input type="checkbox" value="">
                                                 <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                 <span class="text-inverse">{{ __('auth.sign_up.accept.1') }}<a href="#">{{ __('auth.sign_up.accept.2') }}</a></span>
                                             </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-20">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-mat btn-primary btn-md btn-block waves-effect text-center m-b-5">{{ __('auth.sign_up.submit') }}</button>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                @if(App::isLocale('en'))
                                <a href="{{ URL::to('change/th')}}" class="toggle toggle-on"></a> @elseif(App::isLocale('th'))
                                <a href="{{ URL::to('change/en')}}" class="toggle toggle-off"></a> @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>
@endsection
