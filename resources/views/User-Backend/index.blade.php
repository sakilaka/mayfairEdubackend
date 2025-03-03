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

