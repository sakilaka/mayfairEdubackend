@extends('Frontend.layouts.master-layout')
@section('title', ' - All Universities')
@section('head')
    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/select2.min.css') }}">
    <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/main_china.css"
        rel="stylesheet">
    <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/page_search_china.css"
        rel="stylesheet">

    <style>
        .has-margin-top-2 {
            margin-top: 10px !important;
        }

        .stretched-link::after {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: 1;
            pointer-events: auto;
            content: "";
            background-color: rgba(0, 0, 0, 0);
        }

        .school-pagination li a {
            font-size: 1em;
            padding-left: 0.5em;
            padding-right: 0.5em;
            justify-content: center;
            text-align: center;
            border-color: #dbdbdb !important;
            color: #2f64bf;
            min-width: 2.25em;
            -webkit-appearance: none;
            align-items: center;
            border: 1px solid transparent;
            box-shadow: none;
            display: inline-flex;
            font-size: 1rem;
            height: 2.25em;
            line-height: 1.5;
            padding-bottom: calc(0.375em - 1px);
            padding-left: calc(0.625em - 1px);
            padding-right: calc(0.625em - 1px);
            padding-top: calc(0.375em - 1px);
            position: relative;
            vertical-align: top;

        }

        .school-pagination li.active a {
            background-color: #2f64bf !important;
            border-color: #2f64bf;
            border-radius: 0;
            color: #fff;

        }

        .top_hero {
            padding-bottom: 2rem;
            padding-right: 2rem;
            padding-left: 2rem;
            background: #d7353844;
            background: linear-gradient(rgba(189, 237, 177, 0.8), rgba(0, 128, 47, 0.561)), url({{ @$banner->image_show }});
            background-position: center;
            background-repeat: no-repeat;
            padding-top: 7rem;
            /* height:300px; */
        }

        .no-result li {
            margin-left: 40px;
        }
    </style>

    <style>
        .column.is-2 {
            background-color: #f2f8f19e;
            height: fit-content;
            border-radius: 10px;
            padding: 10px 20px;
        }

        .university-tag {
            padding: 2px 4px;
            border-radius: 4px;
            font-size: 12px;
            color: #fff;
            font-weight: 600;
            white-space: nowrap;
        }
    </style>
@endsection
@section('main_content')

    <header class="hero is-bold is-small top_hero" style="margin-top: 3rem">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <h1 class="title is-2 has-text-centered " style="color: #fff;">{{ @$banner->title }}</h1>
                    <div class="columns">
                        <div class="column is-three-fifths is-offset-one-fifth">
                            <div class="field has-addons">
                                <div class="control">
                                    <input id="search-input" class="input" type="text"
                                        placeholder="Search by university">
                                </div>
                                <div class="control">
                                    <a id="search-input" class="button btn-primary-bg is-info">
                                        <i class="fas fa-search"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="section wrapper-search-page search-results">
        <div class="container ajax-filter-show">
            @include('Frontend.preloader')
            <div class="columns university_filter_container">
                <div class="column is-2">
                    <div class="wrapper-filters" style="display: block;">

                        <div class="toggle-header">
                            <h4 class="title is-5" style="color: var(--primary_background); font-weight:bold">
                                Filter University
                            </h4>
                        </div>

                        {{-- <div class="my-2">
                            <div class="toggle-header" data-filterslist="continent">
                                <h5 class="title is-5">Continent</h5>
                                <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="continent">
                                <select name="continent" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Continent</option>
                                    @foreach ($continents as $continent)
                                        <option value="{{ $continent->id }}">{{ @$continent->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if (@$countries->count() > 0)
                            <div class="my-2">
                                <div class="toggle-header" data-filterslist="country">
                                    <h5 class="title is-5">Country</h5>
                                    <div class="toggle-icon" style="transform: rotate(135deg);"></div>
                                </div>
                                <div class="toggle-content" data-filters="country" style="display: none">
                                    <select name="country" class="form-control select2_form_select" style="width: 90%;">
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                @if ($select_country == $country->id) selected @endif>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif --}}

                        {{-- @if (@$states->count() > 0) --}}
                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="state">
                                <h5 class="title is-5">Province</h5>
                                <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="state" {{-- style="display: none" --}}>
                                <select name="state" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Province</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            @if ($select_state == $state->id) selected @endif>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- @endif --}}

                        @if (@$cities->count() > 0)
                            <div class="my-2">
                                <div class="toggle-header" data-filterslist="city">
                                    <h5 class="title is-5">City</h5>
                                    <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                                </div>
                                <div class="toggle-content" data-filters="city" style="display: none">
                                    <select name="city" class="form-control select2_form_select" style="width: 90%;">
                                        <option value="">Select City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                @if ($select_city == $city->id) selected @endif>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        @php
                            $availableTags = ['211 Projects', '985 Projects', 'Double First Class', 'C9 League'];
                            $selectedTags = request()->input('tags') ?? [];
                        @endphp

                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="tags">
                                <h5 class="title is-5">Tags</h5>
                                <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                            </div>
                            <div class="toggle-content" data-filters="tags">
                                <select name="tags" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Tag</option>
                                    @foreach ($availableTags as $tag)
                                        <option value="{{ $tag }}"
                                            {{ in_array($tag, $selectedTags) ? 'selected' : '' }}>
                                            {{ $tag }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        @php
                            $selectedIntakes = request()->input('intakes') ?? [];
                        @endphp


                        <div class="my-2">
                            <div class="toggle-header" data-filterslist="intakes">
                                <h5 class="title is-5">Intake</h5>
                                <div class="toggle-icon" style="transform: rotate(-45deg);"></div>
                            </div>

                            <div class="toggle-content" data-filters="intakes">
                                <select name="intakes" class="form-control select2_form_select" style="width: 90%;">
                                    <option value="">Select Intake</option>
                                    @foreach ($intakes as $intake)
                                        <option value="{{ $intake->name }}"
                                            {{ in_array($tag, $selectedIntakes) ? 'selected' : '' }}>
                                            {{ $intake->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="column is-10" id="schools">

                    <div class="all_university_container">
                        <div class="columns">
                            <div class="column">
                                <p class="result-search">
                                    Total University:
                                    <span class="count">{{ $universities->count() }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="columns mb-0">
                            <div class="column pt-0 pb-0">
                                <p class="result-search"></p>
                                <div class="pt-0 wrapper-result-tags-and-sort">
                                    <div class="tags searchingTags_wrapper">
                                        @if ($select_continent > 0)
                                            @php
                                                $select_continents = \App\Models\Continent::where(
                                                    'id',
                                                    $select_continent,
                                                )->get();
                                            @endphp
                                            @foreach ($select_continents as $select_continent)
                                                <span class="tag filterTags" data-field="continent"
                                                    data-keyword="{{ $select_continent->id }}">{{ $select_continent->name }}<span
                                                        class="delete-tag">X</span></span>
                                            @endforeach
                                        @endif

                                        @if ($select_country > 0)
                                            @php
                                                $select_countries = \App\Models\Country::where(
                                                    'id',
                                                    $select_country,
                                                )->get();
                                            @endphp
                                            @foreach ($select_countries as $contry)
                                                <span class="tag filterTags" data-field="country"
                                                    data-keyword="{{ $contry->id }}">{{ $contry->name }}<span
                                                        class="delete-tag">X</span></span>
                                            @endforeach
                                        @endif

                                        @if ($select_state > 0)
                                            @php
                                                $select_states = \App\Models\State::where('id', $select_state)->get();
                                            @endphp
                                            @foreach ($select_states as $state)
                                                <span class="tag filterTags" data-field="state"
                                                    data-keyword="{{ $state->id }}">{{ $state->name }}<span
                                                        class="delete-tag">X</span></span>
                                            @endforeach
                                        @endif

                                        @if ($select_city > 0)
                                            @php
                                                $select_cities = \App\Models\City::where('id', $select_city)->get();
                                            @endphp
                                            @foreach ($select_cities as $city)
                                                <span class="tag filterTags" data-field="city"
                                                    data-keyword="{{ $city->id }}">{{ $city->name }}<span
                                                        class="delete-tag">X</span></span>
                                            @endforeach
                                        @endif
                                        <a style="" class="clear-filter">Clear all</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <style>
                                .university {
                                    transition: 0.3s;
                                    height: 100% !important;
                                    /* box-shadow: 0px 0px 30px rgba(29, 23, 77, .09); */
                                    box-shadow: 0px 3px 20px -10px rgba(24, 54, 98, 0.75);
                                }

                                .university:hover {
                                    border-color: var(--primary_background);
                                    box-shadow: 0px 8px 30px -20px rgb(98 182 107 / 58%);

                                    .university-showcase-container .university-image-container .university-image {
                                        -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1.05) scaleY(1.05);
                                        transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1.05) scaleY(1.05);
                                    }
                                }

                                .university_name:hover {
                                    color: var(--primary_background) !important;
                                }

                                .university-showcase-container .university-image-container .university-image {
                                    transition: transform 0.3s;
                                    transform-origin: center center;
                                    opacity: 1;
                                    /* width: 6.125rem !important; */
                                    /* height: 5.375rem !important; */
                                    /* object-fit: contain !important; */
                                    width: 100% !important;
                                    height: 200px !important;
                                    object-fit: cover !important;
                                    -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
                                    transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
                                }

                                .university-top-header {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    color: #fff;
                                    z-index: 10;
                                }

                                .university-details-container table th,
                                .university-details-container table td {
                                    font-size: 13px;
                                    color: #fff;
                                }

                                .university-details-href {
                                    font-size: 11px;
                                    font-weight: 700;
                                    margin-top: 0 !important;
                                }

                                .university-tag {
                                    background-color: #ff0015b5;
                                    padding: 2px 4px;
                                    border-radius: 4px;
                                    font-size: 12px;
                                }
                            </style>
                            @if (count($universities) > 0)
                                @foreach ($universities as $university)
                                    @php
                                        $courses = App\Models\Course::where([
                                            'university_id' => $university->id,
                                            'status' => 1,
                                        ])->get();
                                        $course_count = count($courses);

                                        $display_data = json_decode($university->display_data, true);
                                    @endphp
                                    <div class="col-12 col-md-6 col-lg-4 col-auto mt-3 mt-md-4">
                                        <div class="text-center card university overflow-hidden p-0"
                                            style="border-radius:8px; cursor: pointer;"
                                            onclick="window.location.href='{{ route('frontend.university_details', $university->id) }}'">

                                            <div class="card-body p-0 university-showcase-container position-relative">
                                                <div class="university-top-header d-flex justify-content-between">
                                                    {{-- @if ($display_data && $display_data['available_seats'])
                                                <div style="background-color: var(--primary_background); width:25%; height:50px"
                                                    class="d-flex flex-column position-relative">
                                                    <div class="position-absolute" style="bottom: 0; left: 5px;">
                                                        <p class="text-capital mb-0 text-left" style="font-size: 0.55rem">
                                                            Seats
                                                        </p>
                                                        <p class="text-capital mb-0 text-left" style="font-size: 0.55rem">
                                                            Available
                                                        </p>
                                                    </div>
                                                    <div class="position-absolute" style="top: 0; right: 5px;">
                                                        <span class="fw-bold"
                                                            style="font-size: 1.25rem; color:rgb(226, 226, 22)">
                                                            {{ $display_data['available_seats'] ?? 'N/A' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endif --}}
                                                    <div style="background-color: var(--primary_background); width:30%; height:50px"
                                                        class="d-flex justify-content-center align-items-center">
                                                        <a style="font-size: 14px"
                                                            href="{{ route('frontend.university_course_list') }}"
                                                            class="text-capital fw-bold mt-1 text-light">
                                                            Apply Now
                                                        </a>
                                                    </div>

                                                    @if ($display_data && $display_data['countdown_deadline'])
                                                        <div style="background-color: var(--btn_tertiary_color); width:70%; height:50px"
                                                            class="d-flex justify-content-around align-items-center">
                                                            <div class="d-flex flex-column">
                                                                <div>
                                                                    <span id="countdown-{{ $university->id }}-days"
                                                                        class="fw-bold"
                                                                        style="font-size: 1.25rem;">--</span>
                                                                </div>
                                                                <div>Days</div>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <div>
                                                                    <span id="countdown-{{ $university->id }}-hours"
                                                                        class="fw-bold"
                                                                        style="font-size: 1.25rem;">--</span>
                                                                </div>
                                                                <div>Hours</div>
                                                            </div>
                                                            <div class="d-flex flex-column">
                                                                <div>
                                                                    <span id="countdown-{{ $university->id }}-minutes"
                                                                        class="fw-bold"
                                                                        style="font-size: 1.25rem;">--</span>
                                                                </div>
                                                                <div>Min</div>
                                                            </div>
                                                        </div>

                                                        <script>
                                                            (function() {
                                                                const countdownDeadline = "{{ $display_data['countdown_deadline'] }}";
                                                                if (countdownDeadline) {
                                                                    setupCountdown('countdown-{{ $university->id }}', countdownDeadline);
                                                                }

                                                                function setupCountdown(id, date) {
                                                                    function updateCountdown() {
                                                                        const now = new Date();
                                                                        const endOfDay = new Date(date + 'T23:59:59'); // End of the day
                                                                        const timeDiff = endOfDay - now;

                                                                        if (timeDiff <= 0) {
                                                                            document.getElementById(`${id}-days`).textContent = '0';
                                                                            document.getElementById(`${id}-hours`).textContent = '0';
                                                                            document.getElementById(`${id}-minutes`).textContent = '0';
                                                                            return;
                                                                        }

                                                                        const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                                                                        const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                                        const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

                                                                        document.getElementById(`${id}-days`).textContent = days;
                                                                        document.getElementById(`${id}-hours`).textContent = hours;
                                                                        document.getElementById(`${id}-minutes`).textContent = minutes;
                                                                    }

                                                                    updateCountdown();

                                                                    setInterval(updateCountdown, 60000);
                                                                }
                                                            })
                                                            ();
                                                        </script>
                                                    @endif
                                                </div>

                                                <div class="university-image-container position-relative">
                                                    <img decoding="async" src="{{ $university->banner_image_show }}"
                                                        alt="{{ $university->name }}" title="{{ $university->name }}"
                                                        class="university-image">

                                                    <div class="position-absolute" style="top: 55px; right:5px;">
                                                        <img src="{{ $university->image_show }}"
                                                            alt="{{ $university->name }}"
                                                            style="width: 80px; height:auto; border-radius:50%;">
                                                    </div>

                                                    <div class="position-absolute"
                                                        style="bottom: 5px; left:0px; width:100%">
                                                        @forelse (json_decode($university->tags, true) ?? [] as $index => $tag)
                                                            @php
                                                                $colors = ['#357A61', '#302C61'];
                                                                $backgroundColor = $colors[$index % count($colors)];
                                                            @endphp
                                                            <span class="university-tag me-1"
                                                                style="background-color: {{ $backgroundColor }};">
                                                                {{ $tag }}
                                                            </span>
                                                        @empty
                                                            <span>&nbsp;</span>
                                                        @endforelse
                                                    </div>
                                                </div>

                                                <div class="university-details-container w-100"
                                                    style="background-color: #eee">
                                                    <div>
                                                        {{-- <table class="table table-borderless m-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-start p-0">University Type</td>
                                                            <td class="text-start px-1 py-0">:</td>
                                                            <td class="text-start p-0">
                                                                {{ $display_data['university_type'] ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start p-0">World Rank</td>
                                                            <td class="text-start px-1 py-0">:</td>
                                                            <td class="text-start p-0">
                                                                {{ $display_data['world_rank'] ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start p-0">National Rank</td>
                                                            <td class="text-start px-1 py-0">:</td>
                                                            <td class="text-start p-0">
                                                                {{ $display_data['national_rank'] ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start p-0">Total Students</td>
                                                            <td class="text-start px-1 py-0">:</td>
                                                            <td class="text-start p-0">
                                                                {{ $display_data['total_students'] ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start p-0">International Students</td>
                                                            <td class="text-start px-1 py-0">:</td>
                                                            <td class="text-start p-0">
                                                                {{ $display_data['international_students'] ?? 'N/A' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-start p-0">Location</td>
                                                            <td class="text-start px-1 py-0">:</td>
                                                            <td class="text-start p-0">{{ $university->address }}</td>
                                                        </tr>
                                                    </tbody>
    
                                                </table> --}}

                                                        <div class="d-flex flex-column"
                                                            style="background-color: var(--primary_background); color:white;">
                                                            <div class="px-2">
                                                                <p class="mb-0 mt-1 text-start fw-bold"
                                                                    style="font-size: 16px; height:48px;">
                                                                    {{ Illuminate\Support\Str::limit($university->name, 60, '...') }}
                                                                </p>

                                                                <div>
                                                                    <table class="table table-borderless m-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="border-0 text-start p-0">World
                                                                                    Rank
                                                                                </td>
                                                                                <td class="border-0 text-start px-1 py-0">:
                                                                                </td>
                                                                                <td class="border-0 text-start p-0">
                                                                                    {{ $display_data['world_rank'] ?? 'N/A' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="border-0 text-start p-0">
                                                                                    Location
                                                                                </td>
                                                                                <td class="border-0 text-start px-1 py-0">:
                                                                                </td>
                                                                                <td class="border-0 text-start p-0">
                                                                                    {{ Illuminate\Support\Str::limit($university->address, 30, '...') }}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>

                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="px-2 pb-1 mt-2 d-flex justify-content-between">
                                                                <div class="d-flex justify-content-start align-items-end">
                                                                    @php
                                                                        $avg_round = floor(
                                                                            $university->reviews->avg('ratting'),
                                                                        );
                                                                    @endphp
                                                                    @if ($avg_round > 0)
                                                                        <div class="text-warning me-2">
                                                                            @for ($i = 1; $i <= @$avg_round; $i++)
                                                                                <i class="fa fa-star"
                                                                                    style="font-size:12px;"></i>
                                                                            @endfor
                                                                        </div>

                                                                        <div>
                                                                            {{ $avg_round }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <div>
                                                                    <p class="mb-0" style="font-size: 12px">
                                                                        <span class="fw-bold"
                                                                            style="color:rgb(226, 226, 22);">
                                                                            {{ $display_data ? $display_data['student_enrolled'] . '+' : 'N/A' }}
                                                                        </span>
                                                                        Students Enrolled
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center mx-0"
                                                    style="background-color: #eee">
                                                    <div
                                                        class="col-12 d-flex justify-content-between border-bottom border-light">
                                                        <div class="col-4 border-end border-light">
                                                            <a href="{{ route('frontend.university_details', ['id' => $university->id]) }}"
                                                                class="text-dark university-details-href">
                                                                Admission
                                                            </a>
                                                        </div>
                                                        <div class="col-4">
                                                            <a href="{{ route('frontend.university_details', ['id' => $university->id]) }}"
                                                                class="text-dark university-details-href">
                                                                Accommodation
                                                            </a>
                                                        </div>
                                                        <div class="col-4 border-start border-light">
                                                            <a href="{{ route('frontend.university_details', ['id' => $university->id]) }}"
                                                                class="text-dark university-details-href">
                                                                Facilities
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 row">
                                                        <div class="col-4 border-end border-light">
                                                            <a href="{{ route('frontend.university_details', ['id' => $university->id]) }}"
                                                                class="text-dark university-details-href">
                                                                Fees Structures
                                                            </a>
                                                        </div>
                                                        <div class="col-4">
                                                            <a href="{{ route('frontend.university_details', ['id' => $university->id]) }}"
                                                                class="text-dark university-details-href">
                                                                Scholarship
                                                            </a>
                                                        </div>
                                                        <div class="col-4 border-start border-light">
                                                            <a href="{{ route('frontend.university_details', ['id' => $university->id]) }}"
                                                                class="text-dark university-details-href">
                                                                Documents
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <div class="d-flex flex-column"
                                            style="background-color: var(--primary_background); color:white;">
                                            <div class="px-2">
                                                <p class="mb-0 mt-1 text-start fw-bold" style="font-size: 16px;">
                                                    {{ Illuminate\Support\Str::limit($university->name, 35, '...') }}
                                                </p>
                                                <p class="mb-0 text-start">
                                                    {!! $display_data['university_subtitle'] ?? '&nbsp;' !!}
                                                </p>
                                            </div>
    
                                            <div class="px-2 pb-1 mt-2 d-flex justify-content-between">
                                                <div class="d-flex justify-content-start align-items-end">
                                                    @php
                                                        $avg_round = floor($university->reviews->avg('ratting'));
                                                    @endphp
                                                    @if ($avg_round > 0)
                                                        <div class="text-warning me-2">
                                                            @for ($i = 1; $i <= @$avg_round; $i++)
                                                                <i class="fa fa-star" style="font-size:12px;"></i>
                                                            @endfor
                                                        </div>
    
                                                        <div>
                                                            {{ $avg_round }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="mb-0" style="font-size: 12px">
                                                        <span class="fw-bold" style="color:rgb(226, 226, 22);">
                                                            {{ $display_data ? $display_data['student_enrolled'] . '+' : 'N/A' }}
                                                        </span>
                                                        Students Enrolled
                                                    </p>
                                                </div>
                                            </div>
                                        </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        @if (@$universities->count() == 0)
                            <div class="text-center">
                                <h1 style="font-size: 25px">University Not Found !</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Frontend.layouts.parts.news-letter')
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
            filterUniversity(true)
            $(this).parent().remove();
            if ($('.searchingTags_wrapper').children().length == 2) {
                $('.clear-filter').css('display', 'none');
            }
        });

        $(document).on('click', '.clear-filter', function() {
            window.location = "{{ url('/list/all-universities') }}/"
            $('.filterTags').remove();
            //  op start
            filterUniversity(false, true)
            return false;
            //  end end
            $('.clear-filter').css('display', 'none');
            //location.reload();
        });

        $(document).on('keydown', '#search-input', function(e) {
            var key = e.which;
            if (key == 13) {
                filterUniversity(false, true)
                return false;
            }
        })

        $(document).on('click', '#search-input', function(e) {
            filterUniversity(false, true)
            return false;
        })
    </script>

    <script>
        $(document).on('change', 'select[name="continent"]', function() {
            $(document).find('select[name="continent"]').prop('selected', false);
            $(this).prop('selected', true);
            filterUniversity();
        });
        $(document).on('change', 'select[name="country"]', function() {
            $(document).find('select[name="country"]').prop('selected', false);
            $(this).prop('selected', true);
            filterUniversity();
        });
        $(document).on('change', 'select[name="state"]', function() {
            $(document).find('select[name="state"]').prop('selected', false);
            $(this).prop('selected', true);
            filterUniversity();
        });
        $(document).on('change', 'select[name="city"]', function() {
            $(document).find('select[name="city"]').prop('selected', false);
            $(this).prop('selected', true);
            filterUniversity();
        });

        $(document).on('change', 'select[name="tags"]', function() {
            $(document).find('select[name="tags"]').prop('selected', false);
            $(this).prop('selected', true);
            filterUniversity();
        });

        $(document).on('change', 'select[name="intakes"]', function() {
            $(document).find('select[name="intakes"]').prop('selected', false);
            $(this).prop('selected', true);
            filterUniversity();
        });

        function filterUniversity(del_filter = false, onsearch_val = false) {
            var continent_id = $(document).find('select[name="continent"]:selected').val();
            var country_id = $(document).find('select[name="country"]:selected').val();
            var state_id = $(document).find('select[name="state"]:selected').val();
            var city_id = $(document).find('select[name="city"]:selected').val();
            var tags = $(document).find('select[name="tags"]:selected').val();
            var intakes = $(document).find('select[name="intakes"]:selected').val();
            // alert(intakes);
            
            var data_val = {};

            $(".university_filter_container").empty();
            $('.preloader_container').removeClass('d-none').addClass('d-inline-block');

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
            var search_val = $('#search-input').val();
            if (search_val) {
                if (del_filter == true) {
                    if (del_name != 'search_val') {
                        data_val.search_val = search_val;
                    }
                } else {
                    data_val.search_val = search_val;
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

            if (tags) {
                if (del_filter == true) {
                    if (del_name != 'tags') {
                        data_val.tags = tags;
                    }
                } else {
                    data_val.tags = tags;
                }
            }

            if (intakes) {
                if (del_filter == true) {
                    if (del_name != 'intakes') {
                        data_val.intakes = intakes;
                    }
                } else {
                    data_val.intakes = intakes;
                }
            }

            data_val.onsearch_val = onsearch_val;
            // console.log(data_val);
            

            $.ajax({
                type: 'GET',
                url: "{{ url('ajax-university-filter') }}",
                data: data_val,
                success: function(data) {
                    // console.log(data);
                    
                    $('.preloader_container').removeClass('d-inline-block').addClass('d-none');
                    $(".university_filter_container").append(data);

                    $('.select2_form_select').select2();
                },
                error: function() {
                    $('.preloader_container').removeClass('d-inline-block').addClass('d-none');
                }

            });
        }
    </script>

    <script>
        $(document).on("click", ".toggle-header", function() {
            var vm = this,
                filterslistItem = $(vm).data();

            if (
                $(".toggle-content[data-filters=" + filterslistItem.filterslist + "]").css("display") == "none") {
                $(".toggle-content[data-filters=" + filterslistItem.filterslist + "]").css("display", 'block');

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
