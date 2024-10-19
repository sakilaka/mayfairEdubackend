<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Overseas Delegates of '{{ $expo->title }}'</title>
    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">


    @php
        $additional_contents = json_decode($expo->additional_contents, true) ?? [];
    @endphp
</head>

<body>

    <div class="bg-section" style="height:auto;">
        <div class="container">
            <nav class="navbar navbar-expand-md shadow-none" style="z-index: 3">
                <div class="container d-flex justify-content-between">
                    <a class="navbar-brand" href="{{ route('expo.details', ['id' => $expo->unique_id]) }}">
                        <img src="{{ $additional_contents['nav_logo'] ?? '' }}" alt="Logo" class="logo">
                    </a>

                    @include('Expo.components.navbar')
                </div>
            </nav>
        </div>

        {{-- <div class="layer-image"></div> --}}
        <div class="bg-color"></div>
    </div>

    <section class="university-highlights my-5">
        <div class="container">
            <div class="text-start">
                <h2 class="section-title d-inline">Overseas Delegates of</h2>
                <h4 class="section-title d-inline ms-2 fs-4">{{ $expo->title }}</h4>
            </div>

            <div class="row justify-content-between align-items-center mt-5 mx-auto">
                @php
                    $delegates = json_decode($expo->delegates, true) ?? [];
                @endphp

                <div class="col-12 mt-2">
                    <p class="text-center fw-bold"
                        style="color:var(--primary_background); font-family: 'DM Sans', sans-serif;font-size:1.5rem;font-weight:500;">
                        What Our Overseas Delegates Are Saying
                    </p>
                    <div class="row delegates-slick-carousel slick-slider">
                        @foreach ($delegates as $delegate)
                            <div class="d-lg-flex flex-lg-column col-md-6 col-lg-4 justify-content-center p-2">
                                <div class="testimonial-single-card bg-white p-3">
                                    <div class="d-flex justify-content-center">
                                        <img class="testimonial-user-img"
                                            src="{{ $delegate['photo'] ?? asset('frontend/images/no-profile.jpg') }}"
                                            alt="" style="border-radius:10px;">
                                    </div>

                                    <div style="height: 70px">
                                        <p class="mb-0 fw-bold mt-2 text-center"
                                            style="font-size: 1.25rem; font-family: 'DM Sans', sans-serif !important;">
                                            {{ $delegate['name'] }}
                                        </p>
                                        <p class="mb-0 text-center"
                                            style="font-size: 0.9rem; font-family: 'DM Sans', sans-serif;">
                                            {{ $delegate['designation'] }}
                                        </p>
                                    </div>

                                    <div class="my-2 mt-3">
                                        <img src="{{ asset('frontend/images/left-quotes-sign.png') }}" alt=""
                                            style="width:1rem">
                                    </div>
                                    <div class="testimonial-content">
                                        @php
                                            $description = strip_tags($delegate['description']);
                                        @endphp
                                        <p class="mb-0 ckeditor5-rendered testimonial-comment"
                                            data-full-comment="{{ $description }}">
                                            {!! $description !!}
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
