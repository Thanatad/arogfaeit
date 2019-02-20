@extends('layouts.master_auth')
@section('Title', 'Reset')
@section('content')

<!-- Pre-loader end -->
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->
                <form class="md-float-material form-material" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="text-center">
                        <a href="{{ config('app.url') }}"><img src="{{asset('images/logo.png')}}" alt="logo.png"></a>
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-left">{{ __('auth.reset.title') }}</h3>
                                </div>
                            </div>
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled"></i>
                                    </button>{{ session('status') }}
                            </div>
                            @endif
                            <div class="form-group form-primary">
                                <input id="email" type="email" placeholder="{{ __('auth.reset.email-input') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    name="email" value="{{ old('email') }}" required> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span> @endif
                                <span class="form-bar"></span>
                            </div>
                            <div class="row m-t-20">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-mat btn-primary btn-md btn-block waves-effect text-center m-b-15">
                                        {{ __('auth.reset.submit') }}
                                    </button>
                                </div>
                            </div>
                            <p class="f-w-600 text-right">{{ __('auth.reset.signin.1') }}<a href="{{ route('login') }}">{{ __('auth.reset.signin.2') }}</a></p>
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
