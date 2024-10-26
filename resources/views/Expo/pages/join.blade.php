<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Join With Us</title>
    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">

    @php
        $additional_contents = json_decode($expo->additional_contents, true) ?? [];
        $join_page_contents = json_decode($expo->join_page_contents, true) ?? [];
    @endphp

    <style>
        .custom-numbered-list {
            line-height: 1.6;
        }

        .custom-item {
            display: flex;
            align-items: baseline;
            margin-bottom: 8px;
        }

        .custom-number {
            font-weight: bold;
            font-size: 18px;
            margin-right: 5px;
            border-radius: 50%;
            background-image: linear-gradient(to bottom left, var(--secondary_background), var(--primary_background));
            width: 35px !important;
            height: 35px !important;
            text-align: center;
            color: white;
            border: 2px solid var(--primary_background);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .custom-text {
            margin-left: 5px;
        }

        .reference-card {
            border: 0;
            background-color: var(--primary_background);
            border-radius: 12px;
        }

        .reference-card img {
            border-radius: 8px;
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
                    <a class="ms-md-4 ps-md-4 navbar-brand" href="{{ route('home') }}">
                        <img src="{{ $additional_contents['nav_logo'] ?? '' }}" alt="Logo" class="logo"
                            style="width: 180px; height:auto;">
                    </a>

                    @include('Expo.components.navbar')
                </div>
            </nav>
        </div>

        {{-- <div class="layer-image"></div> --}}
        <div class="bg-color"></div>
    </div>

    <section class="university-highlights">
        <div class="container mt-4">
            <div class="text-start">
                <h2 class="section-title d-inline">How to join us:</h2>
            </div>

            <div class="row justify-content-between align-items-center mx-auto">
                <div class="col-md-6 order-md-2 text-end">
                    <img src="{{ $join_page_contents['qr_code'] ?? '' }}" alt="" class="img-fluid"
                        width="250">
                </div>

                <div class="col-md-6 order-md-1" style="font-size: 18px;">
                    <div class="custom-numbered-list">
                        @foreach ($join_page_contents['steps'] ?? [] as $step)
                            <div class="custom-item d-flex align-items-start">
                                <div>
                                    <div class="custom-number d-flex justify-content-center align-items-center">
                                        <span>{{ $loop->iteration }}</span>
                                    </div>
                                </div>
                                <div>
                                    <span class="custom-text">{{ $step ?? '' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <h3 class="section-title d-inline fs-2">Deadline of Applying:
                    {{ $join_page_contents['deadline'] ?? '' }}</h3>
            </div>

            <div class="row justify-content-start align-items-center mt-4">
                @foreach ($join_page_contents['join_contents'] ?? [] as $content)
                    <div class="col-md-4 mt-3">
                        <div class="card reference-card">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    @foreach ($content['reference'] ?? [] as $reference)
                                        <div class="col-6 d-flex flex-column align-items-center">
                                            <img src="{{ $reference['image'] ?? '' }}" alt="" class="img-fluid">
                                            <span class="fw-700 mt-2" style="color: greenyellow; font-size:16px;">
                                                {{ $reference['qr_code_type'] ?? '' }}
                                            </span>
                                        </div>
                                    @endforeach

                                    <div class="col-12 text-center mt-4">
                                        <h4 class="text-white fw-800">{{ $content['name'] ?? '' }}</h4>
                                        <p class="text-white my-0" style="font-size: 16px;">
                                            {{ $content['email'] ?? '' }}
                                        </p>
                                        <p class="text-white my-0" style="font-size: 16px;">
                                            {{ $content['phone'] ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-center align-items-center mt-5">
                <div class="col-md-10">
                    <img src="{{ asset('frontend/images/join-page-contact.png') }}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
