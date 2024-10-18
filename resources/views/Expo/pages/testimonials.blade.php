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

            <div class="row justify-content-between mt-5">
                @for ($i = 0; $i < 6; $i++)
                    <div class="col-md-6 px-3 mt-3">
                        <div class="row align-items-center border border-3 border-primary rounded">
                            <div class="col-md-3">
                                <img src="{{ asset('frontend/images/no-profile.jpg') }}" alt=""
                                    class="img-fluid rounded-circle border border-3 border-success" width="100">
                            </div>
                            <div class="col-md-9">
                                <blockquote class="blockquote">
                                    <p class="mb-0 text-muted" style="font-size: 16px">
                                        Your testimonial text goes here.
                                    </p>
                                    <footer class="blockquote-footer mt-2">
                                        <strong>Anonymous</strong>,
                                        <cite title="Designation">No Designation</cite>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
