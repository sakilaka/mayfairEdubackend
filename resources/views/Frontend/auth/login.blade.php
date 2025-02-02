@extends('Frontend.layouts.master-layout')
@section('title', '- Student Login')
@section('head')

@endsection
@section('main_content')
    <br>
    <br>
    <br>
    <div class="py-5">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="row mx-0 align-items-center border-md rounded-3">
                        <div class="col-md-6 border-end-md p-4 p-sm-5">
                            @php
                                $home_content = \App\Models\HomeContentSetup::first();
                            @endphp
                            <h2 class="h3 mb-4 mb-sm-3">
                                Hey there!<br>Welcome back. </h2>

                            <div class="mt-sm-2 mb-sm-4 text-center">
                                Login as <strong>
                                    <a href="{{ route('frontend.consultant_signin') }}"
                                        class="text-decoration-underline">Partner</a> </strong>
                            </div>
                            <img class="d-block mx-auto img-fluid" style="margin-top:50px; height:380px; width:330px;"
                                src="{{ $home_content->register_image_show }}" alt="image">
                            <!--<div class="mt-4 mt-sm-5">Don't have an account? <a href="" class="text-decoration-underline">Sign up here</a></div>-->
                        </div>
                        <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
                            {{-- success message start --}}

                            {{-- @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                                <script>
                                    setTimeout(function() {
                                        $('.alert.alert-success').hide();
                                    }, 3000);
                                </script>
                            @endif --}}

                            @php
                                $header_logo = \App\Models\Tp_option::where('option_name', 'theme_logo')->first();
                            @endphp

                            <a class="navbar-brand" href="{{ env('FRONTEND_URL') }}">
                                <img style="width: 75%; margin-top: -135px;" src="{{ @$header_logo->header_image == '' ? @$header_logo->no_image : @$header_logo->header_image_show }}"
                                    alt="Logo-{{ @$theme_header->company_name }}">
                            </a>

                            {{-- success message start --}}
                            <h4 class="mt-3">
                                Student Sign in
                            </h4>

                            <form action="{{ route('frontend.sign_in') }}" class="myform" id="learner_myform"
                                enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                @csrf

                                {{-- <input type="hidden" name="csrf_test_name" value="23b826ad1bc7f991149ab321ac679e99" />                                                                                                            --}}
                                <div class="mb-3">
                                    <label class="form-label mb-1" for="email">
                                        Email address </label>
                                    <input class="form-control form-control-lg" name="email" type="text" id="email"
                                        placeholder="Enter your Email" tabindex="1" required="" autofocus>
                                </div>
                                <div class="mb-3" style="position : relative">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <label class="form-label mb-0" for="password">
                                            Password </label><a class="fs-sm" href="#"
                                            class="text-decoration-underline"></a>
                                    </div>
                                    <input class="form-control form-control-lg" name="password" type="password"
                                        id="password" placeholder="Enter password" tabindex="2" required="">
                                    <span style="position: absolute;    right: 10px;    top: 36px;    font-size: 20px;">
                                        <a href="javascript:void(0)" onclick="viewpasswordSignin(4)">
                                            <div class="change-icon">
                                                <i class="fas fa-eye"></i>
                                            </div>
                                        </a>
                                    </span>
                                </div>

                                <div class="col-6 mb-2">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" data-val="true"
                                            data-val-required="The Remember me? field is required." id="rememberme"
                                            onclick="is_remember()" name="remember_me" type="checkbox" value="1"
                                            checked>
                                        <label class="custom-control-label" for="rememberme">Stay logged in for 30
                                            days</label>
                                    </div>
                                </div>

                                <button class="btn btn-dark-cerulean btn-lg w-100 login_submit" type="submit"
                                    onclick="loginProcess(4)">
                                    Sign in </button>
                            </form>
                            <div class="col-6 text-right">
                                <a class="m-link-muted small" href="{{ route('forget.password') }}">
                                    <strong>Forgot Password ?</strong>
                                </a>
                            </div>


                            <div class="mt-sm-4 text-center">
                                Don't have an account? <strong>

                                    <a href="{{ route('frontend.register') }}" class="text-decoration-underline">Create an
                                        Account</a> </strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- @include('Frontend.layouts.parts.news-letter') --}}

@endsection
