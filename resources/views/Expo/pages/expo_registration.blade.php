<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Expo Registration</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $header_logo = \App\Models\Tp_option::where('option_name', 'theme_logo')->first();
        $header_logo = $header_logo->header_image == '' ? $header_logo->no_image : $header_logo->header_image_show;
    @endphp
    <style>
        .form-container {
            border-radius: 8px;
            background-repeat: no-repeat;
            background-position: top;
            background-size: 30% auto;
            background-blend-mode: overlay;
        }
    </style>

    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/select2.min.css') }}">

    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .select2-container .select2-selection--multiple {
            min-height: 48px;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: solid #ccc 1px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            font-size: 0.85rem;
        }
    </style>

    <style>
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
            padding: 0 20px;
        }

        .step-indicator::before {
            content: '';
            position: absolute;
            top: 30%;
            left: 10%;
            right: 14%;
            height: 2px;
            background-color: #ddd;
            z-index: 0;
            transform: translateY(-50%);
        }

        .step-item {
            position: relative;
            z-index: 1;
            text-align: center;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .step-item .step-number {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 28px;
            border-radius: 50%;
            background-color: #fff;
            border: 2px solid #ddd;
            color: #aaa;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .step-item .step-text {
            font-size: 14px;
            color: #aaa;
        }

        .step-item.active-step .step-text {
            color: var(--primary_background);
            font-weight: bold;
        }

        .step-item.active-step .step-number {
            border-color: var(--primary_background);
            color: var(--primary_background);
        }

        .step-item.completed-step {
            color: #5bc0de;
        }

        .step-item.completed-step .step-number {
            border-color: #5bc0de;
            color: #5bc0de;
        }

        @media (max-width: 384px) {
            .step-indicator::before {
                top: 20%;
                left: 18%;
                right: 20%;
            }
        }

        @media (min-width: 385px) and (max-width: 536px) {
            .step-indicator::before {
                top: 20%;
                left: 15%;
                right: 20%;
            }
        }

        @media (max-width: 536px) {
            .step-item .step-text {
                font-size: 12px;
            }
        }

        @media (min-width: 385px) and (max-width: 728px) {
            .step-indicator::before {
                left: 15%;
                right: 20%;
            }
        }

        @media (min-width: 768px) and (max-width: 991px) {
            .step-indicator::before {
                top: 30%;
                left: 13%;
                right: 17%;
            }
        }

        @media (min-width: 992px) and (max-width: 1023px) {
            .step-indicator::before {
                top: 30%;
                left: 15%;
                right: 19%;
            }
        }

        @media (min-width: 1024px) {
            .step-indicator::before {
                top: 30%;
                left: 14%;
                right: 18%;
            }
        }

        .captcha-container {
            display: flex;
            align-items: center;
        }
    </style>
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

        <div class="container justify-content-center align-items-center">
            <div class="row justify-content-center">
                <div class="col-xl-12" style="position: relative; z-index: 2;">
                    <div class="row mx-0 align-items-center justify-content-center">

                        <div class="col-md-10 col-lg-7 col-xl-6 co p-4 my-5 bg-white shadow form-container card-red-pattern-bg"
                            style="border-radius: 15px">
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    <img src="{{ asset('frontend/images/studyinchina-logo.png') }}" alt=""
                                        width="160" class="img-fluid mt-2" style="cursor: pointer";
                                        onclick="location.href='{{ route('home') }}'">

                                </div>
                                <div class="col-4">
                                    <h2 class="h3 text-center" style="font-weight: bold">
                                        <img src="{{ asset('frontend/images/logo/study-in-china-exhibition-color.png') }}"
                                            alt="" width="150" class="img-fluid">
                                    </h2>
                                </div>
                                <div class="col-4 text-end d-flex flex-column align-items-center">
                                    <img src="{{ asset(asset('frontend/images/logo/cscse-color-2.png')) }}"
                                        alt="" width="130" class="img-fluid" style="cursor: pointer";
                                        onclick="location.href='{{ route('home') }}'">
                                    <img src="{{ $header_logo }}" alt="" width="70" class="img-fluid mt-2"
                                        style="cursor: pointer";
                                        onclick="location.href='{{ env('APP_MAIN_DOMAIN') }}'">
                                </div>
                            </div>

                            <div class="card bg-transparent border-0">
                                @if (session()->has('success') && session('status') === 'submitted')
                                    <div class="mt-4 d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{ asset('frontend/images/done.png') }}" alt=""
                                            width="80px">
                                        <h5 class="text-center mt-3">{{ session('success') }}
                                        </h5>

                                        <div class="d-flex">
                                            <a href="{{ route('expo.expo-ticket', ['unique_id' => $expo->unique_id, 'ticket_no' => session('expoData')['id']]) }}"
                                                class="mt-2 me-2 btn btn-tertiary-bg" target="_blank">
                                                View Ticket
                                            </a>
                                            <a href="{{ route('expo.sign-up', ['unique_id' => $expo->unique_id]) }}"
                                                class="mt-2 me-2 btn btn-primary-bg">
                                                Register Another
                                            </a>
                                            <a href="{{ route('expo.login.page', ['unique_id' => $expo->unique_id]) }}"
                                                class="mt-2 me-2 btn btn-primary-bg">
                                                Login
                                            </a>
                                            <a href="{{ route('expo.details', ['id' => $expo->unique_id]) }}"
                                                class="mt-2 btn btn-secondary-bg">
                                                Explore Now
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="card-body">
                                        <div class="step-indicator">
                                            <div class="step-item active-step">
                                                <span class="step-number">1</span>
                                                <div class="step-text">Email Verification</div>
                                            </div>
                                            <div class="step-item">
                                                <span class="step-number">2</span>
                                                <div class="step-text">Fill in the Information</div>
                                            </div>
                                            <div class="step-item">
                                                <span class="step-number">3</span>
                                                <div class="step-text">Registered Successfully</div>
                                            </div>
                                        </div>

                                        <form id="regForm"
                                            action="{{ route('expo.sign-up.submit', ['unique_id' => $expo->unique_id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <!-- Step 1 -->
                                            <div class="step active">
                                                <div class="form-group row mt-2">
                                                    <label for="email" class="col-md-3 col-form-label">
                                                        <span class="text-danger">*</span>
                                                        Email:</label>
                                                    <div class="col-md-9">
                                                        <input type="email" class="form-control form-control-lg"
                                                            id="email" name="email" required
                                                            placeholder="Enter your email">
                                                        @error('email')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div class="invalid-feedback">
                                                            Please provide a valid email address.
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mt-2">
                                                    <label for="verificationImage" class="col-md-3 col-form-label">
                                                        <span class="text-danger">*</span>
                                                        Captcha:</label>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control form-control-lg"
                                                            id="verificationImage" required
                                                            placeholder="Enter CAPTCHA">
                                                        <div class="invalid-feedback">
                                                            Please fill the CAPTCHA code
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 d-flex align-items-center">
                                                        <img src="{{ url('/captcha') }}" alt="CAPTCHA"
                                                            class="captcha-image" id="captchaImage"
                                                            onclick="this.src='{{ url('/captcha') }}?'+Math.random();">
                                                    </div>
                                                </div>

                                                {{-- <div class="form-group row mt-2 align-items-center">
                                                    <label for="verificationCode" class="col-md-3 col-form-label">
                                                        <span class="text-danger">*</span>
                                                        Verification Code:</label>
                                                    <div class="col-md-9 d-flex align-items-center">
                                                        <input type="text" class="form-control form-control-lg me-2"
                                                            id="verificationCode" required style="flex: 1;"
                                                            placeholder="Enter verification code">
                                                        <button type="button" class="btn btn-danger-bg"
                                                            id="sendCodeBtn"
                                                            style="white-space: nowrap; height:48px;">Send
                                                            Code</button>
                                                    </div>
                                                </div> --}}

                                                <div class="row justify-content-between mt-4">
                                                    <div class="col-6">
                                                        <a href="{{ route('expo.login.page', ['unique_id' => $expo->unique_id]) }}"
                                                            class="btn btn-primary-bg">Login</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <button type="button"
                                                            class="btn btn-secondary-bg nextBtn">Next</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Step 2 -->
                                            <div class="step">
                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label mb-2">Upload Photo</label>
                                                            <div class="dropify-wrapper" style="border: none">
                                                                <input type="file" class="dropify" name="photo"
                                                                    accept="image/*" id="photo_upload">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-sm-6 d-flex justify-content-center align-items-center">
                                                        <div class="px-3 pe-0">
                                                            <img src="{{ asset('frontend/images/No-image.jpg') }}"
                                                                alt="" class="img-fluid"
                                                                style="border-radius: 10px; max-height: 150px !important;"
                                                                id="icon_preview">
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <!-- ID Type -->
                                                <div class="form-group row mt-2">
                                                    <label for="id_type" class="col-md-3 col-form-label">
                                                        <span class="text-danger">*</span> ID Type:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <select name="id_type" id="id_type"
                                                            class="form-control form-control-lg">
                                                            <option value="">Select an option</option>
                                                            <option value="Passport">Passport</option>
                                                            <option value="ID/NID">ID/NID</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select an ID Type.</div>
                                                    </div>
                                                </div>

                                                <!-- ID Number -->
                                                <div class="form-group row mt-2">
                                                    <label for="id_no" class="col-md-3 col-form-label">
                                                        <span class="text-danger">*</span> ID No.:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="id_no" name="id_no"
                                                            class="form-control form-control-lg"
                                                            placeholder="Enter your ID number">
                                                        <div class="invalid-feedback">Please provide your ID number.
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                <!-- First Name -->
                                                <div class="form-group row mt-2">
                                                    <label for="first_name" class="col-md-3 col-form-label">
                                                        <span class="text-danger">*</span> First Name:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="first_name" name="first_name"
                                                            class="form-control form-control-lg"
                                                            placeholder="Enter your first name">
                                                        <div class="invalid-feedback">Please provide your first name.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Last Name -->
                                                <div class="form-group row mt-2">
                                                    <label for="last_name" class="col-md-3 col-form-label">
                                                        <span class="text-danger">*</span> Last Name:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="last_name" name="last_name"
                                                            class="form-control form-control-lg"
                                                            placeholder="Enter your last name">
                                                        <div class="invalid-feedback">Please provide your last name.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Nationality -->
                                                <div class="form-group row mt-2">
                                                    <label for="nationality" class="col-md-3 col-form-label">
                                                        Nationality:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="nationality" name="nationality"
                                                            class="form-control form-control-lg"
                                                            placeholder="Enter your nationality">
                                                        <div class="invalid-feedback">Please provide your nationality.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Sex -->
                                                <div class="form-group row mt-2">
                                                    <label for="sex" class="col-md-3 col-form-label">
                                                        <span class="text-danger">*</span> Sex:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <select id="sex" name="sex"
                                                            class="form-control form-control-lg">
                                                            <option value="">Select an option</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select your sex.</div>
                                                    </div>
                                                </div>

                                                <!-- Date of Birth -->
                                                <div class="form-group row mt-2">
                                                    <label for="dob" class="col-md-3 col-form-label">
                                                        <span class="text-danger">*</span> Date of Birth:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="date" id="dob" name="dob"
                                                            class="form-control form-control-lg">
                                                        <div class="invalid-feedback">Please select your date of birth.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Phone -->
                                                <div class="form-group row mt-2">
                                                    <label for="phone" class="col-md-3 col-form-label">
                                                        <span class="text-danger">*</span> Contact Number:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="phone" name="phone"
                                                            class="form-control form-control-lg"
                                                            placeholder="Enter your contact number">
                                                        <div class="invalid-feedback">Please provide a valid contact
                                                            number.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Profession -->
                                                <div class="form-group row mt-2">
                                                    <label for="profession" class="col-md-3 col-form-label">
                                                        Profession:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="profession" name="profession"
                                                            class="form-control form-control-lg"
                                                            placeholder="Enter your profession">
                                                        <div class="invalid-feedback">Please provide a valid
                                                            profession.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Name of Institution/Organization -->
                                                <div class="form-group row mt-2">
                                                    <label for="institution" class="col-md-3 col-form-label">
                                                        Institution /Organization: </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="institution" name="institution"
                                                            class="form-control form-control-lg"
                                                            placeholder="Enter the name of your institution">
                                                        <div class="invalid-feedback">Please provide a valid
                                                            institution
                                                            name.
                                                        </div>
                                                        </input>
                                                    </div>
                                                </div>
                                                <!-- Interested Program -->
                                                <div class="form-group row mt-2">
                                                    <label for="program" class="col-md-3 col-form-label">
                                                        Interested Program:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="program" name="program"
                                                            class="form-control form-control-lg"
                                                            placeholder="Enter the interested program">
                                                        <div class="invalid-feedback">Please provide a valid
                                                            program
                                                            name.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Interested Degree -->
                                                <div class="form-group row mt-2">
                                                    <label for="degree" class="col-md-3 col-form-label">
                                                        Interested Degree:
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="degree" name="degree"
                                                            class="form-control form-control-lg"
                                                            placeholder="Enter the interested degree">
                                                        <div class="invalid-feedback">Please provide a valid degree
                                                            name.
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Password -->
                                                <div class="form-group row mt-2">
                                                    <label for="password" class="col-md-3 col-form-label"><span
                                                            class="text-danger">*</span>Password:</label>
                                                    <div class="col-md-9">
                                                        <input type="password" id="password" name="password"
                                                            class="form-control form-control-lg" required
                                                            placeholder="Enter your password">
                                                        <div class="invalid-feedback">Please provide a valid
                                                            password.
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Confirm Password -->
                                                <div class="form-group row mt-2">
                                                    <label for="confirm_password"
                                                        class="col-md-3 col-form-label"><span
                                                            class="text-danger">*</span>Confirm Password:</label>
                                                    <div class="col-md-9">
                                                        <input type="password" id="confirm_password"
                                                            name="confirm_password"
                                                            class="form-control form-control-lg"
                                                            placeholder="Confirm your password">
                                                        <div class="invalid-feedback">Passwords do not match.</div>
                                                    </div>
                                                </div>

                                                <!-- Navigation Buttons -->
                                                <div class="row justify-content-between mt-4">
                                                    <div class="col-6">
                                                        <a href="{{ route('expo.login.page', ['unique_id' => $expo->unique_id]) }}"
                                                            class="btn btn-primary-bg">Login</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <button type="button"
                                                            class="btn btn-primary-bg prevBtn">Previous</button>
                                                        <button type="button"
                                                            class="btn btn-secondary-bg nextBtn">Next</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Step 3 -->
                                            <div class="step">
                                                <div class="form-group row mt-2">
                                                    <div class="col-md-12">
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input me-2" type="checkbox"
                                                                id="agreeTerms" required>
                                                            <label class="form-check-label" for="agreeTerms">
                                                                I agree to the <a
                                                                    href="https://malishaedu.com/terms-conditions">terms
                                                                    and conditions</a>.
                                                            </label>
                                                            <div class="invalid-feedback">
                                                                You must agree to the terms and conditions before
                                                                submitting.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Navigation Buttons -->
                                                <div class="row justify-content-between mt-4">
                                                    <div class="col-6">
                                                        <a href="{{ route('expo.login.page', ['unique_id' => $expo->unique_id]) }}"
                                                            class="btn btn-primary-bg">Login</a>
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <button type="button"
                                                            class="btn btn-primary-bg prevBtn">Previous</button>
                                                        <button type="submit"
                                                            class="btn btn-secondary-bg">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Expo.components.footer')

    <script src="{{ asset('backend/lib/select2/js/select2.min.js') }}"></script>

    <script>
        /* $('select').select2({
                                                        placeholder: 'Select an option'
                                                    }); */

        $('#photo_upload').on('change', function(e) {
            var fileInput = $(this)[0];

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#icon_preview').attr('src', e.target.result);
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            var currentStep = 0;
            showStep(currentStep);

            function showStep(step) {
                $(".step").removeClass("active");
                $(".step").eq(step).addClass("active");
                $(".step-item").removeClass("active-step");
                $(".step-item").eq(step).addClass("active-step");
            }

            $(".nextBtn").click(function() {
                if (validateForm()) {
                    // var verificationCode = $("#verificationCode").val().trim();
                    var captchaInput = $("#verificationImage").val().trim();

                    var password = $("#password").val().trim();
                    var confirmPassword = $("#confirm_password").val().trim();

                    // Check if both password fields are filled
                    if (password !== "" || confirmPassword !== "") {
                        if (password === "") {
                            $("#password").addClass("is-invalid");
                        } else {
                            $("#password").removeClass("is-invalid");
                        }

                        if (confirmPassword === "") {
                            $("#confirm_password").addClass("is-invalid");
                        } else {
                            $("#confirm_password").removeClass("is-invalid");
                        }

                        // Check if passwords match only if both fields are filled
                        if (password !== "" && confirmPassword !== "" && password !== confirmPassword) {
                            $("#password").addClass("is-invalid");
                            $("#confirm_password").addClass("is-invalid");
                            return; // Prevent proceeding to the next step
                        }
                    }

                    // If all validations pass, remove invalid classes before making AJAX calls
                    $("#password").removeClass("is-invalid");
                    $("#confirm_password").removeClass("is-invalid");

                    // Validate CAPTCHA and OTP code
                    $.ajax({
                        type: "POST",
                        url: "/verify-captcha",
                        data: {
                            captcha: captchaInput,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.valid) {
                                currentStep++;
                                showStep(currentStep);

                                /* $.ajax({
                                    type: "POST",
                                    url: "/verify-code",
                                    data: {
                                        verification_code: verificationCode,
                                        _token: $('meta[name="csrf-token"]').attr(
                                            'content')
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            currentStep++;
                                            showStep(currentStep);
                                        } else {
                                            $("#verificationCode").addClass(
                                                "is-invalid");
                                            alert(response.message);
                                        }
                                    },
                                    error: function(xhr) {
                                        alert('Error verifying the code.');
                                    }
                                }); */
                            } else {
                                $("#verificationImage").addClass("is-invalid");
                                alert('Invalid CAPTCHA. Please try again.');
                            }
                        },
                        error: function(xhr) {
                            alert(xhr.responseJSON.message);
                        }
                    });

                    /* $.ajax({
                        type: "POST",
                        url: "/verify-code",
                        data: {
                            verification_code: verificationCode,
                            _token: $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        success: function(response) {
                            if (response.success) {
                                currentStep++;
                                showStep(currentStep);
                            } else {
                                $("#verificationCode").addClass(
                                    "is-invalid");
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            alert(xhr.responseJSON.message);
                        }
                    }); */
                }
            });

            $(".prevBtn").click(function() {
                currentStep--;
                showStep(currentStep);
            });

            function validateForm() {
                var inputs = $(".step").eq(currentStep).find("input");
                var valid = true;

                inputs.each(function() {
                    if ($(this).attr("required") && !$(this).val()) {
                        valid = false;
                        $(this).addClass("is-invalid");
                    } else {
                        $(this).removeClass("is-invalid");
                    }
                });

                return valid;
            }

            /* submit the form */
            $("#regForm").on("submit", function(e) {
                e.preventDefault();

                var password = $("#password").val().trim();
                var confirmPassword = $("#confirm_password").val().trim();
                var isValid = true;

                $("#password, #confirm_password").removeClass("is-invalid");

                if (password === "") {
                    $("#password").addClass("is-invalid");
                    isValid = false;
                }

                if (password !== confirmPassword) {
                    $("#confirm_password").addClass("is-invalid");
                    isValid = false;
                }

                if (password.length < 8) {
                    $("#password").addClass("is-invalid");
                    alert("Password must be at least 8 characters long.");
                    isValid = false;
                }

                if (!$("#agreeTerms").is(":checked")) {
                    $("#agreeTerms").addClass("is-invalid");
                    isValid = false;
                }

                if (isValid) {
                    this.submit();
                } else {
                    alert("Please fix the errors in the form.");
                }
            });

            $("#captchaImage").on("click", function() {
                $(this).attr("src", "/captcha?" + new Date().getTime());
            });

            /* $('#sendCodeBtn').on('click', function() {
                var email = $('#email').val().trim();

                if (email === '') {
                    $('#email').addClass('is-invalid');
                    return;
                } else {
                    $('#email').removeClass('is-invalid');
                }

                var $button = $(this);
                $button.prop('disabled', true).text('Sending...');

                $.ajax({
                    url: '/send-verification-email',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        email: email
                    }),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.success) {
                            $button.text('Sent!');
                        } else {
                            alert('Error sending email: ' + data.message);
                            console.error('Error:', data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('An unexpected error occurred. Please try again later.');
                    },
                    complete: function() {
                        setTimeout(function() {
                            $button.prop('disabled', false).text('Send Code');
                        }, 2000);
                    }
                });
            }); */
        });
    </script>
</body>

</html>
