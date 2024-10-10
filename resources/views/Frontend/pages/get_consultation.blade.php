@extends('Frontend.layouts.master-layout')
@section('title', '- Inquery Form')
@section('head')
    @php
        $header_logo = \App\Models\Tp_option::where('option_name', 'theme_logo')->first();
        $header_logo = $header_logo->header_image == '' ? $header_logo->no_image : $header_logo->header_image_show;
    @endphp
    <style>
        .form-container {
            border-radius: 8px;
            background-color: rgba(245, 246, 255, 0.8);
            background-image: url('{{ $header_logo }}');
            background-repeat: no-repeat;
            background-position: top;
            background-size: 50% auto;
            background-blend-mode: overlay;
        }
    </style>

    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/select2.min.css') }}">

    <style>
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/css/intlTelInput.css">
@endsection
@section('main_content')


    <div class="content_search" style="margin-top:70px">
        <div class="" style="margin-top: 7rem; margin-bottom:3rem">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="row mx-0 align-items-center justify-content-center">

                            @if (session()->has('success') && session('status') === 'submitted')
                                <div class="mt-5 pt-5 d-flex flex-column justify-content-center align-items-center">
                                    <img src="{{ asset('frontend/images/done.png') }}" alt="" width="80px">
                                    <h5 class="text-center mt-3">{{ session('success') }}</h5>

                                    <a href="{{ route('home') }}" class="mt-2 btn btn-primary-bg">
                                        Explore Now
                                    </a>
                                </div>
                            @else
                                <div class="col-md-10 p-4 p-sm-5 mt-5 border form-container">
                                    <h2 class="h3 mb-4 mb-sm-5 text-center" style="font-weight: bold">
                                        Get A Free Consultation
                                    </h2>
                                    <form action="{{ route('frontend.get_consultation_store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">

                                            <div class="col-12 col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label>Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                                                        name="name" placeholder="Enter Full Name"
                                                        value="{{ old('name') }}" required>
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 mt-2">
                                                <div class="form-group d-flex flex-column">
                                                    <label>Phone Number (Whatsapp/WeChat/Telegram/Line)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input id="phone" type="tel"
                                                        class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                                        name="phone" placeholder="{{-- Whatsapp/WeChat/Telegram/Line --}}"
                                                        value="{{ old('phone') }}" required>
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                        name="email" placeholder="Enter Email Address"
                                                        value="{{ old('email') }}">
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label>Interested Major</label>
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('major') is-invalid @enderror"
                                                        name="major" placeholder="Enter Degree"
                                                        value="{{ old('major') }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label>Interested Degree</label>
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('degree') is-invalid @enderror"
                                                        name="degree" placeholder="Enter Degree"
                                                        value="{{ old('degree') }}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label>Last Academic Result</label>
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('result') is-invalid @enderror"
                                                        name="result" placeholder="Enter Result"
                                                        value="{{ old('result') }}">
                                                </div>
                                            </div>

                                            <div class="col-12 mt-5 text-center">
                                                <button type="submit" class="btn btn-primary-bg">Submit</button>
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


    @include('Frontend.layouts.parts.news-letter')

@endsection

@section('script')
    <script src="{{ asset('backend/lib/select2/js/select2.min.js') }}"></script>
    <script>
        $('.select2').select2({
            placeholder: 'Select an option'
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/intlTelInput.min.js"></script>
    <script>
        const input = document.querySelector("#phone");
        window.intlTelInput(input, {
            loadUtilsOnInit: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/utils.js",
        });

        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            input.value = iti.getNumber(); // Get the full phone number with country code
            if (!iti.isValidNumber()) {
                event.preventDefault(); // Stop submission if the number is invalid
                alert("Please enter a valid phone number");
            }
        });
    </script>
@endsection
