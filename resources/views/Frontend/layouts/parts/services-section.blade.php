<style>
    .service-card,
    .main-service-card {
        border-radius: 8px;
        overflow: hidden;
        background-color: #166D4D0A;
        border: 0;
    }

    .main-service-card img {
        width: 18%;
        margin-top: 0.5rem;
        margin-bottom: 1rem;
        filter: brightness(0) saturate(100%) invert(30%) sepia(33%) saturate(753%) hue-rotate(109deg) brightness(93%) contrast(90%);
    }

    .main-service-card p {
        font-size: 1rem;
        line-height: 1.5;
        height: 3rem;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0;
    }

    .service-card img {
        height: 250px !important;
        object-fit: cover;
    }

    .details-link {
        font-size: 1.25rem;
        color: var(--secondary_background);
        cursor: pointer;
        font-size: 18px;
        position: relative;
        display: inline-flex;
        white-space: nowrap;
        padding-bottom: 8px;
    }

    .details-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 5px;
        border-radius: 10px;
        background-color: var(--secondary_background);
        opacity: 1;
        visibility: visible;
        transform: scaleX(1);
        transition: transform .2s, opacity .2s;
        transition-timing-function: cubic-bezier(.2, .57, .67, 1.53);
    }

    .details-link:hover::after {
        transition-timing-function: cubic-bezier(.8, 0, .1, 1);
        transition-duration: .4s;
        transform: scaleX(1.15);
    }

    .card-text {
        font-size: 1rem;
        line-height: 1.5;
        height: 3rem;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<section style="margin-top: 5rem" class="section-background-img py-4">
    {{-- <div>
        <div class="text-center mb-5">
            <h3 class="ca-card-title d-block text-center mb-4 font-dm-sans-title">
                Our Services
            </h3>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card main-service-card">
                    <div class="card-body"
                        style="padding: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                        <img src="{{ asset('frontend/images/service-section/main-services/1.png') }}" alt="">
                        <p class="text-muted" style="">
                            Recruit High-Quality International Students
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card main-service-card">
                    <div class="card-body"
                        style="padding: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                        <img src="{{ asset('frontend/images/service-section/main-services/2.png') }}" alt="">
                        <p class="text-muted">
                            Education Expo and Promotion of China Universities in Overseas
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card main-service-card">
                    <div class="card-body"
                        style="padding: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                        <img src="{{ asset('frontend/images/service-section/main-services/3.png') }}" alt="">
                        <p class="text-muted">
                            Education Expo and Conference in China
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card main-service-card">
                    <div class="card-body"
                        style="padding: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                        <img src="{{ asset('frontend/images/service-section/main-services/4.png') }}" alt="">
                        <p class="text-muted">
                            Belt and Road Chinese Center (BRCC)
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card main-service-card">
                    <div class="card-body"
                        style="padding: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                        <img src="{{ asset('frontend/images/service-section/main-services/5.png') }}" alt="">
                        <p class="text-muted">
                            On-Campus Service
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card main-service-card">
                    <div class="card-body"
                        style="padding: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                        <img src="{{ asset('frontend/images/service-section/main-services/6.png') }}" alt="">
                        <p class="text-muted">
                            Post Graduation Service (Easy Link)
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card main-service-card">
                    <div class="card-body"
                        style="padding: 15px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                        <img src="{{ asset('frontend/images/service-section/main-services/7.png') }}" alt="">
                        <p class="text-muted">
                            Corporate Social Responsibility (Malisha Foundation)
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container">
        <div class="text-center mb-5">
            <h3 class="ca-card-title d-block text-center mb-4 font-dm-sans-title">
                International Student Admission Services
            </h3>
        </div>
        @php
            $servicesLarge = json_decode($services['contents'], true)['servicesLarge'] ?? [];
        @endphp

        <div class="row justify-content-center">
            @foreach ($servicesLarge as $key => $service)
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('frontend.single_service', ['title' => $service['title']]) }}">
                        <div class="card service-card" style="">
                            <img src="{{ $service['image'] ?? asset('frontend/images/No-image.jpg') }}"
                                class="card-img-top" alt="{{ $service['title'] }}-image">
                            <div class="card-body">
                                <p class="card-subtitle text-capital text-muted">Service {{ $loop->iteration }}</p>
                                <h4 class="card-title mb-2 fw-bold" style="font-size: 1.3rem">
                                    {{ $service['title'] }}
                                </h4>
                                <p class="card-text text-muted">
                                    {{ $service['description'] }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                @php
                    if ($loop->iteration == 6) {
                        break;
                    }
                @endphp
            @endforeach
        </div>

        @if (count($servicesLarge) > 6)
            <div class="text-center mt-3 firstbutton">
                <a href="{{ route('frontend.our_services') }}" class="btn btn-lg browse-more-btn btn-dark-cerulean"
                    style="color: #fff">
                    Browse more Services
                    <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="28.56" height="15.666"
                        viewBox="0 0 28.56 15.666">
                        <path id="right-arrow_3_" data-name="right-arrow (3)"
                            d="M20.727,107.5l-1.272,1.272,5.661,5.661H0v1.8H25.116l-5.661,5.661,1.272,1.272,7.833-7.833Z"
                            transform="translate(0 -107.5)" fill="#fff"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>
