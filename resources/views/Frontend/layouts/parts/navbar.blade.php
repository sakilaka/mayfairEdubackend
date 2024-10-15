@php
    $header_logo = \App\Models\Tp_option::where('option_name', 'theme_logo')->first();
    $theme_header = \App\Models\Tp_option::where('option_name', 'theme_option_header')->first();
    $branches = App\Models\Office::all();

    $headOffice = null;
    $country_offices = [];

    foreach ($branches as $branch) {
        if ($branch['name'] === 'Head Office') {
            $headOffice = $branch;
        } else {
            $country = $branch['country'];
            if (!isset($country_offices[$country])) {
                $country_offices[$country] = [];
            }
            $country_offices[$country][] = $branch;
        }
    }

    $offices = [
        'head_office' => $headOffice,
        'country_offices' => $country_offices,
    ];
@endphp

<header class="fixed-top-header">
    <div class="text-center py-2" style="background-color: var(--primary_background); width:100vw !important;">
        <a href="{{ json_decode($theme_header['option_value'], true)['top_bar_url'] ?? route('home') }}"
            class="text-white"
            style="/* color:rgb(213, 255, 216); */font-size: 0.95rem;font-weight:500;font:family:'DM Sans', sans-serif;">
            {{ json_decode($theme_header['option_value'], true)['top_bar_text'] ?? 'Want to launch innovative new courses? We\'ll Show You' }}
        </a>
    </div>

    <!-- Navigation -->
    <nav class="navbar sticky-header navbar-expand-lg" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ @$header_logo->header_image == '' ? @$header_logo->no_image : @$header_logo->header_image_show }}"
                    alt="Logo-{{ @$theme_header->company_name }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="main-menu-collapse collapse navbar-collapse" id="navbarSupportedContent">

                <div class="header-nav-left-side me-auto d-flex">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('frontend.university_course_list') ? 'active' : '' }}"
                                href="{{ route('frontend.university_course_list') }}">Programs</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('frontend.all_universities_list') ? 'active' : '' }}"
                                href="{{ route('frontend.all_universities_list') }}">Partner Universities</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('frontend.scholarship') ? 'active' : '' }}"
                                href="{{ route('frontend.scholarship') }}">Scholarship</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                data-bs-toggle="dropdown">Services
                            </a>
                            <ul class="dropdown-menu {{-- dropdown-menu-end --}}">
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.our_services') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.our_services') }}">
                                        Our Services
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.why_china') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.why_china') }}">
                                        Why China?
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.about_china') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.about_china') }}">
                                        About China
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="contactDropdown"
                                data-bs-toggle="dropdown">
                                Expo
                            </a>
                            @php
                                $expoArray = App\Models\Expo::select('id', 'title', 'location')->latest()->get();
                                $groupedExpos = [
                                    'china' => [],
                                    'overseas' => [],
                                    'undefined' => [],
                                ];

                                foreach ($expoArray as $expo) {
                                    $locationData = $expo->location ? json_decode($expo->location, true) : null;

                                    if ($locationData && isset($locationData['type'])) {
                                        $countryName = $locationData['country'] ?? null;

                                        if ($locationData['type'] === 'china') {
                                            $groupedExpos['china'][] = [
                                                'id' => $expo->id,
                                                'title' => $expo->title,
                                                'location' => 'China',
                                            ];
                                        } elseif ($locationData['type'] === 'overseas') {
                                            $groupedExpos['overseas'][] = [
                                                'id' => $expo->id,
                                                'title' => $expo->title,
                                                'location' => $countryName,
                                            ];
                                        }
                                    } else {
                                        $groupedExpos['undefined'][] = [
                                            'id' => $expo->id,
                                            'title' => $expo->title,
                                            'location' => null,
                                        ];
                                    }
                                }
                            @endphp
                            <ul class="dropdown-menu">
                                <!-- Expo in China -->
                                <li>
                                    <a class="dropdown-item" href="#">Expo In China</a>
                                    <ul class="submenu dropdown-menu">
                                        @foreach ($groupedExpos['china'] as $expo)
                                            <li>
                                                <a class="dropdown-item" href="#">{{ $expo['title'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <!-- Expo in Overseas -->
                                <li>
                                    <a href="#" class="dropdown-item dropdown-toggle">Expo In Overseas</a>
                                    <ul class="submenu dropdown-menu">
                                        @foreach ($groupedExpos['overseas'] as $expo)
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    {{ $expo['location'] }} &nbsp; <!-- Country name -->
                                                </a>
                                                <ul class="submenu dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="#">{{ $expo['title'] }}</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                data-bs-toggle="dropdown">About
                            </a>
                            <ul class="dropdown-menu {{-- dropdown-menu-end --}}">
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.company_details') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.company_details') }}">Company Details</a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.founders_co_founders') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.founders_co_founders') }}">Meet Our Leaders</a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.gallery') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.gallery') }}">Gallery</a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.authorization_letters') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.authorization_letters') }}">Authorization Letters</a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.activities') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.activities') }}">Activities</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown">
                                More
                            </a>
                            <ul class="dropdown-menu {{-- dropdown-menu-end --}}">
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.instructor') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.instructor') }}">Partner</a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.blog') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.blog') }}">Blog</a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.event_list') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.event_list') }}">Event</a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.faq') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.faq') }}">FAQ</a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.payment_process') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.payment_process') }}">Payment Process</a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ Route::is('landing_page.all_notice') ? 'active-bg' : '' }}"
                                        href="{{ route('landing_page.all_notice') }}">Notice Board</a>
                                </li>
                            </ul>
                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Route::is('frontend.expo_list') ? 'active' : '' }}"
                                href="{{ route('frontend.expo_list') }}">Expo</a>
                        </li> --}}

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="contactDropdown"
                                data-bs-toggle="dropdown">
                                Contact
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Contact -->
                                <li>
                                    <a class="dropdown-item {{ Route::is('frontend.contact') ? 'active-bg' : '' }}"
                                        href="{{ route('frontend.contact') }}">Contact</a>
                                </li>

                                <!-- Head Office -->
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('frontend.office_details', ['office_id' => $offices['head_office']->id]) }}">
                                        Head Office
                                    </a>
                                </li>

                                <!-- Regional Offices Dropdown -->
                                @if (!empty($offices['country_offices']))
                                    <li>
                                        <a href="#" class="dropdown-item dropdown-toggle">Regional Offices</a>
                                        <ul class="submenu dropdown-menu">
                                            @foreach ($offices['country_offices'] as $country => $countryOffices)
                                                <li>
                                                    <a href="javascript:void(0)"
                                                        class="dropdown-item dropdown-toggle">
                                                        {{ $country }} Offices &nbsp;
                                                    </a>
                                                    <ul class="submenu dropdown-menu">
                                                        @foreach ($countryOffices as $office)
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('frontend.office_details', ['office_id' => $office['id']]) }}">
                                                                    {{ $office['name'] }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </li>

                        <li class="nav-item dropdown d-inline-block d-lg-none">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown">
                                {{ getApplicationCurrency()->currency_icon }}
                            </a>
                            <ul class="dropdown-menu">
                                @php
                                    $currencies = \App\Models\Currency::get();
                                @endphp
                                @foreach ($currencies as $currency)
                                    <li>
                                        <a class="dropdown-item {{ !$loop->last ? 'border-bottom' : '' }}"
                                            href="{{ route('frontend.change_currency', $currency->currency_name) }}">
                                            {{ $currency->currency_name . ' (' . $currency->currency_icon . ')' }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="header-nav-right-side d-flex">
                    <ul class="navbar-nav d-flex flex-row align-items-center justify-content-between">
                        <li class="nav-item dropdown d-none d-lg-inline-block">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown">
                                {{ getApplicationCurrency()->currency_icon }}
                            </a>
                            <ul class="dropdown-menu">
                                @php
                                    $currencies = \App\Models\Currency::get();
                                @endphp
                                @foreach ($currencies as $currency)
                                    <li>
                                        <a class="dropdown-item {{ !$loop->last ? 'border-bottom' : '' }}"
                                            href="{{ route('frontend.change_currency', $currency->currency_name) }}">
                                            {{ $currency->currency_name . ' (' . $currency->currency_icon . ')' }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item mx-2 d-flex align-items-center">
                            <div>
                                <div id="gt-mordadam-43217984"></div>
                            </div>
                        </li>

                        @if (Auth::check())
                            <li
                                class="nav-item dropdown menu-round-btn menu-user-btn dropdown-top-space d-flex align-items-center">
                                <div {{-- data-bs-toggle="dropdown" --}} onclick="location.href='{{ route('user.profile') }}'">
                                    <img src="{{ auth()->user()->image_show ?? asset('frontend/images/no-profile.jpg') }}"
                                        alt="user" class="radius-50">
                                </div>
                                <div class="dropdown-menu-profile dropdown-menu p-3 dropdown-menu-end"
                                    data-bs-popper="none">
                                    <!-- Dropdown User Info Item Start -->
                                    <div class="dropdown-user-info">
                                        <div class="message-user-item d-flex align-items-center">
                                            <div class="message-user-item-left">
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0">
                                                        <div class="user-img-wrap position-relative radius-50">
                                                            <img src="{{ auth()->user()->image_show ?? asset('frontend/images/no-profile.jpg') }}"
                                                                alt="img" class="radius-50">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <h6 class="color-heading font-14">{{ auth()->user()->name }}
                                                        </h6>
                                                        <p class="font-13">{{ auth()->user()->email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Dropdown User Info Item End -->
                                    <ul class="user-dropdown-item-box list-unstyled">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user.profile') }}">Dashboard</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (!Auth::check())
                            <li class="nav-item">
                                <a href="{{ route('frontend.signin') }}" class="btn btn-primary-bg"
                                    style="font-weight: 500;">Login</a>
                            </li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </nav>
    <!-- Navigation -->
</header>
