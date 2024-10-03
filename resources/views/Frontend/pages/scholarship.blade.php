@extends('Frontend.layouts.master-layout')
@section('title', ' - Scholarship')
@section('head')
    <style>
        .content_search {
            margin-top: 3.5rem;
        }

        .details-text-container p,
        .details-text-container ul {
            color: rgba(16, 24, 40, 0.6);
            font-size: 1rem;
        }

        .page-banner {
            position: relative;
            height: 10rem;
            width: 100%;
            background-image: url('{{ asset('frontend/images/scholarship.jpg') }}');
            background-position: bottom;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-bottom: 2rem;
        }

        .page-banner::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgb(0 29 18 / 70%) 0%, rgb(15 29 65 / 35%) 100%);
            pointer-events: none;
            z-index: 1;
        }

        .page-banner-title {
            margin: 0;
            z-index: 9;
            white-space: nowrap;
        }

        @media screen and (min-width:768px) {
            .page-banner {
                height: 12.5rem;
            }
        }

        @media screen and (min-width:992px) {
            .page-banner {
                height: 14rem;
            }
        }

        @media screen and (min-width:1200px) {
            .page-banner {
                height: 16.75rem;
            }
        }
    </style>

    <style>
        .accordion {
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .accordion-header {
            background: #f1f1f1;
            cursor: pointer;
            padding: 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .accordion-content {
            display: none;
            padding: 15px;
            border-top: 1px solid #ddd;
        }

        .toggle-icon {
            transition: transform 0.3s;
        }

        .accordion-header.active .toggle-icon {
            transform: rotate(180deg);
        }
    </style>

    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/select2.min.css') }}">

    <style>
        .filter-container,
        .table-data-container {
            background-color: #f2f8f19e;
            height: fit-content;
            border-radius: 10px;
            padding: 10px 20px;
        }

        .toggle-header {
            display: flex;
            justify-content: space-between;
            cursor: pointer;
            padding: 10px 0;
        }

        .toggle-header .title {
            font-size: 16px;
            user-select: none;
            font-weight: 600;
            font-style: normal;
            font-stretch: normal;
            line-height: normal;
            letter-spacing: normal;
            text-transform: uppercase;
            text-align: left;
            color: var(--btn_primary_color);
            margin: 0;
        }

        .toggle-header .toggle-icon {
            display: block;
            width: 9.5px;
            height: 9.5px;
            border-left: 1px solid rgba(0, 0, 0, 0.41);
            border-bottom: 1px solid rgba(0, 0, 0, 0.41);
            transition: 0.5s;
            transform: rotate(-45deg);
        }

        .toggle-content {
            display: flex;
            flex-direction: column;
        }

        .toggle-content-wrapper-field {
            display: flex;
            flex-direction: column;
            overflow: auto;
            max-height: 200px;
            max-width: 100%;
            padding: 12px 14px 12px 0;
        }

        .toggle-content .control.display-flex {
            justify-content: space-between;
            margin: 0 1.35rem;
        }

        table.dataTable> :not(:last-child)> :last-child>* {
            border-bottom-color: #cecece !important;
        }
    </style>

    <style>
        .university {
            transition: 0.3s;
            height: 100% !important;
        }

        .university-showcase-container .university-image-container .university-image {
            transition: transform 0.3s;
            transform-origin: center center;
            opacity: 1;
            width: 6.125rem !important;
            height: 5.375rem !important;
            object-fit: contain !important;
            -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
            transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
        }

        .university:hover {
            border-color: var(--primary_background);

            .university-showcase-container .university-image-container .university-image {
                -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1.05) scaleY(1.05);
                transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1.05) scaleY(1.05);
            }
        }

        .university_name:hover {
            color: var(--primary_background) !important;
        }

        .university-course-container {
            height: 340px !important;
        }

        .course-nav-tab .btn-dark-cerulean {
            color: #fff;
            background-color: var(--primary_background) !important;
            border-color: var(--primary_background) !important;
        }

        .course-nav-tab .btn-dark-cerulean:hover {
            color: #fff;
            background-color: var(--primary_background) !important;
            border-color: var(--primary_background) !important;
        }

        .course_nav_tabs::-webkit-scrollbar {
            width: 0px;
            display: none;
        }

        .course-nav-tab-subtitle {
            position: relative;
            display: flex;
            align-items: center;
            color: var(--btn_primary_color);
        }

        .course-nav-tab-subtitle .line {
            width: 30px;
            height: 1px;
            background-color: var(--btn_primary_color);
            margin-right: 10px;
        }

        .course-nav-tab-subtitle .text-uppercase {
            font-weight: 500;
        }

        .browse-more-btn.btn-dark-cerulean {
            color: #fff;
            background-color: var(--secondary_background) !important;
            border-color: var(--secondary_background) !important;
        }

        .browse-more-btn.btn-dark-cerulean:hover {
            color: #fff;
            background-color: var(--primary_background) !important;
            border-color: var(--primary_background) !important;
        }

        .course-university-image-container img {
            transition: transform 0.3s;
            transform-origin: center center;
            opacity: 1;
            width: 6.125rem !important;
            height: 5.375rem !important;
            object-fit: contain !important;
            -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
            transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
        }
    </style>

    <style>
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 18px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 18px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 1px;
            bottom: 1px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: var(--primary_background);
        }

        input:checked+.slider:before {
            transform: translateX(22px);
        }

        .program-top-right-degree {
            position: absolute;
            top: 0;
            right: 0;
            font-size: 14px;
            color: #fff;
            padding: 3px 8px;
            font-weight: 600;
        }

        .university-tag {
            background-color: #ff0015b5;
            padding: 2px 4px;
            border-radius: 4px;
            font-size: 12px;
            color: #fff;
            font-weight: 600;
            white-space: nowrap;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('frontend/DataTables/datatables.css') }}">
@endsection
@section('main_content')

    <div class="content_search">
        <div class="page-banner">
            <h2 class="page-banner-title py-2 fw-bold text-center text-capital py-5" style="color: #fff; letter-spacing:2px;">
                SCHOLARSHIP
            </h2>
        </div>

        <div class="container">
            <div class="row my-3">
                <div class="col-md-4 col-lg-3">
                    <div class="wrapper-filters filter-container" style="display: block;">
                        <div class="toggle-header">
                            <h4 class="title is-5" style="color: var(--primary_background); font-weight:bold">
                                Filter Programs
                            </h4>
                        </div>

                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="scholarship">
                                <h5 class="title is-5">Scholarship</h5>
                                <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="scholarship">
                                <select name="scholarship" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Scholarship</option>
                                    <option value="free">Free</option>
                                    @foreach ($scholarships as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="scholarship_type">
                                <h5 class="title is-5">Scholarship Type</h5>
                                <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="scholarship_type">
                                <select name="scholarship_type" class="form-control select2_form_select"
                                    style="width: 90%;">
                                    <option value="">Select Type</option>
                                    @foreach ($scholarships->unique('type') as $item)
                                        <option value="{{ $item->type }}">{{ $item->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="course_type">
                                <h5 class="title is-5">Program Type</h5>
                                <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="course_type">
                                <select name="course_type" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Type</option>
                                    <option value="1">Our Top Picks</option>
                                    <option value="2">Most Popular</option>
                                    <option value="3">Fastest Admissions</option>
                                    <option value="4">Highest Rating</option>
                                    <option value="5">Top Ranked</option>
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="degree">
                                <h5 class="title is-5">Degree</h5>
                                <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="degree">
                                <select name="degree" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Degree</option>
                                    @foreach ($degrees as $degree)
                                        <option value="{{ $degree->id }}"
                                            {{ request()->get('degree') == $degree->id ? 'selected' : '' }}>
                                            {{ $degree->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="department">
                                <h5 class="title is-5">Major/Subject</h5>
                                <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="department">
                                <select name="subject" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Major/Subject</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ @$department->id }}"
                                            {{ request()->get('department') == $department->id ? 'selected' : '' }}>
                                            {{ @$department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="university">
                                <h5 class="title is-5">University</h5>
                                <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="university" style="display: none">
                                <select name="university" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select University</option>
                                    @foreach ($univerties as $university)
                                        <option value="{{ @$university->id }}"
                                            {{ request()->get('university') == $university->id ? 'selected' : '' }}>
                                            {{ @$university->name . ' ' . $university->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="session">
                                <h5 class="title is-5">Intake</h5>
                                <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="session" style="display: none">
                                <select name="section" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Intake</option>
                                    @foreach ($sections as $session)
                                        <option value="{{ @$session->id }}"
                                            {{ request()->get('session') == $session->id ? 'selected' : '' }}>
                                            {{ @$session->name . ' ' . $session->year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="language">
                                <h5 class="title is-5">Language</h5>
                                <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="language" style="display: none">
                                <select name="language" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Language</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}"
                                            {{ request()->get('language') == $language->id ? 'selected' : '' }}>
                                            {{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="state">
                                <h5 class="title is-5">Province</h5>
                                <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="state" style="display: none">
                                <select name="state" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Province</option>
                                    @foreach ($states as $state)
                                        <option value="{{ @$state->id }}"
                                            {{ request()->get('state') == $state->id ? 'selected' : '' }}>
                                            {{ @$state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="city">
                                <h5 class="title is-5">City</h5>
                                <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="city" style="display: none">
                                <select name="city" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ @$city->id }}"
                                            {{ request()->get('city') == $city->id ? 'selected' : '' }}>
                                            {{ @$city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="tuition_fees">
                                <h5 class="title is-5">Tuition Fees</h5>
                                <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="tuition_fees" style="display: none">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="slider-container" style="width: 50%;">
                                        <input type="range" id="tuition-fees-slider" class="form-range" min="0"
                                            max="500000" step="1000" value="25000" style="width: 100%;">
                                    </div>
                                    <div style="width: 30%">
                                        <input type="text" name="tuition_fees" id="tuition-fees-slider-value"
                                            class="text-center form-control" value="25000">
                                    </div>
                                    <div style="width: 15%">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-search" id="tuition_fees_filter_btn" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="accommodation_fees">
                                <h5 class="title is-5">Accommodation Fees</h5>
                                <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="accommodation_fees" style="display: none">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="slider-container" style="width: 50%;">
                                        <input type="range" id="accommodation-fees-slider" class="form-range"
                                            min="0" max="500000" step="1000" value="25000"
                                            style="width: 100%;">
                                    </div>
                                    <div style="width: 30%">
                                        <input type="text" name="accommodation_fees"
                                            id="accommodation-fees-slider-value" value="25000"
                                            class="text-center form-control">
                                    </div>
                                    <div style="width: 15%">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-search" id="accommodation_fees_filter_btn"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="service_charge">
                                <h5 class="title is-5">Service Charge</h5>
                                <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="service_charge" style="display: none">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="slider-container" style="width: 50%;">
                                        <input type="range" id="service-charge-slider" class="form-range"
                                            min="0" max="500000" step="1000" value="25000"
                                            style="width: 100%;">
                                    </div>
                                    <div style="width: 30%">
                                        <input type="text" name="service_charge" id="service-charge-slider-value"
                                            value="25000" class="text-center form-control">
                                    </div>
                                    <div style="width: 15%">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-search" id="service_charge_filter_btn"
                                                aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9 px-md-3" style="padding-right: 0 !important">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 style="color: var(--primary_background); font-family:'DM Sans', sans-serif; font-weight:700">
                            Programs
                        </h4>
                        <div class="d-inline-flex align-items-center">
                            List Mode &nbsp;
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>

                    @include('Frontend.preloader')

                    <div class="all_course_container">
                        <div class="scholarship-card-container" style="display: none">
                            <div class="row justify-content-start gy-4 gx-3">
                                @forelse ($scholarship_courses as $course)
                                    @php
                                        if (session('partner_ref_id')) {
                                            $partnerRef = session('partner_ref_id');
                                        } elseif (request()->query('partner_ref_id')) {
                                            $partnerRef = request()->query('partner_ref_id');
                                        } else {
                                            $partnerRef = null;
                                        }

                                        if ($partnerRef) {
                                            $apply_url_params = ['id' => $course->id, 'partner_ref_id' => $partnerRef];
                                            $course_details_url_params = [
                                                'id' => $course->id,
                                                'partner_ref_id' => $partnerRef,
                                            ];
                                            $course_list_url_params = ['partner_ref_id' => $partnerRef];

                                            if (session('is_anonymous')) {
                                                $apply_url_params['is_anonymous'] = 'true';
                                                $course_details_url_params['is_anonymous'] = 'true';
                                                $course_list_url_params['is_anonymous'] = 'true';
                                            }

                                            if (session('is_applied_partner')) {
                                                $apply_url_params['is_applied_partner'] = true;
                                                $course_details_url_params['is_applied_partner'] = true;
                                                $course_list_url_params['is_applied_partner'] = true;
                                            }

                                            $apply_url = route('apply_cart', $apply_url_params);
                                            $course_details_url = route(
                                                'frontend.course.details',
                                                $course_details_url_params,
                                            );
                                            $course_list_url = route(
                                                'frontend.university_course_list',
                                                $course_list_url_params,
                                            );
                                        } else {
                                            $apply_url = route('apply_cart', [
                                                'id' => $course->id,
                                            ]);

                                            $course_details_url = route('frontend.course.details', [
                                                'id' => $course->id,
                                            ]);

                                            $course_list_url = route('frontend.university_course_list');
                                        }
                                    @endphp

                                    @if ($course->university)
                                        <div class="col-12 col-md-6 col-lg-4 col-auto mt-sm-3 mt-md-4">
                                            <div class="text-center card university overflow-hidden"
                                                style="border-radius:8px; cursor: pointer;"
                                                onclick="window.location.href='{{ $course_details_url }}'">
                                                <div class="card-body university-course-container mt-4">
                                                    <div class="course-university-image-container">
                                                        <a href="{{ $course_details_url }}">
                                                            <img decoding="async"
                                                                src="{{ @$course->university?->image_show }}"
                                                                alt="{{ $course->university?->name }}"
                                                                title="{{ $course->university?->name }}"
                                                                style="border-radius: 8px" class="university-image">
                                                        </a>
                                                    </div>
                                                    <div class="mt-4">
                                                        <div class="mt-3">
                                                            <a href="{{ $course_details_url }}"
                                                                class="text-dark university_name">
                                                                <h5 style="font-size: 1.25rem;" class="fw-bold">
                                                                    {{ Illuminate\Support\Str::limit($course->name, 35, '...') }}
                                                                </h5>
                                                            </a>
                                                        </div>
                                                        <div style="position: absolute; bottom: 0.85rem; width: 90%;">

                                                            <div class="tags py-0 pt-2 d-flex flex-column">
                                                                <div class="mobile-title">
                                                                    <div class="d-flex flex-column">
                                                                        <div class="my-2 mt-4 text-center">
                                                                            @forelse (json_decode($course->university?->tags, true) ?? [] as $index => $tag)
                                                                                @php
                                                                                    $colors = ['#357A61', '#302C61'];
                                                                                    $backgroundColor =
                                                                                        $colors[
                                                                                            $index % count($colors)
                                                                                        ];
                                                                                @endphp
                                                                                <span class="university-tag mx-1 mt-2"
                                                                                    style="background-color: {{ $backgroundColor }};">
                                                                                    {{ $tag }}
                                                                                </span>
                                                                            @empty
                                                                                <span>&nbsp;</span>
                                                                            @endforelse
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <span class="mt-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" fill="currentColor"
                                                                        class="bi bi-mortarboard-fill"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z" />
                                                                        <path
                                                                            d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z" />
                                                                    </svg>
                                                                    {{ Illuminate\Support\Str::limit($course->university?->name, 35, '...') }}
                                                                </span>
                                                                <span class="mt-1">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                        height="16" class="bi bi-geo-alt-fill"
                                                                        viewBox="0 0 16 16" style="fill:#494949">
                                                                        <path
                                                                            d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                                                    </svg>
                                                                    @php
                                                                        $locationParts = array_filter([
                                                                            /* $course->university?->continent?->name ?? '', */
                                                                            /* $course->university?->country?->name ?? '', */
                                                                            $course->university?->state?->name ?? '',
                                                                            $course->university?->city?->name ?? '',
                                                                        ]);
                                                                    @endphp

                                                                    {{ implode(', ', $locationParts) }}
                                                                </span>

                                                                <div class="mt-1">
                                                                    <span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16"
                                                                            class="bi bi-translate" viewBox="0 0 16 16"
                                                                            style="fill:#494949">
                                                                            <path
                                                                                d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286zm1.634-.736L5.5 3.956h-.049l-.679 2.022z" />
                                                                            <path
                                                                                d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm7.138 9.995q.289.451.63.846c-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6 6 0 0 1-.415-.492 2 2 0 0 1-.94.31" />
                                                                        </svg>
                                                                        {{ @$course->language?->name }}
                                                                    </span>

                                                                    <span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="16" height="16"
                                                                            fill="currentColor" class="bi bi-flag-fill"
                                                                            viewBox="0 0 16 16">
                                                                            <path
                                                                                d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                                                                        </svg>
                                                                        @php
                                                                            $display_data = json_decode(
                                                                                $course->university?->display_data,
                                                                                true,
                                                                            );
                                                                        @endphp

                                                                        World Ranking:
                                                                        {{ $display_data['world_rank'] ?? 'N/A' }}
                                                                    </span>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="d-flex justify-content-between align-items-center mt-2">
                                                                <div class="fw-bold"
                                                                    style="color: var(--secondary_background); font-size:0.85rem;">
                                                                    @php
                                                                        $scholarship = $course->scholarship;

                                                                        // Calculate yearly tuition fee
                                                                        $yearly_tuition_fee =
                                                                            $scholarship?->tuition_fee == 1
                                                                                ? 'Free'
                                                                                : $course->year_fee -
                                                                                    ($scholarship?->tuition_fee ?? 0);

                                                                        // Calculate accommodation fee
                                                                        $accommodation_fee =
                                                                            $scholarship?->accommodation_fee == 1
                                                                                ? 'Free'
                                                                                : $course->accommodation_fee -
                                                                                    ($scholarship?->accommodation_fee ??
                                                                                        0);

                                                                        // Calculate insurance fee
                                                                        $insurance_fee =
                                                                            $scholarship?->insurance_fee == 1
                                                                                ? 'Free'
                                                                                : $course->insurance_fee -
                                                                                    ($scholarship?->insurance_fee ?? 0);

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
                                                                                $yearly_tuition_fee != 'Free'
                                                                                    ? $yearly_tuition_fee
                                                                                    : 0;
                                                                            $main_value +=
                                                                                $accommodation_fee != 'Free'
                                                                                    ? $accommodation_fee
                                                                                    : 0;
                                                                            /* $main_value +=
                                                                            $insurance_fee != 'Free'
                                                                                ? $insurance_fee
                                                                                : 0;
                                                                        $main_value += $course->visa_extension_fee;
                                                                        $main_value += $course->medical_in_china_fee; */
                                                                        }

                                                                        // Calculate the original total fee before scholarships
                                                                        $cut_value =
                                                                            ($course->year_fee ?? 0) +
                                                                            ($course->accommodation_fee ?? 0);
                                                                    @endphp

                                                                    <p class="mb-0 text-start">Yearly Fee</p>
                                                                    <p class="mb-0">
                                                                        <span style="font-size: 16px">
                                                                            {{ $main_value == 0 || $main_value == 'Free' ? 'Free' : convertCurrency($main_value) }}
                                                                        </span>
                                                                        <span style="font-size: 13px">
                                                                            <del>
                                                                                @convertCurrency($cut_value ?? 0)
                                                                            </del>
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                                @if (strtotime(@$course->application_deadline) < strtotime(now()))
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-dark-cerulean"
                                                                        style="background-color: #6c757d !important; border-color: #6c757d !important; cursor: not-allowed !important; pointer-events: none !important;">
                                                                        <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/cart.png"
                                                                            style="width: 14px;">
                                                                        Apply Now
                                                                    </a>
                                                                @else
                                                                    <a href="{{ $apply_url }}"
                                                                        class="btn btn-dark-cerulean">
                                                                        <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/cart.png"
                                                                            style="width: 14px;">
                                                                        Apply Now
                                                                    </a>
                                                                @endif

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="position-absolute program-top-right-degree"
                                                    style="background-color: var(--primary_background)">
                                                    {{ $course->degree?->name }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                @empty
                                    <p class="text-center">
                                        No Program Found!
                                    </p>
                                @endforelse
                            </div>
                        </div>

                        <div class="table-responsive pt-2 scholarship-table-container">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th>Program</th>
                                        <th>City, Province</th>
                                        <th>Degree</th>
                                        <th>Language</th>
                                        <th>Tuition Fees</th>
                                        <th>Sch. Type</th>
                                        <th>Deadline</th>
                                        <th>Apply</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if (count($scholarship_courses) > 0)
                                        @foreach ($scholarship_courses as $course)
                                            <tr>
                                                <td>
                                                    <a data-toggle="tooltip" title="{{ $course->name }}"
                                                        href="{{ route('frontend.course.details', ['id' => $course->id]) }}"
                                                        style="color: var(--primary_background)">
                                                        {{ Illuminate\Support\Str::limit($course->name, 25, '...') }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <span data-toggle="tooltip"
                                                        title="{{ @$course->university?->city->name }}, {{ @$course->university?->state?->name }}">
                                                        {{ Illuminate\Support\Str::limit(@$course->university?->city->name . ', ' . @$course->university?->state?->name, 20, '...') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span data-toggle="tooltip" title="{{ $course->degree?->name }}">
                                                        {{ Illuminate\Support\Str::limit($course->degree?->name, 15, '...') }}
                                                    </span>
                                                </td>
                                                <td>{{ @$course->language?->name }}</td>
                                                <td>
                                                    @php
                                                        $scholarship = $course->scholarship;

                                                        $yearly_tuition_fee =
                                                            $scholarship?->tuition_fee == 1
                                                                ? 'Free'
                                                                : $course->year_fee - ($scholarship?->tuition_fee ?? 0);

                                                        if ($yearly_tuition_fee == 0 || $yearly_tuition_fee == 'Free') {
                                                            $yearly_tuition_fee = 'Free';
                                                        } else {
                                                            $yearly_tuition_fee = convertCurrency($yearly_tuition_fee);
                                                        }
                                                    @endphp
                                                    {{ $yearly_tuition_fee }}
                                                </td>

                                                <td class="text-center">
                                                    <span data-toggle="tooltip"
                                                        title="{{ $course->scholarship?->type }}">
                                                        {{ Illuminate\Support\Str::limit($course->scholarship?->type, 25, '...') }}
                                                    </span>
                                                </td>
                                                <td>{{ date('d-m-Y', strtotime($course->application_deadline)) }}</td>
                                                <td>
                                                    @php
                                                        if (session('partner_ref_id')) {
                                                            $partnerRef = session('partner_ref_id');
                                                        } elseif (request()->query('partner_ref_id')) {
                                                            $partnerRef = request()->query('partner_ref_id');
                                                        } else {
                                                            $partnerRef = null;
                                                        }

                                                        if ($partnerRef) {
                                                            $apply_url_params = [
                                                                'id' => $course->id,
                                                                'partner_ref_id' => $partnerRef,
                                                            ];

                                                            if (session('is_anonymous')) {
                                                                $apply_url_params['is_anonymous'] = 'true';
                                                            }

                                                            if (session('is_applied_partner')) {
                                                                $apply_url_params['is_applied_partner'] = true;
                                                            }

                                                            $apply_url = route('apply_cart', $apply_url_params);
                                                        } else {
                                                            $apply_url = route('apply_cart', [
                                                                'id' => $course->id,
                                                            ]);
                                                        }
                                                    @endphp

                                                    <a href="{{ $apply_url }}" class="btn btn-primary-bg">Apply</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Frontend.layouts.parts.news-letter')
@endsection

@section('script')
    <script src="{{ asset('frontend/DataTables/datatables.js') }}"></script>
    <script>
        function initializeDataTable() {
            let table = new DataTable('.dataTable');
        }

        $(document).ready(function() {
            initializeDataTable();
        });
    </script>

    <script src="{{ asset('backend/assets/js/select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2_form_select').select2();
        });
    </script>

    <script>
        document.querySelectorAll('.accordion-header').forEach(header => {
            header.addEventListener('click', function() {
                const target = document.querySelector(this.dataset.target);
                const icon = this.querySelector('.toggle-icon');
                this.classList.toggle('active');
                if (target.style.display === 'none' || !target.style.display) {
                    target.style.display = 'block';
                } else {
                    target.style.display = 'none';
                }
            });
        });

        $(document).on("click", ".toggle-header", function() {
            var vm = this,
                filterslistItem = $(vm).data();

            if (
                $(
                    ".toggle-content[data-filters=" + filterslistItem.filterslist + "]"
                ).css("display") == "none"
            ) {
                $(
                    ".toggle-content[data-filters=" + filterslistItem.filterslist + "]"
                ).css("display", 'block');

                $(vm)
                    .find(".toggle-icon")
                    .css({
                        transform: "rotate(-45deg)"
                    });
            } else {
                $(".toggle-content[data-filters=" + filterslistItem.filterslist + "]")
                    .css("display", 'none');
                $(vm).find(".toggle-icon")
                    .css({
                        transform: "rotate(135deg)"
                    });
            }
        });
    </script>

    <script>
        function updateSliderValue(sliderId, valueDisplayId) {
            const slider = document.getElementById(sliderId);
            const valueDisplay = document.getElementById(valueDisplayId);

            slider.addEventListener('input', function() {
                valueDisplay.value = slider.value;
            });

            valueDisplay.addEventListener('input', function() {
                const value = Math.max(slider.min, Math.min(slider.max, valueDisplay.value));
                valueDisplay.value = value;
                slider.value = value;
            });

            valueDisplay.value = slider.value;
        }

        updateSliderValue('tuition-fees-slider', 'tuition-fees-slider-value');
        updateSliderValue('accommodation-fees-slider', 'accommodation-fees-slider-value');
        updateSliderValue('service-charge-slider', 'service-charge-slider-value');
    </script>

    <script>
        $(document).on('change', 'select[name="continent"]', function() {
            $(document).find('select[name="continent"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        $(document).on('change', 'select[name="country"]', function() {
            $(document).find('select[name="country"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        $(document).on('change', 'select[name="state"]', function() {
            $(document).find('select[name="state"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        $(document).on('change', 'select[name="city"]', function() {
            $(document).find('select[name="city"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        $(document).on('change', 'select[name="degree"]', function() {
            $(document).find('select[name="degree"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        $(document).on('change', 'select[name="course_type"]', function() {
            $(document).find('select[name="course_type"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        $(document).on('change', 'select[name="language"]', function() {
            $(document).find('select[name="language"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        $(document).on('change', 'select[name="section"]', function() {
            $(document).find('select[name="section"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        $(document).on('change', 'select[name="subject"]', function() {
            $(document).find('select[name="subject"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        $(document).on('change', 'select[name="university"]', function() {
            $(document).find('select[name="university"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        $(document).on('change', 'select[name="scholarship"]', function() {
            $(document).find('select[name="scholarship"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        $(document).on('change', 'select[name="scholarship_type"]', function() {
            $(document).find('select[name="scholarship_type"]').prop('selected', false);
            $(this).prop('selected', true);
            filterCourse();
        });
        /* $(document).on('click', '#name_filter_btn', function() {
            let value = $('input[name="name"]').val();
            var data_val = {};
            data_val.name = value;

            fetchCourses(data_val);
        }); */
        $(document).on('click', '#tuition_fees_filter_btn', function() {
            let value = $('#tuition-fees-slider-value').val();
            var data_val = {};
            data_val.tuition_fees = value;

            fetchCourses(data_val);
        });
        $(document).on('click', '#accommodation_fees_filter_btn', function() {
            let value = $('#accommodation-fees-slider-value').val();
            var data_val = {};
            data_val.tuition_fees = value;

            fetchCourses(data_val);
        });
        $(document).on('click', '#service_charge_filter_btn', function() {
            let value = $('#service-charge-slider-value').val();
            var data_val = {};
            data_val.service_charge = value;

            fetchCourses(data_val);
        });

        function filterCourse(del_filter = false, page = 1) {

            var continent_id = $(document).find('select[name="continent"]:selected').val();
            var country_id = $(document).find('select[name="country"]:selected').val();
            var state_id = $(document).find('select[name="state"]:selected').val();
            var city_id = $(document).find('select[name="city"]:selected').val();
            var course_type = $(document).find('select[name="course_type"]:selected').val();
            var degree_id = $(document).find('select[name="degree"]:selected').val();
            var language_id = $(document).find('select[name="language"]:selected').val();
            var section_id = $(document).find('select[name="section"]:selected').val();
            var subject_id = $(document).find('select[name="subject"]:selected').val();
            var university_id = $(document).find('select[name="university"]:selected').val();
            var scholarship_id = $(document).find('select[name="scholarship"]:selected').val();
            var scholarship_type = $(document).find('select[name="scholarship_type"]:selected').val();
            var data_val = {};

            if (continent_id) {
                if (del_filter == true) {
                    if (del_name != 'continent') {
                        data_val.continent = continent_id;
                    }
                } else {
                    data_val.continent = continent_id;
                }
            }

            if (country_id) {
                if (del_filter == true) {
                    if (del_name != 'country') {
                        data_val.country = country_id;
                    }
                } else {
                    data_val.country = country_id;
                }
            }

            if (state_id) {
                if (del_filter == true) {
                    if (del_name != 'state') {
                        data_val.state = state_id;
                    }
                } else {
                    data_val.state = state_id;
                }
            }

            if (city_id) {
                if (del_filter == true) {
                    if (del_name != 'city') {
                        data_val.city = city_id;
                    }
                } else {
                    data_val.city = city_id;
                }
            }

            if (course_type) {
                if (del_filter == true) {
                    if (del_name != 'course_type') {
                        data_val.course_type = course_type;
                    }
                } else {
                    data_val.course_type = course_type;
                }
            }

            if (degree_id) {
                if (del_filter == true) {
                    if (del_name != 'degree') {
                        data_val.degree = degree_id;
                    }
                } else {
                    data_val.degree = degree_id;
                }
            }

            if (language_id) {
                if (del_filter == true) {
                    if (del_name != 'language') {
                        data_val.language = language_id;
                    }
                } else {
                    data_val.language = language_id;
                }
            }

            if (section_id) {
                if (del_filter == true) {
                    if (del_name != 'section') {
                        data_val.section = section_id;
                    }
                } else {
                    data_val.section = section_id;
                }
            }

            if (subject_id) {
                if (del_filter == true) {
                    if (del_name != 'subject') {
                        data_val.subject = subject_id;
                    }
                } else {
                    data_val.subject = subject_id;
                }
            }

            if (university_id) {
                if (del_filter == true) {
                    if (del_name != 'university') {
                        data_val.university = university_id;
                    }
                } else {
                    data_val.university = university_id;
                }
            }

            if (scholarship_id) {
                if (del_filter == true) {
                    if (del_name != 'scholarship') {
                        data_val.scholarship = scholarship_id;
                    }
                } else {
                    data_val.scholarship = scholarship_id;
                }
            }

            if (scholarship_type) {
                if (del_filter == true) {
                    if (del_name != 'scholarship') {
                        data_val.scholarship_type = scholarship_type;
                    }
                } else {
                    data_val.scholarship_type = scholarship_type;
                }
            }

            data_val.page = page;

            fetchCourses(data_val);
        }

        function fetchCourses(data_val) {
            $(".all_course_container").empty();
            $('.preloader_container').removeClass('d-none').addClass('d-inline-block');

            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.scholarship.program_filter') }}",
                data: data_val,
                success: function(data) {
                    console.log(data);

                    $('.preloader_container').removeClass('d-inline-block').addClass('d-none');
                    $('.all_course_container').append(data);

                    initializeDataTable();
                    initializeToggleSwitch();
                },
                error: function() {
                    $('.preloader_container').removeClass('d-inline-block').addClass('d-none');
                }
            });
        }

        function initializeToggleSwitch() {
            const $toggleSwitch = $('.toggle-switch input');
            const $cardContainer = $('.scholarship-card-container');
            const $tableContainer = $('.scholarship-table-container');

            function updateDisplay() {
                if ($toggleSwitch.is(':checked')) {
                    $cardContainer.hide();
                    $tableContainer.show();
                } else {
                    $cardContainer.show();
                    $tableContainer.hide();
                }
            }

            updateDisplay();

            $toggleSwitch.off('change').on('change', updateDisplay);
        }

        $(document).ready(function() {
            initializeToggleSwitch();
        });
    </script>
@endsection
