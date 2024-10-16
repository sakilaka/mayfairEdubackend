<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Contact Us</title>

    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">
</head>

<body>

    <div class="bg-section" style="height:auto;">
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
    </div>

    <div class="container mt-5">
        <div class="text-center">
            <h2 class="section-title">Contact Us</h2>
        </div>
    </div>

    <section class="my-5">
        <div class="container">
            @php
                $contents = isset($page['contents']) ? json_decode($page['contents']) : '';
            @endphp
            <div class="ckeditor5-rendered">
                {!! $contents ? $contents : '<p class="text-center">No content available.</p>' !!}
            </div>
        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
