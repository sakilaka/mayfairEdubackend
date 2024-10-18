<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Overseas Delegates of '{{ $expo->title }}'</title>
    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">
    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/slick-theme.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/slick.css') }}">

    @php
        $additional_contents = json_decode($expo->additional_contents, true) ?? [];
    @endphp

    <style>
        blockquote .testimonial-description::-webkit-scrollbar {
            width: 3px;
        }

        blockquote .testimonial-description::-webkit-scrollbar-track {
            background: #e0e0e0;
        }

        blockquote .testimonial-description::-webkit-scrollbar-thumb {
            background-color: #28a74648;
            border-radius: 10px;
        }

        blockquote .testimonial-description::-webkit-scrollbar-thumb:hover {
            background-color: #218838;
        }
    </style>

    <style>
        @media screen and (min-width:1199px) {
            .testimonial-title-border {
                position: relative;
            }
        }

        .testimonial-user-img {
            border-radius: 50% !important;
            object-position: center !important;
            padding: 3px;
            background-color: var(--primary_background);
        }

        @media screen and (max-width:767px) {
            .testimonial-user-img {
                width: 8em !important;
                height: 8em !important;

            }
        }

        @media screen and (max-width:991px) {
            .testimonial-user-img {
                width: 10em !important;
                height: 10em !important;
            }
        }

        @media screen and (min-width:992px) {
            .testimonial-user-img {
                width: 13em !important;
                height: 13em !important;
            }
        }

        .testimonial-cards.slick-slide {
            margin: 0 20px !important;
            text-align: center !important;
        }

        .testimonial-single-card {
            background-color: #f2f8f19e;
            border-radius: 10px;
            box-shadow: 0 2px 5px -3px rgba(54, 54, 54, 0.5);
            /* height: 575px; */
            /* overflow: auto; */
            /* position: relative; */
        }

        .testimonial-content {
            position: relative;
            height: 250px;
            overflow-y: auto !important;
        }

        .testimonial-content::-webkit-scrollbar {
            width: 3px;
        }

        .testimonial-content::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .testimonial-content::-webkit-scrollbar-thumb {
            background-color: #ddd;
            border-radius: 10px;
        }

        .testimonial-content .more-text {
            display: none;
            color: #333;
        }

        .see-more-btn-container {
            background-color: #f2f8f19e;
            border-radius: 0 0 10px 10px;
            text-align: center;
            padding: 0.5rem;
        }

        .see-more-btn {
            background-color: transparent;
            border: none;
            color: var(--secondary_background);
            cursor: pointer;
            font-size: 1rem;
            font-family: 'DM Sans', sans-serif;
        }
    </style>
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
                <h2 class="section-title d-inline">Overseas Delegates of</h2>
                <h4 class="section-title d-inline ms-2 fs-4">{{ $expo->title }}</h4>
            </div>

            <div class="row justify-content-between align-items-center mt-5 mx-auto">
                @php
                    $delegates = json_decode($expo->testimonials, true) ?? [];
                @endphp

                {{-- @foreach ($delegates as $delegate)
                    <div class="col-md-6 px-md-3 mt-3">
                        <div
                            class="row align-items-start justify-content-center border border-success border-3 border-top-0 border-start-0 rounded">
                            <div class="col-md-3">
                                <img src="{{ $delegate['photo'] ?? asset('frontend/images/no-profile.jpg') }}"
                                    alt="" class="img-fluid rounded-circle border border-3 border-success"
                                    width="150">
                            </div>

                            <div class="col-md-9 mt-3 mt-md-0">
                                <blockquote class="blockquote border-start-0 mb-0 px-2">
                                    <div class="mb-0 text-muted testimonial-description"
                                        style="font-size: 16px; max-height: 120px; overflow-y:auto;">
                                        {!! $delegate['description'] !!}
                                    </div>
                                    <footer class="blockquote-footer my-2" style="font-size: 16px">
                                        <strong>{{ $delegate['name'] }}</strong>,
                                        <cite title="{{ $delegate['designation'] }}">
                                            {{ $delegate['designation'] }}
                                        </cite>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                @endforeach --}}

                <div class="col-12 mt-3">
                    <p class="text-center fw-bold"
                        style="color:var(--primary_background); font-family: 'DM Sans', sans-serif;font-size:1.5rem;font-weight:500;">
                        What Our Partners Are Saying
                    </p>
                    <div class="row testimonial-cards-partners slick-slider">
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

    <script src="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/js/slick-slider.min.js') }}">
    </script>
    <script>
        $('.testimonial-cards-partners').slick({
            slidesToShow: 3,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>
</body>

</html>
