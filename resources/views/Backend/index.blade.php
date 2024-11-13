<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.components.head')
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
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('Backend.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Backend.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">
                            Dashboard
                        </h3>
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
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Visitors in last 30 days</h4>
                                    <canvas id="visitorLineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="today-tab" data-toggle="tab" href="#today_data"
                                        role="tab" aria-controls="today_data" aria-selected="true">Today</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="week-tab" data-toggle="tab" href="#week_data"
                                        role="tab" aria-controls="week_data" aria-selected="false">This Week</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="month-tab" data-toggle="tab" href="#month_data"
                                        role="tab" aria-controls="month_data" aria-selected="false">This Month</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="year-tab" data-toggle="tab" href="#year_data"
                                        role="tab" aria-controls="year_data" aria-selected="false">This Year</a>
                                </li>
                            </ul>

                            <div class="tab-content border-0 p-0 mt-2">
                                <div class="tab-pane fade active show" id="today_data" role="tabpanel"
                                    aria-labelledby="today-tab">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Visitors</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_visitor'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-eye text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Applications</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_application'] }}
                                                                </h2>
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
                                                    <h4 class="card-title mb-0">Programs</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_general_course'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-cubes text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Applications</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_applicants'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-users text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Partners</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_consultant'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="icon-people text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Events</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_event'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fa fa-podcast text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">News & Blogs</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_blog'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-rss text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Subscribers</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_subscriber'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-thumbs-up text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Testimonials</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_testimonial'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-comments text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Universities</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_university'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fa fa-university text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Media Partners</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_media_partner'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-bullseye text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Reviews & Ratings</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_review'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-certificate text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="week_data" role="tabpanel"
                                    aria-labelledby="week-tab">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Visitors</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $week['total_visitor'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-eye text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Applications</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $week['total_application'] }}
                                                                </h2>
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
                                                    <h4 class="card-title mb-0">Programs</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $week['total_general_course'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-cubes text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Applications</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $week['total_applicants'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-users text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Partners</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $week['total_consultant'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="icon-people text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Events</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $week['total_event'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fa fa-podcast text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">News & Blogs</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $week['total_blog'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-rss text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Subscribers</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $week['total_subscriber'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-thumbs-up text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Testimonials</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $week['total_testimonial'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-comments text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Universities</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $week['total_university'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fa fa-university text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Media Partners</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $week['total_media_partner'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-bullseye text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Reviews & Ratings</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $today['total_review'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-certificate text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="month_data" role="tabpanel"
                                    aria-labelledby="month-tab">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Visitors</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $month['total_visitor'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-eye text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Applications</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $month['total_application'] }}
                                                                </h2>
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
                                                    <h4 class="card-title mb-0">Programs</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">
                                                                    {{ $month['total_general_course'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-cubes text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Applications</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $month['total_applicants'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-users text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Partners</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $month['total_consultant'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="icon-people text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Events</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $month['total_event'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fa fa-podcast text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">News & Blogs</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $month['total_blog'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-rss text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Subscribers</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $month['total_subscriber'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-thumbs-up text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Testimonials</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $month['total_testimonial'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-comments text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Universities</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $month['total_university'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fa fa-university text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Media Partners</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $month['total_media_partner'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-bullseye text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Reviews & Ratings</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $month['total_review'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-certificate text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="year_data" role="tabpanel"
                                    aria-labelledby="year-tab">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Visitors</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_visitor'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-eye text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Applications</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_application'] }}
                                                                </h2>
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
                                                    <h4 class="card-title mb-0">Programs</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_general_course'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-cubes text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Applications</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_applicants'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-users text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Partners</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_consultant'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="icon-people text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Events</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_event'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fa fa-podcast text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">News & Blogs</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_blog'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-rss text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Subscribers</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_subscriber'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-thumbs-up text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Testimonials</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_testimonial'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-comments text-info icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Universities</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_university'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fa fa-university text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Media Partners</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_media_partner'] }}
                                                                </h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-bullseye text-primary icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-4 col-lg-3 grid-margin">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-0">Reviews & Ratings</h4>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="d-inline-block pt-3">
                                                            <div class="d-md-flex">
                                                                <h2 class="mb-0">{{ $year['total_review'] }}</h2>
                                                            </div>
                                                        </div>
                                                        <div class="d-inline-block">
                                                            <i class="fas fa-certificate text-danger icon-lg"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('Backend.components.footer')
            </div>
        </div>
    </div>

    @include('Backend.components.script')

    <script>
        if ($("#visitorLineChart").length) {
            var daywiseVisitors = @json($chart_data['daywiseVisitors']);

            var visitorLabels = daywiseVisitors.map(function(e) {
                return e.date;
            });

            var visitorData = daywiseVisitors.map(function(e) {
                return e.count;
            });

            var visitorLineData = {
                labels: visitorLabels,
                datasets: [{
                    label: 'Visitors',
                    data: visitorData,
                    borderColor: 'rgba(87 ,210 ,119, 0.5)',
                    backgroundColor: 'rgba(87 ,210 ,119, 0.15)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 2
                }]
            };

            var visitorLineOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        enabled: true,
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        title: {
                            display: true,
                            text: 'Count'
                        }
                    },
                    xAxes: [{
                        gridLines: false
                    }],
                    yAxes: [{
                        gridLines: false
                    }]
                },
                onResize: function(chart, size) {
                    if (chart.canvas.parentNode) {
                        chart.canvas.parentNode.style.height = 350 + 'px';
                        chart.canvas.parentNode.style.paddingBottom = 50 + 'px';
                    }
                }
            };
            var visitorLineChartCanvas = $("#visitorLineChart").get(0).getContext("2d");
            var visitorLineChart = new Chart(visitorLineChartCanvas, {
                type: 'line',
                data: visitorLineData,
                options: visitorLineOptions
            });
        }

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
            var totalApplications = @json($chart_data['total_applications']);
            var totalStudents = @json($chart_data['total_students']);
            var totalPartners = @json($chart_data['total_partners']);
            var totalUniversities = @json($chart_data['total_universities']);
            var totalPrograms = @json($chart_data['total_programs']);

            var doughnutPieData = {
                datasets: [{
                    data: [
                        totalApplications,
                        totalStudents,
                        totalPartners,
                        totalUniversities,
                        totalPrograms
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.45)',
                        'rgba(54, 162, 235, 0.45)',
                        'rgba(255, 206, 86, 0.45)',
                        'rgba(75, 192, 192, 0.45)',
                        'rgba(153, 102, 255, 0.45)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 0.45)',
                        'rgba(54, 162, 235, 0.45)',
                        'rgba(255, 206, 86, 0.45)',
                        'rgba(75, 192, 192, 0.45)',
                        'rgba(153, 102, 255, 0.45)'
                    ],
                }],
                labels: [
                    'Applications',
                    'Students',
                    'Partners',
                    'Universities',
                    'Programs'
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
