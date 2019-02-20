@extends('layouts.master_back')
@section('Title', 'Verify')
@section('content')

<div class="content-inner">
    <header class="page-header">
        <div class="container-fluid">
            <h2 class="title-page no-margin-bottom">Verify</h2>
        </div>
    </header>
    <!-- Page Header-->
    <section>
        <section>
            <div class="main-body">
                <div class="page-wrapper">

                    <div class="card">
                        <div class="card-headers">{{ __('verify.email.header') }}</div>
                        <div class="card-body">
                            @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('verify.email.main.1') }}
                            </div>
                            @endif {{ __('verify.email.main.2') }} {{ __('verify.email.main.3') }} <a href="{{ route('verification.resend') }}">{{ __('verify.email.main.4') }}</a>
                        </div>
                    </div>
                </div>

    </div>
    </section>
</div>
@endsection
