<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo-User-Panel.components.head')
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
    </style>

    <style>
        .course-card {
            position: relative;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        .course-card:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .course-card img {
            transition: transform 0.3s ease;
            display: block;
        }

        .course-card:hover img {
            transform: scale(1.1);
        }

        .position-relative {
            position: relative;
        }

        .gradient-shadow {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: linear-gradient(to top, rgba(6, 139, 118, 0.7) 0%, rgba(30, 86, 92, 0) 50%);
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('Expo-User-Panel.components.navbar')

        <div class="container-fluid page-body-wrapper">
            @include('Expo-User-Panel.components.sidebar')

            <div class="main-panel">
                <div class="content-wrapper p-2 pd-md-3 pt-3">
                    <div class="page-header d-flex">
                        <h3 class="page-title">
                            Dashboard
                        </h3>
                        <a href="{{ route('expo.expo-ticket', ['unique_id' => $expo->unique_id, 'ticket_no' => $userData['id']]) }}?download"
                            class="btn btn-sm btn-primary-bg d-md-none" target="_blank">
                            <i class="fa fa-address-book"></i>
                            Download Ticket
                        </a>
                    </div>

                    <div class="card card-red-pattern-bg">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><b>Personal Informations</b></h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <img src="{{ $userData->photo ?? asset('frontend/images/no-profile.jpg') }}"
                                        alt="{{ $userData->name }}" width="200" style="border-radius: 8px">
                                    <div class="mt-2">
                                        <p class="pr-3" style="font-size: 1rem !important">
                                            {{ $userData->description }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-9 mt-3 mt-lg-0">
                                    <div class="row">
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">First Name</label>
                                                <p>{{ $userData->first_name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Last Name</label>
                                                <p>{{ $userData->last_name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Email Address</label>
                                                <p>{{ $userData->email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Phone Number</label>
                                                <p>{{ $userData->phone }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Sex</label>
                                                <p>{{ $userData->sex }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Nationality</label>
                                                <p>{{ $userData->nationality }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Date Of Birth</label>
                                                <p>{{ date('d M, Y', strtotime($userData->dob)) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">ID Type</label>
                                                <p>{{ $userData->id_type }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">ID No.</label>
                                                <p>{{ $userData->id_no }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="profession">Profession</label>
                                                <p>{{ $userData->profession }}</p>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="institution">Name of Institution/Organization</label>
                                                <p>{{ $userData->institution }}</p>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="program">Interested Program</label>
                                                <p>{{ $userData->program }}</p>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="degree">Interested Degree</label>
                                                <p>{{ $userData->degree }}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><b>Exhibitors</b></h4>
                        </div>

                        <div class="card-body p-2">
                            <div class="row justify-content-center justify-content-md-start">
                                @forelse ($exhibitors->take(4) as $exhibitor)
                                    @php
                                        $courses = App\Models\Course::where([
                                            'university_id' => $exhibitor->id,
                                            'status' => 1,
                                        ])->get();

                                        $course_count = count($courses) > 0 ? count($courses) : 100;

                                        $available_scholarship = json_decode($exhibitor->scholarships, true) ?? [];
                                    @endphp
                                    <div class="col-md-4 col-lg-3 mb-4">
                                        <div class="card university-card rounded-0 overflow-hidden"
                                            style="position: relative;">
                                            <div class="card-body p-2"
                                                style="background-color: var(--primary_background)">
                                                <div class="bg-white">
                                                    <div style="position: relative;" class="overflow-hidden">
                                                        <!-- Banner Image -->
                                                        <img src="{{ env('APP_MAIN_DOMAIN') . '/upload/university/' . $exhibitor->banner_image }}"
                                                            class="card-img-top banner-image rounded-0"
                                                            alt="{{ $exhibitor->name }}"
                                                            style="height: 150px; object-fit: cover; transition: transform 0.3s;">

                                                        <!-- University Logo (Top-right corner) -->
                                                        <img src="{{ env('APP_MAIN_DOMAIN') . '/upload/university/' . $exhibitor->image }}"
                                                            alt="{{ $exhibitor->name }} Logo"
                                                            style="position: absolute; top: 10px; right: 10px; width: 50px; height: 50px;">

                                                        <div class="d-flex justify-content-center align-items-center mb-2 position-absolute w-100"
                                                            style="bottom: 5px; left: 0; display: flex; justify-content: center; gap: 4px;">
                                                            <div class="badge bg-primary"
                                                                style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                                                Bachelor</div>
                                                            <div class="badge bg-success"
                                                                style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                                                Masters</div>
                                                            <div class="badge bg-warning"
                                                                style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                                                Phd</div>
                                                            <div class="badge bg-info"
                                                                style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                                                Language</div>
                                                        </div>
                                                    </div>

                                                    <div class="p-2">
                                                        <h4 class="card-title"
                                                            style="font-size: 16px; font-weight: bold; min-height: 40px;">
                                                            {{ Illuminate\Support\Str::limit($exhibitor->name, 60, '...') }}
                                                        </h4>
                                                        <p class="card-subtitle" style="font-size: 15px;">
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-send-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z" />
                                                                </svg>
                                                            </span>
                                                            {{ Illuminate\Support\Str::limit($exhibitor->address, 30, '...') }}
                                                        </p>

                                                        <!-- Black border as divider -->
                                                        <hr class="my-2" style="border-top: 2px solid black;">


                                                        <p class="card-text">
                                                            @php
                                                                $uni_data =
                                                                    json_decode($exhibitor->display_data, true) ?? [];
                                                            @endphp

                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-flag-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                                                                </svg>
                                                            </span>
                                                            World Ranking: {{ $uni_data['world_rank'] ?? 'N/A' }}<br>
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-flag-fill" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                                                                </svg>
                                                            </span>
                                                            Country Ranking:
                                                            {{ $uni_data['national_rank'] ?? 'N/A' }}<br>

                                                            <span class="me-2">
                                                                <span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        fill="currentColor" class="bi bi-book-half"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                                                                    </svg>
                                                                </span>
                                                                Program: {{-- {{ $course_count }} --}} 50+ <br>
                                                            </span>
                                                            <span class="me-2">
                                                                <span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        fill="currentColor" class="bi bi-bell-fill"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901" />
                                                                    </svg>
                                                                </span>
                                                                Scholarships:
                                                                {{ count($available_scholarship) > 0 ? 'Available' : 'Unavailable' }}
                                                                <br>
                                                            </span>
                                                            <span class="me-2">
                                                                <span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        fill="currentColor" class="bi bi-people-fill"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                                                    </svg>
                                                                </span>
                                                                Total Students:
                                                                {{ isset($uni_data['total_students']) ? $uni_data['total_students'] . '+' : 'N/A' }}
                                                                <br>
                                                            </span>
                                                            <span class="me-2">
                                                                <span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        fill="currentColor" class="bi bi-translate"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286zm1.634-.736L5.5 3.956h-.049l-.679 2.022z" />
                                                                        <path
                                                                            d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm7.138 9.995q.289.451.63.846c-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6 6 0 0 1-.415-.492 2 2 0 0 1-.94.31" />
                                                                    </svg>
                                                                </span>
                                                                Teaching language: English, Chinese
                                                            </span>
                                                        </p>
                                                        <div class="text-center">
                                                            <a href="{{ env('APP_MAIN_DOMAIN') . '/exhibitor/' . $exhibitor->id . '/details' }}"
                                                                class="btn btn-secondary-bg mx-auto px-5 rounded-0"
                                                                target="_blank">Details</a>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center">No Exhibitors Found!</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                @include('Expo-User-Panel.components.footer')
            </div>

        </div>

        @include('Expo-User-Panel.components.wrapper-footer')
    </div>

    @include('Expo-User-Panel.components.script')
</body>

</html>
