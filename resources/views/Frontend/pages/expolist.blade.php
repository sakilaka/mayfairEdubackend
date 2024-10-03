@extends('Frontend.layouts.master-layout')
@section('title', ' - Expo')
@section('head')
    <style>
        .category-banner {
            position: relative;
            height: 30vh !important;
            background-image: url(@json($banner?->image_show));
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
@endsection
@section('main_content')
    <div class="content_search">
        <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/blog.css"
            rel="stylesheet">

        <div class="bg-alice-blue py-3 py-lg-0">
            <div class="container-lg p-2 p-md-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">

                        <!--Start Category Banner-->
                        <div
                            class="category-banner d-flex flex-column justify-content-center align-items-center position-relative text-white px-4 py-5 px-sm-5 mb-4">
                            <div class="py-2 px-3 py-lg-4 px-lg-5 position-relative" style="border-radius:8px;">
                                <h4 class="fw-bold fs-1 text-center" style="color: #fff">
                                    Our Expos
                                </h4>
                                <h4 class="fw-bold fs-4 text-center" style="color: #fff">
                                    Connect with Leading Universities and Experts
                                </h4>
                            </div>
                        </div>
                        <!--End Category Banner-->

                        <div
                            class="row g-3 justify-content-center event_cat_ajax-show show-events-data event_relese_ajax-show">

                            @foreach ($expos as $expo)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <!--Start Course Card-->
                                    <div class="course-card rounded-3 bg-white position-relative overflow-hidden">
                                        <div class="position-relative">
                                            <!--Start Course Image-->
                                            <a href="{{ route('frontend.expo.details', $expo->id) }}" class="">
                                                <img src="{{ $expo->banner ?? '' }}" class="img-fluid w-100 imgdiv"
                                                    alt="" style="object-fit: cover">
                                            </a>
                                            <!--End Course Image-->

                                            <!--Start Course Card Body-->
                                            <div
                                                class="course-card_body bg-prussian-blue p-3 pb-0 top_shadow position-relative">
                                                <!--Start Course Title-->
                                                <h3 class="course-card__course--title text-uppercase fs-6 mb-3">
                                                    <a href="{{ route('frontend.expo.details', $expo->id) }}"
                                                        class="text-decoration-none"
                                                        style="color: var(--btn_primary_color)">{{ $expo->title }}</a>
                                                </h3>
                                                <!--End Course Title-->
                                                <!--Start Course Hints-->
                                                <table class="course-card__hints table table-borderless table-sm">
                                                    <tbody>

                                                        <tr>
                                                            <td class="ps-0">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="course-card__hints--icon me-3">
                                                                        <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white"
                                                                            aria-hidden="true"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" fill="none"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke="var(--btn_primary_color)"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="fw-bold">
                                                                        {{ Carbon\Carbon::createFromFormat('d M Y h:i A', str_replace(',', '', $expo->datetime))->format('d M, Y') }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="ps-0">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="course-card__hints--icon me-3">
                                                                        <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white"
                                                                            aria-hidden="true"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" fill="none"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke="var(--btn_primary_color)"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="fw-bold">
                                                                        {{ Carbon\Carbon::createFromFormat('d M Y h:i A', str_replace(',', '', $expo->datetime))->format('h:i A') }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="ps-0">
                                                                <div class="d-flex align-items-center">

                                                                    <div class="course-card__hints--icon me-3">
                                                                        <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white"
                                                                            aria-hidden="true"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" fill="none"
                                                                            viewBox="0 0 24 24">
                                                                            <path stroke="var(--btn_primary_color)"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                                            <path stroke="var(--btn_primary_color)"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="course-card__hints--text fw-bold">
                                                                        {{ Illuminate\Support\Str::limit($expo->place, 25, '...') }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                                <!--End Course Hints-->
                                            </div>
                                            <!--End Course Card Body-->
                                        </div>

                                        <div class="course-card_footer g-2 p-3 pt-0">
                                            <div class="d-flex justify-content-between align-items-stretch">
                                                <div class="flex-grow-1">
                                                    <a type="button"
                                                        class="align-items-center btn btn-dark-cerulean d-flex justify-content-between px-2 w-100"
                                                        href="{{ route('frontend.expo.details', $expo->id) }}">

                                                        <svg width="16" height="17" viewBox="0 0 16 17"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <rect width="15.5325" height="15.5325"
                                                                transform="matrix(-1 0 0 1 15.8613 0.721741)"
                                                                fill="url(#pattern0)" />
                                                            <defs>
                                                                <pattern id="pattern0"
                                                                    patternContentUnits="objectBoundingBox" width="1"
                                                                    height="1">
                                                                    <use xlink:href="#image0_228_160"
                                                                        transform="scale(0.00653595)" />
                                                                </pattern>
                                                                <image id="image0_228_160" width="153" height="153"
                                                                    xlink:href="data:image/png;base64,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" />
                                                            </defs>
                                                        </svg>
                                                        <span class="w-100" style="color: #fff">Details</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Course Card-->
                                </div>
                            @endforeach

                            @if ($expos->count() == 0)
                                <div class="text-center">
                                    <h2>Data Not Found !</h2>
                                </div>
                            @endif

                            <div class="pagination-container d-flex justify-content-center pt-3">
                                {{ $expos->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('Frontend.layouts.parts.news-letter')

@endsection
