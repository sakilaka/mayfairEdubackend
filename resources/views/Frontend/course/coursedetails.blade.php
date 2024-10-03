@extends('Frontend.layouts.master-layout')
@section('title', ' - Course Details')
@section('head')
    <style>
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
        }

        .filter-img {
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

        .ui-helper-hidden-accessible {
            display: none;
        }

        .youtube-video-preview iframe {
            border-radius: 8px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery.js/2.4.0/css/lightgallery.min.css">
@endsection
@section('main_content')
    <div>
        <link rel="stylesheet" id="contact-form-7-css" href="{{ asset('frontend/lizza/css/styles.css') }}" type="text/css"
            media="all">
        <link rel="stylesheet" id="fontawesome-css" href="{{ asset('frontend/lizza/css/all.min.css') }}" type="text/css"
            media="all">
        <link rel="stylesheet" id="material-icon-css"
            href="{{ asset('frontend/lizza/css/material-design-iconic-font.min.css') }}" type="text/css" media="all">
        <link rel="stylesheet" id="b549b30414ed46447538ef1d3a028552-css"
            href="//fonts.googleapis.com/css?family=Red+Hat+Display:300,400,500,600,700,800,900,300italic,italic,500italic,600italic,700italic,800italic,900italic&amp;subset=latin-ext"
            type="text/css" media="all">
        <link rel="stylesheet" id="9cf5893edf1d7e4d60526d4dd68092d4-css"
            href="//fonts.googleapis.com/css?family=DM+Sans:100,200,300,400,500,600,700,800,900&amp;subset=latin-ext"
            type="text/css" media="all">
        <link rel="stylesheet" id="3313e79ffe037d389688456f7efde7a0-css"
            href="//fonts.googleapis.com/css?family=Manrope:200,300,400,500,600,700,800&amp;subset=latin-ext"
            type="text/css" media="all">
        <link rel="stylesheet" id="lizza-lms-css" href="{{ asset('frontend/lizza/css/style.css') }}" type="text/css"
            media="all">

        <style id="lizza-lms-inline-css" type="text/css">
            :root {
                --wdtPrimaryColor: var(--secondary_background);
                --wdtPrimaryColorRgb: 20, 69, 47;
                --wdtSecondaryColor: #7cff77;
                --wdtSecondaryColorRgb: 124, 255, 119;
                --wdtTertiaryColor: #f2f8f1;
                --wdtTertiaryColorRgb: 242, 248, 241;
                --wdtBodyBGColor: #ffffff;
                --wdtBodyBGColorRgb: 255, 255, 255;
                --wdtBodyTxtColor: #394630;
                --wdtBodyTxtColorRgb: 57, 70, 48;
                --wdtHeadAltColor: #22281E;
                --wdtHeadAltColorRgb: 34, 40, 30;
                --wdtLinkColor: #22281E;
                --wdtLinkColorRgb: 34, 40, 30;
                --wdtLinkHoverColor: var(--secondary_background);
                --wdtLinkHoverColorRgb: 20, 69, 47;
                --wdtBorderColor: #E7E7E7;
                --wdtBorderColorRgb: 231, 231, 231;
                --wdtAccentTxtColor: #ffffff;
                --wdtAccentTxtColorRgb: 255, 255, 255;
                --wdtFontTypo_Base: "Manrope", sans-serif;
                --wdtFontWeight_Base: 400;
                --wdtFontSize_Base: 16px;
                --wdtLineHeight_Base: 1.7;
                --wdtFontTypo_Alt: "DM Sans", sans-serif;
                --wdtFontWeight_Alt: 700;
                --wdtFontSize_Alt: 68px;
                --wdtLineHeight_Alt: 1.2;
                --wdtFontTypo_H1: "DM Sans", sans-serif;
                --wdtFontWeight_H1: 700;
                --wdtFontSize_H1: 68px;
                --wdtLineHeight_H1: 1.2;
                --wdtFontTypo_H2: "DM Sans", sans-serif;
                --wdtFontWeight_H2: 700;
                --wdtFontSize_H2: 55px;
                --wdtLineHeight_H2: 1.2;
                --wdtFontTypo_H3: "DM Sans", sans-serif;
                --wdtFontWeight_H3: 700;
                --wdtFontSize_H3: 40px;
                --wdtLineHeight_H3: 1.2;
                --wdtFontTypo_H4: "DM Sans", sans-serif;
                --wdtFontWeight_H4: 700;
                --wdtFontSize_H4: 30px;
                --wdtLineHeight_H4: 1.2;
                --wdtFontTypo_H5: "DM Sans", sans-serif;
                --wdtFontWeight_H5: 700;
                --wdtFontSize_H5: 24px;
                --wdtLineHeight_H5: 1.2;
                --wdtFontTypo_H6: "DM Sans", sans-serif;
                --wdtFontWeight_H6: 700;
                --wdtFontSize_H6: 20px;
                --wdtLineHeight_H6: 1.2;
                --wdtFontTypo_Ext: "DM Sans", sans-serif;
                --wdtFontWeight_Ext: 500;
                --wdtFontSize_Ext: 14px;
                --wdtLineHeight_Ext: 1.15;
            }
        </style>

        <link rel="stylesheet" id="lizza-base-css" href="{{ asset('frontend/lizza/css/base_1.css') }}" type="text/css"
            media="all">
        <link rel="stylesheet" id="lizza-grid-css" href="{{ asset('frontend/lizza/css/grid.css') }}" type="text/css"
            media="all">
        <link rel="stylesheet" id="lizza-layout-css" href="{{ asset('frontend/lizza/css/layout.css') }}" type="text/css"
            media="all">
        <link rel="stylesheet" id="lizza-theme-css" href="{{ asset('frontend/lizza/css/theme.css') }}" type="text/css"
            media="all">

        <style id="lizza-admin-inline-css" type="text/css">
            body {
                font-family: "Manrope", sans-serif;
                font-weight: 400;
                font-size: 16px;
                line-height: 1.7;
                color: #394630;
            }

            a {
                color: #22281E;
            }

            a:hover {
                color: #14452f;
            }

            h1 {
                font-family: "DM Sans", sans-serif;
                font-weight: 700;
                font-size: 68px;
                line-height: 1.2;
            }

            h2 {
                font-family: "DM Sans", sans-serif;
                font-weight: 700;
                font-size: 55px;
                line-height: 1.2;
            }

            h3 {
                font-family: "DM Sans", sans-serif;
                font-weight: 700;
                font-size: 40px;
                line-height: 1.2;
            }

            h4 {
                font-family: "DM Sans", sans-serif;
                font-weight: 700;
                font-size: 30px;
                line-height: 1.2;
            }

            h5 {
                font-family: "DM Sans", sans-serif;
                font-weight: 700;
                font-size: 24px;
                line-height: 1.2;
            }

            h6 {
                font-family: "DM Sans", sans-serif;
                font-weight: 700;
                font-size: 20px;
                line-height: 1.2;
            }

            .fas {
                font-size: 16px !important;
            }
        </style>

        <link rel="stylesheet" id="scrolltabs-css" href="{{ asset('frontend/lizza/css/scrolltabs.css') }}" type="text/css"
            media="all">
        <link rel="stylesheet" id="dtlms-common-css" href="{{ asset('frontend/lizza/css/common_2.css') }}" type="text/css"
            media="all">
        <link rel="stylesheet" id="dtlms-frontend-css" href="{{ asset('frontend/lizza/css/frontend.css') }}"
            type="text/css" media="all">
        <link rel="stylesheet" id="dtlms-frontend-css" href="{{ asset('frontend/lizza/css/fontawesome.min.css') }}"
            type="text/css" media="all">
        <link rel="stylesheet" id="dtlms-single-css" href="{{ asset('frontend/lizza/css/single-items.css') }}"
            type="text/css" media="all">
        <link rel="stylesheet" id="dtlms-google-fonts-css"
            href="https://fonts.googleapis.com/css?family=Poppins&amp;ver=6.4.3" type="text/css" media="all">
    </div>

    <div class="wrapper" style="margin-top: 5rem;">
        <!-- ** Inner Wrapper ** -->
        <div class="inner-wrapper">
            <!-- **Main** -->
            <div id="main">
                <!-- ** Container ** -->
                <div class="container">
                    <div class="dtlms-container">
                        <article id="course-10741"
                            class="dtlms-course-detail type4  post-10741 dtlms_courses type-dtlms_courses status-publish has-post-thumbnail hentry course_category-computer-science">
                            <div class="dtlms-course-detail-header">
                                <div class="dtlms-course-detail-image">
                                    <img width="1920" height="auto"
                                        src="{{ @$course->university->banner_image_show }}"
                                        class="attachment-full size-full wp-post-image" alt="" decoding="async"
                                        style="height: 330px">
                                </div>
                                <div class="dtlms-course-detail-content-holder">
                                    <div class="dtlms-course-detail-header-inner">
                                        <div class="dtlms-course-detail-header-inner-content">
                                            <div class="dtlms-course-detail-purchaseprogress-content">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dtlms-main-title-section">
                                        <h2>{{ @$course->name }}</h2>
                                    </div>

                                    <div class="dtlms-course-detail-content left">
                                        <div class="dtlms-course-detail-content-meta">
                                            <div class="dtlms-course-detail-author">
                                                <span>University</span>
                                                <div class="dtlms-course-detail-author-image"><img alt=""
                                                        src="{{ @$course->university->image_show }}"
                                                        class="avatar avatar-150 photo" height="150" width="150"
                                                        decoding="async"></div>
                                                <div class="dtlms-course-detail-author-title">
                                                    <h5>
                                                        @php
                                                            $routeParameters = ['id' => $course->university->id];

                                                            if (session('partner_ref_id')) {
                                                                $routeParameters['partner_ref_id'] = session(
                                                                    'partner_ref_id',
                                                                );
                                                            }

                                                            if (session('applied_by')) {
                                                                $routeParameters['applied_by'] = session('applied_by');
                                                            }

                                                            if (session('is_anonymous')) {
                                                                $routeParameters['is_anonymous'] = session(
                                                                    'is_anonymous',
                                                                );
                                                            }
                                                        @endphp

                                                        <a href="{{ route('frontend.university_details', $routeParameters) }}"
                                                            data-toggle="tooltip"
                                                            title="{{ $course->university?->name }}">
                                                            {{ Illuminate\Support\Str::limit($course->university?->name, 17, '...') }}
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="dtlms-course-detail-curriculum">
                                                <span data-toggle="tooltip"
                                                    title="{{ $course->degree?->name }}">Degree</span>
                                                {{ Illuminate\Support\Str::limit($course->degree?->name, 17, '...') }}
                                            </div>
                                            <div class="dtlms-course-detail-curriculum">
                                                <span data-toggle="tooltip" title="{{ $course->department?->name }}">
                                                    Department
                                                </span>
                                                {{ Illuminate\Support\Str::limit($course->department?->name, 17, '...') }}
                                            </div>
                                            <div class="dtlms-course-detail-curriculum">
                                                <span>Duration</span>
                                                {{ @$course->course_duration }} Years
                                            </div>
                                            <div class="dtlms-course-detail-curriculum">
                                                <span>Students</span>
                                                @php
                                                    $students = \App\Models\CourseParticipant::leftJoin(
                                                        'courses',
                                                        'courses.id',
                                                        'course_participants.course_id',
                                                    )->get();
                                                @endphp
                                                {{ $students->count() }}
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="dtlms-course-detail-content right justify-content-between justify-content-md-end">
                                        <div class="dtlms-coursedetail-price-details px-0 bg-white text-start">
                                            @php
                                                $scholarship = $course->scholarship;

                                                // Calculate yearly tuition fee
                                                $yearly_tuition_fee =
                                                    $scholarship?->tuition_fee == 1
                                                        ? 'Free'
                                                        : $course->year_fee - ($scholarship?->tuition_fee ?? 0);

                                                // Calculate accommodation fee
                                                $accommodation_fee =
                                                    $scholarship?->accommodation_fee == 1
                                                        ? 'Free'
                                                        : $course->accommodation_fee -
                                                            ($scholarship?->accommodation_fee ?? 0);

                                                // Calculate insurance fee
                                                $insurance_fee =
                                                    $scholarship?->insurance_fee == 1
                                                        ? 'Free'
                                                        : $course->insurance_fee - ($scholarship?->insurance_fee ?? 0);

                                                // Check if all fees are 'Free'
                                                $all_free =
                                                    $yearly_tuition_fee == 'Free' &&
                                                    $accommodation_fee == 'Free' &&
                                                    $insurance_fee == 'Free';

                                                if ($all_free) {
                                                    $main_value = 'Free';
                                                } else {
                                                    $main_value = 0;

                                                    $main_value +=
                                                        $yearly_tuition_fee != 'Free' ? $yearly_tuition_fee : 0;
                                                    $main_value +=
                                                        $accommodation_fee != 'Free' ? $accommodation_fee : 0;
                                                    /* $main_value += $insurance_fee != 'Free' ? $insurance_fee : 0;
                                                    $main_value += $course->visa_extension_fee;
                                                    $main_value += $course->medical_in_china_fee; */
                                                }

                                                // Calculate the original total fee before scholarships
                                                $cut_value =
                                                    ($course->year_fee ?? 0) + ($course->accommodation_fee ?? 0);
                                            @endphp

                                            <div class="dtlms-course-detail-curriculum">
                                                <span class="text-dark">Yearly Fee:</span>
                                                <span class="fw-bold"
                                                    style="color: var(--primary_background); font-size:20px">
                                                    {{ $main_value == 0 || $main_value == 'Free' ? 'Free' : convertCurrency($main_value) }}
                                                    <span>
                                                        <del style="color: var(--primary_background); font-size:14px;">
                                                            {{ convertCurrency($cut_value) }}
                                                        </del>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="dtlms-coursedetail-cart-details">
                                            @php
                                                $partnerRef =
                                                    session('partner_ref_id') ?? request()->query('partner_ref_id');
                                                $appliedBy = session('applied_by') ?? request()->query('applied_by');

                                                $apply_url_params = ['id' => $course->id];

                                                if ($partnerRef) {
                                                    $apply_url_params['partner_ref_id'] = $partnerRef;
                                                }

                                                if ($appliedBy) {
                                                    $apply_url_params['applied_by'] = $appliedBy;
                                                }

                                                if (session('is_anonymous')) {
                                                    $apply_url_params['is_anonymous'] = 'true';
                                                }

                                                $apply_url = route('apply_cart', $apply_url_params);
                                            @endphp

                                            @if (strtotime(@$course->application_deadline) < strtotime(now()))
                                                <a href="javascript:void(0)"
                                                    class="dtlms-button small filled add_to_cart_button product_type_simple"
                                                    style="background-color: #6c757d; cursor: not-allowed; pointer-events: none;">
                                                    <i class="fas fa-shopping-cart"></i>Apply Now
                                                </a>
                                            @else
                                                <a href="{{ $apply_url }}"
                                                    class="dtlms-button small filled add_to_cart_button product_type_simple">
                                                    <i class="fas fa-shopping-cart"></i>Apply Now
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dtlms-column dtlms-three-fourth no-space first">
                                <div class="dtlms-tabs-horizontal-container">

                                    <ul class="dtlms-tabs-horizontal scroll_tabs_container scroll_tab_active">
                                        <div class="scroll_tab_left_button scroll_arrow_disabled scroll_tab_left_button_disabled"
                                            style="position: absolute; left: 0px; top: 0px; width: 26px; cursor: pointer;">
                                        </div>

                                        <style>
                                            /* custom styles */
                                            .scroll_tab_inner::-webkit-scrollbar {
                                                width: 0;
                                                display: none !important;
                                            }
                                        </style>
                                        <div class="scroll_tab_inner"
                                            style="margin: 0px; overflow: scroll !important; white-space: nowrap; text-overflow: clip; font-size: 0px; position: absolute; top: 0px; left: 26px; right: 26px;">
                                            <span
                                                class="scroll_tab_left_finisher tab_selected scroll_tab_left_finisher_selected"
                                                style="display: none;">&nbsp;</span>

                                            <li class="scroll_tab_first tab_selected current"
                                                style="display: inline-block; zoom: 1; user-select: none;">
                                                <a href="javascript:void(0);">
                                                    <span class="fab fa-docker"></span>
                                                    Overview
                                                </a>
                                            </li>
                                            <li style="display: inline-block; zoom: 1; user-select: none;">
                                                <a href="javascript:void(0);">
                                                    <span class="far fa-newspaper"></span>
                                                    Accommodation
                                                </a>
                                            </li>
                                            <li style="display: inline-block; zoom: 1; user-select: none;">
                                                <a href="javascript:void(0);">
                                                    <span class="fas fa-id-card"></span>
                                                    Pre-Requisites
                                                </a>
                                            </li>
                                            <li style="display: inline-block; zoom: 1; user-select: none;">
                                                <a href="javascript:void(0);">
                                                    <span class="fas">&#xf0d6;</span>
                                                    Costs & Scholarships
                                                </a>
                                            </li>
                                            <li class="scroll_tab_last"
                                                style="display: inline-block; zoom: 1; user-select: none;">
                                                <a href="javascript:void(0);">
                                                    <span class="fas fa-star"></span>
                                                    Reviews
                                                </a>
                                            </li>
                                            <span class="scroll_tab_right_finisher" style="display: none;">&nbsp;</span>
                                        </div>
                                        <div class="scroll_tab_right_button"
                                            style="position: absolute; right: 0px; top: 0px; width: 26px; cursor: pointer;">
                                        </div>
                                    </ul>

                                    <div class="dtlms-tabs-horizontal-content" style="display: block;">
                                        <div class="dtlms-title">About This Program</div>
                                        <div class="ckeditor5-rendered">
                                            {!! @$course->about !!}
                                        </div>
                                    </div>

                                    <div class="dtlms-tabs-horizontal-content" style="display: none;">
                                        <div class="dtlms-title">Accommodation</div>
                                        <div class="ckeditor5-rendered">
                                            {!! @$course->university->accommodation !!}
                                        </div>

                                        @php
                                            $selectedDormitories = json_decode($course->dormitories, true) ?? [];
                                            $selectedDormitoriesDetails = $dormitories->whereIn(
                                                'id',
                                                $selectedDormitories,
                                            );
                                        @endphp

                                        @if (!empty($selectedDormitories))
                                            <div class="row justify-content-start">
                                                <div class="dtlms-title mt-4">Dormitories</div>

                                                @foreach ($selectedDormitoriesDetails as $dormitory)
                                                    <div class="col-md-12 mb-4">
                                                        <div class="card main-service-card bg-light">
                                                            <div class="card-body">
                                                                <h4 class="fs-5 fw-bold mt-4 mb-2"
                                                                    style="color: var(--btn_primary_color)">
                                                                    {{ $dormitory->name }}
                                                                </h4>

                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-4">
                                                                        <div class="d-flex justify-content-between fs-08">
                                                                            <span class="text-muted text-start mb-0">
                                                                                Rent:
                                                                            </span>
                                                                            <span class="text-muted text-end fw-bold mb-0">
                                                                                @convertCurrency($dormitory->rent)
                                                                            </span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between fs-08">
                                                                            <span class="text-muted text-start mb-0">
                                                                                Persons Per Room:
                                                                            </span>
                                                                            <span class="text-muted text-end fw-bold mb-0">
                                                                                {{ $dormitory->persons_in_room }}
                                                                            </span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between fs-08">
                                                                            <span class="text-muted text-start mb-0">
                                                                                Off Campus Facility:
                                                                            </span>
                                                                            <span class="text-muted text-end fw-bold mb-0">
                                                                                {{ ucfirst($dormitory->off_campus_facility) }}
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                    @if ($dormitory->introduction)
                                                                        <div class="col-12">
                                                                            <h4 class="fw-bold mt-4 mb-2"
                                                                                style="color: var(--btn_primary_color); font-size:17px">
                                                                                Introduction
                                                                            </h4>
                                                                            <p class="text-muted text-start"
                                                                                style="font-size: 16px">
                                                                                {{ $dormitory->introduction }}</p>
                                                                        </div>
                                                                    @endif

                                                                    @if ($dormitory->video_url)
                                                                        <div class="col-12">
                                                                            <h4 class="fw-bold mt-4 mb-2"
                                                                                style="color: var(--btn_primary_color); font-size:17px">
                                                                                Watch Video
                                                                            </h4>

                                                                            <div class="youtube-video-preview">
                                                                                {!! $dormitory->video_url !!}
                                                                            </div>
                                                                        </div>
                                                                    @endif

                                                                    @if ($dormitory->photos)
                                                                        <div class="col-12">
                                                                            <h4 class="fw-bold mt-4 mb-2"
                                                                                style="color: var(--btn_primary_color); font-size:17px">
                                                                                Gallery
                                                                            </h4>

                                                                            <section class="footer_showcase d-flex mt-4">
                                                                                <div id="lightgallery"
                                                                                    class="row justify-content-start px-2">
                                                                                    @foreach (json_decode($dormitory->photos, true) as $index => $image)
                                                                                        <div
                                                                                            class="col-6 col-md-4 col-lg-3 mb-2">
                                                                                            <a href="{{ $image }}"
                                                                                                data-src="{{ $image }}"
                                                                                                class="thumbnail-container">
                                                                                                <div style="height: 200px; border-radius: 8px; overflow:hidden;"
                                                                                                    class="d-flex align-items-center justify-content-center mx-2">
                                                                                                    <img src="{{ $image }}"
                                                                                                        alt="dormitory-photo-{{ $index }}"
                                                                                                        class="img-fluid w-100 h-100"
                                                                                                        style="border-radius: 8px; object-fit:cover">
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </section>

                                                                            <script>
                                                                                lightGallery(document.getElementById('lightgallery'), {
                                                                                    thumbnail: true,
                                                                                    zoom: true,
                                                                                    toggleThumb: true,
                                                                                    selector: '.thumbnail-container',
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="dtlms-tabs-horizontal-content" style="display: none;">
                                        <div class="dtlms-title">Pre-Requisites</div>
                                        <div class="ckeditor5-rendered">
                                            {!! @$course->requisites !!}
                                        </div>
                                    </div>

                                    <div class="dtlms-tabs-horizontal-content" style="display: none;">
                                        <div class="dtlms-title">Tuition Fees & Scholarship Costs</div>

                                        <div class="elementor-widget-container">
                                            <div class="row justify-content-between">
                                                <div class="col-lg-6 px-4 mb-4">
                                                    <div class="card main-service-card"
                                                        style="background-color: var(--primary_background);">
                                                        <div class="card-body"
                                                            style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                                            <p class="text-white fw-bold title">
                                                                Yearly Original Fees
                                                                @if ($course->scholarship_id == 'free')
                                                                    <br>
                                                                    <span>(Full Scholarship)</span>
                                                                @endif
                                                            </p>

                                                            <div style="width: 100%">
                                                                @php
                                                                    $year_fee =
                                                                        $course->scholarship_id == 'free'
                                                                            ? 0
                                                                            : $course->year_fee;
                                                                    $accommodation_fee =
                                                                        $course->scholarship_id == 'free'
                                                                            ? 0
                                                                            : $course->accommodation_fee;
                                                                    $insurance_fee =
                                                                        $course->scholarship_id == 'free'
                                                                            ? 0
                                                                            : $course->insurance_fee;
                                                                    $visa_extension_fee =
                                                                        $course->scholarship_id == 'free'
                                                                            ? 0
                                                                            : $course->visa_extension_fee;
                                                                    $medical_in_china_fee =
                                                                        $course->scholarship_id == 'free'
                                                                            ? 0
                                                                            : $course->medical_in_china_fee;

                                                                    $total_yearly_fees =
                                                                        $year_fee +
                                                                            $accommodation_fee +
                                                                            $insurance_fee +
                                                                            $visa_extension_fee +
                                                                            $medical_in_china_fee ??
                                                                        0;
                                                                @endphp
                                                                <div class="d-flex justify-content-between">
                                                                    <span class="text-white text-start mb-0">
                                                                        Tuition Fee:
                                                                    </span>
                                                                    <span class="text-white text-end fw-bold mb-0">
                                                                        {{ $year_fee !== null ? convertCurrency($year_fee) : '-' }}
                                                                    </span>
                                                                </div>
                                                                <div class="d-flex justify-content-between mt-2">
                                                                    <span class="text-white text-start mb-0">
                                                                        Accommodation Fee:
                                                                    </span>
                                                                    <span class="text-white text-end fw-bold mb-0">
                                                                        {{ $accommodation_fee !== null ? convertCurrency($accommodation_fee) : '-' }}
                                                                    </span>
                                                                </div>
                                                                <div class="d-flex justify-content-between mt-2">
                                                                    <span class="text-white text-start mb-0">
                                                                        Insurance Fee:
                                                                    </span>
                                                                    <span class="text-white text-end fw-bold mb-0">
                                                                        {{ $insurance_fee !== null ? convertCurrency($insurance_fee) : '-' }}
                                                                    </span>
                                                                </div>
                                                                <div class="d-flex justify-content-between mt-2">
                                                                    <span class="text-white text-start mb-0">
                                                                        Visa Extension:
                                                                    </span>
                                                                    <span class="text-white text-end fw-bold mb-0">
                                                                        {{ $visa_extension_fee !== null ? convertCurrency($visa_extension_fee) : '-' }}
                                                                    </span>
                                                                </div>
                                                                <div class="d-flex justify-content-between mt-2">
                                                                    <span class="text-white text-start mb-0">
                                                                        Medical In China:
                                                                    </span>
                                                                    <span class="text-white text-end fw-bold mb-0">
                                                                        {{ $medical_in_china_fee !== null ? convertCurrency($medical_in_china_fee) : '-' }}
                                                                    </span>
                                                                </div>
                                                                {{-- <div
                                                                    class="d-flex border-top justify-content-between mt-3 pt-1">
                                                                    <span class="text-muted text-start mb-0">
                                                                        Total Yearly Fees
                                                                    </span>
                                                                    <span class="text-muted text-end fw-bold mb-0">
                                                                        {{ convertCurrency($total_yearly_fees) }}
                                                                    </span>
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($course->scholarship_id != 'free')
                                                    <div class="col-lg-6 px-4 mb-4">
                                                        @php
                                                            $scholarship = $course->scholarship;

                                                            $scholarship_amount =
                                                                $scholarship?->scholarship_amount == 1
                                                                    ? 'Free'
                                                                    : $scholarship?->scholarship_amount ?? 0;
                                                            $yearly_tuition_fee =
                                                                $scholarship?->tuition_fee == 1
                                                                    ? 'Free'
                                                                    : $course->year_fee -
                                                                        ($scholarship?->tuition_fee ?? 0);
                                                            $accommodation_fee =
                                                                $scholarship?->accommodation_fee == 1
                                                                    ? 'Free'
                                                                    : $course->accommodation_fee -
                                                                        ($scholarship?->accommodation_fee ?? 0);
                                                            $insurance_fee =
                                                                $scholarship?->insurance_fee == 1
                                                                    ? 'Free'
                                                                    : $course->insurance_fee -
                                                                        ($scholarship?->insurance_fee ?? 0);
                                                            $stipend_monthly =
                                                                $scholarship?->stipend_monthly == 1
                                                                    ? 'Free'
                                                                    : $scholarship?->stipend_monthly ?? '-';
                                                            $stipend_yearly =
                                                                $scholarship?->stipend_yearly == 1
                                                                    ? 'Free'
                                                                    : $scholarship?->stipend_yearly ?? '-';
                                                            $visa_extension = $course->visa_extension_fee ?? 0;
                                                            $medical_in_china = $course->medical_in_china_fee ?? 0;

                                                            $total_fees_after_scholarship = 0;
                                                            $total_fees_after_scholarship += $visa_extension;
                                                            $total_fees_after_scholarship += $medical_in_china;
                                                            $total_fees_after_scholarship += is_numeric(
                                                                $scholarship_amount,
                                                            )
                                                                ? $scholarship_amount
                                                                : 0;
                                                            $total_fees_after_scholarship += is_numeric(
                                                                $yearly_tuition_fee,
                                                            )
                                                                ? $yearly_tuition_fee
                                                                : 0;
                                                            $total_fees_after_scholarship += is_numeric(
                                                                $accommodation_fee,
                                                            )
                                                                ? $accommodation_fee
                                                                : 0;
                                                            $total_fees_after_scholarship += is_numeric($insurance_fee)
                                                                ? $insurance_fee
                                                                : 0;
                                                        @endphp

                                                        @if (empty($scholarship))
                                                            <div class="card main-service-card"
                                                                style="background-color: var(--tertiary_background);">
                                                                <div class="card-body"
                                                                    style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                                                    <p class="text-white fw-bold title">No Scholarship
                                                                        Available</p>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="card main-service-card"
                                                                style="background-color: var(--tertiary_background);">
                                                                <div class="card-body"
                                                                    style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                                                    <p class="text-white fw-bold title">
                                                                        After Scholarship Fees
                                                                        @if ($scholarship)
                                                                            <br>
                                                                            <span
                                                                                style="font-size: 0.9rem">({{ $scholarship->title }})</span>
                                                                        @endif
                                                                    </p>

                                                                    <div style="width: 100%">
                                                                        {{-- <div class="d-flex justify-content-between">
                                                                            <span
                                                                                class="text-muted text-start mb-0">Scholarship
                                                                                Amount:</span>
                                                                            <span
                                                                                class="text-muted text-end fw-bold mb-0">{{ $scholarship_amount == 'Free' ? 'Free' : convertCurrency($scholarship_amount) }}</span>
                                                                        </div> --}}
                                                                        <div class="d-flex justify-content-between">
                                                                            <span
                                                                                class="text-white text-start mb-0">Tuition
                                                                                Fee:</span>
                                                                            <span class="text-white text-end fw-bold mb-0">
                                                                                @php
                                                                                    if (
                                                                                        $yearly_tuition_fee == 'Free' ||
                                                                                        $yearly_tuition_fee == 1 ||
                                                                                        $yearly_tuition_fee == 0
                                                                                    ) {
                                                                                        $yearly_tuition_fee = 'Free';
                                                                                    } else {
                                                                                        $yearly_tuition_fee = convertCurrency(
                                                                                            $yearly_tuition_fee,
                                                                                        );
                                                                                    }
                                                                                @endphp
                                                                                {{ $yearly_tuition_fee }}
                                                                            </span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between mt-2">
                                                                            <span
                                                                                class="text-white text-start mb-0">Accommodation
                                                                                Fee:</span>
                                                                            <span class="text-white text-end fw-bold mb-0">
                                                                                @php
                                                                                    if (
                                                                                        $accommodation_fee == 'Free' ||
                                                                                        $accommodation_fee == 1 ||
                                                                                        $accommodation_fee == 0
                                                                                    ) {
                                                                                        $accommodation_fee = 'Free';
                                                                                    } else {
                                                                                        $accommodation_fee = convertCurrency(
                                                                                            $accommodation_fee,
                                                                                        );
                                                                                    }
                                                                                @endphp
                                                                                {{ $accommodation_fee }}
                                                                            </span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between mt-2">
                                                                            <span
                                                                                class="text-white text-start mb-0">Insurance
                                                                                Fee:</span>
                                                                            <span class="text-white text-end fw-bold mb-0">
                                                                                @php
                                                                                    if (
                                                                                        $insurance_fee == 'Free' ||
                                                                                        $insurance_fee == 1 ||
                                                                                        $insurance_fee == 0
                                                                                    ) {
                                                                                        $insurance_fee = 'Free';
                                                                                    } else {
                                                                                        $insurance_fee = convertCurrency(
                                                                                            $insurance_fee,
                                                                                        );
                                                                                    }
                                                                                @endphp
                                                                                {{ $insurance_fee }}
                                                                            </span>
                                                                        </div>
                                                                        {{-- <div class="d-flex justify-content-between mt-2">
                                                                            <span class="text-muted text-start mb-0">Visa
                                                                                Extension:</span>
                                                                            <span
                                                                                class="text-muted text-end fw-bold mb-0">@convertCurrency($visa_extension)</span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between mt-2">
                                                                            <span
                                                                                class="text-muted text-start mb-0">Medical
                                                                                In China:</span>
                                                                            <span
                                                                                class="text-muted text-end fw-bold mb-0">@convertCurrency($medical_in_china)</span>
                                                                        </div> --}}
                                                                        <div class="d-flex justify-content-between mt-2">
                                                                            <span
                                                                                class="text-white text-start mb-0">Stipend
                                                                                (Monthly):</span>
                                                                            <span class="text-white text-end fw-bold mb-0">
                                                                                @php
                                                                                    if ($stipend_monthly == 'Free') {
                                                                                        $stipend_monthly = 'Free';
                                                                                    } elseif ($stipend_monthly == 0) {
                                                                                        $stipend_monthly =
                                                                                            'Not Available';
                                                                                    }
                                                                                @endphp
                                                                                {{ $stipend_monthly }}
                                                                            </span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between mt-2">
                                                                            <span
                                                                                class="text-white text-start mb-0">Stipend
                                                                                (Yearly):</span>
                                                                            <span class="text-white text-end fw-bold mb-0">
                                                                                @php
                                                                                    if ($stipend_yearly == 'Free') {
                                                                                        $stipend_yearly = 'Free';
                                                                                    } elseif ($stipend_yearly == 0) {
                                                                                        $stipend_yearly =
                                                                                            'Not Available';
                                                                                    }
                                                                                @endphp
                                                                                {{ $stipend_yearly }}
                                                                            </span>
                                                                        </div>
                                                                        {{-- <div
                                                                            class="d-flex border-top justify-content-between mt-3 pt-1">
                                                                            <span class="text-muted text-start mb-0">
                                                                                Total Fees After Scholarship</span>
                                                                            <span
                                                                                class="text-muted text-end fw-bold mb-0">{{ convertCurrency($total_fees_after_scholarship) }}</span>
                                                                        </div> --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif

                                                @if (!empty($course->additional_scholarships))
                                                    @php
                                                        $additional_scholarships =
                                                            json_decode($course->additional_scholarships, true) ?? [];
                                                    @endphp
                                                    @foreach ($additional_scholarships as $scholarship_id)
                                                        @if ($scholarship_id != 'free')
                                                            <div class="col-lg-6 px-4 mb-4">
                                                                @php
                                                                    $scholarship = App\Models\Scholarship::find(
                                                                        $scholarship_id,
                                                                    );

                                                                    $scholarship_amount =
                                                                        $scholarship?->scholarship_amount == 1
                                                                            ? 'Free'
                                                                            : $scholarship?->scholarship_amount ?? 0;
                                                                    $yearly_tuition_fee =
                                                                        $scholarship?->tuition_fee == 1
                                                                            ? 'Free'
                                                                            : $scholarship?->tuition_fee ?? 0;
                                                                    $accommodation_fee =
                                                                        $scholarship?->accommodation_fee == 1
                                                                            ? 'Free'
                                                                            : $scholarship?->accommodation_fee ?? 0;
                                                                    $insurance_fee =
                                                                        $scholarship?->insurance_fee == 1
                                                                            ? 'Free'
                                                                            : $scholarship?->insurance_fee ?? 0;
                                                                    $stipend_monthly =
                                                                        $scholarship?->stipend_monthly == 1
                                                                            ? 'Free'
                                                                            : $scholarship?->stipend_monthly ?? '-';
                                                                    $stipend_yearly =
                                                                        $scholarship?->stipend_yearly == 1
                                                                            ? 'Free'
                                                                            : $scholarship?->stipend_yearly ?? '-';
                                                                    $visa_extension = $course->visa_extension_fee ?? 0;
                                                                    $medical_in_china =
                                                                        $course->medical_in_china_fee ?? 0;

                                                                    $total_fees_after_scholarship = 0;
                                                                    $total_fees_after_scholarship += $visa_extension;
                                                                    $total_fees_after_scholarship += $medical_in_china;
                                                                    $total_fees_after_scholarship += is_numeric(
                                                                        $scholarship_amount,
                                                                    )
                                                                        ? $scholarship_amount
                                                                        : 0;
                                                                    $total_fees_after_scholarship += is_numeric(
                                                                        $yearly_tuition_fee,
                                                                    )
                                                                        ? $yearly_tuition_fee
                                                                        : 0;
                                                                    $total_fees_after_scholarship += is_numeric(
                                                                        $accommodation_fee,
                                                                    )
                                                                        ? $accommodation_fee
                                                                        : 0;
                                                                    $total_fees_after_scholarship += is_numeric(
                                                                        $insurance_fee,
                                                                    )
                                                                        ? $insurance_fee
                                                                        : 0;
                                                                @endphp

                                                                @if (empty($scholarship))
                                                                    <div class="card main-service-card"
                                                                        @if ($loop->iteration % 2 != 0) style="background-color: var(--primary_background);"
                                                                        @else
                                                                            style="background-color: var(--tertiary_background);" @endif>
                                                                        <div class="card-body"
                                                                            style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                                                            <p class="text-white fw-bold title">
                                                                                No Scholarship Available
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="card main-service-card"
                                                                        @if ($loop->iteration % 2 != 0) style="background-color: var(--primary_background);"
                                                                        @else
                                                                            style="background-color: var(--tertiary_background);" @endif>
                                                                        <div class="card-body"
                                                                            style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                                                            <p class="text-white fw-bold title">
                                                                                @if ($scholarship)
                                                                                    <br>
                                                                                    <span
                                                                                        style="font-size: 0.9rem">({{ $scholarship->title }})</span>
                                                                                @endif
                                                                            </p>

                                                                            <div style="width: 100%">
                                                                                {{-- <div class="d-flex justify-content-between">
                                                                            <span
                                                                                class="text-muted text-start mb-0">Scholarship
                                                                                Amount:</span>
                                                                            <span
                                                                                class="text-muted text-end fw-bold mb-0">{{ $scholarship_amount == 'Free' ? 'Free' : convertCurrency($scholarship_amount) }}</span>
                                                                        </div> --}}
                                                                                <div
                                                                                    class="d-flex justify-content-between">
                                                                                    <span
                                                                                        class="text-white text-start mb-0">Tuition
                                                                                        Fee:</span>
                                                                                    <span
                                                                                        class="text-white text-end fw-bold mb-0">{{ $yearly_tuition_fee == 'Free' ? 'Free' : convertCurrency($yearly_tuition_fee) }}</span>
                                                                                </div>
                                                                                <div
                                                                                    class="d-flex justify-content-between mt-2">
                                                                                    <span
                                                                                        class="text-white text-start mb-0">Accommodation
                                                                                        Fee:</span>
                                                                                    <span
                                                                                        class="text-white text-end fw-bold mb-0">{{ $accommodation_fee == 'Free' ? 'Free' : convertCurrency($accommodation_fee) }}</span>
                                                                                </div>
                                                                                <div
                                                                                    class="d-flex justify-content-between mt-2">
                                                                                    <span
                                                                                        class="text-white text-start mb-0">Insurance
                                                                                        Fee:</span>
                                                                                    <span
                                                                                        class="text-white text-end fw-bold mb-0">{{ $insurance_fee == 'Free' ? 'Free' : convertCurrency($insurance_fee) }}</span>
                                                                                </div>
                                                                                {{-- <div class="d-flex justify-content-between mt-2">
                                                                            <span class="text-muted text-start mb-0">Visa
                                                                                Extension:</span>
                                                                            <span
                                                                                class="text-muted text-end fw-bold mb-0">@convertCurrency($visa_extension)</span>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between mt-2">
                                                                            <span
                                                                                class="text-muted text-start mb-0">Medical
                                                                                In China:</span>
                                                                            <span
                                                                                class="text-muted text-end fw-bold mb-0">@convertCurrency($medical_in_china)</span>
                                                                        </div> --}}
                                                                                <div
                                                                                    class="d-flex justify-content-between mt-2">
                                                                                    <span
                                                                                        class="text-white text-start mb-0">Stipend
                                                                                        (Monthly)
                                                                                        :</span>
                                                                                    <span
                                                                                        class="text-white text-end fw-bold mb-0">{{ $stipend_monthly == 'Free' ? 'Free' : $stipend_monthly }}</span>
                                                                                </div>
                                                                                <div
                                                                                    class="d-flex justify-content-between mt-2">
                                                                                    <span
                                                                                        class="text-white text-start mb-0">Stipend
                                                                                        (Yearly):</span>
                                                                                    <span
                                                                                        class="text-white text-end fw-bold mb-0">{{ $stipend_yearly == 'Free' ? 'Free' : $stipend_yearly }}</span>
                                                                                </div>
                                                                                {{-- <div
                                                                            class="d-flex border-top justify-content-between mt-3 pt-1">
                                                                            <span class="text-muted text-start mb-0">
                                                                                Total Fees After Scholarship</span>
                                                                            <span
                                                                                class="text-muted text-end fw-bold mb-0">{{ convertCurrency($total_fees_after_scholarship) }}</span>
                                                                        </div> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dtlms-tabs-horizontal-content" style="display: none;">
                                        <div class="dtlms-title">Reviews</div>
                                        <div class="dtlms-column dtlms-one-third first">
                                            <div class="dtlms-course-detail-review-box">
                                                <div class="dtlms-course-detail-average-value">
                                                    {{ round(@$course->reviews->avg('ratting'), 1) }}</div>
                                                <div class="dtlms-course-detail-star-review">
                                                    @php
                                                        $avg_round = floor($course->reviews->avg('ratting'));
                                                    @endphp

                                                    @for ($i = 1; $i <= @$avg_round; $i++)
                                                        <span class="zmdi zmdi-star"
                                                            data-value="{{ $i }}"></span>
                                                    @endfor
                                                </div>
                                                <div class="dtlms-course-detail-total-reviews">
                                                    {{ count(@$course->reviews) }} Reviews</div>
                                            </div>
                                        </div>
                                        <div class="dtlms-column dtlms-two-third">
                                            <ul class="dtlms-course-detail-ratings-breakup">
                                                <li>
                                                    @php
                                                        @$one_count = @$course->reviews?->where('ratting', 1)?->count();
                                                        @$one_percent =
                                                            @$one_count > 0
                                                                ? (@$one_count / @$course?->reviews?->count()) * 100
                                                                : 0;
                                                    @endphp
                                                    <span class="dtlms-course-detail-ratings-label">1 Stars</span>
                                                    <div class="dtlms-course-detail-ratings-percentage">
                                                        <span style="width:{{ @$one_percent }}%"></span>
                                                    </div>
                                                    <span>{{ @$one_count }}</span>
                                                </li>
                                                <li>
                                                    @php
                                                        @$two_count = @$course->reviews?->where('ratting', 2)?->count();
                                                        @$two_percent =
                                                            @$two_count > 0
                                                                ? (@$two_count / @$course?->reviews?->count()) * 100
                                                                : 0;
                                                    @endphp
                                                    <span class="dtlms-course-detail-ratings-label">2 Stars</span>
                                                    <div class="dtlms-course-detail-ratings-percentage">
                                                        <span style="width:{{ @$two_percent }}%"></span>
                                                    </div>
                                                    <span>{{ @$two_count }}</span>
                                                </li>
                                                <li>
                                                    @php
                                                        @$three_count = @$course->reviews
                                                            ?->where('ratting', 3)
                                                            ?->count();
                                                        @$three_percent =
                                                            @$three_count > 0
                                                                ? (@$three_count / @$course?->reviews?->count()) * 100
                                                                : 0;
                                                    @endphp
                                                    <span class="dtlms-course-detail-ratings-label">3 Stars</span>
                                                    <div class="dtlms-course-detail-ratings-percentage">
                                                        <span style="width:{{ @$three_percent }}%"></span>
                                                    </div>
                                                    <span>{{ @$three_count }}</span>
                                                </li>
                                                <li>
                                                    @php
                                                        @$four_count = @$course->reviews
                                                            ?->where('ratting', 4)
                                                            ?->count();
                                                        @$four_percent =
                                                            @$four_count > 0
                                                                ? (@$four_count / @$course?->reviews?->count()) * 100
                                                                : 0;
                                                    @endphp
                                                    <span class="dtlms-course-detail-ratings-label">4 Stars</span>
                                                    <div class="dtlms-course-detail-ratings-percentage">
                                                        <span style="width:{{ @$four_percent }}%"></span>
                                                    </div>
                                                    <span>{{ @$four_count }}</span>
                                                </li>
                                                <li>
                                                    @php
                                                        @$five_count = @$course->reviews
                                                            ?->where('ratting', 5)
                                                            ?->count();
                                                        @$five_percent =
                                                            @$five_count > 0
                                                                ? (@$five_count / @$course?->reviews?->count()) * 100
                                                                : 0;
                                                    @endphp
                                                    <span class="dtlms-course-detail-ratings-label">5 Stars</span>
                                                    <div class="dtlms-course-detail-ratings-percentage">
                                                        <span style="width:{{ @$five_percent }}%"></span>
                                                    </div>
                                                    <span>{{ @$five_count }}</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="single-dtlms">
                                            <div id="comments" class="comments-area">
                                                <h3>Comments ({{ $reviews->count() }})</h3>
                                                <ul class="commentlist">
                                                    @foreach ($reviews as $review)
                                                        <li id="comment-55" class="comment even thread-even depth-1">
                                                            <article id="div-comment-55" class="comment-body">
                                                                <footer class="comment-meta">
                                                                    <div class="comment-author vcard">
                                                                        <img alt=""
                                                                            src="{{ $review->user->image_show }}"
                                                                            srcset="https://secure.gravatar.com/avatar/4016094f0e1d3a11fed8105d3bd999cf?s=100&amp;d=mm&amp;r=g 2x"
                                                                            class="avatar avatar-50 photo" height="50"
                                                                            width="50" decoding="async"> <b
                                                                            class="fn">{{ $review->user->name }}</b>
                                                                        <span class="says">says:</span>
                                                                    </div>
                                                                    <div class="comment-metadata">
                                                                        <a href="#">
                                                                            <time datetime="2017-11-22T07:07:29+00:00">
                                                                                {{ \Carbon\Carbon::createFromTimestamp($review->created_at->timestamp, 'Asia/Dhaka')->format('d M, Y h:i a') }}
                                                                            </time>
                                                                        </a>
                                                                    </div>
                                                                </footer>
                                                                <div class="comment-content">
                                                                    <div class="dtlms-comment-rating">
                                                                        @for ($i = 1; $i <= $review->ratting; $i++)
                                                                            <span class="zmdi zmdi-star"
                                                                                data-value="{{ $i }}"></span>
                                                                        @endfor
                                                                    </div>
                                                                    <p>{{ $review->comment }}</p>
                                                                </div>
                                                            </article>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                <div id="respond" class="comment-respond">
                                                    <h3 id="reply-title" class="comment-reply-title">
                                                        Leave a Comment
                                                    </h3>
                                                    <form action="{{ route('frontend.review.store') }}" method="post"
                                                        id="commentform" class="comment-form" novalidate="">
                                                        @csrf

                                                        <p class="comment-notes">
                                                            <span class="required-field-message">
                                                                Required fields are marked
                                                                <span class="required">*</span>
                                                            </span>
                                                        </p>
                                                        <div class="dtlms-rating-wrapper">
                                                            <label for="lms_rating">Ratings</label>
                                                            <div class="ratings">

                                                                <div class="avatar-text">
                                                                    <div class="rating-input-block">
                                                                        <input type="hidden" name="ratting"
                                                                            id="input_rating">
                                                                        <input type="hidden" name="course_id"
                                                                            value="{{ $course->id }}">
                                                                        <input type="hidden" value="Program"
                                                                            name="type" />
                                                                        <i data-rating="1"
                                                                            class="fas fa-star fs-4 input-ratting"
                                                                            style="color:#ffe6ad;"></i>
                                                                        <i data-rating="2"
                                                                            class="fas fa-star fs-4 input-ratting"
                                                                            style="color:#ffe6ad;"></i>
                                                                        <i data-rating="3"
                                                                            class="fas fa-star fs-4 input-ratting"
                                                                            style="color:#ffe6ad;"></i>
                                                                        <i data-rating="4"
                                                                            class="fas fa-star fs-4 input-ratting"
                                                                            style="color:#ffe6ad;"></i>
                                                                        <i data-rating="5"
                                                                            class="fas fa-star fs-4 input-ratting"
                                                                            style="color:#ffe6ad;"></i>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <script>
                                                                var ratingInputBlock = document.querySelector('.rating-input-block');

                                                                // Mouseleave event
                                                                ratingInputBlock.addEventListener('mouseleave', function() {
                                                                    var activeStar = document.querySelector('.input-ratting.active');
                                                                    var rm = activeStar ? parseInt(activeStar.getAttribute('data-rating')) : 0;

                                                                    for (var i = 1; i <= rm; i++) {
                                                                        var star = document.querySelector('.input-ratting[data-rating="' + i + '"]');
                                                                        star.classList.add('text-warning');
                                                                        star.classList.remove('btn-grey');
                                                                    }

                                                                    for (var ram = rm + 1; ram <= 5; ram++) {
                                                                        var star = document.querySelector('.input-ratting[data-rating="' + ram + '"]');
                                                                        star.classList.remove('text-warning');
                                                                        star.classList.add('btn-grey');
                                                                    }
                                                                });

                                                                // Mouseenter event
                                                                ratingInputBlock.addEventListener('mouseenter', function() {
                                                                    console.log("over");
                                                                });

                                                                // Click event
                                                                var stars = document.querySelectorAll('.input-ratting');
                                                                stars.forEach(function(star) {
                                                                    star.addEventListener('click', function() {
                                                                        stars.forEach(function(s) {
                                                                            s.classList.remove('active');
                                                                        });

                                                                        if (this.classList.contains('active')) {
                                                                            document.getElementById('input_rating').value = '';
                                                                            this.classList.remove('active');
                                                                        } else {
                                                                            document.getElementById('input_rating').value = this.getAttribute(
                                                                                'data-rating');
                                                                            this.classList.add('active');
                                                                        }
                                                                    });
                                                                });

                                                                // Hover event
                                                                stars.forEach(function(star) {
                                                                    star.addEventListener('mouseenter', function() {
                                                                        var rating = parseInt(this.getAttribute('data-rating'));
                                                                        stars.forEach(function(s) {
                                                                            var sRating = parseInt(s.getAttribute('data-rating'));
                                                                            if (sRating <= rating) {
                                                                                s.classList.add('text-warning');
                                                                                s.classList.remove('btn-grey');
                                                                            } else {
                                                                                s.classList.remove('text-warning');
                                                                                s.classList.add('btn-grey');
                                                                            }
                                                                        });
                                                                    });
                                                                });
                                                            </script>
                                                        </div>

                                                        <p class="comment-form-comment">
                                                            <textarea id="comment" name="comment" cols="45" rows="8" placeholder="Comment *" maxlength="65525"
                                                                required></textarea>
                                                        </p>
                                                        <p class="form-submit">
                                                            <input name="submit" type="submit" id="submit"
                                                                class="submit" value="Post Comment">
                                                        </p>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="dtlms-column dtlms-one-fourth no-space">
                                <div class="dtlms-course-dynamic-section-holder"></div>

                                <div class="dtlms-courses-detail-holder">
                                    <div class="dtlms-title">Course Info</div>
                                    <ul class="dtlms-course-detail-info">
                                        @php
                                            $yearly_tuition_fee = $course->year_fee;
                                            $accommodation_fee = $course->accommodation_fee;
                                            $stipend_monthly =
                                                $course->scholarship?->stipend_monthly == 1
                                                    ? 'Free'
                                                    : ($course->scholarship?->stipend_monthly
                                                        ? $course->scholarship?->stipend_monthly
                                                        : '');
                                            $course_scholarship = $course->scholarship_id;

                                            if ($course_scholarship != 'free') {
                                                $yearly_tuition_fee = '';

                                                if ($course->scholarship?->tuition_fee == 1) {
                                                    $yearly_tuition_fee = 'Free';
                                                } elseif ($course->scholarship?->tuition_fee !== null) {
                                                    $yearly_tuition_fee =
                                                        $course->year_fee - $course->scholarship?->tuition_fee;
                                                } elseif ($course->year_fee !== null) {
                                                    $yearly_tuition_fee = $course->year_fee;
                                                }

                                                if ($course->accommodation_fee) {
                                                    $accommodation_fee =
                                                        $course->scholarship?->accommodation_fee == 1
                                                            ? 'Free'
                                                            : $course->accommodation_fee -
                                                                $course->scholarship?->accommodation_fee;
                                                } else {
                                                    $accommodation_fee = '';
                                                }
                                            } elseif ($course_scholarship == 'free') {
                                                $yearly_tuition_fee = 'Free';
                                                $accommodation_fee = 'Free';
                                                $stipend_monthly = 'Free';
                                            }
                                        @endphp

                                        <li>
                                            <label>Application Deadline :</label>
                                            {{ date('d-m-Y', strtotime($course->application_deadline)) }}
                                        </li>
                                        <li>
                                            <label>Service Charge: </label>
                                            @if ($course->service_charge_1)
                                                @convertCurrency($course->service_charge_1)
                                            @else
                                                @convertCurrency(0)
                                            @endif

                                            @if ($course->service_charge_1 != '' && $course->service_charge_2 != '')
                                                -
                                            @endif

                                            @if ($course->service_charge_2)
                                                @convertCurrency($course->service_charge_2)
                                            @endif
                                        </li>
                                        <li>
                                            <label>Application Fees: </label>
                                            @convertCurrency($course->application_charge)
                                        </li>
                                        <li>
                                            <label>Tuition Fees (Yearly): </label>
                                            @convertCurrency($yearly_tuition_fee)
                                        </li>
                                        <li>
                                            <label>Accommodation Fees (Yearly): </label>
                                            @convertCurrency($accommodation_fee)
                                        </li>
                                        <li>
                                            <label>Stipend (Monthly): </label>
                                            {{ $stipend_monthly ?? '-' }}
                                        </li>
                                    </ul>
                                </div>

                                <div class="dtlms-courses-share-holder">
                                    <div class="dtlms-title">Social Share</div>
                                    <ul class="dtlms-courses-share-list with-color with-circle">
                                        <li>
                                            <a href="https://www.facebook.com/sharer.php?u={{ route('frontend.course.details', ['id' => $course->id]) }}"
                                                title="facebook" target="_blank">
                                                <span class="fab fa-facebook-f"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="//www.linkedin.com/shareArticle?mini=true&amp;title={{ urlencode($course->name) }}&amp;url={{ route('frontend.course.details', ['id' => $course->id]) }}"
                                                title="linkedin" target="_blank">
                                                <span class="fab fa-linkedin-in"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://api.whatsapp.com/send?text={{ route('frontend.course.details', ['id' => $course->id]) }}"
                                                title="whatsapp" target="_blank">
                                                <span class="fab fa-whatsapp"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="mailto:?subject={{ urlencode($course->name) }}&body={{ route('frontend.course.details', ['id' => $course->id]) }}"
                                                title="envelope" target="_blank">
                                                <span class="far fa-envelope"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.facebook.com/dialog/send?link={{ route('frontend.course.details', ['id' => $course->id]) }}"
                                                title="messenger" target="_blank">
                                                <span class="fab fa-facebook-messenger"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </article>
                    </div>
                </div><!-- ** Container End ** -->
            </div><!-- **Main - End ** -->
        </div><!-- **Inner Wrapper - End** -->

    </div>

    @include('Frontend.course.related_course')

    @include('Frontend.layouts.parts.news-letter')
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('frontend/lizza/js/jquery.min.js') }}" id="dtlms-tabs-js"></script>
    <script type="text/javascript" src="{{ asset('frontend/lizza/js/jquery.tabs.min.js') }}" id="dtlms-tabs-js"></script>
    <script type="text/javascript" src="{{ asset('frontend/lizza/js/jquery.scrolltabs.js') }}" id="scrolltab-js"></script>
    <script type="text/javascript" src="{{ asset('frontend/lizza/js/jquery.mousewheel.js') }}" id="mousewheel-js"></script>
    <script type="text/javascript" id="dtlms-common-js-extra">
        var lmscommonobject = {
            "elementorPreviewMode": ""
        };
    </script>
    <script type="text/javascript" src="{{ asset('frontend/lizza/js/common_2.js') }}" id="dtlms-common-js"></script>
    <script type="text/javascript" src="{{ asset('frontend/lizza/js/frontend_6.js') }}" id="dtlms-frontend-js"></script>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function scrollNav() {
                $('a[href^="#"]').click(function() {
                    $(".active").removeClass("active");
                    $(this).addClass("active");

                    $('html, body').stop().animate({
                        scrollTop: $($(this).attr('href')).offset().top - 140
                    }, 1000);
                    return false;
                });
            }
            scrollNav();
        });
    </script>
@endsection
