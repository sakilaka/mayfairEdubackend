<section class="my-5">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Co-Organizer Profile</h2>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-3">
                <div class="d-flex flex-column justify-content-center align-items-center align-items-md-end">
                    <img src="{{ $additional_contents['co_organizerDetails']['logo'] ?? '' }}" alt=""
                        class="img-fluid" width="150">
                    <div class="text-center mt-4 me-md-3">
                        <a href="https://www.malishaedu.com/" class="btn btn-primary-bg mx-auto px-5 rounded-0"
                            target="_blank">Details</a>
                    </div>
                </div>
            </div>

            <div class="col-md-8 mt-4 mt-md-0">
                <p class="fs-5 mb-2">
                    <strong class="fw700">{{ $additional_contents['co_organizerDetails']['name'] ?? '' }}</strong>
                </p>

                <div class="ckeditor5-rendered">
                    {!! $additional_contents['co_organizerDetails']['details'] ?? '' !!}
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section>
