<section class="exhibitors-highlights my-5">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Overseas Delegates</h2>
        </div>

        <div class="row justify-content-center mt-3">
            @php
                $delegates = json_decode($expo->testimonials, true) ?? [];
            @endphp

            <div class="col-12">
                <p class="text-center fw-bold"
                    style="color:var(--primary_background); font-family: 'DM Sans', sans-serif;font-size:1.5rem;font-weight:500;">
                    What Our Overseas Delegates Are Saying
                </p>
                <div class="row testimonial-cards-partners slick-slider">
                    @foreach ($delegates as $delegate)
                        <div class="d-lg-flex flex-lg-column col-md-6 col-lg-4 justify-content-center p-2">
                            <div class="testimonial-single-card bg-white p-3">
                                <div class="d-flex justify-content-center">
                                    <img class="testimonial-user-img"
                                        src="{{ $delegate['photo'] ?? asset('frontend/images/no-profile.jpg') }}"
                                        alt="" style="border-radius:10px;">
                                </div>

                                <div style="height: 70px">
                                    <p class="mb-0 fw-bold mt-2 text-center"
                                        style="font-size: 1.25rem; font-family: 'DM Sans', sans-serif !important;">
                                        {{ $delegate['name'] }}
                                    </p>
                                    <p class="mb-0 text-center"
                                        style="font-size: 0.9rem; font-family: 'DM Sans', sans-serif;">
                                        {{ $delegate['designation'] }}
                                    </p>
                                </div>

                                <div class="my-2 mt-3">
                                    <img src="{{ asset('frontend/images/left-quotes-sign.png') }}" alt=""
                                        style="width:1rem">
                                </div>
                                <div class="testimonial-content">
                                    @php
                                        $description = strip_tags($delegate['description']);
                                    @endphp
                                    <p class="mb-0 ckeditor5-rendered testimonial-comment"
                                        data-full-comment="{{ $description }}">
                                        {!! $description !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if ($delegates)
                <div class="text-center mt-3">
                    <a href="{{ route('expo.delegates', ['unique_id' => $expo->unique_id]) }}"
                        class="btn btn-primary-bg mx-auto px-5 rounded-0">
                        View Overseas Delegates
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
