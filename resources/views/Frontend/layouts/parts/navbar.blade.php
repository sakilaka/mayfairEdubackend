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
            <a class="navbar-brand" href="{{ url('http://localhost:5173/') }}">
                <img src="{{ @$header_logo->header_image == '' ? @$header_logo->no_image : @$header_logo->header_image_show }}"
                    alt="Logo-{{ @$theme_header->company_name }}">
            </a>
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> --}}


        </div>

        <div class="me-5">
            @if (Auth::check())
                <li class="nav-item dropdown menu-round-btn menu-user-btn dropdown-top-space d-flex align-items-center">
                    <div {{-- data-bs-toggle="dropdown" --}} onclick="location.href='{{ route('user.profile') }}'">
                        <img src="{{ auth()->user()->image_show ?? asset('frontend/images/no-profile.jpg') }}"
                            alt="user" class="radius-50">
                    </div>
                    <div class="dropdown-menu-profile dropdown-menu p-3 dropdown-menu-end" data-bs-popper="none">
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
        </div>
    </nav>
    <!-- Navigation -->
</header>
