<style>
    .home-header {
        top: 15%;
    }

    @media (max-width: 767px) {
        .home-header {
            top: 18%;
        }
    }

    .home-header-title {
        font-size: 2.5rem;
        color: white;
        text-shadow: 1px 1px 2px black;
        display: block;
    }

    .home-header-subtitle {
        font-size: 1rem;
        color: white;
        text-shadow: 1px 1px 2px rgb(47, 47, 47);
        display: block;
    }

    @media (min-width: 576px) {
        .home-header-title {
            font-size: 4rem;
        }

        .home-header-subtitle {
            font-size: 1rem;
        }
    }

    @media (min-width: 768px) {
        .home-header-title {
            font-size: 5vw;
        }

        .home-header-subtitle {
            font-size: 1vw;
        }
    }

    @media (min-width: 992px) {
        .home-header-title {
            font-size: 5.5vw;
        }

        .home-header-subtitle {
            font-size: 1.25vw;
        }
    }

    @media (min-width: 1200px) {
        .home-header-title {
            font-size: 6.5vw;
        }

        .home-header-subtitle {
            font-size: 1.5vw;
        }
    }

    .home-header-slider-image {
        cursor: pointer;
        width: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        height: 85vh;
        opacity: 0.8 !important;
    }

    @media (min-width: 576px) {
        .home-header-slider-image {
            height: 60vh;
        }
    }

    @media (min-width: 768px) {
        .home-header-slider-image {
            height: 60vh;
        }
    }

    @media (min-width: 992px) {
        .home-header-slider-image {
            height: 60vh;
        }
    }

    @media (min-width: 1200px) {
        .home-header-slider-image {
            height: 77.5vh;
        }
    }

    .home-header-search-container {
        border-radius: 15px;
        z-index: 1;
        width: 90%;
        background-color: rgba(255, 255, 255, 0.6);
        box-shadow: 0px 7px 14px rgba(28, 97, 167, 0.2);
        margin-top: 1.5rem;
    }

    @media (min-width: 768px) {
        .home-header-search-container {
            width: 80%;
        }
    }

    .full-width-row {
        width: 100% !important;
        margin: 0;
        padding: 0;
    }

    .full-width-card {
        width: 100%;
        border: none;
        border-radius: 8px;
    }

    .home-header-bottom-cards {
        z-index: 99;
        transform: translateY(48%);
    }

    .count-value {
        font-size: 3.25rem;
        font-weight: bold;
        display: inline-block;
        color: #fff;
    }

    .count-title {
        font-size: 1.25rem;
        color: #fff;
    }

    @media (max-width: 1200px) {
        .count-value {
            font-size: 3rem;
        }

        .count-title {
            font-size: 1.25rem;
        }
    }

    @media (max-width: 992px) {
        .count-value {
            font-size: 2.5rem;
        }

        .count-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .count-value {
            font-size: 2.25rem;
        }

        .count-title {
            font-size: 1.15rem;
        }
    }

    @media (max-width: 576px) {
        .count-value {
            font-size: 2rem;
        }

        .count-title {
            font-size: 1rem;
        }
    }
</style>

<header class="main-header position-relative w-100 mt-md-5">
    <div class="row mt-md-5">
        <div class="col-12 px-0 position-relative ">
            <div class="header-resonsive-images swiper">
                @if ($home_content->banner_type == 'photo')
                    @php
                        $banner_images = json_decode($home_content->banner_image, true)['images'] ?? [];
                        $banner_image_urls = json_decode($home_content->banner_image, true)['image_url'] ?? [];
                    @endphp
                    <div class="image-container swiper-wrapper">
                        @forelse ($banner_images as $key => $image)
                            <img src="{{ $image }}" class="home-header-slider-image img-fluid swiper-slide"
                                alt="Banner-Image-{{ $key }}"
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
            </div>

            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
            <script>
                const swiper = new Swiper('.swiper', {
                    direction: 'horizontal',
                    loop: true,
                    autoplay: {
                        delay: 2500,
                        disableOnInteraction: false,
                    },
                });
            </script>

            <div class="container w-100 position-absolute start-50 translate-middle-x home-header" style="z-index: 99">
                <div class="d-flex flex-column text-center">
                    <div>
                        <h1 class="home-header-title">Study In
                            <span class="fw-bold">China</span>
                        </h1>
                        <h3 class="home-header-subtitle">{{ $home_content->banner_text }}</h3>
                    </div>

                    <div class="home-header-search-container mx-auto">
                        <form class="hero_search_form" action="{{ route('frontend.university_course_list') }}"
                            method="GET" onsubmit="removeEmptyFields(this)">
                            <div class="row justify-content-center col-12 col-md-10 py-4 m-auto filtering_box">
                                <div class="col-12 col-lg-10 mt-2 mt-lg-0 col-padding-right">
                                    <div class="d-flex">
                                        <input type="text" class="form-control filter-input" name="search"
                                            id="provinceInput"
                                            placeholder="Province, City, Degree, Major, University, Scholarship, Medium of Intruction">
                                        <button type="submit" class="btn btn-tertiary-bg d-flex"
                                            style="padding:10px 15px;">
                                            <span>
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </span>
                                            &nbsp;
                                            <span>
                                                Search
                                            </span>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-12 col-md-10 mt-3">
                                    @foreach ($buttons as $button)
                                        <a href="{{ $button->answer }}"
                                            class="btn btn-light text-dark py-1 px-2 mx-1 btn-lg mb-2"
                                            style="border-radius: 4px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                                            {{ $button->question }}
                                        </a>
                                    @endforeach
                                </div>
                                <div class="col-12 col-md-2"></div>
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
            </div>

            <div class="position-absolute bottom-0 home-header-bottom-cards full-width-row" style="z-index: 99;">

                <div class="container row justify-content-center mx-auto">
                    <!-- Card 1 -->
                    <div class="col-6 col-md-3 d-flex justify-content-center mb-3 mb-md-0">
                        <div class="card text-center mx-md-2 py-3 py-md-4 px-2 full-width-card"
                            style="background-color: #ff0115;">
                            <div class="card-body p-0">
                                <h3 class="fw-bold mb-1">
                                    <span class="counter count-value">{{ $home_content->count_num_1 }}</span>
                                </h3>
                                <p class="count-title">
                                    {{ $home_content->count_text_1 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-6 col-md-3 d-flex justify-content-center mb-3 mb-md-0">
                        <div class="card text-center mx-md-2 py-3 py-md-4 px-2 full-width-card"
                            style="background-color: #f1c440;">
                            <div class="card-body p-0">
                                <h3 class="fw-bold mb-1">
                                    <span class="counter count-value">{{ $home_content->count_num_2 }}</span>
                                </h3>
                                <p class="count-title">
                                    {{ $home_content->count_text_2 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-6 col-md-3 d-flex justify-content-center mb-3 mb-md-0">
                        <div class="card text-center mx-md-2 py-3 py-md-4 px-2 full-width-card"
                            style="background-color: #078b74;">
                            <div class="card-body p-0">
                                <h3 class="fw-bold mb-1">
                                    <span class="counter count-value">{{ $home_content->count_num_3 }}</span>
                                </h3>
                                <p class="count-title">
                                    {{ $home_content->count_text_3 }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-6 col-md-3 d-flex justify-content-center mb-3 mb-md-0">
                        <div class="card text-center mx-md-2 py-3 py-md-4 px-2 full-width-card"
                            style="background-color: #50b0a3;">
                            <div class="card-body p-0">
                                <h3 class="fw-bold mb-1">
                                    <span class="counter count-value">{{ $home_content->count_num_4 }}</span>
                                </h3>
                                <p class="count-title">
                                    {{ $home_content->count_text_4 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
