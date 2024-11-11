@extends('Frontend.layouts.master-layout')
@section('title', ' - University Details')
@section('head')
    <link rel="stylesheet" href="{{ asset('frontend/studentconnect/css/app.f6cbb5f7.css') }}" />

    <link rel="stylesheet" href="{{ asset('frontend/justifiedGallery/justifiedGallery.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-zoom.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/css/lg-thumbnail.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        #gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .single-gallery-image {
            position: relative;
            overflow: hidden;
            display: inline-block;
            border-radius: 6px;
            transition: transform 0.3s ease-in-out;
        }

        .single-gallery-image img {
            transition: transform 0.3s ease;
            width: 280px !important;
            height: 175px !important;
            height: auto;
        }

        .single-gallery-image:hover img {
            transform: scale(1.1);
        }


        .section-background-img {
            background-image: url('{{ asset('frontend/images/section_bg.webp') }}') !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            height: auto;
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


        .justified-gallery>a {
            box-shadow: rgba(0, 0, 0, 0.3) 0px 3px 10px -7px !important;
            overflow: hidden;
            transition: 0.3s ease-in-out all;
            /* Adjusted for a smoother transition */
            border: none;
        }

        .justified-gallery>a:hover {
            box-shadow: rgba(0, 0, 0, 0.6) 0px 3px 20px -5px !important;
            border: 1px solid rgba(35, 124, 58, 0.75) !important;
        }

        .justified-gallery a img {
            transition: 0.3s ease !important;
            /* Slightly faster zoom */
        }

        .justified-gallery a:hover img {
            transform: scale(1.05) !important;
            /* Increased zoom effect */
        }

        a.single-gallery-image {
            position: relative;
        }


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

        .main-service-card p.title {
            font-size: 1rem;
            line-height: 1.5;
            height: 3rem;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 0;
        }

        @media screen and (min-width:1259px) {
            .content-wrapper {
                position: relative;
            }

            .content {
                max-height: 100px;
                overflow: hidden;
                position: relative;
            }

            .content.expanded {
                max-height: 100%;
            }

            .toggle-content-btn {
                display: inline-block !important;
            }
        }

        .fs-08 {
            font-size: 0.925rem !important;
        }

        table tr td,
        table tr th {
            border: 1px solid #d8dce5 !important;
            padding: 3px 10px !important;
        }

        table.review-table tr td,
        table.review-table tr td {
            border: none !important;
        }
    </style>
@endsection

@section('main_content')
    <section class="_tps-university">

        <div class="wrapper">

            <main>
                <div class="university-header" style="background-image: url('{{ @$university->banner_image_show }}');">
                    <div class="container">
                        <div class="university-header__inner">
                            <div class="university-header__logo-wrapper">
                                <img class="university-header__logo" src="{{ @$university->image_show }}"
                                    alt="{{ @$university->name }}" title="{{ @$university->name }}" />
                            </div>

                            <div class="university-header__main d-flex align-items-start mx-3">
                                <div>

                                    <h1 class="university-header__heading">
                                        {{ @$university->name }}
                                    </h1>

                                    <ul class="breadcrumbs">
                                        <li class="breadcrumbs__item">
                                            <a href="{{ route('home') }}" class="breadcrumbs__link">
                                                Homepage
                                            </a>
                                        </li>
                                        <li class="breadcrumbs__item">
                                            <a href="{{ route('frontend.all_universities_list') }}"
                                                class="breadcrumbs__link">
                                                Find a University
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="university-header__actions">
                                <button class="enquireModalOpener university-header__btn btn btn--primary btn--lg"
                                    data-toggle="modal" data-target="#enquireModal">
                                    Enquire now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="university-nav">
                    <div class="container">
                        <ul class="university-nav__list">
                            <li class="university-nav__item">
                                <a href="#majors-section" class="university-nav__btn" data-target="majors-section">
                                    Programs
                                </a>
                            </li>

                            @if ($university->about)
                                <li class="university-nav__item">
                                    <a href="#accomodation" class="university-nav__btn" data-target="about">
                                        About
                                    </a>
                                </li>
                            @endif

                            <li class="university-nav__item">
                                <a href="#fees-structure" class="university-nav__btn" data-target="fees-structure">
                                    Fees Structure
                                </a>
                            </li>

                            @if ($university->accommodation)
                                <li class="university-nav__item">
                                    <a href="#accomodation" class="university-nav__btn" data-target="accomodation">
                                        Accommodation
                                    </a>
                                </li>
                            @endif

                            @if ($university->admissions_process)
                                <li class="university-nav__item">
                                    <a href="#admission-process" class="university-nav__btn"
                                        data-target="admission-process">
                                        Admission Process
                                    </a>
                                </li>
                            @endif

                            <li class="university-nav__item">
                                <a href="#scholarship-section" class="university-nav__btn"
                                    data-target="scholarship-section">
                                    Scholarships
                                </a>
                            </li>

                            @if ($university->universityFAQ->count() > 0)
                                <li class="university-nav__item">
                                    <a href="#faq-section" class="university-nav__btn" data-target="faq-section">
                                        FAQ
                                    </a>
                                </li>
                            @endif

                            <li class="university-nav__item">
                                <a href="#university-gallery" class="university-nav__btn" data-target="university-gallery">
                                    Gallery
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="university-body">
                    <div class="container">
                        <div class="university-body__inner">
                            <div class="university-body__main">

                                <div class="university-body__section text section" id="majors-section">
                                    <div class="university-body__section-header js-accordion">
                                        <h3 class="university-body__section-heading">
                                            Programs
                                        </h3>
                                    </div>

                                    <div class="university-body__section-inner">
                                        <div class="university-body__section-content">
                                            @if (count($university_courses) > 0)
                                                @include('Frontend.university.university_courses')
                                            @else
                                                <p class="text-center text-muted">No Program Found!</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if ($university->about)
                                    <div class="university-body__section text section" id="about">
                                        <div class="university-body__section-header js-accordion">
                                            <h3 class="university-body__section-heading">
                                                About
                                            </h3>
                                        </div>

                                        <div class="university-body__section-inner">
                                            <div class="university-body__section-content">
                                                <div class="content-wrapper">
                                                    <div class="content ckeditor5-rendered">
                                                        {!! $university->about !!}
                                                    </div>
                                                    <div class="text-center">
                                                        <button
                                                            class="toggle-content-btn university-header__btn btn btn--primary px-3 mt-3"
                                                            style="display: none;">See
                                                            More</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="university-body__section text section" id="fees-structure">
                                    <div class="university-body__section-header js-accordion">
                                        <h3 class="university-body__section-heading">
                                            Fees Structure
                                        </h3>
                                    </div>

                                    <div class="university-body__section-inner">
                                        <div class="university-body__section-content">
                                            <div class="row">
                                                <div class="col-lg-6 px-4 mb-4">
                                                    <div class="card main-service-card"
                                                        style="background-color: var(--primary_background);">
                                                        <div class="card-body"
                                                            style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                                            <p class="text-white fw-bold title">
                                                                Fees Structure
                                                            </p>

                                                            <div style="width: 100%">
                                                                @php
                                                                    // Decode the fees structure and handle null case
                                                                    $fees_structure = $university->fees_structure
                                                                        ? json_decode($university->fees_structure, true)
                                                                        : null;

                                                                    // Set a default array for degrees and tuition fees if null
                                                                    $degrees = $fees_structure['degrees'] ?? [];
                                                                    $tuition_fees_1 =
                                                                        $fees_structure['tuition_fees_1'] ?? [];
                                                                    $tuition_fees_2 =
                                                                        $fees_structure['tuition_fees_2'] ?? [];

                                                                    // Handle other fees
                                                                    $accommodation_fee_1 =
                                                                        $fees_structure['accommodation_fees_1'] ??
                                                                        'N/A';
                                                                    $accommodation_fee_2 =
                                                                        $fees_structure['accommodation_fees_2'] ??
                                                                        'N/A';
                                                                    $insurance_fee =
                                                                        $fees_structure['insurance_fee'] ?? 'N/A';
                                                                    $visa_extension_fee =
                                                                        $fees_structure['visa_extension_fee'] ?? 'N/A';
                                                                    $medical_in_china_fee =
                                                                        $fees_structure['medical_in_china_fee'] ??
                                                                        'N/A';
                                                                @endphp

                                                                <!-- Loop through degrees and tuition fees -->
                                                                @foreach ($degrees as $index => $degree)
                                                                    <div class="d-flex justify-content-between mt-3">
                                                                        <span
                                                                            class="text-white text-start fw-bold mb-1">{{ $degree }}</span>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between">
                                                                        <span class="text-white text-start mb-0">Tuition
                                                                            Fee:</span>
                                                                        <span class="text-white text-end fw-bold mb-0">
                                                                            {{ !empty($tuition_fees_1[$index]) && !empty($tuition_fees_2[$index])
                                                                                ? convertCurrency($tuition_fees_1[$index]) . ' - ' . convertCurrency($tuition_fees_2[$index])
                                                                                : 'N/A' }}
                                                                        </span>
                                                                    </div>
                                                                @endforeach

                                                                <div class="d-flex justify-content-between mt-3">
                                                                    <span class="text-white text-start mb-0">Accommodation
                                                                        Fees:</span>
                                                                    <span class="text-white text-end fw-bold mb-0">
                                                                        {{ $accommodation_fee_1 !== 'N/A' &&
                                                                        $accommodation_fee_1 != 0 &&
                                                                        $accommodation_fee_2 !== 'N/A' &&
                                                                        $accommodation_fee_2 != 0
                                                                            ? convertCurrency($accommodation_fee_1) . ' - ' . convertCurrency($accommodation_fee_2)
                                                                            : 'N/A' }}
                                                                    </span>
                                                                </div>

                                                                <div class="d-flex justify-content-between mt-3">
                                                                    <span class="text-white text-start mb-0">Insurance
                                                                        Fee:</span>
                                                                    <span class="text-white text-end fw-bold mb-0">
                                                                        {{ $insurance_fee !== 'N/A' && $insurance_fee != 0 ? convertCurrency($insurance_fee) : 'N/A' }}
                                                                    </span>
                                                                </div>

                                                                <div class="d-flex justify-content-between mt-3">
                                                                    <span class="text-white text-start mb-0">Visa Extension
                                                                        Fee:</span>
                                                                    <span class="text-white text-end fw-bold mb-0">
                                                                        {{ $visa_extension_fee !== 'N/A' && $visa_extension_fee != 0 ? convertCurrency($visa_extension_fee) : 'N/A' }}
                                                                    </span>
                                                                </div>

                                                                <div class="d-flex justify-content-between mt-3">
                                                                    <span class="text-white text-start mb-0">Medical In
                                                                        China Fee:</span>
                                                                    <span class="text-white text-end fw-bold mb-0">
                                                                        {{ $medical_in_china_fee !== 'N/A' && $medical_in_china_fee != 0 ? convertCurrency($medical_in_china_fee) : 'N/A' }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($university->accommodation)
                                    <div class="university-body__section text section" id="accomodation">
                                        <div class="university-body__section-header js-accordion">
                                            <h3 class="university-body__section-heading">
                                                Accommodation
                                            </h3>
                                        </div>

                                        <div class="university-body__section-inner">
                                            <div class="university-body__section-content">
                                                <div class="content-wrapper">
                                                    <div class="content ckeditor5-rendered">
                                                        {!! $university->accommodation !!}
                                                    </div>
                                                    <div class="text-center">
                                                        <button
                                                            class="toggle-content-btn university-header__btn btn btn--primary px-3 mt-3"
                                                            style="display: none;">See
                                                            More</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($university->admissions_process)
                                    <div class="university-body__section text section" id="admission-process">
                                        <div class="university-body__section-header js-accordion">
                                            <h3 class="university-body__section-heading">
                                                Admission Process
                                            </h3>
                                        </div>

                                        <div class="university-body__section-inner">
                                            <div class="university-body__section-content">
                                                <div class="content-wrapper">
                                                    <div class="content ckeditor5-rendered">
                                                        {!! $university->admissions_process !!}
                                                    </div>
                                                    <div class="text-center">
                                                        <button
                                                            class="toggle-content-btn university-header__btn btn btn--primary px-3 mt-3"
                                                            style="display: none;">See
                                                            More</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="university-body__section text section" id="scholarship-section">
                                    <div class="university-body__section-header js-accordion">
                                        <h3 class="university-body__section-heading">
                                            Scholarships
                                        </h3>
                                    </div>

                                    <div class="university-body__section-inner">
                                        <div class="university-body__section-content">
                                            @php
                                                $selectedScholarships =
                                                    json_decode($university->scholarships, true) ?? [];
                                                $selectedScholarshipDetails = $scholarships->whereIn(
                                                    'id',
                                                    $selectedScholarships,
                                                );
                                            @endphp

                                            <div class="row justify-content-start">
                                                @foreach ($selectedScholarshipDetails as $scholarship)
                                                    <div class="col-md-6 col-lg-4 mb-4">
                                                        <div class="card main-service-card">
                                                            <div class="card-body"
                                                                style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                                                <img src="{{ asset('frontend/images/service-section/main-services/6.png') }}"
                                                                    alt="">
                                                                <p class="text-muted fw-bold title">
                                                                    {{ $scholarship->title }}</p>

                                                                <div style="width: 100%">
                                                                    <div class="d-flex justify-content-between fs-08">
                                                                        <span class="text-muted text-start mb-0">
                                                                            Tuition Fee:
                                                                        </span>
                                                                        <span class="text-muted text-end fw-bold mb-0">
                                                                            @php
                                                                                if ($scholarship->tuition_fee == 1) {
                                                                                    $tuition_fee = 'Free';
                                                                                } elseif (
                                                                                    $scholarship->tuition_fee == 0
                                                                                ) {
                                                                                    $tuition_fee = 'N/A';
                                                                                } else {
                                                                                    $tuition_fee = convertCurrency(
                                                                                        $scholarship->tuition_fee,
                                                                                    );
                                                                                }
                                                                            @endphp
                                                                            {{ $tuition_fee }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between fs-08 mt-2">
                                                                        <span class="text-muted text-start mb-0">
                                                                            Accommodation Fee:
                                                                        </span>
                                                                        <span class="text-muted text-end fw-bold mb-0">
                                                                            @php
                                                                                if (
                                                                                    $scholarship->accommodation_fee == 1
                                                                                ) {
                                                                                    $accommodation_fee = 'Free';
                                                                                } elseif (
                                                                                    $scholarship->accommodation_fee == 0
                                                                                ) {
                                                                                    $accommodation_fee = 'N/A';
                                                                                } else {
                                                                                    $accommodation_fee = convertCurrency(
                                                                                        $scholarship->accommodation_fee,
                                                                                    );
                                                                                }
                                                                            @endphp
                                                                            {{ $accommodation_fee }}
                                                                        </span>
                                                                    </div>

                                                                    <div class="d-flex justify-content-between fs-08 mt-2">
                                                                        <span class="text-muted text-start mb-0">
                                                                            Insurance Fee:
                                                                        </span>
                                                                        <span class="text-muted text-end fw-bold mb-0">
                                                                            @php
                                                                                if ($scholarship->insurance_fee == 1) {
                                                                                    $insurance_fee = 'Free';
                                                                                } elseif (
                                                                                    $scholarship->insurance_fee == 0
                                                                                ) {
                                                                                    $insurance_fee = 'N/A';
                                                                                } else {
                                                                                    $insurance_fee = convertCurrency(
                                                                                        $scholarship->insurance_fee,
                                                                                    );
                                                                                }
                                                                            @endphp
                                                                            {{ $insurance_fee }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between fs-08 mt-2">
                                                                        <span class="text-muted text-start mb-0">
                                                                            Stipend Monthly:
                                                                        </span>
                                                                        <span class="text-muted text-start fw-bold mb-0">
                                                                            {{ $scholarship->stipend_monthly ?? 'N/A' }}
                                                                        </span>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between fs-08 mt-2">
                                                                        <span class="text-muted text-start mb-0">
                                                                            Stipend Yearly:
                                                                        </span>
                                                                        <span class="text-muted text-start fw-bold mb-0">
                                                                            {{ $scholarship->stipend_yearly ?? 'N/A' }}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($university->universityFAQ->count() > 0)
                                    <div class="university-body__section text section" id="faq-section">
                                        <div class="university-body__section-header js-accordion">
                                            <h3 class="university-body__section-heading">
                                                FAQ
                                            </h3>
                                        </div>

                                        <div class="university-body__section-inner">
                                            <div class="university-body__section-content">
                                                <style>
                                                    .question::before,
                                                    .answer::before {
                                                        content: "";
                                                        border-radius: 2px;
                                                        height: 6px;
                                                        width: 6px;
                                                        position: absolute;
                                                        left: -20px;
                                                        top: 50%;
                                                        transform: translateY(-50%);
                                                        z-index: 1;
                                                    }

                                                    .question::before {
                                                        content: "Q: " !important;
                                                        background: none !important;
                                                        color: #5f74a2 !important;
                                                        font-weight: bold;
                                                        left: -30px;
                                                        top: 0 !important;
                                                        transform: none;
                                                    }

                                                    .answer::before {
                                                        content: "A: " !important;
                                                        background: none !important;
                                                        color: #5f74a2 !important;
                                                        font-weight: bold;
                                                        left: -30px;
                                                        top: 0 !important;
                                                        transform: none;
                                                    }

                                                    ul.faq li+li {
                                                        margin-top: 5px !important;
                                                    }

                                                    ul.faq li {
                                                        list-style-type: none;
                                                        position: relative;
                                                    }
                                                </style>

                                                <ul class="faq">
                                                    @foreach ($university->universityFAQ as $item)
                                                        @if ($item->answer)
                                                            <li class="question">{{ $item->question }}</li>
                                                            <li class="answer">{{ $item->answer }}</li>
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="university-body__section text section" id="university-gallery">
                                    <div class="university-body__section-header js-accordion">
                                        <h3 class="university-body__section-heading">
                                            Gallery
                                        </h3>
                                    </div>


                                    <p style="color: black !important;" class="mb-4 text-center fs-3 fw-bold">Images</p>

                                    <div id="gallery" class="section-background-img">
                                        @php
                                            $imageGallery = json_decode($university->image_gallery, true) ?? [];
                                            $hasImages = false;

                                            // Check if there is at least one image in the gallery
                                            foreach ($imageGallery as $gallery) {
                                                if (!empty($gallery['images'])) {
                                                    $hasImages = true;
                                                    break;
                                                }
                                            }
                                        @endphp

                                        @if ($hasImages)
                                            @foreach ($imageGallery as $key => $gallery)
                                                @foreach ($gallery['images'] as $img)
                                                    <a href="{{ $img }}" target="_blank"
                                                        class="single-gallery-image" style="cursor: pointer">
                                                        <img class="img-fluid authorization_image"
                                                            src="{{ $img }}" alt="">
                                                    </a>
                                                @endforeach
                                            @endforeach
                                        @else
                                            <h4 class="company-details-title py-2 fw-bold text-center ">
                                                No Image Found!
                                            </h4>
                                        @endif
                                    </div>





                                    <p style="color: black !important;" class="mt-5 mb-2 text-center fs-3 fw-bold">Videos</p>

                                    <section class="section-background-img">
                                        @php
                                            $video_contents = json_decode($university->video, true) ?? [];
                                        @endphp

                                        <div class="gallery-section py-5 video-gallery">
                                            <div class="">
                                                @if (empty($video_contents))
                                                    <h4 class="company-details-title fw-bold text-center">
                                                        No Video Found!
                                                    </h4>
                                                @else
                                                    @foreach ($video_contents as $video)
                                                        <a class="single-gallery-video position-relative me-md-2 overflow-hidden"
                                                            style="cursor: pointer">
                                                            @if ($video['type'] === 'youtube')
                                                                <!-- YouTube Embed Code -->
                                                                {!! $video['url'] !!}
                                                            @elseif ($video['type'] === 'upload')
                                                                <!-- Video Preview -->
                                                                <video class="img-fluid authorization_video" controls
                                                                    style="max-height: 200px; border-radius: 10px;">
                                                                    <source src="{{ $video['url'] }}" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            @endif

                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </section>






                                </div>

                            </div>

                            <aside class="university-aside mt-md-3" style="border-radius: 8px">
                                <div class="university-aside-item">
                                    <div class="university-aside-item__label">
                                        Institution
                                    </div>

                                    <div class="university-aside-item__body">
                                        <div class="university-aside-item__row">
                                            {{ $university->name }}
                                        </div>
                                    </div>
                                </div>

                                <div class="university-aside-item">
                                    <div class="university-aside-item__label">
                                        Location
                                    </div>

                                    <div class="university-aside-item__body">
                                        <div class="university-aside-item__row">
                                            <div class="university-aside-item__cell">
                                                @php
                                                    $locationParts = array_filter([
                                                        // ucfirst($university->address),
                                                        ucfirst($university->city?->name ?? 'No city.'),
                                                        ucfirst($university->state?->name ?? 'No provience.'),
                                                    ]);
                                                @endphp

                                                {{ implode(', ', $locationParts) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="university-aside-item">
                                    <div class="university-aside-item__label">
                                        University Courses
                                    </div>

                                    <div class="university-aside-item__body text-center">
                                        @php
                                            $partnerRef =
                                                session('partner_ref_id') ?? request()->query('partner_ref_id');
                                            $appliedBy = session('applied_by') ?? request()->query('applied_by');

                                            $apply_url_params['university'] = $university->id;

                                            if ($partnerRef) {
                                                $apply_url_params['partner_ref_id'] = $partnerRef;
                                            }

                                            if ($appliedBy) {
                                                $apply_url_params['applied_by'] = $appliedBy;
                                            }

                                            if (session('is_anonymous')) {
                                                $apply_url_params['is_anonymous'] = 'true';
                                            }

                                            $all_programs_url = route(
                                                'frontend.university_course_list',
                                                $apply_url_params,
                                            );
                                        @endphp

                                        <button class="university-header__btn btn btn--primary btn--lg js-call-modal"
                                            onclick="window.location.href='{{ $all_programs_url }}'">
                                            View Programs
                                        </button>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>

                <span class="pseudo-anchor" id="block_1"></span>

                <section class="cta-block">
                    <div class="container">
                        <div class="cta-block__inner">
                            <div class="cta-block__main">
                                <h3 class="cta-block__heading">
                                    Are you ready to start building your future?
                                </h3>

                                <p class="cta-block__text">
                                    Contact our admission counseller and get a free consultation.
                                </p>
                            </div>

                            <div class="cta-block__action">
                                <button type="button"
                                    class="enquireModalOpener cta-block__btn btn btn--xlg btn--primary js-call-modal"
                                    data-toggle="modal" data-target="#enquireModal">
                                    Book now
                                </button>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="enquireModal" tabindex="-1" role="dialog" aria-labelledby="enquireModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header py-3">
                        <h5 class="modal-title" id="exampleModalLabel">Have a Query?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('frontend.question') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="university" />
                        <input type="hidden" name="university_id" value="{{ $university->id }}" />
                        <div class="modal-body px-4">
                            <div class="form-group">
                                <label for="name" class="title">Name</label>
                                <input type="text" name="name" id="name" class="form-control mt-1" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="email" class="title">Email</label>
                                <input type="email" name="email" id="email" class="form-control mt-1" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="question" class="title">Your Query</label>
                                <textarea name="question" id="question" rows="5" class="form-control mt-1" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger px-3 py-2" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary-bg px-3 py-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    @include('Frontend.layouts.parts.news-letter')
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButtons = document.querySelectorAll('.toggle-content-btn');

            toggleButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const content = this.closest('.content-wrapper').querySelector('.content');

                    if (content.classList.contains('expanded')) {
                        content.classList.remove('expanded');
                        this.textContent = 'See More';
                    } else {
                        content.classList.add('expanded');
                        this.textContent = 'See Less';
                    }
                });
            });
        });
    </script>

    <script>
        $('.enquireModalOpener').click(function() {
            $('#enquireModal').modal('show');
        });
        document.addEventListener("DOMContentLoaded", function() {
            // Get the close button elements
            const closeModalButtons = document.querySelectorAll('[data-dismiss="modal"]');

            // Add click event listener to each close button
            closeModalButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    // Find the parent modal of the clicked button
                    const modal = button.closest('.modal');
                    if (modal) {
                        // Use Bootstrap modal method to hide the modal
                        $(modal).modal('hide');
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('frontend/studentconnect/js/runtime.b7ed2637.js') }}"></script>
    <script src="{{ asset('frontend/studentconnect/js/730.535b5aff.js') }}"></script>
    <script src="{{ asset('frontend/studentconnect/js/app.773d3c55.js') }}"></script>
@endsection



<script src="{{ asset('frontend/justifiedGallery/jquery.justifiedGallery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/lightgallery.min.js" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.2/plugins/thumbnail/lg-thumbnail.min.js"
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
