<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ env('APP_NAME') }} | Reset Password</title>

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
                                {{-- @php
                                    $header_logo = \App\Models\Tp_option::where('option_name', 'theme_logo')->first();
                                @endphp --}}
                                <img src="{{ $header_logo->header_image_show ?? asset('backend/assets/images/logo.svg') }}"
                                    alt="logo">
                            </div>
                            <h6 class="font-weight-light">Enter new password!</h6>

                            <form class="pt-3" method="POST"
                                action="{{ route('admin-reset.forgot_password', $user->id) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        placeholder="New Password" required>
                                    <p class="text-primary">At least 8 digit required</p>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-lg" placeholder="Retype New Password" required>
                                </div>

                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">
                                        Change Password
                                    </button>
                                </div>
                            </form>

                            <div class="my-2 d-flex justify-content-center align-items-center">
                                <a href="{{ route('login') }}" class="text-primary mt-3">
                                    Back to Login
                                </a>
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
