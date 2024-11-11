@extends('Frontend.layouts.master-layout')
@section('title', ' - ' . $office->name)
@section('head')
    <style>
        .mapbox iframe {
            width: 100% !important;
            border-radius: 8px;
            box-shadow: 0 0 40px -10px rgba(100, 100, 100, 0.25);
        }

        .branch-table.table tr td,
        .branch-table.table tr th {
            border: 0;
            font-size: 1rem;
        }

        .branch-details p,
        .branch-details a {
            font-size: 1rem !important;
        }

        .media-vidoe-preview {
            width: 100%;
            border-radius: 8px;
        }

        @media screen and (min-width:768px) {
            .media-vidoe-preview {
                width: 80%;
            }
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

    <!-- Slick CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

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
            object-fit: cover;
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

        <div class="bg-alice-blue py-3 py-lg-0">
            <div class="container-lg p-2 p-md-5">
                <div class="row justify-content-center">
                    <h2 class="text-center"
                        style="color: var(--btn_primary_color); font-family:'DM Sans', sans-serif; font-weight:700">
                        {{ $office->name }}
                    </h2>
                    <div class="col-md-12">
                        <div class="bg-alice-blue py-5">
                            <div class="container-fluid branch-details">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6">
                                        <h4 class="fs-5 fw-bold mt-4 mb-2" style="color: var(--btn_primary_color)">
                                            Branch Details
                                        </h4>
                                        <div class="contact_form">
                                            <table class="table branch-table" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <span style="margin-right: 5px">
                                                                <i class="fa fa-map-pin" aria-hidden="true"></i>
                                                            </span>
                                                            <span>
                                                                {{ $office->address . ', ' . $office->city . ', ' . $office->country }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            @foreach (json_decode($office->contact_no, true) as $index => $contact)
                                                                @php
                                                                    $isEmail = filter_var(
                                                                        $contact,
                                                                        FILTER_VALIDATE_EMAIL,
                                                                    );
                                                                @endphp
                                                                <span style="margin-right: 5px">
                                                                    @if ($isEmail)
                                                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                                                    @else
                                                                        <i class="fa fa-phone-square"
                                                                            aria-hidden="true"></i>
                                                                    @endif
                                                                </span>
                                                                <span>
                                                                    {{ $contact }}
                                                                </span>
                                                                @if (!$loop->last)
                                                                    <br>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div>
                                            {!! $office->others !!}
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mapbox">
                                            <div style="width: 100%">
                                                {!! $office->map_link !!}
                                            </div>
                                        </div>
                                    </div>

                                    @if ($office->photos || $office->video)
                                        <div class="col-lg-12">
                                            <h4 class="fs-5 fw-bold mt-4 mb-2" style="color: var(--btn_primary_color)">
                                                Media Gallery
                                            </h4>

                                            @if ($office->video)
                                                <div class="d-flex justify-content-start mb-3">
                                                    <video src="{{ json_decode($office->video, true)[0] }}"
                                                        class="media-vidoe-preview" controls></video>
                                                </div>
                                            @endif

                                            @if ($office->photos)
                                                <section class="footer_showcase d-flex mb-2">
                                                    <div class="row justify-content-start px-2 office-image-slider"
                                                        {{-- id="lightGallery" --}}>
                                                        @foreach (json_decode($office->photos, true) as $index => $image)
                                                            <div class="thumbnail-container">
                                                                <a href="{{ $image }}" data-src="{{ $image }}"
                                                                    class="thumbnail-container">
                                                                    <div style="height: 250px; border-radius: 8px; overflow: hidden;"
                                                                        class="d-flex align-items-center justify-content-center">
                                                                        <img src="{{ $image }}" alt=""
                                                                            class="img-fluid"
                                                                            style="object-fit: cover; object-position: center; width: 100%; height: 100%;">
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </section>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--======== main content close ==========-->


    @include('Frontend.layouts.parts.news-letter')

@endsection

@section('script')
    <!-- Slick JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <!-- LightGallery JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery.js/2.4.0/lightgallery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery.js/2.4.0/plugins/lg-thumbnail.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery.js/2.4.0/plugins/lg-zoom.min.js"></script>

    <script>
        $('.office-image-slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: true,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3
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
@endsection
