@extends('layouts.master_auth')
@section('Title', 'Reset')
@section('content')

<!-- Pre-loader end -->
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="md-float-material form-material" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="text-center">
                        <a href="{{ config('app.url') }}"><img src="{{asset('images/logo.png')}}" alt="logo.png"></a>
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">{{ __('auth.reset_r.title') }}</h3>
                                </div>
                            </div>

                            <div class="form-group form-primary">
                                <input id="email" type="email" placeholder="{{ __('auth.reset_r.email-input') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    readonly name="email" value="{{ $email ?? old('email') }}" required autofocus>
                                <input id="acc_type" type="hidden" name="acc_type" value="email"> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('email') }}</strong>
                                     </span> @endif
                                <span class="form-bar"></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-primary">
                                        <input id="password" type="password" placeholder="{{ __('auth.reset_r.password-input') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" required> @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong></span>                                        @endif
                                        <span class="form-bar"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-primary">
                                        <input id="password-confirm" type="password" placeholder="{{ __('auth.reset_r.c-password-input') }}" class="form-control" name="password_confirmation"
                                            required>
                                        <span class="form-bar"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-mat btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                     {{ __('auth.reset_r.submit') }}
                                 </button>
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
