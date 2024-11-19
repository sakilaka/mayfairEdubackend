@if (!empty($footer_image))
    <style>
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
            box-shadow: rgba(0, 0, 0, 0.75) 0px 3px 20px -5px !important;
            border: 1px solid rgba(35, 124, 58, 0.75) !important;
        }

        .justified-gallery a img {
            transition: 0.45s ease !important;
        }

        .justified-gallery a:hover img {
            transform: scale(1.025) !important;
        }

        a.single-gallery-image {
            position: relative;
        }

        a.single-gallery-image p.image-title {
            background-color: #068b7792;
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
    </style>
    <link rel="stylesheet" href="{{ asset('frontend/justifiedGallery/justifiedGallery.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-zoom.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-thumbnail.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="section-background-img py-4">
        <div class="container">
            <div class="text-center mb-3">
                <div class="" style="color: var(--text_color)">
                    <h3 class="font-dm-sans-title"><b>Activity Gallery</b></h3>
                </div>
            </div>

            <section class="footer_showcase d-flex mb-2">

                @php
                $imagesWithPosition = collect($footer_image['images'] ?? [])->map(function ($image, $key) use ($footer_image) {
                    return [
                        'src' => $image,
                        'title' => $footer_image['image_titles'][$key] ?? '',
                        'position' => $footer_image['image_positions'][$key] ?? 0,
                    ];
                })->sortBy('position');
                 @endphp
            
                <div id="justified-gallery">
                    @foreach ($imagesWithPosition as $imageData)
                        <a data-src="{{ $imageData['src'] }}" class="single-gallery-image" style="cursor: pointer">
                            <img class="img-fluid authorization_image" src="{{ $imageData['src'] }}"
                                alt="{{ $imageData['title'] }}">
                            @if ($imageData['title'])
                                <p class="image-title">
                                    {{ $imageData['title'] }}
                                </p>
                            @endif
                        </a>
                    @endforeach
                </div>
                
            </section>
        </div>
    </div>

    <script src="{{ asset('frontend/justifiedGallery/jquery.justifiedGallery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/lightgallery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/thumbnail/lg-thumbnail.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <script>
        lightGallery(document.getElementById('lightgallery'), {
            thumbnail: true,
            zoom: true,
            toggleThumb: true,
            selector: '.thumbnail-container',
        });
    </script> --}}

    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#justified-gallery').justifiedGallery({
                rowHeight: 180,
                margins: 5,
                maxRowHeight: 200,
                lastRow: 'nojustify',
                captions: false
            }).on('jg.complete', function() {
                lightGallery(document.getElementById('justified-gallery'), {
                    plugins: [lgZoom, lgThumbnail],
                    thumbnail: true
                });
            });
        });
    </script>
@endif
