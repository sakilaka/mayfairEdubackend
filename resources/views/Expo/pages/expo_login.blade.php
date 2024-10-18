<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Login to your Expo Dashboard</title>

    <style>
        .section-height {
            height: 78vh;
        }

        @media screen and (max-width:767px) {
            .section-height {
                height: auto !important;
            }
        }
    </style>

    @php
        $contents = json_decode($expo['additional_contents'], true) ?? [];
    @endphp
</head>

<body>

    <div class="bg-section">
        <div class="container">
            <nav class="navbar navbar-expand-md shadow-none" style="z-index: 3">
                <div class="container d-flex justify-content-between">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('frontend/expo-domain/images/vector_smart_object_3.png') }}" alt="Logo"
                            class="logo">
                    </a>

                    @include('Expo.components.navbar')
                </div>
            </nav>
        </div>

        {{-- <div class="layer-image"></div> --}}
        <div class="bg-color"></div>

        <div style="width: 100%;" class="section-height d-flex justify-content-center align-items-center">
            <div
                class="container mx-auto row justify-content-center justify-content-md-start align-items-center mb-md-5 pb-md-5">
                <div class="col-md-8 z-2 p-4 pb-5" style="position: relative; z-index: 2;">
                    <div>
                        <h2 class="main-heading text-white fw-semibold fs-3">{{ $contents['pre_title'] }}</h2>
                        <h1 class="main-title text-white fw-bold fs-2">{{ $expo->title }}</h1>
                    </div>
                    <p class="location-text text-white">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                            </svg>
                        </span>
                        <span class="text-style fw-bold">BICC(Former Bangladesh-China Friendship Conference
                            Center)</span><br>
                        Agargaon, Sher-E-Bangla Nagar, Dhaka-1207, Bangladesh
                    </p>

                    <div class="rectangle-3-copy-holder text-white">
                        <a href="{{ route('expo.sign-up', ['unique_id' => $expo->unique_id]) }}"
                            class="btn btn-light fw-bold btn-responsive mb-2">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                                    <path
                                        d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                                    <path
                                        d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
                                </svg>
                            </span>
                            Registration
                        </a>
                        <a href="https://maps.app.goo.gl/Tkx7Et7Lk8gZjbgV6" target="_blank"
                            class="btn text-white fw-bold btn-responsive mb-2">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                    class="bi bi-map-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v14a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.5.5 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5zM5 14.09V1.11l.5-.1.5.1v12.98l-.402-.08a.5.5 0 0 0-.196 0zm5 .8V1.91l.402.08a.5.5 0 0 0 .196 0L11 1.91v12.98l-.5.1z" />
                                </svg>
                            </span>
                            View Location
                        </a>
                    </div>
                </div>

                <div class="col-md-4 border p-4 pt-0 bg-white shadow card-red-pattern-bg"
                    style="position: relative; z-index: 2; border-radius:8px;">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                        <script>
                            setTimeout(function() {
                                $('.alert.alert-success').hide();
                            }, 3000);
                        </script>
                    @endif
                    <h4 style="color: var(--red-btn-color); font-size:18px;" class="fw-bold">Login to your Expo
                        Dashboard
                    </h4>

                    <form action="{{ route('expo.login.attempt', ['unique_id' => $expo->unique_id]) }}" class="mt-3"
                        enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        @csrf

                        <!-- Radio buttons to toggle between ID and Email -->
                        {{-- <div class="mb-3 d-flex justify-content-between">
                            <label class="form-label mb-1">Login Method:</label>
                            <div class="d-flex">
                                <div class="me-3">
                                    <input type="radio" id="toggle_email" name="login_method" value="email"
                                        onclick="toggleFields()" checked>
                                    <label for="toggle_email">Email</label>
                                </div>

                                <div>
                                    <input type="radio" id="toggle_id" name="login_method" value="id"
                                        onclick="toggleFields()">
                                    <label for="toggle_id">ID</label>
                                </div>
                            </div>
                        </div> --}}
                        <input type="hidden" name="login_method" value="email">

                        <!-- Email field (initially hidden) -->
                        <div class="mb-3" id="email_field">
                            <label class="form-label mb-1" for="email">Email</label>
                            <input class="form-control form-control-lg" name="email" type="text" id="email"
                                placeholder="Enter Email" tabindex="1">
                        </div>

                        <!-- ID field -->
                        <div class="mb-3" id="id_field" style="display: none;">
                            <label class="form-label mb-1" for="id_no">ID No.</label>
                            <input class="form-control form-control-lg" name="id_no" type="text" id="id_no"
                                placeholder="Enter ID" tabindex="1">
                        </div>

                        <!-- Password field -->
                        <div class="mb-3" style="position: relative;">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <label class="form-label mb-0" for="password">Password</label>
                            </div>
                            <input class="form-control form-control-lg" name="password" type="password" id="password"
                                placeholder="Enter password" tabindex="2">
                            <span style="position: absolute; right: 10px; top: 36px; font-size: 20px;">
                                <a href="javascript:void(0)" onclick="viewpasswordSignin(this)">
                                    <div class="change-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                </a>
                            </span>
                        </div>

                        <!-- Submit button -->
                        <button class="btn btn-danger-bg btn-lg w-100 position-relative" style="z-index: 2"
                            type="submit">Sign in</button>
                    </form>

                    <div class="text-center mt-4 mb-5">
                        Don't have an account?
                        <strong>
                            <a href="{{ route('expo.sign-up', ['unique_id' => $expo->unique_id]) }}"
                                class="text-decoration-underline">
                                Create an Account
                            </a>
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Expo.components.footer')

    @if (session()->has('success') || session()->has('error'))
        <script>
            alert(@json(session('success') ?? session('error')));
        </script>
    @endif

    <script>
        function viewpasswordSignin(element) {
            var passwordField = $(element).closest('.mb-3').find('input[name="password"]');
            var icon = $(element).find('.change-icon i');

            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        }

        function toggleFields() {
            var idField = document.getElementById('id_field');
            var emailField = document.getElementById('email_field');

            if (document.getElementById('toggle_id').checked) {
                idField.style.display = 'block';
                emailField.style.display = 'none';
            } else {
                idField.style.display = 'none';
                emailField.style.display = 'block';
            }
        }
    </script>
</body>

</html>
