<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Testimonials of '{{ $expo->title }}'</title>
    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">

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

        .university-highlights {
            background-image: url('{{ asset('frontend/images/expo-page-white-bg-blank.jpeg') }}');
            background-position: top;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            padding: 5rem 0;
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

    <section class="university-highlights">
        <div class="container">
            <div class="text-start">
                <h2 class="section-title d-inline">Testimonials From</h2>
                <h4 class="section-title d-inline ms-2 fs-4">{{ $expo->title }}</h4>
            </div>

            <div class="row justify-content-between align-items-center mt-5 mx-auto">
                @php
                    $testimonials = json_decode($expo->testimonials, true) ?? [];
                @endphp

                @foreach ($testimonials as $testimonial)
                    <div class="col-md-6 px-md-3 mt-3">
                        <div
                            class="row align-items-start justify-content-center border border-success border-3 border-top-0 border-start-0 rounded">
                            <div class="col-md-3">
                                <img src="{{ $testimonial['photo'] ?? asset('frontend/images/no-profile.jpg') }}"
                                    alt="" class="img-fluid rounded-circle border border-3 border-success"
                                    width="150">
                            </div>

                            <div class="col-md-9 mt-3 mt-md-0">
                                <blockquote class="blockquote border-start-0 mb-0 px-2">
                                    <div class="mb-0 text-muted testimonial-description"
                                        style="font-size: 16px; max-height: 120px; overflow-y:auto;">
                                        {!! $testimonial['description'] !!}
                                    </div>
                                    <footer class="blockquote-footer my-2" style="font-size: 16px">
                                        <strong>{{ $testimonial['name'] }}</strong>,
                                        <cite title="{{ $testimonial['designation'] }}">
                                            {{ $testimonial['designation'] }}
                                        </cite>
                                    </footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
