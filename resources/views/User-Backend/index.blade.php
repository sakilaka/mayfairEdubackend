<!DOCTYPE html>
<html lang="en">

<head>
    @include('User-Backend.components.head')
    <title>{{ env('APP_NAME') }} | Dashboard</title>

    <style>
        .nav-tabs .nav-item:nth-child(1) {
            margin-left: 0px;
        }

        .nav-tabs .nav-item {
            line-height: 1;
            margin-left: 6px;
            font-size: 0.9rem;
        }

        .nav-tabs .nav-item .nav-link {
            border-radius: 6px !important;
        }

        .partner-social-container ul {
            list-style-type: none;
            display: flex;
            justify-content: start;
            align-items: center;
        }

        .partner-social-container ul li {
            margin-right: 0.85rem;
            background-color: rgb(228, 254, 237);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 45px;
            height: 45px;
            transition: 0.4s;
        }

        .partner-social-container ul li:hover {
            background-color: var(--btn_primary_color);
        }

        .partner-social-container ul li a {
            font-size: 18px !important;
            margin-top: 2.5px;
            text-decoration: none;
            padding: 12px;
            color: var(--btn_primary_color);
            transition: 0.4s;
        }

        .partner-social-container ul li:hover a {
            color: rgb(228, 254, 237);
        }

        @media screen and (max-width:1299px) {
            .partner-social-container-lg {
                display: inline-block;
            }

            .partner-social-container-sm {
                display: none;
            }
        }

        @media screen and (min-width:1300px) {
            .partner-social-container-lg {
                display: none;
            }

            .partner-social-container-sm {
                display: inline-block;
            }
        }

        .form-group label {
            font-size: 1.08rem;
            font-weight: 600;
            color: rgb(99, 99, 99);
        }

        .form-group p {
            font-size: 1rem;
            color: rgb(43, 43, 43);
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

        .university-course-container {
            height: 370px !important;
        }

        .course-nav-tab .btn-dark-cerulean {
            color: #fff;
            background-color: var(--secondary_background) !important;
            border-color: var(--secondary_background) !important;
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
            color: var(--primary_background);
        }

        .course-nav-tab-subtitle .line {
            width: 30px;
            height: 1px;
            background-color: var(--secondary_background);
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
</head>

<body>

    <div class="container-scroller"
        style="
        @if ($user->role == 'partner') @if ($status == 0) filter: blur(5px); pointer-events: none; @endif @endif
        ">
        @include('User-Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('User-Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            Dashboard
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Applications</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $orders->count() }}</h2>
                                            </div>
                                        </div>
                                        <div class="d-inline-block">
                                            <i class="fa fa-file-pdf text-danger icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Total Applications fees paid</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $totalApplicationFee }}</h2>
                                            </div>
                                        </div>
                                        <div class="d-inline-block">
                                            <i class="fa fa fa-money-bill mt-1 text-danger icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Total service charge</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $totalServiceCharge }}</h2>
                                            </div>
                                        </div>
                                        <div class="d-inline-block">
                                            <i class="fa fa-money-bill mt-1 text-danger icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Total service charge Paid</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                <h2 class="mb-0">{{ $totalServiceChargePaid }}</h2>
                                            </div>
                                        </div>
                                        <div class="d-inline-block">
                                            <i class="fa fa-money-bill mt-1 text-danger icon-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($user->role == 'partner')
                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Your Level</h4>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-inline-block pt-3">
                                            <div class="d-md-flex">
                                                @php
                                                    $star = \App\Models\Level::where('eligibility_range_min', '<=', $orders->count())
                                                        ->where('eligibility_range_max', '>=', $orders->count())
                                                        ->value('star_value');
                                                @endphp
                        
                                                @if ($star == 0)
                                                    <h2 class="mb-0">Beginner</h2>
                                                @else
                                                    @for ($i = 0; $i < $star; $i++)
                                                        <i class="fa fa-star text-warning icon-md"></i>
                                                    @endfor
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($user->type == 1 && $user->is_verified === 1)
                            <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0">Email Verify status</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="pt-3">
                                                <div class="">
                                                    @if ($user->is_verified === 0)
                                                        <h5 class="mb-2 text-danger fw-bold" style="font-size: 1rem;">
                                                            Your email is not verified!!</h5>

                                                        <br>
                                                        <form action="">
                                                            <a href="{{ route('frontend.send_verification_email') }}"
                                                                class="btn btn-success btn-sm">
                                                                Verify Email
                                                            </a>
                                                        </form>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif



                        @if (Auth::user()->type == 1 && $consultant)
                            <div class="col-sm-6 col-md-4 col-lg-5 ml-lg-auto grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-2">My Partner</h4>
                                        @if ($consultant)
                                            <div class="d-flex flex-row">
                                                <img src="{{ @$consultant->image_show }}" class="img-lg rounded"
                                                    alt="profile-{{ @$consultant->name }}">
                                                <div class="ml-3">
                                                    <h6>{{ @$consultant->name }}</h6>
                                                    <p class="text-muted">{{ @$consultant->address }},
                                                        {{ @$consultant->continents->name }}</p>
                                                    <div
                                                        class="mt-0 partner-social-container partner-social-container-sm">
                                                        <ul class="social">
                                                            <li>
                                                                <a href="{{ @$consultant->facebook_url ?? 'javascript:void(0)' }}"
                                                                    target="_blank" class="fab fa-facebook"
                                                                    aria-hidden="true"></a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ @$consultant->twitter_url ?? 'javascript:void(0)' }}"
                                                                    target="_blank" class="fab fa-twitter"
                                                                    aria-hidden="true"></a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ @$consultant->google_plus_url ?? 'javascript:void(0)' }}"
                                                                    target="_blank" class="fab fa-google-plus"
                                                                    aria-hidden="true"></a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ @$consultant->instagram_url ?? 'javascript:void(0)' }}"
                                                                    target="_blank" class="fab fa-instagram"
                                                                    aria-hidden="true"></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 partner-social-container partner-social-container-lg">
                                                <ul class="social">
                                                    <li>
                                                        <a href="{{ @$consultant->facebook_url ?? 'javascript:void(0)' }}"
                                                            target="_blank" class="fab fa-facebook"
                                                            aria-hidden="true"></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ @$consultant->twitter_url ?? 'javascript:void(0)' }}"
                                                            target="_blank" class="fab fa-twitter"
                                                            aria-hidden="true"></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ @$consultant->google_plus_url ?? 'javascript:void(0)' }}"
                                                            target="_blank" class="fab fa-google-plus"
                                                            aria-hidden="true"></a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ @$consultant->instagram_url ?? 'javascript:void(0)' }}"
                                                            target="_blank" class="fab fa-instagram"
                                                            aria-hidden="true"></a>
                                                    </li>
                                                </ul>
                                            </div>

                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>

                    <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Applications History Diagram</h4>
                                    <canvas id="linechart-multi"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Summary</h4>
                                    <canvas id="doughnutChart"></canvas>
                                </div>
                            </div>
                        </div>
                      
                    </div>

                    <h4 class="mt-3">Programs</h4>

                    <div class="tab-pane fade show tabidload active" id="all_program">
                        <div class="row justify-content-center gx-3 gy-4">
                            @if (count($courses_all) > 0)
                                @foreach ($courses_all as $course)
                                    @php
                                        // Retrieve partner_ref_id and applied_by from session or query parameters
                                        $partnerRef = session('partner_ref_id') ?? request()->query('partner_ref_id');
                                        $appliedBy = session('applied_by') ?? request()->query('applied_by');

                                        // Set up the URL parameters
                                        $apply_url_params = ['id' => $course->id];
                                        $course_details_url_params = ['id' => $course->id];

                                        $course_list_url_params = [
                                            'partner_ref_id' => $partnerRef,
                                            'applied_by' => $appliedBy,
                                        ];

                                        // Add partner_ref_id and applied_by to the parameters if they are set
                                        if ($partnerRef) {
                                            $apply_url_params['partner_ref_id'] = $partnerRef;
                                            $course_details_url_params['partner_ref_id'] = $partnerRef;
                                            $course_list_url_params['is_anonymous'] = 'true';
                                        }

                                        if ($appliedBy) {
                                            $apply_url_params['applied_by'] = $appliedBy;
                                            $course_details_url_params['applied_by'] = $appliedBy;
                                            $course_list_url_params['is_anonymous'] = 'true';
                                        }

                                        // Add is_anonymous if it is set in the session
                                        if (session('is_anonymous')) {
                                            $apply_url_params['is_anonymous'] = 'true';
                                            $course_details_url_params['is_anonymous'] = 'true';
                                            $course_list_url_params['is_anonymous'] = 'true';
                                        }

                                        // Generate the routes with the parameters
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

                                    <div class="col-12 col-md-6 col-lg-3 col-auto mt-sm-3 mt-md-4">
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
                                                                                    $colors[$index % count($colors)];
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
                                                                    class="btn btn-primary-bg"
                                                                    style="background-color: #6c757d !important; border-color: #6c757d !important; cursor: not-allowed !important; pointer-events: none !important;">
                                                                    <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/cart.png"
                                                                        style="width: 14px;">
                                                                    Apply Now
                                                                </a>
                                                            @else
                                                                <a href="{{ $apply_url }}"
                                                                    class="btn btn-primary-bg">
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
                                @endforeach
                            @else
                                <div class="text-center mt-4">
                                    <h3>Course Not Found !</h3>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                @include('User-Backend.components.footer')
            </div>
        </div>
    </div>

    @if ($user->role == 'partner')
        @if ($status == 0)
            <!-- Full-page overlay for inactive users -->
            <div class="inactive-overlay"
                style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.7); z-index: 1000; display: flex; align-items: center; justify-content: center; color: #fff;">
                <div class="text-center">
                    <h2>Your account is inactive</h2>
                    <p>Please contact the administrator to activate your account.</p>
                </div>
            </div>
        @endif
    @endif

    @include('User-Backend.components.script')

    <script>
        if ($("#linechart-multi").length) {
            var dataForChart = @json($dataForChart);

            var labels = dataForChart.map(function(e) {
                return e.y;
            });
            var dataApplications = dataForChart.map(function(e) {
                return e.a;
            });
            var dataApproved = dataForChart.map(function(e) {
                return e.b;
            });

            var multiLineData = {
                labels: labels,
                datasets: [{
                        label: 'Applications',
                        data: dataApplications,
                        borderColor: 'rgba(255, 99, 132, 0.75)',
                        backgroundColor: 'rgba(255, 99, 132, 0.35)',
                        borderWidth: 3,
                        fill: true,
                        cubicInterpolationMode: 'default',
                        tension: 0.3,
                        pointRadius: 1
                    },
                    {
                        label: 'Approved',
                        data: dataApproved,
                        borderColor: 'rgba(11, 148, 247, 0.75)',
                        backgroundColor: 'rgba(11, 148, 247, 0.35)',
                        borderWidth: 3,
                        fill: true,
                        cubicInterpolationMode: 'default',
                        tension: 0.3,
                        pointRadius: 1
                    }
                ]
            };

            var options = {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Applications and Approvals'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Date'
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Count'
                        },
                        suggestedMin: -10,
                        suggestedMax: 50,
                        grid: {
                            display: false
                        }
                    },
                    xAxes: [{
                        gridLines: false
                    }],
                    yAxes: [{
                        gridLines: false
                    }]
                }
            };
            var multiLineCanvas = $("#linechart-multi").get(0).getContext("2d");
            var lineChart = new Chart(multiLineCanvas, {
                type: 'line',
                data: multiLineData,
                options: options
            });
        }
        if ($("#doughnutChart").length) {
            var totalApplications = @json($total_applications);
            var totalServiceCharge = @json($totalServiceCharge);
            var totalApplicationFee = @json($totalApplicationFee);

            var doughnutPieData = {
                datasets: [{
                    data: [
                        totalApplications,
                        totalServiceCharge,
                        totalApplicationFee,
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.45)',
                        'rgba(54, 162, 235, 0.45)',
                        'rgba(75, 192, 192, 0.45)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 0.45)',
                        'rgba(54, 162, 235, 0.45)',
                        'rgba(75, 192, 192, 0.45)',
                    ],
                }],
                labels: [
                    'Applications',
                    'Service Charge',
                    'Applcation fee',
                ]
            };

            var doughnutPieOptions = {
                responsive: true,
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            };

            var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
        }
    </script>
    
</body>

</html>

