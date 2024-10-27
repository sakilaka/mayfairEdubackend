<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Overseas Delegates of '{{ $expo->title }}'</title>
    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">

    @php
        $additional_contents = json_decode($expo->additional_contents, true) ?? [];
    @endphp

    <style>
        .university-highlights {
            background-image: url('{{ asset('frontend/images/expo-page-bg-blank.jpeg') }}?v={{ rand() }}');
            background-position: top;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            padding: 5rem 0;
        }

        .testimonial-single-card {
            border: 4px solid var(--primary_background);
        }

        .delegate-desc-container::-webkit-scrollbar {
            width: 3px;
        }

        .delegate-desc-container::-webkit-scrollbar-track {
            background: #e0e0e0;
        }

        .delegate-desc-container::-webkit-scrollbar-thumb {
            background-color: #28a74648;
            border-radius: 10px;
        }

        .delegate-desc-container::-webkit-scrollbar-thumb:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

    <div class="bg-section" style="height:auto;">
        <div class="container">
            <nav class="navbar navbar-expand-md shadow-none" style="z-index: 3">
                <div class="container d-flex justify-content-between">
                    <a class="ms-md-4 ps-md-4 navbar-brand" href="{{ route('home') }}">
                        <img src="{{ $additional_contents['nav_logo'] ?? '' }}" alt="Logo" class="logo"
                            style="width: 180px; height:auto;">
                    </a>

                    @include('Expo.components.navbar')
                </div>
            </nav>
        </div>

        {{-- <div class="layer-image"></div> --}}
        <div class="bg-color"></div>
    </div>

    <section class="university-highlights">
        <div class="container">
            <div class="text-start">
                <h2 class="section-title d-inline">Overseas Delegates of</h2>
                <h4 class="section-title d-inline ms-2 fs-4">
                    {{ $additional_contents['pre_title'] . ' ' . $expo->title }}
                </h4>
            </div>

            <div class="row justify-content-between align-items-center mt-5 mx-auto">
                @php
                    $delegates = json_decode($expo->delegates, true) ?? [];
                @endphp

                <div class="col-12 mt-2">

                    <div class="row {{-- delegates-slick-carousel slick-slider --}} mt-3">
                        @foreach ($delegates as $delegate)
                            <div class="d-lg-flex flex-lg-column col-md-4 col-lg-3 justify-content-center p-2">
                                <div class="testimonial-single-card bg-white p-3">
                                    <div class="d-flex justify-content-center">
                                        <img class="testimonial-user-img"
                                            src="{{ $delegate['photo'] ?? asset('frontend/images/no-profile.jpg') }}"
                                            alt=""
                                            style="border-radius:10px; background-color:var(--secondary_background)">
                                    </div>

                                    <div class="delegate-desc-container" style="max-height: 120px; overflow-y:auto;">
                                        <p class="mb-0 fw-bold mt-2 text-center"
                                            style="font-size: 1.25rem; font-family: 'DM Sans', sans-serif !important;">
                                            {!! $delegate['name'] ?? '&nbsp;' !!}
                                        </p>
                                        <p class="mb-0 text-center"
                                            style="font-size: 0.9rem; font-family: 'DM Sans', sans-serif;">
                                            {!! $delegate['designation'] ?? '&nbsp;' !!}
                                        </p>
                                        <p class="mb-0 text-center"
                                            style="font-size: 0.9rem; font-family: 'DM Sans', sans-serif;">
                                            {!! $delegate['organization_name'] ?? '&nbsp;' !!}
                                        </p>
                                        <p class="mb-0 text-center"
                                            style="font-size: 0.9rem; font-family: 'DM Sans', sans-serif;">
                                            {!! $delegate['country'] ?? '&nbsp;' !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
