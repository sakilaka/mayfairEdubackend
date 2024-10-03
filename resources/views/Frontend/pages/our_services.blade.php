@extends('Frontend.layouts.master-layout')
@section('title', ' - Our Services')
@section('head')
    <style>
        .content_search {
            margin-top: 3.5rem;
        }

        /* @media screen and (min-width:391px) {
            .content_search {
                margin-top: 6rem;
            }
        } */

        .service-card,
        .main-service-card {
            border-radius: 8px;
            overflow: hidden;
            background-color: #166D4D0A;
            border: 0;
        }

        .main-service-card img {
            width: 18%;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
            filter: brightness(0) saturate(100%) invert(30%) sepia(33%) saturate(753%) hue-rotate(109deg) brightness(93%) contrast(90%);
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
    </style>
@endsection
@section('main_content')

    <div class="content_search">
        <h2 class="py-2 fw-bold text-center text-capital pt-5 pb-2" style="color: var(--primary_background); letter-spacing:2px">
            International Student Admission Services
        </h2>

        <div class="container">
            {{-- @php
                $servicesMini = json_decode($page['contents'], true)['servicesMini'] ?? [];
            @endphp
            @if (!empty($servicesMini))
                <div>
                    <div class="row justify-content-center">
                        @foreach ($servicesMini as $key => $service)
                            <div class="col-md-4 col-lg-3 mb-4">
                                <div class="card main-service-card">
                                    <div class="card-body"
                                        style="padding: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                        <img src="{{ $service['image'] ?? asset('frontend/images/No-image.jpg') }}" alt="Service-image-{{ $loop->iteration }}">
                                        <p class="text-muted">
                                            {{ $service['description'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif --}}

            @php
                $servicesLarge = json_decode($page['contents'], true)['servicesLarge'] ?? [];
            @endphp
            @if (!empty($servicesLarge))
                <div class="mt-5">
                    <div class="row justify-content-center">
                        @foreach ($servicesLarge as $key => $service)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card service-card" style="">
                                    <img src="{{ $service['image'] ?? asset('frontend/images/No-image.jpg') }}"
                                        class="card-img-top" alt="{{ $service['title'] }}-image">
                                    <div class="card-body">
                                        <p class="card-subtitle text-capital text-muted">Service {{ $loop->iteration }}</p>
                                        <h4 class="card-title mb-2 fw-bold" style="font-size: 1.3rem">
                                            {{ $service['title'] }}
                                        </h4>
                                        <p class="card-text text-muted">
                                            {{ $service['description'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        @include('Frontend.layouts.parts.news-letter')

    @endsection
