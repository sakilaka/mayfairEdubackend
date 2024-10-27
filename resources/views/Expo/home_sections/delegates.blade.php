<section class="exhibitors-highlights py-5 section-background">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Overseas Delegates</h2>
        </div>

        <div class="row justify-content-center mt-2">
            @php
                $delegates = json_decode($expo->delegates, true) ?? [];
            @endphp

            <div class="col-12">
                {{-- <p class="text-center fw-bold"
                    style="color:var(--primary_background); font-family: 'DM Sans', sans-serif;font-size:1.5rem;font-weight:500;">
                    What Our Overseas Delegates Are Saying
                </p> --}}

                <style>
                    .testimonial-single-card {
                        border: 4px solid var(--primary_background);
                    }

                    .delegate-desc-container::-webkit-scrollbar {
                        width: 3px;
                    }

                    .delegate-desc-container::-webkit-scrollbar-track {
                        background: #e0e0e0;
                    }

                    .delegate-desc-container::-webkit-scrollbar-thumb {
                        background-color: #28a74648;
                        border-radius: 10px;
                    }

                    .delegate-desc-container::-webkit-scrollbar-thumb:hover {
                        background-color: #218838;
                    }
                </style>
                <div class="row {{-- delegates-slick-carousel slick-slider --}} mt-3">
                    @foreach ($delegates as $delegate)
                        <div class="d-lg-flex flex-lg-column col-md-4 col-lg-3 justify-content-center p-2">
                            <div class="testimonial-single-card bg-white p-3">
                                <div class="d-flex justify-content-center">
                                    <img class="testimonial-user-img"
                                        src="{{ $delegate['photo'] ?? asset('frontend/images/no-profile.jpg') }}"
                                        alt=""
                                        style="border-radius:10px; background-color:var(--secondary_background)">
                                </div>

                                <div class="delegate-desc-container" style="height: 140px; overflow-y:auto;">
                                    <p class="mb-0 fw-bold mt-2 text-center"
                                        style="font-size: 1.25rem; font-family: 'DM Sans', sans-serif !important;">
                                        {!! $delegate['name'] ?? '&nbsp;' !!}
                                    </p>
                                    <p class="mb-0 text-center"
                                        style="font-size: 0.9rem; font-family: 'DM Sans', sans-serif;">
                                        {!! $delegate['designation'] ?? '&nbsp;' !!}
                                    </p>
                                    <p class="mb-0 text-center"
                                        style="font-size: 0.9rem; font-family: 'DM Sans', sans-serif;">
                                        {!! $delegate['organization_name'] ?? '&nbsp;' !!}
                                    </p>
                                    <p class="mb-0 text-center"
                                        style="font-size: 0.9rem; font-family: 'DM Sans', sans-serif;">
                                        {!! $delegate['country'] ?? '&nbsp;' !!}
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
                        class="btn btn-primary-bg red-hover-button mx-auto px-5 rounded-0">
                        View Overseas Delegates
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
