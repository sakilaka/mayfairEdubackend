@extends('Frontend.layouts.master-layout')
@section('title', ' - Program list')
@section('head')
    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/select2.min.css') }}">
    <link
        href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/china_admission.css?v={{ rand() }}"
        rel="stylesheet">
    <style type="text/css">
        .social a {
            display: inline-block;
            width: 27px;
            height: 27px;
            border-radius: 50%;
            margin: 5px 5px 0 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: initial;
            flex-direction: row;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #fff;
        }

        .scroll-top {
            width: auto !important;
            height: auto !important;
            position: fixed !important;
            bottom: 100px;
            right: 20px !important;
            display: none;
            padding: .5rem 1rem !important;
            font-size: 1.25rem !important;
            line-height: 1.5 !important;
            border-radius: .3rem !important;
            background: #E02200 !important;
            color: #fff !important;
            z-index: 999;
        }

        #secondary-nav {
            font-family: 'Lato', sans-serif !important;
        }

        #secondary-nav .navbar-nav>.nav-item>a {
            border-top: 3px solid transparent;
            display: inline-block;

        }

        #secondary-nav .navbar-nav>.nav-item {
            display: inline-block;
            padding-right: 35px;
        }


        #secondary-nav .navbar-nav>.nav-item>a:hover {
            color: #e10707 !important;
            border-color: #e10707 !important;
        }


        #secondary-nav {
            padding-top: 1px;
            border: 1px solid #e5e5e5;
        }

        #secondary-nav li a:hover {
            text-decoration: underline !important;
        }

        #secondary-nav li>.sub-menu .nav-item:hover {
            background: #f8f8f8;
            color: #333;
        }

        #secondary-nav>li a:hover {
            color: #e10707;
            text-decoration: underline !important;
        }

        .success {
            display: none;
            color: #28a745;
            font-weight: 400;
            text-align: center;
        }

        .top-nav a {
            color: #4a4a4a !important;
        }

        #secondary-nav .nav-item {
            font-family: Lato, sans-serif;
            font-weight: 400;
            font-size: 16px;
            display: inline-block;
        }

        .nav-item .nav-ca:hover {
            color: #e10707 !important;
            background: #fff;
            font-weight: 600;
            border-radius: 5px;
            -webkit-transition: all 0.2s;
            -moz-transition: all 0.2s;
            transition: all 0.2s;
        }

        #secondary-nav .sub-menu a {
            border-bottom: 1px solid #dcdadb;
            padding: 7px 20px;
            color: #333;
            font-family: Lato;
            font-weight: 400;
            font-size: 14px;
            line-height: 1.25;
            height: auto;
        }

        @media screen and (max-width: 800px) {
            .menu-content {
                background-color: #fff !important;
            }

            .nav-ca,
            .nav-link,
            .nav-link span,
            .nav-link i {
                color: #4a4a4a !important;
            }
        }

        @media (max-width: 800px) {
            .navbar .container {
                max-width: 100%;
            }
        }

        .custom-select {

            background: #f3f3f3 url("/static/assets/img/dropdownicon.svg") no-repeat right .75rem center;
            background-image: none\9;
            background-size: 8px 10px;
            border: 1px solid rgba(0, 0, 0, .15);

        }


        /* remove flicker on slider initial load */
        sp-no-js {
            visibility: hidden;
        }

        @media (max-width: 767px) {
            .siq_bR {
                bottom: 120px !important;
                right: 20px !important;
            }

            .scroll-top {
                bottom: 200px;
            }
        }

        .zsiq_custommain,
        .zsiq_floatmain {
            z-index: 999 !important;
        }

        #quiz-modal {
            z-index: 99999;
        }

        .i-review-input-checkbox+label,
        .i-review-input-radio+label {
            font-size: 12px;
        }

        .next-step {
            -webkit-font-smoothing: antialiased;
            letter-spacing: 0.04em;
            display: inline-block;
            position: relative;
            height: 36px;
            padding: 0 16px;
            border: none;
            border-radius: 2px;
            outline: none;
            font-size: 14px;
            font-weight: 600;
            line-height: 36px;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            color: #ffffff;
            background: #d71f27;
        }


        .delete {
            position: absolute;
            right: 0;
            top: -15px;
            padding: 10px;
        }

        .delete .close:hover {
            color: #d71f27;
        }

        .cart-itemList .item .mainContentArea .spec {
            color: #212529
        }

        .program .item .mainContentArea .spec {
            color: #212529
        }

        .itemPool {
            text-align: center;
            padding-bottom: 100px;
        }

        .item {
            position: relative;
            background-color: #ffffff;
            margin: 0 auto 20px;
            border-radius: 5px;
            padding: 2% 3%;
            cursor: pointer;
            text-align: left;
            overflow: hidden;
            min-height: 95px;
        }

        .item a {
            color: #212529
        }

        .item .uniLogo {
            margin: 10px 15px 10px 0;
        }


        .item .mainContentArea .title {
            font-size: 1.5rem;
            font-weight: 700;
            padding-top: 8px;
            line-height: 1.5rem;
        }

        .item .mainContentArea .spec {
            font-size: .8rem;
            margin-bottom: 10px;
            margin-top: 5px;
        }

        .item .mainContentArea .spec span {
            color: #212529
        }

        .item .mainContentArea .details {
            display: block;
        }

        .item .mainContentArea .details .detail {
            display: inline-block;
            vertical-align: top;
            margin: 5px 20px 0 0;
        }

        .item .mainContentArea .details .detail .name {
            color: #212529;
            font-size: .6rem;
        }

        .item .mainContentArea .details .detail .number {
            font-size: 1.3rem;
            font-weight: 700;
            display: inline-block;
            text-transform: uppercase;
        }

        .item .mainContentArea .details .detail .unit {
            font-size: .5rem;
            display: inline-block;
        }

        .item .mainContentArea .details .detail .year {
            font-size: .8rem;
            font-weight: 700;
            display: inline-block;
        }

        .item .actionArea {
            background-color: #fafafa;
            width: 200px;
            height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            text-align: center;
        }

        .item .actionArea .deadline {
            color: #212529;
            font-size: .8rem;
            margin: 15px auto 5px;
        }

        .item .actionArea .deadline .date {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .item .actionArea .button {
            display: inline-block;
        }

        #cart-modal {
            z-index: 99999;
        }
    </style>

    <style>
        @media (max-width: 767px) {
            .siq_bR {
                bottom: 120px !important;
                right: 20px !important;
            }

            .scroll-top {
                bottom: 200px;
            }
        }

        .zsiq_custommain,
        .zsiq_floatmain {
            z-index: 999 !important;
        }
    </style>

    <style>
        #header {
            height: 56px;
            width: 100%;
            display: flex;
            background-color: #d71f27;
            padding-right: 1.5em;
        }

        #header nav {
            background-color: #d71f27;
            height: 56px;
        }

        #header img {
            height: 56px;
        }

        #header .right-nav {
            justify-content: flex-end;
            display: flex;
            align-items: center;
            width: auto;
            flex-shrink: 0;
        }

        ul.dropdown {
            display: none;
            position: absolute;
            top: 6%;
            right: 0;
            margin-top: .5em;
            background: #ffffff;
            min-width: 12em;
            padding: 0;
            border-radius: 0 0 .2em .2em;
        }

        ul.dropdown li {
            list-style-type: none;
        }

        ul.dropdown li a {
            text-decoration: none;
            padding: .5em 1em;
            display: block;
            color: #484848
        }

        ul.toggle {
            top: 80%;
        }

        .mr-2,
        .mx-2 {
            margin-right: .5rem !important
        }

        .is-hidden-mobile .right-nav .mdc-button {
            color: white;
            flex-shrink: 0;
        }

        .tags .tag {
            background-color: var(--primary_background);
        }

        #sort_by .sort_option_list,
        #sort_by .sort_option_sublist {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        #sort_by {
            position: relative;
            margin: 10px 0;
        }

        #sort_by .sort_label {
            cursor: default
        }

        #sort_by .sort_option_list {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            font-size: 14px !important;
        }


        #sort_by .sort_category {
            -webkit-box-flex: 1;
            -webkit-flex-grow: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            display: inline-block;
            font-size: 14px !important;
            font-weight: normal;
            position: relative;
            padding: 0;
            border-radius: 8px;
            margin: 0 8px;
            background-color: #fff;
            transition: 0.4s ease-in-out;
            box-shadow: 1px 4px 20px -18px rgb(120 200 159);
        }

        #sort_by .sort_category:first-child {
            margin-left: 0;
        }

        #sort_by .sort_category:last-child {
            margin-right: 0;
        }

        #sort_by .sort_option,
        #sort_by .deal-container {
            background: 0;
            border-radius: 8px;
            color: #4a4a4a;
            display: block;
            font-size: 14px;
            font-weight: normal;
            line-height: 27px;
            outline: 0;
            padding: 7px;
            text-align: center;
            text-decoration: none;
            white-space: nowrap
        }

        #sort_by .sort_option:hover {
            background-color: #fafcff
        }

        #sort_by .sort_option>i.b-sprite,
        #sort_by .sort_option>.bui__down_orange {
            display: inline-block;
            margin: 0;
            position: static;
            vertical-align: middle
        }

        #sort_by .sort_category.selected {
            background: var(--primary_background);
        }

        #sort_by .sort_category.selected .sort_option,
        #sort_by .sort_category.selected .deal-container {
            color: #fff;
            font-weight: bold;
            transition: 0.3s;
        }

        #sort_by .sort_category.selected .sort_option:hover {
            background-color: var(--secondary_background)
        }

        #sort_by .sort_option_sublist {
            background-color: #fff;
            border-radius: .3em;
            border: 1px solid #c2c2c2;
            padding: .5em 0;
            position: absolute;
            top: 22px;
            width: 100%;
            z-index: 1000;
            text-align: center
        }

        #sort_by .sort_option_sublist_title {
            color: #333;
            display: block;
            font-size: 13px;
            font-weight: bold;
            margin: 5px 0 3px 0;
            padding: 0 0 0 5px;
            white-space: nowrap
        }

        #sort_by .sort_suboption {
            color: #6c757d;
            display: block;
            font-size: 11px;
            font-weight: normal;
            outline: 0;
            padding: .2em .5em .4em;
            text-align: center;
            text-decoration: none;
            white-space: nowrap
        }


        #sort_by .sort_suboption:hover {
            background-color: var(--secondary_background);
            color: #fff;
        }

        #sort_by .sort_option_sublist .selected .sort_suboption {
            background-color: var(--secondary_background);
            color: #fff;
        }

        #sort_by .sort_more_options {
            border-top: 1px solid #6c757d;
            -webkit-box-flex: 0;
            -webkit-flex-grow: 0;
            -ms-flex-positive: 0;
            flex-grow: 0;
            padding: 0;
            position: relative;
            text-align: center;
            width: 30px
        }

        #sort_by .sort_more_options__button {
            background: transparent;
            border: 0;
            cursor: pointer;
            margin: 0;
            padding: 0;
            width: 100%
        }

        #sort_by .sort_more_options__dropdown {
            background: #fff;
            border-radius: 0 0 3px 3px;
            border: 1px solid #6c757d;
            display: none;
            padding: 0;
            position: absolute;
            right: -1px;
            top: 100%;
            z-index: 2
        }

        #sort_by .sort_more_options__dropdown:after {
            background: #fff;
            border-right: 1px solid #6c757d;
            border-bottom: 1px solid #6c757d;
            content: '';
            height: 2px;
            position: absolute;
            right: -1px;
            top: -3px;
            width: 2px
        }

        #sort_by .sort_more_options__button:hover~.sort_more_options__dropdown:after {
            background: #fafcff
        }

        #sort_by .sort_more_options__dropdown.is-visible,
        #sort_by .sort_more_options__dropdown.is-visible {
            display: block
        }

        #sort_by .sort_more_options__dropdown .sort_category {
            border: 0;
            height: 28px;
            width: 100%
        }

        #sort_by .sort_more_options__dropdown .sort_option {
            text-align: right
        }

        #sort_by .sort_more_options__dropdown .sort_option_sublist {
            left: auto;
            line-height: 1.2;
            -webkit-transform: none;
            -ms-transform: none;
            transform: none;
            right: 4px
        }

        #sort_by .sort_more_options__dropdown .sort_suboption {
            text-align: right
        }

        #sort_by .sort_option:focus,
        #sort_by .sort_suboption:focus {
            position: relative;
            z-index: 1
        }

        #sort_by .review_score .sort_option_sublist_title,
        #sort_by .sort_score .sort_option_sublist_title {
            color: #333;
            font-size: 12px;
            font-weight: normal;
            margin: 0;
            padding: .2em .5em .4em
        }

        .sort_category.sort-score {
            border-radius: 4px 0px 0px 4px;
        }

        .with_dd.sort_class.sort_category {
            border-radius: 0px 4px 4px 0px;
        }

        .accending-sort {
            transform: rotate(180deg);
        }

        .discipline-container {
            display: grid;
            grid-gap: 10px;
            grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
        }

        .discipline {
            padding: 1em;
            margin: 5px;
            text-align: center;
            box-sizing: border-box;
            overflow: hidden;
            box-shadow: rgb(99 99 99 / 20%) 0px 2px 8px;
            height: 200px !important;
        }

        .discipline img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .search-page-header {
            border-bottom: solid 1px #c2c2c2;
            border-top: solid 1px #c2c2c2;
        }

        .slick-next:before,
        .slick-prev:before {
            color: #6c757d !important;
            font-size: 25px !important;
        }

        .slick-arrow {
            margin-top: -10px !important;
        }

        .slick-prev {
            display: none !important;
        }

        .slick-arrow.slick-next {
            right: 0px;
        }

        @media screen and (max-width: 768px) {
            .why-ca-card {
                min-width: 240px !important
            }
        }
    </style>

    <style>
        .column.is-3 {
            background-color: #f2f8f19e;
            height: fit-content;
            border-radius: 10px;
            padding: 10px 20px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('frontend/range-slider/noUiSlider.css') }}">

    <style>
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

        @media screen and (max-width: 767px) {
            .bulit .value {
                text-align: left;
            }
        }

        .search-page-list-item .choice-wrapper {
            padding: 25px 15px;
        }
    </style>
@endsection

@section('main_content')
    <section class="section wrapper-search-page search-results mt-5">
        <div class="container mt-5 ajax-course-show">
            <div class="columns">
                <div class="column is-3">
                    <div class="wrapper-filters" style="display: block;">
                        <div class="toggle-header">
                            <h4 class="title is-5" style="color: var(--secondary_background); font-weight:bold">
                                Filter Programs
                            </h4>
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
                            <div class="toggle-header" data-filterslist="language">
                                <h5 class="title is-5">Teaching Language</h5>
                                <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="language">
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
                                <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="university">
                                <select name="university" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select University</option>
                                    @foreach ($univerties as $university)
                                        <option value="{{ $university->id }}"
                                            {{ request()->get('university') == $university->id ? 'selected' : '' }}>
                                            {{ @$university->name }}</option>
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
                        {{-- <div class="my-2">
                            <div class="toggle-header" data-filterslist="continent">
                                <h5 class="title is-5">Continent</h5>
                                <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="continent" style="display: none">
                                <select name="continent" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Continent</option>
                                    @foreach ($continents as $continent)
                                        <option value="{{ $continent->id }}"
                                            {{ request()->get('continent') == $continent->id ? 'selected' : '' }}>
                                            {{ @$continent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="country">
                                <h5 class="title is-5">Country</h5>
                                <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="country" style="display: none">
                                <select name="country" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ @$country->id }}"
                                            {{ request()->get('country') == $country->id ? 'selected' : '' }}>
                                            {{ @$country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
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
                                <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                                    <input type="hidden" name="tuition_fees_min">
                                    <input type="hidden" name="tuition_fees_max">
                                    <div class="tuition-fees-slider" style="width: 80%;"></div>
                                    <div style="width: 15%">
                                        <button class="btn btn-primary" id="tuition_fees_filter_btn">
                                            <i class="fa fa-search" aria-hidden="true"></i>
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
                                <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                                    <input type="hidden" name="accommodation_fees_min">
                                    <input type="hidden" name="accommodation_fees_max">
                                    <div class="accommodation-fees-slider" style="width: 80%;"></div>
                                    <div style="width: 15%">
                                        <button class="btn btn-primary" id="accommodation_fees_filter_btn">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (auth()->check())
                            <div class="my-2">
                                <div class="toggle-header" data-filterslist="service_charge">
                                    <h5 class="title is-5">Service Charge</h5>
                                    <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                                </div>
                                <div class="toggle-content" data-filters="service_charge" style="display: none">
                                    <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                                        <input type="hidden" name="service_charge_min">
                                        <input type="hidden" name="service_charge_max">
                                        <div class="service-charge-slider" style="width: 80%;"></div>
                                        <div style="width: 15%">
                                            <button class="btn btn-primary" id="service_charge_filter_btn">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="column is-9">
                    @include('Frontend.preloader')

                    <div class="all_courses_container">
                        <div class="column p-0">
                            <div class="d-flex justify-content-between">
                                <p class="result-search">{{ $courses->total() }} Programs Found</p>
                                <div class="filters-button"></div>
                            </div>

                            <div class="wrapper-result-tags-and-sort">
                                <div class="tags searchingTags_wrapper mb-0">
                                    <a style="" class="clear-filter">Clear</a>
                                </div>

                                <form id="filter-form" method="POST" style="display:none"></form>
                            </div>

                            <div data-block-id="sort_bar" class="d-none d-md-block">
                                <div id="sort_by" aria-label="Sort your results" class="mb-4">
                                    <ul class="sort_option_list ">
                                        <li class=" sort_category {{-- selected --}} sort-score">
                                            <a href="#" class="sort_option sort_category_course_list"
                                                cat="1" data-category="sort-score" role="button">
                                                Our Top Picks
                                            </a>
                                        </li>
                                        <li class=" sort_category sort-popular">
                                            <a href="#" class="sort_option sort_category_course_list"
                                                cat="2" data-category="sort-popular" role="button">
                                                Most Popular
                                            </a>
                                        </li>
                                        <li class=" sort_category  sort-speed">
                                            <a href="#" class="sort_option sort_category_course_list"
                                                cat="3" data-category="sort-speed" role="button">
                                                Fastest Admissions
                                            </a>
                                        </li>
                                        <li class=" sort_category   sort-rating ">
                                            <a href="#" class="sort_option sort_category_course_list"
                                                cat="4" data-category="sort-rating" role="button">
                                                Highest Rating
                                            </a>
                                        </li>
                                        <li class=" sort_category  sort-rank ">
                                            <a href="#" class="sort_option sort_category_course_list"
                                                cat="5" data-category="sort-rank" role="button">
                                                Top Ranked
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="onSearchResultPage">
                            <div id="programsFoundCount" style="display:none">{{ $courses->count() }} Programs Found
                            </div>
                            <span id="programsfound"></span>
                            <div class="show-course-ajax-data-list show-course-paginate-ajax-data">
                                {{-- @php
                                    $sortedCourses = $courses->items();
                                    usort($sortedCourses, function ($a, $b) {
                                        return strtotime($b['application_deadline']) -
                                            strtotime($a['application_deadline']);
                                    });
                                @endphp --}}

                                @php
                                    $sortedCourses = $courses->items();
                                    usort($sortedCourses, function ($a, $b) {
                                        return strtotime($b['application_deadline']) -
                                            strtotime($a['application_deadline']);
                                    });
                                @endphp

                                @foreach ($sortedCourses as $course)
                                    @php
                                        $partnerRef = session('partner_ref_id') ?? request()->query('partner_ref_id');
                                        $appliedBy = session('applied_by') ?? request()->query('applied_by');

                                        $apply_url_params = [
                                            'id' => $course->id,
                                            'partner_ref_id' => $partnerRef,
                                            'applied_by' => $appliedBy,
                                        ];

                                        $course_details_url_params = $apply_url_params;

                                        $course_list_url_params = [
                                            'partner_ref_id' => $partnerRef,
                                            'applied_by' => $appliedBy,
                                        ];

                                        if (session('is_anonymous')) {
                                            $apply_url_params['is_anonymous'] = 'true';
                                            $course_details_url_params['is_anonymous'] = 'true';
                                            $course_list_url_params['is_anonymous'] = 'true';
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
                                    @endphp


                                    @foreach ($courses as $course)
                                        <div class="columns">
                                            <div class="column">
                                                <div class="d-flex justify-content-center" style="position: relative;">
                                                    <div class="choice s-col-11 search-page-list-item">
                                                        <div class="choice-wrapper overflow-hidden position-relative"
                                                            data-url="">

                                                            <div class="s-row">
                                                                <div class="s-col-9">
                                                                    <div class="d-flex justify-content-start"
                                                                        style="cursor: pointer">
                                                                        <div class="d-none d-md-flex flex-column justify-content-start"
                                                                            style="width: 16%">
                                                                            <img src="{{ @$course->university?->image_show ?? '' }}"
                                                                                class="m-0"
                                                                                style="width: 90px; height:auto">

                                                                            <div class="my-2">
                                                                                @forelse (json_decode($course->university?->tags, true) ?? [] as $index => $tag)
                                                                                    @php
                                                                                        $colors = [
                                                                                            '#357A61',
                                                                                            '#302C61',
                                                                                        ];
                                                                                        $backgroundColor =
                                                                                            $colors[
                                                                                                $index % count($colors)
                                                                                            ];
                                                                                    @endphp
                                                                                    <span class="university-tag"
                                                                                        style="background-color: {{ $backgroundColor }};">
                                                                                        {{ $tag }}
                                                                                    </span>
                                                                                @empty
                                                                                    <span>&nbsp;</span>
                                                                                @endforelse
                                                                            </div>

                                                                        </div>

                                                                        <div class="ms-md-3 w-100">
                                                                            <h4 class="title">
                                                                                <span class="mr-2"
                                                                                    style="vertical-align: middle;">
                                                                                    {{ strlen($course->name) > 50 ? substr($course->name, 0, 50) . '...' : $course->name }}
                                                                                </span>
                                                                            </h4>
                                                                            <p class="school-name-desktop">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="16" height="16"
                                                                                    fill="currentColor"
                                                                                    class="bi bi-mortarboard-fill"
                                                                                    viewBox="0 0 16 16">
                                                                                    <path
                                                                                        d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z" />
                                                                                    <path
                                                                                        d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z" />
                                                                                </svg>
                                                                                {{ @$course->university?->name }}
                                                                            </p>
                                                                            <div class="mobile-title mt-4">
                                                                                <div class="d-flex flex-column">
                                                                                    <img class="mx-auto"
                                                                                        src="{{ @$course->university?->image_show }}">
                                                                                    <div class="my-2 text-center">
                                                                                        @forelse (json_decode($course->university?->tags, true) ?? [] as $index => $tag)
                                                                                            @php
                                                                                                $colors = [
                                                                                                    '#357A61',
                                                                                                    '#302C61',
                                                                                                ];
                                                                                                $backgroundColor =
                                                                                                    $colors[
                                                                                                        $index %
                                                                                                            count(
                                                                                                                $colors,
                                                                                                            )
                                                                                                    ];
                                                                                            @endphp
                                                                                            <span
                                                                                                class="university-tag mx-1 mx-md-0"
                                                                                                style="background-color: {{ $backgroundColor }};">
                                                                                                {{ $tag }}
                                                                                            </span>
                                                                                        @empty
                                                                                            <span>&nbsp;</span>
                                                                                        @endforelse
                                                                                    </div>

                                                                                    <h4 class="title"
                                                                                        style="flex-direction: column;">
                                                                                        <span class="mr-2 text-center mb-3"
                                                                                            style="vertical-align: middle;">
                                                                                            {{ strlen($course->name) > 50 ? substr($course->name, 0, 50) . '...' : $course->name }}
                                                                                        </span>
                                                                                        <p>
                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                width="16"
                                                                                                height="16"
                                                                                                fill="currentColor"
                                                                                                class="bi bi-mortarboard-fill"
                                                                                                viewBox="0 0 16 16">
                                                                                                <path
                                                                                                    d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z" />
                                                                                                <path
                                                                                                    d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z" />
                                                                                            </svg>
                                                                                            {{ @$course->university?->name }}
                                                                                        </p>
                                                                                    </h4>
                                                                                </div>
                                                                            </div>

                                                                            <div class="tags py-0 pt-2">
                                                                                <span>
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16" height="16"
                                                                                        class="bi bi-geo-alt-fill"
                                                                                        viewBox="0 0 16 16"
                                                                                        style="fill:#494949">
                                                                                        <path
                                                                                            d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                                                                    </svg>
                                                                                    @php
                                                                                        $locationParts = array_filter([
                                                                                            /* $course->university?->continent?->name ?? '', */
                                                                                            /* $course->university?->country?->name ?? '', */
                                                                                            $course->university?->state
                                                                                                ?->name ?? '',
                                                                                            $course->university?->city
                                                                                                ?->name ?? '',
                                                                                        ]);
                                                                                    @endphp

                                                                                    {{ implode(', ', $locationParts) }}
                                                                                </span>
                                                                                <span class="mt-2">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16" height="16"
                                                                                        class="bi bi-translate"
                                                                                        viewBox="0 0 16 16"
                                                                                        style="fill:#494949">
                                                                                        <path
                                                                                            d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286zm1.634-.736L5.5 3.956h-.049l-.679 2.022z" />
                                                                                        <path
                                                                                            d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm7.138 9.995q.289.451.63.846c-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6 6 0 0 1-.415-.492 2 2 0 0 1-.94.31" />
                                                                                    </svg>
                                                                                    {{ @$course->language?->name }}
                                                                                </span>
                                                                            </div>

                                                                            <div class="tags pt-2">
                                                                                <span>
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="16" height="16"
                                                                                        fill="currentColor"
                                                                                        class="bi bi-flag-fill"
                                                                                        viewBox="0 0 16 16">
                                                                                        <path
                                                                                            d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                                                                                    </svg>
                                                                                    @php
                                                                                        $display_data = json_decode(
                                                                                            $course->university
                                                                                                ?->display_data,
                                                                                            true,
                                                                                        );
                                                                                    @endphp

                                                                                    World Ranking:
                                                                                    {{ $display_data['world_rank'] ?? 'N/A' }}
                                                                                </span>
                                                                            </div>

                                                                            <div
                                                                                class="wrapper-bullts justify-content-between pb-0 ms-0">
                                                                                <div class="bulit">
                                                                                    <div class="title">Tuition Fees
                                                                                        (Yearly)
                                                                                    </div>
                                                                                    <div class="value">
                                                                                        @php
                                                                                            $scholarship =
                                                                                                $course->scholarship;

                                                                                            // Calculate yearly tuition fee
                                                                                            $yearly_tuition_fee =
                                                                                                $scholarship?->tuition_fee ==
                                                                                                1
                                                                                                    ? 'Free'
                                                                                                    : $course->year_fee -
                                                                                                        ($scholarship?->tuition_fee ??
                                                                                                            0);

                                                                                            // Calculate accommodation fee
                                                                                            $accommodation_fee =
                                                                                                $scholarship?->accommodation_fee ==
                                                                                                1
                                                                                                    ? 'Free'
                                                                                                    : $course->accommodation_fee -
                                                                                                        ($scholarship?->accommodation_fee ??
                                                                                                            0);

                                                                                            // Calculate insurance fee
                                                                                            $insurance_fee =
                                                                                                $scholarship?->insurance_fee ==
                                                                                                1
                                                                                                    ? 'Free'
                                                                                                    : $course->insurance_fee -
                                                                                                        ($scholarship?->insurance_fee ??
                                                                                                            0);

                                                                                            // Check if all fees are 'Free'
                                                                                            $all_free =
                                                                                                $yearly_tuition_fee ==
                                                                                                    'Free' &&
                                                                                                $accommodation_fee ==
                                                                                                    'Free' &&
                                                                                                $insurance_fee ==
                                                                                                    'Free';

                                                                                            if ($all_free) {
                                                                                                $main_value = 'Free';
                                                                                            } else {
                                                                                                $main_value = 0;

                                                                                                $main_value +=
                                                                                                    $yearly_tuition_fee !=
                                                                                                    'Free'
                                                                                                        ? $yearly_tuition_fee
                                                                                                        : 0;
                                                                                                $main_value +=
                                                                                                    $accommodation_fee !=
                                                                                                    'Free'
                                                                                                        ? $accommodation_fee
                                                                                                        : 0;
                                                                                                /* $main_value +=
                                                                                                    $insurance_fee != 'Free'
                                                                                                        ? $insurance_fee
                                                                                                        : 0;
                                                                                                $main_value +=
                                                                                                    $course->visa_extension_fee;
                                                                                                $main_value +=
                                                                                                    $course->medical_in_china_fee; */
                                                                                            }

                                                                                            // Calculate the original total fee before scholarships
                                                                                            $cut_value =
                                                                                                ($course->year_fee ??
                                                                                                    0) +
                                                                                                ($course->accommodation_fee ??
                                                                                                    0);
                                                                                        @endphp
                                                                                        <span class="money">
                                                                                            <span
                                                                                                style="font-size: 16px; color:var(--primary_background)">
                                                                                                {{ $main_value == 0 || $main_value == 'Free' ? 'Free' : convertCurrency($main_value) }}
                                                                                            </span>
                                                                                            <span style="font-size: 12px">
                                                                                                <del>@convertCurrency($cut_value)</del>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="bulit">
                                                                                    <div class="title">Accommodation Fees
                                                                                        (Yearly)
                                                                                    </div>
                                                                                    <div class="value">
                                                                                        <span class="money">
                                                                                            <span
                                                                                                style="font-size: 16px; color:var(--primary_background)">
                                                                                                @convertCurrency($accommodation_fee)
                                                                                            </span>
                                                                                            <span style="font-size: 12px">
                                                                                                <del>@convertCurrency($course->accommodation_fee)</del>
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="bulit">
                                                                                    <div class="title">Study Duration
                                                                                    </div>
                                                                                    <div class="value">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                                            width="16" height="16"
                                                                                            fill="currentColor"
                                                                                            class="bi bi-alarm-fill"
                                                                                            viewBox="0 0 16 16">
                                                                                            <path
                                                                                                d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H9v1.07a7.001 7.001 0 0 1 3.274 12.474l.601.602a.5.5 0 0 1-.707.708l-.746-.746A6.97 6.97 0 0 1 8 16a6.97 6.97 0 0 1-3.422-.892l-.746.746a.5.5 0 0 1-.707-.708l.602-.602A7.001 7.001 0 0 1 7 2.07V1h-.5A.5.5 0 0 1 6 .5m2.5 5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.04 8.04 0 0 0 .86 5.387M11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.04 8.04 0 0 0-3.527-3.527" />
                                                                                        </svg>
                                                                                        {{ @$course->course_duration }}
                                                                                        Year
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="d-none d-md-block s-col-3 search-page-list-item-bottom">
                                                                    <div class="wrapper-bullts call-to-action justify-content-center"
                                                                        style="margin-top: 0 !important">
                                                                        <div class="bulit">
                                                                            <div
                                                                                class="title d-flex justify-content-center">
                                                                                Intake</div>
                                                                            <div class="value">
                                                                                {{ $course->intake?->name }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="wrapper-bullts call-to-action justify-content-center"
                                                                        style="margin-top: 0 !important">
                                                                        <div class="bulit">
                                                                            <div class="title">Application Deadline</div>
                                                                            <div class="value text-danger">
                                                                                {{ date('d M Y', strtotime(@$course->application_deadline)) }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-center mb-3">
                                                                        <section
                                                                            class="apply__action d-flex justify-content-center">
                                                                            @if (strtotime(@$course->application_deadline) < strtotime(now()))
                                                                                <button
                                                                                    class="ca-button justify-content-center"
                                                                                    style="background-color:#6c757d; cursor: not-allowed;">
                                                                                    <a href="javascript:void(0)"
                                                                                        style="color: #fff; pointer-events: none;">
                                                                                        Apply Now
                                                                                    </a>
                                                                                </button>
                                                                            @else
                                                                                <button
                                                                                    class="ca-button justify-content-center">
                                                                                    <a href="{{ $apply_url ?? '#' }}"
                                                                                        style="color: #fff">Apply Now
                                                                                    </a>
                                                                                </button>
                                                                            @endif
                                                                        </section>
                                                                    </div>
                                                                </div>

                                                                <div class="d-md-none s-col-12 mt-3 mb-3">
                                                                    @if (strtotime(@$course->application_deadline) < strtotime(now()))
                                                                        <button
                                                                            class="mx-auto ca-button justify-content-center"
                                                                            style="background-color:#6c757d; cursor: not-allowed;">
                                                                            <a href="javascript:void(0)"
                                                                                style="color: #fff; pointer-events: none;">
                                                                                Apply Now
                                                                            </a>
                                                                        </button>
                                                                    @else
                                                                        <button
                                                                            class="mx-auto ca-button justify-content-center">
                                                                            <a href="{{ $apply_url ?? '#' }}"
                                                                                style="color: #fff">Apply Now
                                                                            </a>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="position-absolute program-top-right-degree"
                                                                style="background-color: var(--primary_background)">
                                                                {{ $course->degree?->name }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{ route('frontend.course.details', $course->id) }}"
                                                        class=""></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach

                                @if (@$courses->count() == 0)
                                    <div class="text-center">
                                        <h1 style="font-size: 25px">Program Not Found !</h1>
                                    </div>
                                @endif
                            </div>

                            <style>
                                .pagination-link {
                                    margin-left: 5px;
                                    margin-right: 5px;
                                }
                            </style>

                            <div class="columns">
                                @if ($courses->lastPage() > 1)
                                    <div class="column">
                                        <nav class="pagination" role="navigation" aria-label="pagination"
                                            style="padding-left: 15px;">
                                            <div class="pagination">
                                                <!-- Previous Button -->
                                                <a page_no="{{ $courses->currentPage() == 1 ? 1 : $courses->currentPage() - 1 }}"
                                                    class="page-link previous_page pagination-link"
                                                    href="{{ $courses->previousPageUrl() }}"
                                                    aria-label="Previous">&laquo;</a>

                                                <!-- Page Numbers -->
                                                @for ($i = 1; $i <= $courses->lastPage(); $i++)
                                                    <a class="pagination-link page @if ($i == $courses->currentPage()) is-current @endif"
                                                        page_no="{{ $i }}" href="{{ $courses->url($i) }}">
                                                        {{ $i }}
                                                    </a>
                                                @endfor

                                                <!-- Next Button -->
                                                <a page_no="{{ $courses->currentPage() == $courses->lastPage() ? $courses->lastPage() : $courses->currentPage() + 1 }}"
                                                    class="page-link next_page pagination-link"
                                                    href="{{ $courses->nextPageUrl() }}" aria-label="Next">&raquo;</a>
                                            </div>
                                        </nav>
                                    </div>
                                @endif
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script src="{{ asset('backend/assets/js/select2.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2_form_select').select2();
        });
    </script>

    <script>
        var del_name = "";
        var del_val = "";
        $(document).on('click', '.delete-tag', function() {
            del_name = $(this).parent().attr('data-field');
            del_val = $(this).parent().attr('data-keyword');
            filterCourse(true);
            $(this).parent().remove();
            if ($('.searchingTags_wrapper').children().length == 2) {
                $('.clear-filter').css('display', 'none');
            }
        });
        $(document).on('click', '.clear-filter', function() {
            $('.filterTags').remove();
            window.location.href = '{{ route('frontend.university_course_list') }}';
            $('.clear-filter').css('display', 'none');
        })
    </script>

    <script src="{{ asset('frontend/range-slider/noUiSlider.js') }}"></script>
    <script>
        function initializeRangeSlider(sliderClass, minInputName, maxInputName, startValues, minRange, maxRange, step) {
            const sliders = document.querySelectorAll(`.${sliderClass}`);

            sliders.forEach((slider, index) => {
                const minValueInput = document.querySelector(`input[name="${minInputName}"]`);
                const maxValueInput = document.querySelector(`input[name="${maxInputName}"]`);

                noUiSlider.create(slider, {
                    start: startValues,
                    connect: true,
                    range: {
                        'min': minRange,
                        'max': maxRange
                    },
                    step: step,
                    tooltips: [true, true],
                    format: {
                        to: function(value) {
                            return parseInt(value);
                        },
                        from: function(value) {
                            return parseInt(value);
                        }
                    }
                });

                slider.noUiSlider.on('update', function(values, handle) {
                    if (handle === 0) {
                        minValueInput.value = values[0];
                    } else {
                        maxValueInput.value = values[1];
                    }
                });
            });
        }

        // Initialize the sliders
        let maxSliderValue = parseInt(@json(convertCurrency(50000)).replace(/[^\d]/g, ''));

        initializeRangeSlider('tuition-fees-slider', 'tuition_fees_min', 'tuition_fees_max',
            [0, maxSliderValue], 0, maxSliderValue, 50);
        initializeRangeSlider('accommodation-fees-slider', 'accommodation_fees_min', 'accommodation_fees_max',
            [0, maxSliderValue], 0, maxSliderValue, 50);
        initializeRangeSlider('service-charge-slider', 'service_charge_min', 'service_charge_max',
            [0, maxSliderValue], 0, maxSliderValue, 50);
    </script>

    <script>
        // all paginate and paginate
        $(document).on('click', '.course-paginate', function() {
            let c_val = $(this).attr('page_no');
            filterCourse(false, c_val);

        });

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
        $(document).on('click', '#tuition_fees_filter_btn', function() {
            let minValue = $('input[name=tuition_fees_min]').val();
            let maxValue = $('input[name=tuition_fees_max]').val();
            var data_val = {};

            data_val.tuition_fees_min = minValue;
            data_val.tuition_fees_max = maxValue;
            data_val.is_filter_tuition_fees = true;

            fetchCourses(data_val);
        });
        $(document).on('click', '#accommodation_fees_filter_btn', function() {
            let minValue = $('input[name=accommodation_fees_min]').val();
            let maxValue = $('input[name=accommodation_fees_max]').val();
            var data_val = {};

            data_val.accommodation_fees_min = minValue;
            data_val.accommodation_fees_max = maxValue;
            data_val.is_filter_accommodation_fees = true;

            fetchCourses(data_val);
        });
        $(document).on('click', '#service_charge_filter_btn', function() {
            let minValue = $('input[name=service_charge_min]').val();
            let maxValue = $('input[name=service_charge_max]').val();
            var data_val = {};

            data_val.service_charge_min = minValue;
            data_val.service_charge_max = maxValue;
            data_val.is_filter_service_charge = true;

            fetchCourses(data_val);
        });

        function filterCourse(del_filter = false, page = 1) {

            var continent_id = $(document).find('select[name="continent"]:selected').val();
            var country_id = $(document).find('select[name="country"]:selected').val();
            var state_id = $(document).find('select[name="state"]:selected').val();
            var city_id = $(document).find('select[name="city"]:selected').val();
            var degree_id = $(document).find('select[name="degree"]:selected').val();
            var language_id = $(document).find('select[name="language"]:selected').val();
            var section_id = $(document).find('select[name="section"]:selected').val();
            var subject_id = $(document).find('select[name="subject"]:selected').val();
            var university_id = $(document).find('select[name="university"]:selected').val();
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

            data_val.page = page;

            fetchCourses(data_val);
        }

        function fetchCourses(data_val) {
            $(".all_courses_container").empty();
            $('.preloader_container').removeClass('d-none').addClass('d-inline-block');

            $.ajax({
                type: 'GET',
                url: "{{ url('ajax-course-filter') }}",
                data: data_val,
                success: function(data) {
                    $('.preloader_container').removeClass('d-inline-block').addClass('d-none');
                    $(".all_courses_container").append(data);
                },
                error: function() {
                    $('.preloader_container').removeClass('d-inline-block').addClass('d-none');
                }
            });
        }

        //University degree Category show
        $(".on_click_university_degree").change(function(e) {
            e.preventDefault();
            let id = $(this).val()
            console.log(id);
            $.ajax({
                type: 'GET',
                url: "{{ url('get-university-course-degree') }}/" + id,

                success: function(data) {
                    $(".university_course_degree-show").html(data);
                }
            });
        });

        // sort category course ajax
        $('body').on("click", '.sort_category_course_list', function() {
            let cat = $(this).attr('cat');
            let url = '{{ url('get-sort-course-list/') }}/' + cat;

            $(".all_courses_container").empty();
            $('.preloader_container').removeClass('d-none').addClass('d-inline-block');

            $.ajax({
                type: 'GET',
                url: "{{ url('get-sort-course-list') }}/" + cat,
                success: function(data) {
                    $('.preloader_container').removeClass('d-inline-block').addClass('d-none');
                    $(".all_courses_container").append(data);
                },
                error: function() {
                    $('.preloader_container').removeClass('d-inline-block').addClass('d-none');
                }
            });
        });

        //Ajax continent Course list show
        $(".continent_course_list").change(function(e) {
            e.preventDefault();
            let id = $(this).val();
            console.log(id);
            $.ajax({
                type: 'GET',
                url: "{{ url('get-continent-course-list') }}/" + id,
                success: function(data) {
                    $(".continent_course_list_show").html(data);
                }
            });
        });

        //Ajax country Course list show
        $(".country_course_list").change(function(e) {
            e.preventDefault();
            let id = $(this).val();
            console.log(id);
            $.ajax({
                type: 'GET',
                url: "{{ url('get-country-course-list') }}/" + id,
                success: function(data) {
                    $(".country_course_list_show").html(data);
                }
            });
        });

        //Ajax state Course list show
        $(".state_course_list").change(function(e) {
            e.preventDefault();
            let id = $(this).val();
            console.log(id);
            $.ajax({
                type: 'GET',
                url: "{{ url('get-state-course-list') }}/" + id,
                success: function(data) {
                    $(".state_course_list_show").html(data);
                }
            });
        });

        //Ajax state Course list show
        $(".city_course_list").change(function(e) {
            e.preventDefault();
            let id = $(this).val();
            console.log(id);
            $.ajax({
                type: 'GET',
                url: "{{ url('get-city-course-list') }}/" + id,
                success: function(data) {
                    $(".city_course_list_show").html(data);
                }
            });
        });
    </script>

    <script type="text/javascript">
        try {
            ! function(n) {
                n.fn.drizzle = function(t) {
                    const i = ["asc", "desc"];
                    var e = n.extend({
                            child: ".child"
                        }, t),
                        c = n(e.child),
                        o = function() {
                            n(e.child).show()
                        },
                        r = function() {
                            n(e.child).hide()
                        };
                    return {
                        filter: function(t) {
                            if ("function" != typeof t) {
                                r();
                                var i = e.child + "" + t;
                                "*" !== t ? n(i).show() : this.rain()
                            } else t.call(this)
                        },
                        sort: function(t, o) {
                            if ("function" != typeof f && "function" != typeof o) {
                                var r = n(e.child).parent(),
                                    f = "asc";
                                o && o.order && (f = i.indexOf(o.order) ? o.order : "asc"), c.sort(function(i, e) {
                                    var c, r;
                                    return t ? (c = n(i).find(t).text(), r = n(e).find(t).text()) : (c = n(
                                        i).text(), r = n(e).text()), o && !0 === o.isNumber && (c =
                                        Number(c), r = Number(r)), c > r ? 1 : c < r ? -1 : 0
                                }), "desc" == f && (c = Object.assign([], c).reverse()), r.html(c)
                            } else "function" == typeof f && f.call(this), "function" == typeof o && type.call(this)
                        },
                        init: function() {
                            o()
                        },
                        rain: function() {
                            o()
                        },
                        unfilter: function() {
                            o()
                        },
                        dry: function() {
                            r()
                        },
                        erase: function() {
                            r()
                        },
                        destroy: function() {
                            r()
                        }
                    }
                }
            }(jQuery)
        } catch (n) {
            console.log("Caught an error", n)
        }

        $(document).ready(function() {
            $('#mobile-search').change(function() {
                $('#search-input').val($(this).val());
            });
            $('#mobile-search').on('keypress', function(e) {
                if (e.which === 13) {
                    $(this).attr("disabled", "disabled");
                    $('#applyFilter').click();
                    $(this).removeAttr("disabled");
                }
            });
            $('#mobile-search').click(function() {
                $('#applyFilter').click();
            })

            //filter toggle 
            $(".filter-open").on("click", function() {
                if (window.innerWidth < 768) {
                    $(".wrapper-filters").css({
                        display: "block"
                    });
                    $(this).css({
                        display: "none"
                    });
                    $(".filter-opened").css({
                        display: "inline"
                    });
                }
            });

            $(".filter-opened").on("click", function() {
                if (window.innerWidth < 768) {
                    $(".wrapper-filters").css({
                        display: "none"
                    });
                    $(this).css({
                        display: "none"
                    });
                    $(".filter-open").css({
                        display: "inline"
                    });
                }
            });

            $(window).resize(function() {
                if (window.innerWidth >= 768) {
                    $(".wrapper-filters").css({
                        display: "block"
                    });
                }
            });

            $(".with_dd").on('click', function() {
                $(".sort_option_sublist").toggleClass("d-none")
                $(this).addClass("selected")
            });
            $(".sort_suboption_outer").on('click', function() {
                $(".sort_suboption_outer").removeClass("selected");
                $(this).addClass("selected");
            });

            //Eligibility
            var quizParams = ['age', 'edu_lvl', 'grade', 'hsk', 'ielts'];
            var hasParams = new RegExp(quizParams.join('|')).test(location.search);
            var preferences;
            if (Cookies.get("jwt") != undefined) {
                getPreference().then((response) => {
                    preferences = response.data;
                    if (response.data["search_quiz_data"] != undefined) {
                        if (hasParams)
                            $(".eligibility").val("search-eligible");
                        $(".has-auth").removeClass("d-none");
                    } else {
                        $(".has-no-auth").removeClass("d-none");
                    }
                })
            } else {
                $(".eligibility").val("not-set");
                $(".has-no-auth").removeClass("d-none");
            }

            $(".eligibility").on("change", function() {
                var option = $(this).val();
                if (option == "take-quiz")
                    showQuiz();
                else if (option == "not-set")
                    window.location = removeQuizParameters();
                else if (option == "search-eligible") {
                    preferences.search_quiz_data.replace('hks_lvl', 'hsk');
                    preferences.search_quiz_data.replace('ielts_lvl', 'ielts');
                    window.location.search = window.location.search + "&" + preferences.search_quiz_data
                        .split("/search/?")[1];
                } else if (option == "go-to-profile")
                    window.location = "/account/profile"
            })
        });

        //Sort subjects on the sidebar alphabetically 
        var instance = $('#subjects').drizzle({
            child: '.subject' // child element
        });
        instance.sort('[data-value]', {
            order: 'asc'
        });


        //Sort bar
        var sortOption = "sort"
        var sort_categories = $('.sort_category')
        sort_categories.on('click', function() {
            if ($(this).find(".sort_option").data("category") != undefined) {
                sortOption = ($(this).find(".sort_option").data("category"));
            }
            sort_categories.removeClass("selected");
            if ($(this).hasClass("with_dd") == false) {
                $('#applyFilter').click();
            }
            $(this).addClass("selected")
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
@endsection
