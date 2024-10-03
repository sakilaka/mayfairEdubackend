<div id="uni-showcase" class="uni-showcase d-flex flex-column section-background-img py-4">
    <div class="container">
        <div class="d-lg-flex align-items-lg-center">
            <div class="col-md-12">
                <h3 class="ca-card-title d-block text-center mb-4 font-dm-sans-title">
                    {{ $home_content->university_title }}
                </h3>
                <div class="row justify-content-center">
                    <style>
                        .university {
                            transition: 0.3s;
                            height: 100% !important;
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
                            padding: 2px 4px;
                            border-radius: 4px;
                            font-size: 12px;
                            color: #fff;
                            font-weight: 600;
                            white-space: nowrap;
                        }
                    </style>
                    @php
                        $university_list = App\Models\University::where(['status' => 1, 'show_on_home' => 1])
                            ->limit(8)
                            ->orderBy('name', 'asc')
                            ->get();
                    @endphp
                    @if (count($university_list) > 0)
                        @foreach ($university_list as $university)
                            @php
                                $courses = App\Models\Course::where([
                                    'university_id' => $university->id,
                                    'status' => 1,
                                ])->get();
                                $course_count = count($courses);

                                $display_data = json_decode($university->display_data, true);
                            @endphp
                            <div class="col-12 col-md-6 col-lg-3 col-auto mt-3 mt-md-4">
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
                                                                class="fw-bold" style="font-size: 1.25rem;">--</span>
                                                        </div>
                                                        <div>Days</div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <div>
                                                            <span id="countdown-{{ $university->id }}-hours"
                                                                class="fw-bold" style="font-size: 1.25rem;">--</span>
                                                        </div>
                                                        <div>Hours</div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <div>
                                                            <span id="countdown-{{ $university->id }}-minutes"
                                                                class="fw-bold" style="font-size: 1.25rem;">--</span>
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
                                                <img src="{{ $university->image_show }}" alt="{{ $university->name }}"
                                                    style="width: 80px; height:auto; border-radius:50%;">
                                            </div>

                                            <div class="position-absolute" style="bottom: 5px; left:0px; width:100%">
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

                                        <div class="university-details-container w-100" style="background-color: #eee">
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
                                                                        <td class="border-0 text-start p-0">World Rank
                                                                        </td>
                                                                        <td class="border-0 text-start px-1 py-0">:</td>
                                                                        <td class="border-0 text-start p-0">
                                                                            {{ $display_data['world_rank'] ?? 'N/A' }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="border-0 text-start p-0">Location
                                                                        </td>
                                                                        <td class="border-0 text-start px-1 py-0">:</td>
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
                                                                <span class="fw-bold" style="color:rgb(226, 226, 22);">
                                                                    {{ $display_data ? $display_data['student_enrolled'] . '+' : 'N/A' }}
                                                                </span>
                                                                Students Enrolled
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-center mx-0" style="background-color: #eee">
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
            </div>
        </div>

        <div class="text-center mt-2 firstbutton">
            <a href="{{ route('frontend.all_universities_list') }}" class="btn btn-lg browse-more-btn btn-primary-bg"
                style="color: #fff">
                View All Universities
                <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="28.56" height="15.666"
                    viewBox="0 0 28.56 15.666">
                    <path id="right-arrow_3_" data-name="right-arrow (3)"
                        d="M20.727,107.5l-1.272,1.272,5.661,5.661H0v1.8H25.116l-5.661,5.661,1.272,1.272,7.833-7.833Z"
                        transform="translate(0 -107.5)" fill="#fff"></path>
                </svg>
            </a>
        </div>
    </div>
</div>
