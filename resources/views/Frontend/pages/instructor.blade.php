@extends('Frontend.layouts.master-layout')
@section('title', ' - Instructor')
@section('head')
    <style>
        @media screen and (min-width:992px) {
            .mx-lg-0 {
                margin-left: 0 !important;
                margin-right: 0 !important;
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
@endsection
@section('main_content')


    <div class="content_search">
        <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/ali.css"
            rel="stylesheet">
        <br><br><br>
        <div class="banner2" style="padding:20px 0 50px 0">
            <div class="container-xl">
                <div class="justify-content-center row">
                    <div class="col-xl-10">
                        <div class="align-items-center row text-center text-lg-start">
                            <div class="col-lg-6">
                                <h2 class="font_open main_title mb-4 {{-- text-capitalize --}}"
                                    style="color: var(--text_color); font-size:35px;">{{ $instructor->top_title }}</h2>
                                <p class="desc font_poppins {{-- text-capitalize --}}" style="color: var(--text_color)">
                                    {{ $instructor->description1 }}</p>
                                <a href="{{ route('frontend.consultant_register') }}"
                                    class="btn btn_getStart btn-primary-bg mt-4 mx-auto mx-lg-0"
                                    style="max-width:220px">{{ $instructor->button1 }}</a>
                            </div>
                            <div class="col-lg-6">
                                <div class="header-video mb-5 mb-lg-0">
                                    <img src="{{ $instructor->image1_show }}"
                                        style="height: 100%; width:100%; border-radius:8px;" class="img-fluid"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="impression" style="background-color: var(--primary_background)">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="text-center" style="max-width: 914px">
                        <h4 class="mb-0 {{-- text-capitalize --}} text_info" style="color:white; font-size:20px">
                            {{ $instructor->text1 }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="become_ins" style="background-color: #f6fff4">
            <div class="container">
                <div class="row">
                    <h2 class="font_poppins text-center fw-semi-bold main_title mb-5"
                        style="color: var(--text_color); font-size:35px">
                        {{ $instructor->text2 }}</h2>
                </div>
                <div class="row g-5">
                    @php
                        $imageContents = json_decode($instructor->contents, true)['images'] ?? [];
                        $titleContents = json_decode($instructor->contents, true)['image_titles'] ?? [];
                    @endphp

                    @foreach ($imageContents as $key => $image)
                        <div class="col-lg-4 col-md-6">
                            <div class="text-center">
                                <img src="{{ $image }}" alt="{{ $titleContents[$key] ?? '' }}"
                                    style="width:200px; height:auto; border-radius:8px;">
                                <h4 class="text_details  mb-0 mt-4" style="color: var(--text_color); font-size:1rem">
                                    {{ $titleContents[$key] ?? '' }}
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('Frontend.layouts.parts.news-letter')

@endsection
