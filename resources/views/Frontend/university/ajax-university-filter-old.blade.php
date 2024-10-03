<div class="column is-2">
    <div class="filters-button">
        <span class="filter-open"><img
                src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/assets_new_design/img/icons/filter.642602b57b41.svg"
                alt="filters">Filters</span>
        <span class="filter-opened"> <img
                src="https://d2xtzyi0kjzog2.cloudfront.net/static/assets/assets_new_design/img/icons/filter.642602b57b41.svg"
                alt="filters">Close Filters</span>
    </div>
    <div class="wrapper-filters">

        {{-- <div class="my-2">
            <div class="toggle-header" data-filterslist="continent">
                <h5 class="title is-5">Continent</h5>
                <div class="toggle-icon" style="transform: rotate(135deg);"></div>
            </div>
            <div class="toggle-content" data-filters="continent" style="display: none">
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
                            <option value="{{ $country->id }}" @if ($select_country == $country->id) selected @endif>
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
                        <option value="{{ $state->id }}" @if ($select_state == $state->id) selected @endif>
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
                <div class="toggle-content" data-filters="city" {{-- style="display: none" --}}>
                    <select name="city" class="form-control select2_form_select" style="width: 90%;">
                        <option value="">Select City</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @if ($select_city == $city->id) selected @endif>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
</div>
<div class="column is-10" id="schools">

    <div class="columns">

        <div class="column">
            <p class="result-search"><span class="count">{{ $universities->count() }}</span> Total University Found
            </p>
            <div class="dropdown">
                {{-- <div class="sorting">Sorting
                    <span class="icon is-small">
                        <i class="fas fa-angle-down" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="dropdown-content" style="left: 0px;">
                    <span id="sort-asc">Ascending order</span>
                    <span id="sort-desc">Descending order</span>
                </div> --}}
            </div>
        </div>

    </div>
    <div class="columns mb-0">
        <div class="column pt-0 pb-0">
            <p class="result-search"></p>
            <div class="pt-0 wrapper-result-tags-and-sort">
                <div class="tags searchingTags_wrapper">
                    @if ($select_search != '')
                        <span class="tag filterTags" data-field="search_val"
                            data-keyword="{{ $select_search }}">{{ $select_search }}<span
                                class="delete-tag">X</span></span>
                    @endif
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
            }

            .university-container .university-image-container .university-image {
                transition: transform 0.3s;
                transform-origin: center center;
                opacity: 1;
                width: 6.125rem !important;
                height: 6.125rem !important;
                object-fit: contain !important;
                -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
                transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
            }

            .university:hover {
                border-color: var(--secondary_background);

                .university-container .university-image-container .university-image {
                    -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1.05) scaleY(1.05);
                    transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1.05) scaleY(1.05);
                }
            }

            .university_name:hover {
                color: var(--secondary_background) !important;
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
                @endphp
                <div class="col-12 col-md-6 col-lg-3 col-auto mt-3 mt-md-4">
                    <div class="text-center card university" style="border-radius:8px; box-shadow:none;cursor: pointer;"
                        onclick="window.location.href='{{ route('frontend.university_details', $university->id) }}'">
                        <div class="card-body university-container">
                            <div class="university-image-container">
                                <img decoding="async" src="{{ $university->image_show }}"
                                    alt="{{ $university->name }}" title="{{ $university->name }}"
                                    style="border-radius: 8px" class="university-image">
                            </div>
                            <div class="mt-4">
                                <div>
                                    <span class="py-2 px-3 text-white"
                                        style="line-height:0;background-color: var(--primary_background); border-radius:8px; font-size:0.85rem;">
                                        {{ $course_count . ' COURSE(S)' }}
                                    </span>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('frontend.university_details', $university->id) }}"
                                        class="text-dark university_name">
                                        <h5 style="font-size: 1rem;" class="fw-bold">
                                            {{ $university->name }}
                                        </h5>
                                    </a>
                                    <div class="text-ellipsis mt-2"
                                        style="white-space:nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $university->city?->name . ', ' . $university->state?->name }}
                                    </div>
                                </div>
                            </div>
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
