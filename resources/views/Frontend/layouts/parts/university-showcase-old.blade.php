<div id="uni-showcase" class="uni-showcase container d-flex flex-column mt-5">
    <div class="d-lg-flex align-items-lg-center">
        <div class="col-md-12">
            <h3 class="ca-card-title d-block text-center mb-4 font-dm-sans-title">{{ $home_content->university_title }}
            </h3>
            <div class="row justify-content-center">
                <style>
                    .university {
                        transition: 0.3s;
                        height: 100% !important;
                    }

                    .university-showcase-container .university-image-container .university-image {
                        transition: transform 0.3s;
                        transform-origin: center center;
                        opacity: 1;
                        width: 6.125rem !important;
                        height: 5.375rem !important;
                        object-fit: contain !important;
                        -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
                        transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
                    }

                    .university:hover {
                        border-color: var(--secondary_background);

                        .university-showcase-container .university-image-container .university-image {
                            -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1.05) scaleY(1.05);
                            transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1.05) scaleY(1.05);
                        }
                    }

                    .university_name:hover {
                        color: var(--secondary_background) !important;
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
                        @endphp
                        <div class="col-12 col-md-6 col-lg-3 col-auto mt-3 mt-md-4">
                            <div class="text-center card university py-3" style="border-radius:8px; cursor: pointer;"
                                onclick="window.location.href='{{ route('frontend.university_details', $university->id) }}'">
                                <div class="card-body university-showcase-container">
                                    <div class="university-image-container">
                                        <img decoding="async" src="{{ $university->image_show }}"
                                            alt="{{ $university->name }}" title="{{ $university->name }}"
                                            style="border-radius: 8px" class="university-image">
                                    </div>
                                    <div class="mt-4">
                                        <div>
                                            <span class="py-2 px-3 text-dark"
                                                style="line-height:0;font-family:'DM Sans', sans-serif;">
                                                {{ $course_count . ' Programs' }}
                                            </span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="{{ route('frontend.university_details', $university->id) }}"
                                                class="text-dark university_name">
                                                <h5 style="font-size: 1.25rem; font-family:'DM Sans', sans-serif;"
                                                    class="fw-bold">
                                                    {{ $university->name }}
                                                </h5>
                                            </a>
                                            <div class="text-ellipsis"
                                                style="white-space:nowrap; overflow: hidden; text-overflow: ellipsis;font-family:'DM Sans', sans-serif;">
                                                {{ $university->address }}
                                            </div>
                                        </div>
                                    </div>
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
