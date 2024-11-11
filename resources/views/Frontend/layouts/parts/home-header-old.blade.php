<header class="main-header position-relative overflow-hidden w-100 mt-md-5">
    <style>
        .image-container {
            height: 100% !important;
        }

        .image-container img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
        }

        .image-container video {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover
        }
    </style>

    <div class="row mt-md-5">
        <div class="col-12 col-md-6 px-0 position-relative header-resonsive-images swiper">

            @if ($home_content->banner_type == 'photo')
                @php
                    $banner_images = json_decode($home_content->banner_image, true)['images'] ?? [];
                    $banner_image_urls = json_decode($home_content->banner_image, true)['image_url'] ?? [];
                @endphp
                <div class="image-container swiper-wrapper">
                    @forelse ($banner_images as $key => $image)
                        <img src="{{ $image }}" class="img-fluid swiper-slide"
                            alt="Banner-Image-{{ $key }}"
                            style="cursor: pointer; height:100% !important; width:100% !important;"
                            onclick="window.open('{{ $banner_image_urls[$key] ?? '#' }}', '_blank')">
                    @empty
                        <img src="{{ asset('frontend/images/No-image.jpg') }}" class="img-fluid" alt="no-image">
                    @endforelse
                </div>
            @elseif ($home_content->banner_type == 'video')
                <div class="image-container">
                    <video src="{{ json_decode($home_content->banner_video, true)[0] ?? '' }}" autoplay muted
                        loop></video>
                </div>
            @endif

            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
            <script>
                const swiper = new Swiper('.swiper', {
                    direction: 'horizontal',
                    loop: true,
                    autoplay: {
                        delay: 2000,
                        disableOnInteraction: false,
                    },
                });
            </script>
        </div>

        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center position-relative"
            style="background-color: var(--primary_background)">
            <div class="text-white py-5 py-md-3">
                <div class="text-center pt-5 py-md-5">
                    <div class="row">
                        <div class="col-sm-7 m-auto">
                            <div class="text-uppercase" style="font-size: 1.35rem;">
                                Find The University
                            </div>
                            <div class="text-uppercase fw-bold" style="font-size: 2rem">
                                That Fits You Best
                            </div>
                        </div>
                        <div class="col-sm-7 m-auto">
                            <style>
                                .home-squiggle {
                                    height: 16px;
                                    margin: 1rem auto;
                                    width: 150px
                                }

                                .home-squiggle svg {
                                    display: block
                                }

                                .home-squiggle svg path {
                                    fill: none;
                                    stroke-linecap: round;
                                    stroke-miterlimit: 10;
                                    stroke-width: 4;
                                    stroke: #237c3a
                                }

                                .home-background-squiggle {
                                    left: 0;
                                    overflow-x: hidden;
                                    position: absolute;
                                    top: 0;
                                    width: 100%
                                }

                                .home-background-squiggle svg {
                                    width: 600px
                                }

                                .home-background-squiggle svg path {
                                    fill: #fff
                                }

                                @media only screen and (min-width: 600px) {
                                    .home-background-squiggle {
                                        top: -10vw
                                    }

                                    .home-background-squiggle svg {
                                        width: 100%
                                    }
                                }

                                .home-background-squiggle--green svg path {
                                    fill: #237c3a
                                }
                            </style>
                            <div class="home-squiggle">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 186 17" fill="none">
                                    <path
                                        d="M184.68 8.95006C169.95 1.68006 152.06 1.68006 137.32 8.95006C124.03 15.5101 107.9 15.5101 94.61 8.95006C79.88 1.68006 61.99 1.68006 47.25 8.95006C33.96 15.5101 17.83 15.5101 4.54 8.95006L1 7.43006">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-8 m-auto px-4 ckeditor5-rendered" style="font-size: 1.1rem;">
                            {!! $home_content->banner_text !!}
                        </div>

                    </div>

                    <div class="header-btn l mt-5 text-uppercase" style="letter-spacing: 2px;">
                        <div class="text-uppercase mb-2" style="font-size: 1rem;">
                            Start Your Search
                        </div>
                        <style>
                            .btn-secondary-bg:hover {
                                background-color: var(--btn_primary_color) !important;
                            }
                        </style>
                        @foreach ($buttons as $button)
                            <a href="{{ $button->answer }}" class="btn btn-secondary-bg btn-lg mb-2"
                                style="color: #fff; border-radius:2px;">{{ $button->question }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div style="transform: translateY(-52px);">
            <style>
                .filtering_box {
                    border-radius: 15px;
                    z-index: 1;
                    box-shadow: 0px 7px 14px rgba(28, 97, 167, 0.2);
                }

                @media screen and (max-width: 990px) {
                    .hero_search_form {
                        width: 90%;
                        margin: 0 auto;
                        margin-top: 1rem;
                    }
                }

                .filter-dropdown {
                    position: absolute;
                    z-index: 1100;
                    padding: 5px;
                    max-height: 200px;
                    overflow: auto;
                    display: none;
                    background-color: #fff;
                    border: 1px solid #ccc;
                    border-radius: 0.25rem;
                    left: 0;
                    width: auto;
                    scrollbar-width: none;
                }

                .form-control.filter-input {
                    padding: 1rem 0.75rem;
                }

                .filter-dropdown::-webkit-scrollbar {
                    width: 5px;
                    height: 0;
                }

                .filter-dropdown .dropdown-item {
                    padding: 0.5rem;
                    cursor: pointer;
                    display: block;
                    white-space: nowrap;
                }

                .filter-dropdown .dropdown-item:hover {
                    background-color: #f1f1f1;
                }

                @media (max-width: 768px) {
                    .filter-dropdown {
                        width: 100%;
                        top: 100%;
                    }

                    .filter-dropdown .dropdown-item {
                        width: 100%;
                    }
                }

                @media (min-width: 769px) {
                    .filter-dropdown {
                        width: auto;
                        top: auto;
                        bottom: 100%;
                        left: 0;
                    }

                    .filter-dropdown .dropdown-item {
                        width: auto;
                    }
                }
            </style>
            <form class="hero_search_form" action="{{ route('frontend.university_course_list') }}" method="GET"
                onsubmit="removeEmptyFields(this)">
                <div class="row justify-content-center col-12 col-md-9 col-lg-7 py-4 bg-light m-auto filtering_box">
                    {{-- <div class="col-12 col-md-2 mt-2 mt-md-0 col-padding-right">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Floating label select example"
                                    name="state">
                                    <option value="">Select Province</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Province</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mt-2 mt-md-0 col-padding-right">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Floating label select example" name="state">
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">City</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mt-2 mt-md-0 col-padding-right">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Floating label select example" name="degree">
                                    <option value="">Select Degree</option>
                                    @foreach ($degrees as $degree)
                                        <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Degree</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mt-2 mt-md-0 col-padding-right">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Floating label select example" name="degree">
                                    <option value="">Select Major</option>
                                    @foreach ($majors as $major)
                                        <option value="{{ $major->id }}">{{ $major->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Major</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 mt-2 mt-md-0 col-padding-right">
                            <div class="form-floating">
                                <select class="form-select" aria-label="Floating label select example" name="university">
                                    <option value="">Select University</option>
                                    @foreach ($universities as $university)
                                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">University</label>
                            </div>
                        </div> --}}

                    <div class="col-12 col-lg-9 mt-2 mt-lg-0 col-padding-right">
                        <div class="{{-- form-floating --}}">
                            <input type="text" class="form-control filter-input" name="search" id="provinceInput"
                                placeholder="Province, City, Degree, Major, University, Scholarship, Medium of Intruction">
                            <div class="dropdown-menu filter-dropdown" id="provinceDropdown"></div>
                        </div>
                    </div>

                    <div
                        class="col-12-padding-right col-12 col-lg-3 mt-3 mt-lg-0 ps-0 d-flex justify-content-center align-items-center">
                        <div>
                            <button type="submit" class="btn btn-secondary-bg" style="padding:17px 30px">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Explore
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                function removeEmptyFields(form) {
                    for (var i = form.elements.length - 1; i >= 0; i--) {
                        var element = form.elements[i];
                        if (element.tagName === 'SELECT' && element.value === '') {
                            element.name = '';
                        }
                    }
                }
            </script>
        </div>
    </div>
</header>
