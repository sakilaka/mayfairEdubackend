
@extends('Frontend.layouts.master-layout')
@section('title','- Reset Password')
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
                        <h2 class="h3 mb-4 mb-sm-3">
                            Hey there!<br>Welcome back.                        </h2>
                            <div class="mt-sm-2 text-center">
                                Login as                            <strong>
                                    <a href="{{ route('frontend.signin') }}" class="text-decoration-underline">Student</a>                            </strong>
                            </div>
                            <div class="mt-sm-2 text-center mb-5">
                                Login as                            <strong>
                                    <a href="{{ route('frontend.consultant_signin') }}" class="text-decoration-underline">Partner</a>                            </strong>
                            </div>
                        <img class="d-block mx-auto img-fluid" src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/signin.svg"
                            width="344" alt="Illustartion">
                        <!--<div class="mt-4 mt-sm-5">Don't have an account? <a href="" class="text-decoration-underline">Sign up here</a></div>-->
                    </div>
                    <div class="col-md-6 px-4 pt-2 pb-4 px-sm-5 pb-sm-5 pt-md-5">
                            {{-- success message start --}}
                            @if(session()->has('message'))
                            <div class="alert alert-success">
                            {{session()->get('message')}}
                            </div>
                            <script>
                                setTimeout(function(){
                                    $('.alert.alert-success').hide();
                                }, 3000);
                            </script>
                            @endif
                            {{-- success message start --}}

                    <h4>Forgot Password!</h4>

                        <form action="{{ route('reset.forgot_password',$user->id) }}" class="myform" id="learner_myform" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf

                        <label class="mb-1" for="">New Password</label>

                      <div class="col-md-12">
                        <input class="form-control @error('password') is-invalid @enderror" type="text" id="password" name="password"/>
                      </div>
                      <p>Be at least 8 characters</p>
                      <label class="mt-3 mb-1" for="">Confirm Password</label>
                      <div class="col-md-12">
                        <input class="form-control" type="text" id="password_confirmation" name="password_confirmation"/>
                      </div>
                      <p>Be at least 8 characters</p>

                        <button class="btn btn-dark-cerulean btn-lg w-100 login_submit mt-3" type="submit">
                            Reset Password
                        </button>
                        </form>



                        <!-- <a class="btn btn-outline-dark-cerulean btn-lg w-100 mb-3" href=""><i
                                class="fab fa-facebook me-1"></i>Sign in with Facebook</a> -->



                        <div class="mt-sm-4 text-center">
                            Don't have an account?                            <strong>

                                <a href="{{ route('frontend.register') }}" class="text-decoration-underline">Create an Account</a>                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('Frontend.layouts.parts.news-letter')

@endsection
