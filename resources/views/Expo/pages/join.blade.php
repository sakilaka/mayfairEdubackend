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

            <div class="row justify-content-between align-items-center flex-row-reverse flex-md-row mt-5 mx-auto">
                <div class="col-md-9">
                    <ol class="list-decimal list-inside" style="font-size: 18px;">
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet
                            consectetur, adipisicing elit. Alias, impedit.</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet
                            consectetur, adipisicing elit. Alias, impedit.</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet
                            consectetur, adipisicing elit. Alias, impedit.</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
