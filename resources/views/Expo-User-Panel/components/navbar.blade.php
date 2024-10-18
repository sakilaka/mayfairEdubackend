<style>
    :root {
        --red-btn-color: #e74c3c;
        --red-btn-hover-color: #c0392b;
    }

    a {
        color: var(--red-btn-color);
        transition: 0.3s;
    }

    a:hover {
        color: var(--red-btn-hover-color);
    }

    .btn-danger-bg {
        background-color: var(--red-btn-color);
        color: white;
        font-weight: bold;
        transition: 0.3s background;
    }

    .btn-danger-bg:hover {
        color: white;
        background-color: var(--red-btn-hover-color);
    }

    .navbar {
        background-color: transparent !important;
        padding: 20px 0;
    }

    .navbar-nav {
        background-color: #283747;
        padding: 10px;
        border-radius: 5px;
    }

    .navbar-toggler {
        color: white;
        border: none;
        outline: none;
        box-shadow: none;
        transition: background-color 0.3s ease;
    }

    .navbar-toggler:focus,
    .navbar-toggler:active {
        outline: none;
        box-shadow: none;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.5 12a.5.5 0 0 1 0-1h13a.5.5 0 0 1 0 1h-13zm0-4a.5.5 0 0 1 0-1h13a.5.5 0 0 1 0 1h-13zm0-4a.5.5 0 0 1 0-1h13a.5.5 0 0 1 0 1h-13z'/%3E%3C/svg%3E");
    }

    .logo {
        height: 100px;
    }

    @media (max-width: 768px) {
        .logo {
            height: 70px;
        }
    }

    @media (max-width: 576px) {
        .logo {
            height: 50px;
        }
    }

    .bg-section {
        height: auto;
    }

    .nav-link {
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .nav-link {
            font-size: 1rem;
        }

        .bg-section {
            height: auto !important;
            padding: 10px 0;
        }
    }

    .btn-responsive {
        margin-top: 15px;
        padding: 10px 15px;
        font-size: 1rem;
    }

    @media (min-width: 768px) {
        .btn-responsive {
            padding: 10px 20px;
        }
    }

    @media (min-width: 1200px) {
        .btn-responsive {
            padding: 10px 25px;
        }
    }

    .rectangle-3-holder {
        background: #283747;
    }

    .rectangle-2-holder {
        margin: 15px auto 0;
        max-width: 1085px;
        min-height: 122px;
        padding: 5.5rem 2.96496% 4.4rem;
        position: relative;
        background: #283747;
        background-position: center center;
    }

    .registration-btn {
        border-radius: 5px;
        text-transform: uppercase;
        font-family: "Barlow Condensed", sans-serif;
        font-stretch: condensed;
        font-weight: 500;
        text-align: center;
        text-transform: uppercase;
        padding: 15px;
    }

    .nav-item {
        padding: 0 8px;
    }

    .header-navbar .nav-link {
        color: white;
        text-transform: uppercase;
        transition: background 0.45s, color 0.45s;
        border-radius: 5px;
    }

    .header-navbar .nav-link:hover,
    .header-navbar .nav-link.active {
        background: rgba(231, 76, 60, 0.5);
        color: white;
    }

    .bg-section {
        background-image: url("{{ asset('frontend/expo-domain/images/rectangle_1.png') }}");
        height: 100vh;
        width: 100%;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .bg-color {
        /* background-color: rgba(156, 16, 0, 0.303); */
        background-color: rgba(231, 76, 60, 0.22);
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1;
    }

    .fw600 {
        font-weight: 600;
    }

    .fw700 {
        font-weight: bold;
    }

    .overlay-section,
    .red-section-bg {
        background-image: url("../images/rectangle_1.png");
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .overlay-section {
        height: 40px;
    }

    .overlay,
    .red-section-bg::before {
        background-color: rgba(170, 17, 0, 0.236);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .custom-navbar-width {
        width: 100%;
    }

    @media (min-width: 768px) {
        .custom-navbar-width {
            width: auto;
        }
    }

    .dropdown .dropdown-menu {
        background-color: #fff8f8;
        margin-top: 0.75rem;
        font-size: 0.8125rem;
        box-shadow: 0px 2px 25px 0px rgb(200 0 0 / 20%);
        border: 1px solid transparent;
    }
</style>

<div class="bg-section" style="height:auto;">
    <div class="px-3 px-md-5">
        <nav class="navbar header-navbar navbar-expand-md shadow-none" style="z-index: 3">
            <div class="container-fluid d-flex justify-content-between">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('frontend/expo-domain/images/vector_smart_object_3.png') }}" alt="Logo"
                        class="logo">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav ms-auto d-flex align-items-center custom-navbar-width">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('expo.details') ? 'active' : '' }}"
                                href="{{ route('expo.details', ['id' => $expo->unique_id]) }}"
                                style="color: white;">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('expo.schedule') ? 'active' : '' }}"
                                href="{{ route('expo.schedule', ['unique_id' => $expo->unique_id]) }}"
                                style="color: white;">Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('expo.exhibitors') ? 'active' : '' }}"
                                href="{{ route('expo.exhibitors', ['unique_id' => $expo->unique_id]) }}"
                                style="color: white;">Exhibitors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('expo.delegates') ? 'active' : '' }}"
                                href="{{ route('expo.delegates', ['unique_id' => $expo->unique_id]) }}"
                                style="color: white;">Delegates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('expo.testimonials') ? 'active' : '' }}"
                                href="{{ route('expo.testimonials', ['unique_id' => $expo->unique_id]) }}"
                                style="color: white;">Testimonial</a>
                        </li>
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle {{ Route::is('expo.gallery') || Route::is('expo.video') ? 'active' : '' }} text-white"
                                href="#" data-toggle="dropdown" id="whyChinaDropdown" aria-expanded="false">
                                <span class="mr-2">Media</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown shadow"
                                aria-labelledby="whyChinaDropdown">
                                <a class="dropdown-item"
                                    href="{{ route('expo.gallery', ['unique_id' => $expo->unique_id]) }}">
                                    Gallery
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                    href="{{ route('expo.video', ['unique_id' => $expo->unique_id]) }}">
                                    Video
                                </a>
                            </div>
                        </li>

                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"
                                id="profileDropdown" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-md-inline">{{ Auth::guard('expo')->user()->name ?? '' }}</span>
                                <img src="{{ $userData->photo ?? asset('frontend/images/no-profile.jpg') }}"
                                    alt="{{ Auth::guard('expo')->user()->name ?? '' }}" width="50"
                                    style="border-radius: 50%; margin-left:5px;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item"
                                    href="{{ route('user.edit_profile', ['id' => Auth::guard('expo')->user()->id]) }}">
                                    <i class="fa fa-user text-primary"></i>
                                    Edit Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('user.logout') }}">
                                    <i class="fas fa-power-off text-primary"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                        <li class="nav-item mt-1 mt-md-0">
                            <a class="nav-link registration-btn btn-secondary-bg px-2" href="{{ route('logout') }}"
                                style="color: white;">Logout</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </div>

    <div class="bg-color"></div>
</div>
