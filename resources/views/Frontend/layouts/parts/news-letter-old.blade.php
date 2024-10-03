<style>
    .blog-title {
        font-weight: bold !important;
    }

    .blog-card {
        border-radius: 8px;
        overflow: hidden;
        background-color: #166D4D0A;
        border: 0.5px solid #efefef;
        box-shadow: 1px 4px 23px -15px rgb(120 200 159);
        transition: 0.35s;
        cursor: pointer;
    }

    .blog-card:hover {
        border: 0.5px solid #e1e1e1;
        box-shadow: 1px 4px 50px -18px rgb(120 200 159);
    }
</style>
<section class="blog-section" style="margin-bottom: 5rem; margin-top:3rem;">
    <div class="container">

        <div class="row" style="margin-top: 1.5rem;">
            <div class="col-12 col-md-7 col-lg-8 p-md-right-5">
                <h2 style="color: var(--btn_primary_color); font-family:'DM Sans', sans-serif; font-weight:700">
                    Latest
                    Updates</h2>
                <hr>

                @php
                    $blogs = App\Models\Blog::where('status', 1)->orderBy('id', 'desc')->limit(4)->get();
                @endphp
                @if (count($blogs) > 0)
                    @foreach ($blogs as $item)
                        <div class="blog-item blog-card p-2 my-2 d-flex flex-row"
                            onclick="location.href='{{ route('frontend.blog_details', ['id' => $item->id]) }}'">
                            <div class="col-3">
                                <div class="blog-image" style="border-radius: 10px; overflow: hidden;">
                                    <img src="{{ $item->image_show ?? asset('frontend/images/No-image.jpg') }}"
                                        alt="Blog Image" style="width: 100%; height: 110px;">
                                </div>
                            </div>
                            <div class="col-9 d-flex flex-column justify-content-between" style="padding-left: 1.5rem">
                                <div class="blog-content ml-3 mt-2">
                                    <a href="{{ route('frontend.blog_details', ['id' => $item->id]) }}">
                                        <h5 class="blog-title" style="color: var(--btn_primary_color);">
                                            {{ Illuminate\Support\Str::limit($item->title, 50, '...') }}
                                        </h5>
                                    </a>
                                </div>
                                <div class="blog-content ml-3">
                                    <p class="blog-time" style="color: var(--btn_primary_color);">23 June, 2024
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="col-12 col-md-5 col-lg-4 mt-4 mt-lg-0">
                <style>
                    .subscription-form {
                        background-color: var(--btn_primary_color) !important;
                        border-radius: 8px;
                        -webkit-box-shadow: 0 4px 24px rgba(1, 33, 105, .25);
                        box-shadow: 0 4px 24px rgba(1, 33, 105, .25) !important;
                        color: #fff !important;
                        padding: 132px 16px 32px;
                        position: relative;
                        font-family: 'DM Sans', sans-serif !important;
                    }

                    .subscription-form__bg-wrapper {
                        -webkit-box-pack: end;
                        -ms-flex-pack: end;
                        display: -webkit-box;
                        display: -webkit-flex;
                        display: -ms-flexbox;
                        display: flex;
                        -webkit-justify-content: flex-end;
                        justify-content: flex-end;
                        overflow: hidden;
                        pointer-events: none;
                        position: absolute;
                        right: 0;
                        top: 40px;
                        -webkit-user-select: none;
                        -moz-user-select: none;
                        -ms-user-select: none;
                        user-select: none;
                        width: 100%
                    }

                    .subscription-form__bg {
                        height: 250px;
                        margin-right: -32px;
                        opacity: .3
                    }

                    .subscription-form__inner {
                        position: relative
                    }

                    .subscription-form__header {
                        margin-bottom: 40px;
                        text-align: center
                    }

                    .subscription-form__title {
                        font-size: 24px;
                        font-weight: 600;
                        line-height: 1.5
                    }

                    .subscription-form__subtitle {
                        font-size: 16px;
                        line-height: 1.5
                    }

                    .subscription-form__title+.subscription-form__subtitle {
                        margin-top: 8px
                    }

                    .subscription-form__row+.subscription-form__row {
                        margin-top: 24px
                    }

                    .subscription-form__input {
                        -webkit-appearance: none !important;
                        -moz-appearance: none !important;
                        appearance: none !important;
                        background-color: #f3f3f3 !important;
                        border: 1px solid #e9e9e9 !important;
                        border-radius: 4px !important;
                        color: #163269 !important;
                        font-size: 16px !important;
                        font-weight: 500 !important;
                        line-height: 52px !important;
                        min-width: 1% !important;
                        padding: 0 16px !important;
                        text-align: left !important;
                        -webkit-transition: border-color .16s linear, background-color .16s linear !important;
                        transition: border-color .16s linear, background-color .16s linear !important;
                        width: 100% !important;
                    }

                    .subscription-form__input:focus {
                        background-color: #fff !important;
                        border-color: #00a5df !important;
                    }

                    .submit-btn {
                        width: 100%;
                        margin-top: 1rem;
                        padding-top: 10px;
                        padding-bottom: 10px;
                        font-size: 1rem;
                        background-color: var(--primary_background) !important;
                        border: 1px solid var(--primary_background) !important;
                        color: white;
                    }

                    .submit-btn:hover {
                        background-color: var(--secondary_background) !important;
                        color: white;
                        border: 1px solid var(--primary_background) !important;
                    }
                </style>
                <div class="card mb-4" style="border: 0; box-shadow:none;">
                    <div class="card-body px-0 px-lg-4">
                        <div class="subscription-form px-3">
                            <div class="subscription-form__bg-wrapper">
                                <svg class="subscription-form__bg" width="305" height="250" viewBox="0 0 305 250"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.25 11.25L135.251 135.251C148.92 148.92 171.08 148.92 184.749 135.251L308.75 11.25M20 247.5H300C309.665 247.5 317.5 239.665 317.5 230V20C317.5 10.335 309.665 2.5 300 2.5H20C10.335 2.5 2.5 10.335 2.5 20V230C2.5 239.665 10.335 247.5 20 247.5Z"
                                        stroke="#00A5DF" stroke-width="4" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>

                            <div class="subscription-form__inner">
                                <div class="subscription-form__header">
                                    <h3 class="subscription-form__title">
                                        Subscribe to Newsletter
                                    </h3>

                                    <p class="subscription-form__subtitle">
                                        Get updates to news &amp; events
                                    </p>
                                </div>

                                <form class="subscription-form__form" id="newsletterForm"
                                    action="{{ route('frontend.subscription') }}" method="POST">
                                    @csrf

                                    <div class="subscription-form__row">
                                        <input type="text" name="name" placeholder="Your First Name"
                                            class="subscription-form__input" required="">
                                    </div>

                                    <div class="subscription-form__row">
                                        <input type="email" name="email" placeholder="Your Email Address"
                                            class="subscription-form__input" required="">
                                    </div>

                                    <button type="submit" class="btn submit-btn">
                                        Subscribe
                                    </button>
                                </form>

                                <div class="mt-4">
                                    <p class="subscription-form__discalimer">
                                        By clicking "Subscribe" you agree with our
                                        <a href="#" target="_blank" rel="noreferrer" class="text-white"
                                            style="text-decoration: underline">Privacy Policy</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
