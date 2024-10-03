@extends('Frontend.layouts.master-layout')
@section('title', ' - Activities')
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
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            color: var(--primary_background);
        }

        .details-text {
            font-size: 1.10rem;
            text-align: center;
        }

        .activity_section {
            background-image: url('{{ asset('frontend/images/activity_bg.webp') }}');
            background-position: bottom center;
            background-size: 800px auto;
            background-repeat: no-repeat;
            margin: 3rem auto;
        }

        .justified-gallery>a {
            box-shadow: rgba(0, 0, 0, 0.5) 0px 3px 20px -5px !important;
            border-radius: 6px !important;
            overflow: hidden;
            transition: 0.45s;
            border: 1px solid none !important;
        }

        .justified-gallery>a>.jg-caption {
            background-color: rgba(35, 124, 58, 0.75) !important;
            font-weight: 600 !important;
            font-size: 1rem !important;
        }

        .justified-gallery>a:hover {
            box-shadow: rgba(0, 0, 0, 0.75) 0px 3px 20px -5px !important;
            border: 1px solid var(--secondary_background) !important;
        }

        .justified-gallery a img {
            transition:  0.45s ease !important;
        }

        .justified-gallery a:hover img {
            transform: scale(1.05) !important;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('frontend/justifiedGallery/justifiedGallery.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-zoom.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-thumbnail.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('main_content')
    @php
        use Illuminate\Support\Facades\File;
    @endphp

    <div class="content_search">
        <h2 class="company-details-title py-2 fw-bold text-center pt-5 pb-3">
            {{ env('APP_NAME') }} Activities
        </h2>

        <div class="container">
            @php
                $contents = [];
                if ($page && $page['contents']) {
                    $contents = json_decode($page->contents, true);
                }
            @endphp

            @forelse ($contents as $key => $content)
                <div class="activity_section">
                    <div class="text-center">
                        <p class="mb-0" style="color: var(--secondary_background); font-weight:800;">
                            {{ $content['date'] }}
                        </p>
                        <span class="company-details-title">
                            {{ $content['title'] }}
                        </span>

                    </div>
                    <p class="text-muted mt-2 px-lg-5 details-text">
                        {{ $content['description'] }}
                    </p>

                    <div class="justified-gallery">
                        @foreach ($content['images'] ?? [] as $key => $image)
                            <a data-src="{{ $image }}" style="cursor: pointer">
                                <img class="img-fluid authorization_image" src="{{ $image }}"
                                    alt="{{ $content['image_titles'][$key] ?? '' }}">
                            </a>
                        @endforeach
                    </div>
                </div>
            @empty
                <h5 class="page-banner-title py-2 fw-bold text-center text-capital pt-5 pb-3"
                    style="color: var(--btn_primary_color); letter-spacing:2px;">
                    No Activities Found!
                </h5>
            @endforelse
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
                $('.justified-gallery').justifiedGallery({
                    rowHeight: 200,
                    margins: 15,
                    maxRowHeight: 200,
                    lastRow: 'nojustify',
                    captions: true
                }).on('jg.complete', function() {
                    lightGallery(document.querySelector('.justified-gallery'), {
                        plugins: [lgZoom, lgThumbnail],
                        thumbnail: true
                    });
                });
            });
        </script>
    @endsection
