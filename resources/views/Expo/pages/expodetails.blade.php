@extends('Frontend.layouts.master-layout')
@section('title', ' - Expo Details')
@section('head')
    <style>
        .service-card,
        .main-service-card {
            border-radius: 8px;
            overflow: hidden;
            background-color: #166D4D0A;
            border: 0;
        }

        .main-service-card img {
            width: 30%;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }

        .main-service-card p {
            font-size: 1rem;
            line-height: 1.5;
            height: 3rem;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 0;
        }

        .service-card img {
            height: 250px !important;
            object-fit: cover;
        }

        .card-text {
            font-size: 1rem;
            line-height: 1.5;
            height: 3rem;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .guest-card .team_info {
            width: 300px;
            box-sizing: border-box;
            border-radius: 8px;
            border: 0.5px solid #f4f4f4;
            transition: 0.5s;
        }

        .guest-card .team_info:hover {
            box-shadow: 0px 0px 60px -15px rgba(100, 100, 100, 0.25);
        }

        .guest-card .d-flex {
            justify-content: center;
        }

        .instructor_footer_social_container a {
            background-color: var(--btn_primary_color);
            margin-left: 8px;
            padding: 8px;
            border-radius: 50%;
            transition: 0.3s;
            text-align: center !important;
            border-style: solid;
            border-width: 2px 2px 2px 2px;
            border-color: #FFFFFF1A;
        }

        .instructor_footer_social_container a:hover {
            background-color: var(--secondary_background);
            animation-name: footer-animation-push;
            animation-duration: .3s;
            animation-timing-function: linear;
            animation-iteration-count: 1;
        }

        .instructor_footer_social_container a svg {
            fill: white;
        }

        .instructor_footer_social_container a:hover>svg {
            fill: white;
        }

        @keyframes footer-animation-push {
            50% {
                transform: scale(0.8)
            }

            100% {
                transform: scale(1)
            }
        }

        .media-vidoe-preview {
            width: 100%;
            border-radius: 8px;
        }

        @media screen and (min-width:768px) {
            .media-vidoe-preview {
                width: 97%;
            }
        }

        .category-banner {
            position: relative;
            height: 45vh !important;
            background-image: url(@json($expo->banner));
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 8px;
        }

        .category-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0, 29, 18, 0.7) 0%, rgba(15, 29, 65, 0.35) 100%);
            z-index: 0;
            border-radius: inherit;
        }

        .content_search {
            margin-top: 3.5rem;
        }

        /* @media screen and (min-width:391px) {
            .content_search {
                margin-top: 6rem;
            }
        } */
    </style>

    {{-- <!-- Slick CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"> --}}

    <!-- LightGallery CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery.js/2.4.0/css/lightgallery.min.css">

    <style>
        .office-image-slider {
            width: 100%;
            max-width: 100%;
        }

        .office-image-slider .thumbnail-container {
            margin: 0 5px;
        }

        .office-image-slider .thumbnail-container img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 8px;
            object-fit: contain;
            object-position: center;
        }

        @media (max-width: 768px) {
            .office-image-slider .thumbnail-container {
                margin: 0 5px;
            }
        }

        @media (max-width: 576px) {
            .office-image-slider .thumbnail-container {
                margin: 0 3px;
            }
        }
    </style>
@endsection
@section('main_content')

    <div class="content_search">
        <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/blog.css"
            rel="stylesheet">
        <div class="bg-alice-blue pt-5">
            <div class="container-xl mt-3 mt-lg-0">
                <div class="row justify-content-center">

                    <div class="col-12">
                        <!--Start Category Banner-->
                        <div
                            class="category-banner d-flex flex-column justify-content-center align-items-center position-relative text-white px-4 py-5 px-sm-5 mb-4">
                            <div class="py-2 px-3 py-lg-4 px-lg-5 position-relative"
                                style="background-color: #0000003d; border-radius:8px;">
                                <h4 class="fw-bold fs-1 text-center" style="color: #fff">
                                    {{ $expo->title }}</h4>
                                <h4 class="fs-6 fw-bold text-center" style="color: #fff">Venue:
                                    {{ $expo->place }}</h4>
                            </div>
                            <div class="mt-2 py-2 px-2 px-md-4 position-relative d-flex justify-content-center align-items-center"
                                style="background-color: #068b7779; border-radius:8px;">
                                <h6 class="fw-semi-bold text_bluish-black mb-0" style="color: #fff">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    {{ Carbon\Carbon::createFromFormat('d M Y h:i A', str_replace(',', '', $expo->datetime))->format('d M, Y') }}
                                </h6>
                                <span class="mx-4 middle_border" style="background-color: #fff"></span>
                                <h6 class="fw-semi-bold text_bluish-black mb-0" style="color: #fff">
                                    <i class="fa fa-clock" aria-hidden="true"></i>
                                    {{ Carbon\Carbon::createFromFormat('d M Y h:i A', str_replace(',', '', $expo->datetime))->format('h:i A') }}
                                </h6>
                            </div>
                        </div>
                        <!--End Category Banner-->
                    </div>

                    <div class="col-lg-8">
                        @php
                            $guests = json_decode($expo->guests, true) ?? [];
                        @endphp

                        @if ($guests)
                            <div class="row">
                                <div class="row justify-content-start">
                                    <h4 class="fs-5 fw-bold mt-4 mb-1" style="color: var(--btn_primary_color)">
                                        Our Honourable Guest(s)
                                    </h4>

                                    @forelse ($guests as $guest)
                                        <div class="guest-card col-md-6 col-lg-4">
                                            <div class="d-flex px-22 py-3">
                                                <div class="bg-white d-block team_info p-3">
                                                    <div class="text-center">
                                                        <img src="{{ $guest['image'] ?? asset('frontend/images/no-profile.jpg') }}"
                                                            alt="" class="rounded-circle mx-auto w-auto"
                                                            style="height:130px; width:130px">
                                                    </div>
                                                    <div class="d-block my-4">
                                                        <h3 class="text-center" style="color: var(--text_color)">
                                                            {{ $guest['name'] }}
                                                        </h3>
                                                    </div>
                                                    <div class="text-center">
                                                        {{ $guest['designation'] }}
                                                        <br>
                                                        {{ $guest['organization'] }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center text-dark">
                                            No Guest Found!
                                        </p>
                                    @endforelse
                                </div>
                            </div>
                        @endif

                        @if ($expo->universities)
                            <div class="row">
                                <h4 class="fs-5 fw-bold mt-4 mb-2" style="color: var(--btn_primary_color)">Participated
                                    Universities</h4>

                                <div class="row justify-content-start">
                                    @forelse ($expo->universities() as $item)
                                        <div class="col-6 col-md-4 col-lg-4 mb-4">
                                            <div class="card main-service-card">
                                                <div class="card-body"
                                                    style="padding: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                                    <img src="{{ $item->image_show }}" alt="{{ $item['name'] }}">
                                                    <p class="text-muted">
                                                        {{ $item['name'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center text-dark">
                                            No University Found!
                                        </p>
                                    @endforelse
                                </div>
                            </div>
                        @endif

                        @if ($expo->media_partner)
                            <div class="row">
                                <h4 class="fs-5 fw-bold mt-4 mb-2" style="color: var(--btn_primary_color)">
                                    Media Partner
                                </h4>

                                @php
                                    $mediaPartner = json_decode($expo->media_partner, true);
                                @endphp
                                <div class="row justify-content-start">
                                    @foreach ($mediaPartner as $image)
                                        <div class="col-md-4 col-lg-3 mb-4 px-0">
                                            <img src="{{ $image }}" alt="media-partner-logo-{{ $loop->iteration }}"
                                                class="img-fluid mx-2 "
                                                style="margin-left:0; border-radius: 8px; width:90%">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($expo->description)
                            <div class="row">
                                <h4 class="fs-5 fw-bold mt-4 mb-2" style="color: var(--btn_primary_color)">
                                    Expo Description
                                </h4>

                                <div class="col-12 ckeditor5-rendered">
                                    {!! $expo->description !!}
                                </div>
                            </div>
                        @endif

                        @if ($expo->photos || $expo->videos)
                            <div>
                                <h4 class="fs-5 fw-bold mt-4 mb-2" style="color: var(--btn_primary_color)">
                                    Media Gallery
                                </h4>

                                @if ($expo->videos)
                                    <div class="d-flex justify-content-start mb-3">
                                        <video src="{{ json_decode($expo->videos, true)[0] ?? '' }}"
                                            class="media-vidoe-preview" controls></video>
                                    </div>
                                @endif

                                @if ($expo->photos)
                                    {{-- <section class="footer_showcase d-flex mb-2">
                                        <div class="row justify-content-start px-2 office-image-slider" id="lightGallery">
                                            @foreach (json_decode($expo->photos, true) as $index => $image)
                                                <div class="thumbnail-container">
                                                    <a href="{{ $image }}" data-src="{{ $image }}"
                                                        class="thumbnail-container">
                                                        <div style="height: 200px; border-radius: 8px; overflow: hidden;"
                                                            class="d-flex align-items-center justify-content-center">
                                                            <img src="{{ $image }}" alt=""
                                                                class="img-fluid">
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </section> --}}
                                    <section class="footer_showcase d-flex mt-4">
                                        <div id="lightgallery" class="row justify-content-start px-2">
                                            @foreach (json_decode($expo->photos, true) as $index => $image)
                                                <div class="col-6 col-md-4 col-lg-3 mb-2">
                                                    <a href="{{ $image }}" data-src="{{ $image }}"
                                                        class="thumbnail-container">
                                                        <div style="/* height: 235px; */ border-radius: 8px; overflow: hidden;"
                                                            class="d-flex align-items-center justify-content-center mx-2">
                                                            <img src="{{ $image }}" alt="expo-image-{{ $index }}"
                                                                class="img-fluid w-100">
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </section>

                                    <script>
                                        lightGallery(document.getElementById('lightgallery'), {
                                            thumbnail: true,
                                            zoom: true,
                                            toggleThumb: true,
                                            selector: '.thumbnail-container',
                                        });
                                    </script>
                                @endif
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

{{-- @section('script')
    <!-- Slick JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <!-- LightGallery JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery.js/2.4.0/lightgallery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery.js/2.4.0/plugins/lg-thumbnail.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery.js/2.4.0/plugins/lg-zoom.min.js"></script>

    <script>
        $('.office-image-slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: true,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2
                    }
                }
            ]
        });

        // Initialize lightGallery after Slick slider
        lightGallery(document.getElementById('lightGallery'), {
            selector: '.thumbnail-container a',
            plugins: [lgZoom, lgThumbnail],
            mobileSettings: {
                controls: true,
                showCloseIcon: true,
                download: true,
                rotate: false
            }
        });
    </script>
@endsection --}}
