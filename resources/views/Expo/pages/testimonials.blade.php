<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Testimonials of '{{ $expo->title }}'</title>
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
                        <img src="{{ $additional_contents['nav_logo'] }}" alt="Logo" class="logo">
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
                <h2 class="section-title d-inline">Testimonials From</h2>
                <h4 class="section-title d-inline ms-2 fs-4">{{ $expo->title }}</h4>
            </div>

            <div class="row justify-content-between align-items-center mt-5">
                @php
                    $testimonials = json_decode($expo->testimonials, true) ?? [];
                @endphp

                @foreach ($testimonials as $testimonial)
                    <div class="col-md-6 px-3 mt-3">
                        <div
                            class="row align-items-start border border-success border-3 border-top-0 border-start-0 rounded">
                            <div class="col-md-3">
                                <img src="{{ $testimonial['photo'] ?? asset('frontend/images/no-profile.jpg') }}"
                                    alt="" class="img-fluid rounded-circle border border-3 border-success"
                                    width="150">
                            </div>
                            <div class="col-md-9" style="max-height: 250px; overflow-y:auto;">
                                <blockquote class="blockquote border-start-0 mb-0 px-2">
                                    <div class="mb-0 text-muted" style="font-size: 16px">
                                        {!! $testimonial['description'] !!}
                                    </div>
                                    <footer class="blockquote-footer mt-2" style="font-size: 16px">
                                        <strong>{{ $testimonial['name'] }}</strong>,
                                        <cite title="{{ $testimonial['designation'] }}">
                                            {{ $testimonial['designation'] }}
                                        </cite>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
