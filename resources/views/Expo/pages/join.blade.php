<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Join With Us</title>
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
                <h2 class="section-title d-inline">How to join us:</h2>
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
                        
                    </div>
                </div>
            </div>

        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
