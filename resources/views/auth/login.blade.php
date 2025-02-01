<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }} | Admin Login</title>

    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/iconfonts/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/css/vendor.bundle.addons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-center p-5">
                            <div class="brand-logo">
                                @php
                                    $header_logo = \App\Models\Tp_option::where('option_name', 'theme_logo')->first();
                                @endphp
                                <img src="{{ $header_logo->header_image_show ?? asset('backend/assets/images/logo.svg') }}"
                                    alt="logo">
                            </div>
                            <h4 class="text-primary">Hello, Admin!</h4>
                            <h6 class="font-weight-light text-primary">Sign in to continue.</h6>

                            <form class="pt-3" method="POST" action="{{ route('login') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" name="password" placeholder="Password">
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">
                                        SIGN IN
                                    </button>
                                </div>
                            </form>

                            <div class="my-2 d-flex justify-content-center align-items-center">
                                <a href="{{ route('admin.forget.password') }}" class="text-primary mt-3">Reset
                                    Password</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="{{ asset('backend/assets/js/toastDemo.js') }}"></script>
    @include('Backend.components.message')
</body>

</html>
