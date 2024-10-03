<div class="column p-0">
    <div class="d-flex justify-content-between">
        <p class="result-search">{{ $courses->total() }} Programs Found</p>
        <div class="filters-button">
            <span class="filter-open"><img
                    src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/assets_new_design/img/icons/filter.642602b57b41.svg"
                    alt="filters">Filters</span>
            <span class="filter-opened"> <img
                    src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/assets_new_design/img/icons/filter.642602b57b41.svg"
                    alt="filters">Close Filters</span>
        </div>
    </div>

    <div class="wrapper-result-tags-and-sort">
        <div class="tags searchingTags_wrapper mb-0">

            @if ($select_continent > 0)
                @php
                    $select_continents = \App\Models\Continent::where('id', $select_continent)->get();
                @endphp
                @foreach ($select_continents as $select_continent)
                    <span class="tag filterTags" data-field="continent"
                        data-keyword="{{ $select_continent->id }}">{{ $select_continent->name }}<span
                            class="delete-tag">X</span></span>
                @endforeach
            @endif

            @if ($select_country > 0)
                @php
                    $select_countries = \App\Models\Country::where('id', $select_country)->get();
                @endphp
                @foreach ($select_countries as $contry)
                    <span class="tag filterTags" data-field="contry"
                        data-keyword="{{ $contry->id }}">{{ $contry->name }}<span class="delete-tag">X</span></span>
                @endforeach
            @endif

            @if ($select_state > 0)
                @php
                    $select_states = \App\Models\State::where('id', $select_state)->get();
                @endphp
                @foreach ($select_states as $state)
                    <span class="tag filterTags" data-field="state"
                        data-keyword="{{ $state->id }}">{{ $state->name }}<span class="delete-tag">X</span></span>
                @endforeach
            @endif

            @if ($select_city > 0)
                @php
                    $select_cities = \App\Models\City::where('id', $select_city)->get();
                @endphp
                @foreach ($select_cities as $city)
                    <span class="tag filterTags" data-field="city"
                        data-keyword="{{ $city->id }}">{{ $city->name }}<span class="delete-tag">X</span></span>
                @endforeach
            @endif

            @if ($selected_degree > 0)
                @php
                    $selected_degrees = \App\Models\Degree::where('id', $selected_degree)->get();
                @endphp
                @foreach ($selected_degrees as $degree)
                    <span class="tag filterTags" data-field="degree"
                        data-keyword="{{ $degree->id }}">{{ $degree->name }}<span class="delete-tag">X</span></span>
                @endforeach
            @endif

            @if ($selected_language > 0)
                @php
                    $selected_languages = \App\Models\CourseLanguage::where('id', $selected_language)->get();
                @endphp
                @foreach ($selected_languages as $language)
                    <span class="tag filterTags" data-field="language"
                        data-keyword="{{ $language->id }}">{{ $language->name }}<span
                            class="delete-tag">X</span></span>
                @endforeach
            @endif

            @if ($selected_section > 0)
                @php
                    $selected_section = \App\Models\Section::where('id', $selected_section)->get();
                @endphp
                @foreach ($selected_section as $section)
                    <span class="tag filterTags" data-field="section"
                        data-keyword="{{ $section->id }}">{{ $section->name }}<span
                            class="delete-tag">X</span></span>
                @endforeach
            @endif

            @if ($selected_subject > 0)
                @php
                    $selected_subjects = \App\Models\Department::where('id', $selected_subject)->get();
                @endphp
                @foreach ($selected_subjects as $subject)
                    <span class="tag filterTags" data-field="subject"
                        data-keyword="{{ $subject->id }}">{{ $subject->name }}<span
                            class="delete-tag">X</span></span>
                @endforeach
            @endif

            @if ($selected_university > 0)
                @php
                    $selected_university = \App\Models\University::where('id', $selected_university)->get();
                @endphp
                @foreach ($selected_university as $university)
                    <span class="tag filterTags" data-field="university"
                        data-keyword="{{ $university->id }}">{{ $university->name }}<span
                            class="delete-tag">X</span></span>
                @endforeach
            @endif

            <a style="" class="clear-filter">Clear</a>
        </div>

        <form id="filter-form" method="POST" style="display:none"></form>
    </div>

    <div data-block-id="sort_bar" class="d-none d-md-block">
        <div id="sort_by" aria-label="Sort your results" class="mb-4">
            <ul class="sort_option_list ">
                <li class=" sort_category {{ $course_category == 1 ? 'selected' : '' }} sort-score">
                    <a href="#" class="sort_option sort_category_course_list" cat="1"
                        data-category="sort-score" role="button">
                        Our Top Picks
                    </a>
                </li>
                <li class=" sort_category {{ $course_category == 2 ? 'selected' : '' }} sort-popular">
                    <a href="#" class="sort_option sort_category_course_list" cat="2"
                        data-category="sort-popular" role="button">
                        Most Popular
                    </a>
                </li>
                <li class=" sort_category {{ $course_category == 3 ? 'selected' : '' }} sort-speed">
                    <a href="#" class="sort_option sort_category_course_list" cat="3"
                        data-category="sort-speed" role="button">
                        Fastest Admissions
                    </a>
                </li>
                <li class=" sort_category {{ $course_category == 4 ? 'selected' : '' }} sort-rating ">
                    <a href="#" class="sort_option sort_category_course_list" cat="4"
                        data-category="sort-rating" role="button">
                        Highest Rating
                    </a>
                </li>
                <li class=" sort_category {{ $course_category == 5 ? 'selected' : '' }} sort-rank ">
                    <a href="#" class="sort_option sort_category_course_list" cat="5"
                        data-category="sort-rank" role="button">
                        Top Ranked
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>

<div class="onSearchResultPage" style="">

    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Search results</title>
    <div id="programsFoundCount" style="display:none">{{ $courses->count() }} Programs Found</div>
    <span id="programsfound"></span>
    <div class="show-course-ajax-data-list show-course-paginate-ajax-data">
        @php
            $sortedCourses = $courses->items();
            usort($sortedCourses, function ($a, $b) {
                return strtotime($b['application_deadline']) - strtotime($a['application_deadline']);
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
                $course_details_url = route('frontend.course.details', $course_details_url_params);
                $course_list_url = route('frontend.university_course_list', $course_list_url_params);
            @endphp

            <div class="columns">
                <div class="column">
                    <div class="d-flex justify-content-center" style="position: relative;">
                        <div class="choice s-col-11 search-page-list-item">
                            <div class="choice-wrapper overflow-hidden position-relative"
                                data-url="{{ $course_details_url }}">

                                <div class="s-row">
                                    <div class="s-col-9">
                                        <div class="d-flex justify-content-start"
                                            onclick="location.href='{{ $course_details_url }}'"
                                            style="cursor: pointer">
                                            <div class="d-none d-md-flex flex-column justify-content-start"
                                                style="width: 16%">
                                                <img src="{{ @$course->university?->image_show ?? '' }}"
                                                    class="m-0" style="width: 90px; height:auto">

                                                <div class="my-2">
                                                    @forelse (json_decode($course->university?->tags, true) ?? [] as $index => $tag)
                                                        @php
                                                            $colors = ['#357A61', '#302C61'];
                                                            $backgroundColor = $colors[$index % count($colors)];
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
                                                <h4 class="title mb-1">
                                                    <span class="mr-2" style="vertical-align: middle;">
                                                        {{ strlen($course->name) > 50 ? substr($course->name, 0, 50) . '...' : $course->name }}
                                                    </span>
                                                </h4>
                                                <p class="school-name-desktop">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor"
                                                        class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
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
                                                                    $colors = ['#357A61', '#302C61'];
                                                                    $backgroundColor = $colors[$index % count($colors)];
                                                                @endphp
                                                                <span class="university-tag mx-1 mx-md-0"
                                                                    style="background-color: {{ $backgroundColor }};">
                                                                    {{ $tag }}
                                                                </span>
                                                            @empty
                                                                <span>&nbsp;</span>
                                                            @endforelse
                                                        </div>

                                                        <h4 class="title"
                                                            style="flex-direction: column; /* align-items: flex-start; */">
                                                            <span class="mr-2 text-center"
                                                                style="vertical-align: middle;">
                                                                {{ strlen($course->name) > 50 ? substr($course->name, 0, 50) . '...' : $course->name }}
                                                            </span>
                                                            <p>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
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
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" class="bi bi-translate"
                                                            viewBox="0 0 16 16" style="fill:#494949">
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
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-flag-fill" viewBox="0 0 16 16">
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

                                                <div class="wrapper-bullts justify-content-between pb-0 ms-0">
                                                    <div class="bulit">
                                                        <div class="title">Tuition Fees (Yearly)
                                                        </div>
                                                        <div class="value">
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
                                                                            ($scholarship?->accommodation_fee ?? 0);

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
                                                                                                $main_value +=
                                                                                                    $course->visa_extension_fee;
                                                                                                $main_value +=
                                                                                                    $course->medical_in_china_fee; */
                                                                }

                                                                // Calculate the original total fee before scholarships
                                                                $cut_value =
                                                                    ($course->year_fee ?? 0) +
                                                                    ($course->accommodation_fee ?? 0);
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
                                                        <div class="title">Accommodation Fees (Yearly)
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
                                                        <div class="title">Study Duration</div>
                                                        <div class="value">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor"
                                                                class="bi bi-alarm-fill" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H9v1.07a7.001 7.001 0 0 1 3.274 12.474l.601.602a.5.5 0 0 1-.707.708l-.746-.746A6.97 6.97 0 0 1 8 16a6.97 6.97 0 0 1-3.422-.892l-.746.746a.5.5 0 0 1-.707-.708l.602-.602A7.001 7.001 0 0 1 7 2.07V1h-.5A.5.5 0 0 1 6 .5m2.5 5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.04 8.04 0 0 0 .86 5.387M11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.04 8.04 0 0 0-3.527-3.527" />
                                                            </svg>
                                                            {{ @$course->course_duration }} Year
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-none d-md-block s-col-3 search-page-list-item-bottom">
                                        <div class="wrapper-bullts call-to-action justify-content-center"
                                            style="margin-top: 0 !important">
                                            <div class="bulit">
                                                <div class="title d-flex justify-content-center">
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
                                            <section class="apply__action d-flex justify-content-center">
                                                @if (strtotime(@$course->application_deadline) < strtotime(now()))
                                                    <button class="ca-button justify-content-center"
                                                        style="background-color:#6c757d; cursor: not-allowed;">
                                                        <a href="javascript:void(0)"
                                                            style="color: #fff; pointer-events: none;">
                                                            Apply Now
                                                        </a>
                                                    </button>
                                                @else
                                                    <button class="ca-button justify-content-center">
                                                        <a href="{{ $apply_url }}" style="color: #fff">Apply Now
                                                        </a>
                                                    </button>
                                                @endif
                                            </section>
                                        </div>
                                    </div>

                                    <div class="d-md-none s-col-12 mt-3 mb-3">
                                        @if (strtotime(@$course->application_deadline) < strtotime(now()))
                                            <button class="mx-auto ca-button justify-content-center"
                                                style="background-color:#6c757d; cursor: not-allowed;">
                                                <a href="javascript:void(0)"
                                                    style="color: #fff; pointer-events: none;">
                                                    Apply Now
                                                </a>
                                            </button>
                                        @else
                                            <button class="mx-auto ca-button justify-content-center">
                                                <a href="{{ $apply_url }}" style="color: #fff">Apply Now
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
                        <a href="{{ route('frontend.course.details', $course->id) }}" class=""></a>
                    </div>
                </div>
            </div>
        @endforeach

        @if (@$courses->count() == 0)
            <div class="text-center">
                <h1 style="font-size: 25px">Program Not Found !</h1>
            </div>
        @endif
    </div>

    {{-- pagination ajax start --}}
    <style>
        .pagination-link {
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>
    <div class="columns">
        @if ($courses->lastPage() != 1)
            <div class="column" onclick="window.scrollTo(0, 0);">
                <nav class="pagination" role="navigation" aria-label="pagination" style="padding-left: 15px;">
                    <div class="pagination">
                        <a page_no="{{ $courses->currentPage() == 1 ? 1 : $courses->currentPage() - 1 }}"
                            class="page-link course-paginate next_page next pagination-link" href="javascript:void(0)"
                            aria-label="Previous"> &laquo;</a>

                        @for ($i = 1; $i <= $courses->lastPage(); $i++)
                            <a class="pagination-link course-paginate page current @if ($i == $courses->currentPage()) is-current @endif"
                                page_no="{{ $i }}" @if ($i == $courses->currentPage())  @endif
                                href="javascript:void(0)">{{ $i }}</a>
                        @endfor

                        <a page_no="{{ $courses->currentPage() == $courses->lastPage() ? $courses->lastPage() : $courses->currentPage() + 1 }}"
                            class="page-link course-paginate next_page next pagination-link" href="javascript:void(0)"
                            aria-label="Next"> &gt;</a>
                    </div>
                </nav>
            </div>
        @endif
    </div>

</div>
