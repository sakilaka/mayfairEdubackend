<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Join With Us</title>
    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">
    
    @php
        $additional_contents = json_decode($expo->additional_contents, true) ?? [];
    @endphp

    <style>
        .custom-numbered-list {
            line-height: 1.6;
            /* Adjust line height for spacing */
        }

        .custom-number {
            font-weight: bold;
            /* Make the number bold */
            display: inline-block;
            /* Align number and text */
            width: 30px;
            /* Set a width for alignment */
        }

        .custom-text {
            display: inline-block;
            /* Keep text inline with numbers */
            margin-left: 5px;
            /* Space between number and text */
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

    <section class="university-highlights my-5">
        <div class="container">
            <div class="text-start">
                <h2 class="section-title d-inline">How to join us:</h2>
            </div>

            <div class="row justify-content-between align-items-center mt-5 mx-auto">
                <div class="col-md-6 order-md-2 text-end">
                    <img src="{{ asset('frontend/images/No-image.jpg') }}" alt="" class="img-fluid"
                        width="250">
                </div>
                <div class="col-md-6 order-md-1" style="font-size: 18px;">
                    <div class="custom-numbered-list">
                        <div class="custom-number">1.</div>
                        <div class="custom-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum
                            dolor sit amet consectetur, adipisicing elit. Alias, impedit.</div>

                        <div class="custom-number">2.</div>
                        <div class="custom-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum
                            dolor sit amet consectetur, adipisicing elit. Alias, impedit.</div>

                        <div class="custom-number">3.</div>
                        <div class="custom-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum
                            dolor sit amet consectetur, adipisicing elit. Alias, impedit.</div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
