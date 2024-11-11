<div class="container" style="margin-top: 9rem">
    <style>
        .section-2-card-container {}

        .section-2-card {
            border-radius: 10px !important;
            padding: 0 0.8rem;
            margin-top: 1rem;
            cursor: pointer;
        }

        .section-2-card h4,
        .section-2-card p {
            transition: 0.4s;
        }

        .section-2-card h4 {
            font-size: 1.5em;
            font-weight: 700;
        }

        .section-2-card .card-body {
            padding: 20px;
            border-radius: 10px !important;
            transition: 0.4s;
        }

        .section-2-card .card-body img {
            filter: brightness(0) saturate(100%) invert(17%) sepia(82%) saturate(360%) hue-rotate(110deg) brightness(95%) contrast(90%);
            transition: 0.4s;
        }

        .section-2-card:hover {
            .card-body {
                background-color: var(--primary_background) !important;
            }

            h4,
            p {
                color: white !important;
            }

            .card-body img {
                filter: brightness(0) saturate(100%) invert(89%) sepia(82%) saturate(461%) hue-rotate(48deg) brightness(92%) contrast(120%);
            }
        }

        .section-2-card .card-body img {
            height: 60px !important;
            width: 60px !important;
        }
    </style>
    <div class="section-2-card-container">
        <h2 class="text-center"
            style="color: var(--btn_primary_color); font-family:'DM Sans', sans-serif; font-weight:700">
            Choose Degree or Department
        </h2>

        <div class="section-2-first-row row d-flex slick-slider">
            @foreach ($degrees as $degree)
                @php
                    $courses = App\Models\Course::where([
                        'degree_id' => $degree->id,
                        'status' => 1,
                    ])->get();
                    $course_count = count($courses);
                @endphp
                <div class="col-12 col-md-6 col-lg-3 section-2-card"
                    onclick="window.location.href = '{{ route('frontend.university_course_list', ['degree' => $degree->id]) }}'">
                    <div class="card card-body">
                        <div>
                            <img src="{{ asset('frontend/images/section-2-icons/Categorey-Icon-7.svg') }}"
                                alt="">
                        </div>
                        <div class="mt-3">
                            <h4 class="font-dm-sans">{{ $degree->name }}</h4>
                            <p class="font-dm-sans">{{ $course_count }} Course(s)</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="section-2-second-row row d-flex slick-slider">
            @foreach ($departments as $department)
                @php
                    $courses = App\Models\Course::where([
                        'department_id' => $department->id,
                        'status' => 1,
                    ])->get();
                    $course_count = count($courses);
                @endphp
                <div class="col-12 col-md-6 col-lg-3 section-2-card"
                    onclick="window.location.href = '{{ route('frontend.university_course_list', ['department' => $department->id]) }}'">
                    <div class="card card-body">
                        <div>
                            <img src="{{ asset('frontend/images/section-2-icons/Categorey-Icon-2.svg') }}"
                                alt="">
                        </div>
                        <div class="mt-3">
                            <h4 class="font-dm-sans">{{ $department->name }}</h4>
                            <p class="font-dm-sans">{{ $course_count }} Course(s)</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
