@extends('Frontend.layouts.master-layout')
@section('title', ' - Expo Details')
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
            background-image: url(@json($activity['banner']));
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
    </style>

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
                                    {{ $activity['title'] }}</h4>
                            </div>
                            <div class="mt-2 py-2 px-2 px-md-4 position-relative d-flex justify-content-center align-items-center"
                                style="background-color: #00370d84; border-radius:8px;">
                                <h6 class="fw-semi-bold text_bluish-black mb-0" style="color: #fff">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    {{ date('d M, Y', strtotime($activity['date'])) }}
                                </h6>
                            </div>
                        </div>
                        <!--End Category Banner-->
                    </div>

                    <div class="col-lg-12">
                        @if ($activity['description'])
                            <div class="row">
                                <h4 class="fs-5 fw-bold mt-4 mb-2" style="color: var(--btn_primary_color)">
                                    {{-- Activity Description --}}
                                </h4>

                                <div class="col-12 ckeditor5-rendered">
                                    {!! $activity['description'] !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
