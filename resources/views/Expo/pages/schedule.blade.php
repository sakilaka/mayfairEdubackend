<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Schedule of '{{ $expo->title }}'</title>
    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">

    @php
        $additional_contents = json_decode($expo->additional_contents, true) ?? [];
    @endphp

    <style>
        .university-highlights {
            background-image: url('{{ asset('frontend/images/expo-page-white-bg.jpeg') }}');
            background-position: top;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            padding: 10rem 0;
        }
    </style>
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

    <section class="university-highlights {{-- py-5 --}}">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">Schedule</h2>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-12 ckeditor5-rendered">
                    {!! $additional_contents['schedule'] !!}
                </div>
            </div>

        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
