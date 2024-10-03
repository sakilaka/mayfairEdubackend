@extends('Frontend.layouts.master-layout')
@section('title', ' - Authorization Letters')
@section('head')
    <style>
        @font-face {
            font-family: 'Lora';
            src: url('{{ asset('fonts/Lora-BoldItalic.ttf') }}') format('truetype');
        }

        .content_search {
            margin-top: 7.5rem;
        }

        @media screen and (min-width:391px) {
            .content_search {
                margin-top: 6rem;
            }
        }

        .company-details-title {
            font-size: 36px;
            font-style: normal;
            font-family: 'DM Sans', sans-serif;
            color: var(--primary_background);
        }

        .details-text {
            font-size: 1.10rem;
            text-align: center;
        }

        #justified-gallery a img.authorization_image {
            /* border-radius: 6px !important; */
        }

        .image-container .single-card-image {
            /* padding: 6px; */
        }

        .image-container .single-card-image>div {
            overflow: hidden;
            border-radius: 8px;
            box-shadow: rgba(0, 0, 0, 0.25) 0px 5px 18px -7px;
            padding: 8px;
            background: rgb(255, 255, 255);
            border: 1px solid transparent;
            transition: 0.4s;
        }

        .image-container .single-card-image>div:hover {
            box-shadow: rgba(0, 0, 0, 0.5) 0px 5px 18px -6px;
            border-color: rgba(35, 124, 58, 0.5);
        }

        .image-container .single-card-image img {
            height: 100%;
            width: 100%;
            border-radius: 8px;
            transition: 0.4s;
        }

        .image-container .single-card-image>div:hover img {
            transform: scale(1.025);
        }

        .image-container .single-card-image .img-title-container {
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 5px;
            width: 100%;
            background-color: rgba(35, 124, 58, 0.5);
        }

        .image-container .single-card-image .img-title-container span {
            color: #fff;
            font-weight: 600;
        }
    </style>

    {{-- <link rel="stylesheet" href="{{ asset('frontend/justifiedGallery/justifiedGallery.min.css') }}"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-zoom.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-thumbnail.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <style>
        .swiper-wrapper {
            display: flex;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            width: auto;
            background-color: #fff;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ddd;
            transition: 0.4s !important;
        }

        .swiper-slide:hover, .swiper-slide-active {
            border-color: var(--secondary_background);
        }

        .slide-content {
            position: relative;
            width: 100%;
            /* max-height: 375px; */
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .swiper-slide img {
            max-width: 100%;
            height: auto;
            object-fit: contain;
            object-position: center;
        }

        .swiper-slide-active {
            transform: scale(1.1);
            opacity: 1;
        }

        .slide-title {
            position: absolute;
            bottom: -40px;
            left: 0;
            width: 100%;
            color: #000;
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
@endsection
@section('main_content')

    <div class="content_search">
        @php
            $contents = json_decode($page['contents'], true) ?? [];
        @endphp

        @foreach ($contents as $key => $lettersSection)
            <div class="letters-section py-5">
                <h2 class="company-details-title py-2 fw-bold text-center">
                    {{ $lettersSection['title'] ?? '' }}
                </h2>

                <div class="container">
                    <p class="text-muted mt-2 px-lg-5 details-text">
                        {{ $lettersSection['description'] ?? '' }}
                    </p>

                    {{-- <div class="row justify-content-center lightGallery-image-container image-container">
                        @php
                            $authorizationLetterImages = $lettersSection['images'] ?? [];
                            $authorizationLetterImagesTitles = $lettersSection['image_titles'] ?? [];
                        @endphp
                        @foreach ($authorizationLetterImages as $key => $image)
                            <div class="col-6 col-md-3 p-2 single-card-image" data-src="{{ $image }}">
                                <div style="height: 100%" class="position-relative">
                                    <a style="cursor: pointer">
                                        <img class="img-fluid authorization_image" src="{{ $image }}"
                                            alt="{{ $authorizationLetterImagesTitles[$key] ?? '' }}">
                                    </a>

                                    @if ($authorizationLetterImagesTitles[$key] ?? [])
                                        <div class="img-title-container">
                                            <span>{{ $authorizationLetterImagesTitles[$key] ?? '' }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div> --}}
                    
                    <div class="swiper-container">
                        <div class="swiper-wrapper lightGallery-image-container">
                            @php
                                $authorizationLetterImages = $lettersSection['images'] ?? [];
                                $authorizationLetterImagesTitles = $lettersSection['image_titles'] ?? [];
                            @endphp
                            @foreach ($authorizationLetterImages as $key => $image)
                                <div class="swiper-slide" data-src="{{ $image }}">
                                    <div class="slide-content">
                                        <img src="{{ $image }}"
                                            alt="{{ $authorizationLetterImagesTitles[$key] ?? '' }}">
                                    </div>
                                    @if ($authorizationLetterImagesTitles[$key] ?? '')
                                        <div class="slide-title">
                                            <span>{{ $authorizationLetterImagesTitles[$key] }}</span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    @include('Frontend.layouts.parts.news-letter')

@endsection

@section('script')
    <script src="{{ asset('frontend/justifiedGallery/jquery.justifiedGallery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/lightgallery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/thumbnail/lg-thumbnail.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.lightGallery-image-container').each(function() {
                lightGallery(this, {
                    plugins: [lgZoom, lgThumbnail],
                    thumbnail: true,
                    selector: '.swiper-slide'
                });
            });
        });
    </script>

    <script>
        var swiper = new Swiper('.swiper-container', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 3,
            spaceBetween: 20,
            coverflowEffect: {
                rotate: 30,
                stretch: 0,
                depth: 10,
                modifier: 1,
                slideShadows: true,
            },
            loop: true,
            loopedSlides: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 3,
                },
                992: {
                    slidesPerView: 5,
                }
            }
        });
    </script>

@endsection
