<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Gallery</title>

    <style>
        @font-face {
            font-family: 'Lora';
            src: url('{{ asset('fonts/Lora-BoldItalic.ttf') }}') format('truetype');
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

        .justified-gallery>a {
            box-shadow: rgba(0, 0, 0, 0.5) 0px 3px 10px -7px !important;
            /* border-radius: 6px !important; */
            overflow: hidden;
            transition: 0.45s ease-in-out all;
            border: 1px solid none;
        }

        .justified-gallery>a>.jg-caption {
            background-color: rgba(35, 124, 58, 0.75) !important;
            font-weight: 600 !important;
        }

        .justified-gallery>a:hover {
            box-shadow: rgba(0, 0, 0, 0.75) 0px 3px 10px -5px !important;
            border: 1px solid rgba(35, 124, 58, 0.75) !important;
        }

        a.single-gallery-image {
            position: relative;
        }

        a.single-gallery-image p.image-title,
        .video-title {
            background-color: #0050fe7f;
            width: 100%;
            position: absolute;
            left: 0;
            bottom: 0;
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            margin: 0;
            padding: 5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.65);
        }

        .justified-gallery a img {
            transition: 0.45s ease !important;
        }

        .justified-gallery a:hover img {
            transform: scale(1.025) !important;
        }

        @media screen and (min-width:768px) {
            .gallery-section {
                padding: 0 80px;
            }
        }

        @media screen and (min-width:992px) {
            .gallery-section {
                padding: 0 150px;
            }
        }

        .single-gallery-video iframe {
            height: 200px;
            border-radius: 10px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('frontend/justifiedGallery/justifiedGallery.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-zoom.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-thumbnail.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    {{-- <div class="container mt-5">
        <div class="text-center">
            <h2 class="section-title">Gallery</h2>
        </div>
    </div> --}}

    <section>
        @php
            $gallery_contents = isset($expo['gallery']) ? json_decode($expo['gallery'], true) : [];
        @endphp

        @forelse ($gallery_contents as $key => $gallery)
            <div class="gallery-section py-5">
                <h2 class="company-details-title py-2 fw-bold text-center ">
                    {{ $gallery['title'] ?? '' }}
                </h2>

                <div class="container text-center">
                    <p class="text-muted mt-2 px-lg-5 details-text">
                        {{ $gallery['description'] ?? '' }}
                    </p>

                    <div class="image-gallery">
                        @php
                            $galleryImages = $gallery['images'] ?? [];
                            $galleryImagesTitles = $gallery['image_titles'] ?? [];
                        @endphp
                        @foreach ($galleryImages as $key => $image)
                            <a data-src="{{ $image }}" class="single-gallery-image" style="cursor: pointer">
                                <img class="img-fluid authorization_image" src="{{ $image }}"
                                    alt="{{ $galleryImagesTitles[$key] ?? '' }}">
                                @if ($galleryImagesTitles[$key])
                                    <p class="image-title">
                                        {{ $galleryImagesTitles[$key] ?? '' }}
                                    </p>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <div class="gallery-section py-5">
                <h2 class="company-details-title py-2 fw-bold text-center ">
                    No Gallery Found!
                </h2>
            </div>
        @endforelse
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')

    <script src="{{ asset('frontend/justifiedGallery/jquery.justifiedGallery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/lightgallery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/thumbnail/lg-thumbnail.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.image-gallery').each(function(index, element) {
                $(element).justifiedGallery({
                    rowHeight: 180,
                    margins: 5,
                    maxRowHeight: 300,
                    lastRow: 'nojustify',
                    captions: false
                }).on('jg.complete', function() {
                    lightGallery(element, {
                        plugins: [lgZoom, lgThumbnail],
                        thumbnail: true,
                        selector: 'a',
                        download: true,
                        speed: 500
                    });
                });
            });
        });
    </script>
</body>

</html>
