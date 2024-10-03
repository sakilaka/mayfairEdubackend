@php
    $footer_logo = \App\Models\Tp_option::where('option_name', 'theme_logo')->first();
    $footer_contents = \App\Models\Tp_option::where('option_name', 'theme_option_footer')->first();

    $social_url_array = \App\Models\Tp_option::where('option_name', 'theme_social_media')->first();
    $social_url = json_decode($social_url_array->option_value);
@endphp

<style>
    footer .text {
        font-family: 'Manrope', sans-serif !important;
        font-size: 1rem !important;
        font-weight: 500;
        color: rgb(226, 255, 238);
    }

    a.text:hover {
        color: #7CFF77;
    }

    .footer_title {
        font-family: 'DM Sans', sans-serif !important;
        font-weight: 700;
    }

    @media (min-width: 992px) {
        .mt-lg-10rem {
            padding-top: 9rem !important;
        }
    }

    .subscribe-input {
        border-radius: 50px;
        overflow: hidden;
    }

    .subscribe-input input {
        border: none;
        border-radius: 50px 0 0 50px;
        padding-left: 20px;
        height: 45px;
        width: 100%;
        box-shadow: none;
        outline: none;
    }

    .subscribe-input .subscribe-btn {
        background-color: #2e255e;
        color: white;
        border-radius: 0 50px 50px 0;
        padding: 0 25px;
        height: 45px;
        border: none;
    }

    .subscribe-input input::placeholder {
        color: #777;
    }
</style>

<footer style="background-color: var(--primary_background); color:white !important;"
    class="{{ !Route::is('home') ? 'mt-5' : '' }}">
    <div class="container pt-5">
        <div class="row py-3">
            <div class="col-12 col-lg-8 row">
                <div class="col-6 col-lg-4 ml-lg-4 mt-4 mt-lg-0">
                    <h4 class="footer_title">Quick Links</h4>

                    <ul class="nav-list list-unstyled mb-0 mt-4">
                        <li>
                            <a href="{{ route('frontend.our_services') }}"
                                class="text-decoration-none mb-2 text d-inline-block">
                                Our Services
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.authorization_letters') }}"
                                class="text-decoration-none mb-2 text d-inline-block">
                                Authorization Letters
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.payment_process') }}"
                                class="text-decoration-none mb-2 text d-inline-block">
                                Payment Process
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-lg-4 ml-lg-4 mt-4 mt-lg-0">
                    <h4 class="footer_title">Explore</h4>

                    <ul class="nav-list list-unstyled mb-0 mt-4">
                        <li>
                            <a href="{{ route('frontend.why_china') }}"
                                class="text-decoration-none mb-2 text d-inline-block">
                                Why China
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.company_details') }}"
                                class="text-decoration-none mb-2 text d-inline-block">
                                About {{ env('APP_NAME') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.instructor') }}"
                                class="text-decoration-none mb-2 text d-inline-block">
                                Become A Partner
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.faq') }}" class="text-decoration-none mb-2 text d-inline-block">
                                FAQ
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-6 col-lg-4 ml-lg-4 mt-4 mt-lg-0">
                    <h4 class="footer_title">Policies</h4>

                    <ul class="nav-list list-unstyled mt-4 mb-0">
                        <li>
                            <a href="{{ route('frontend.terms_conditions') }}"
                                class="text-decoration-none mb-2 text d-inline-block">
                                Terms & Conditions
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.refund_policy') }}"
                                class="text-decoration-none mb-2 text d-inline-block">
                                Refund Policy
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('frontend.privacy_policy') }}"
                                class="text-decoration-none mb-2 text d-inline-block">
                                Privacy Policy
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-12">
                    <div class="mt-3 mt-lg-10rem">
                        <h4 class="footer_title">Our Payment Modes</h4>
                        <div class="mt-2">
                            @foreach (@$footer_contents->paywiths as $paywith)
                                <a href="{{ route('frontend.payment_process') }}">
                                    <img src="{{ $paywith->pay_image_show }}" class="img-fluid"
                                        alt="{{ $paywith->pay_name }}"
                                        style="height: 34px; width:49px; padding: 2px; margin:1px;-radius:8px;">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                <h4 class="footer_title">Stay Connected</h4>
                <p class="text">
                    Recieve a weekly newsletter with useful tips and updates to prepare for your studying in China.
                </p>

                <div class="row justify-content-start align-items-center mt-3">
                    <form action="{{ route('frontend.subscription') }}" method="POST">
                        @csrf

                        <div class="form-group col-md-10 mb-3 d-flex align-items-center subscribe-input">
                            <input type="email" class="form-control form-control-lg" placeholder="Email">
                            <button type="submit" class="btn btn-lg btn-primary-bg subscribe-btn">Subscribe</button>
                        </div>
                    </form>

                    <div class="col-12 d-flex">
                        <div class="d-flex flex-column align-items-center">
                            <p class="mb-1" style="font-weight: 600">WeChat</p>
                            <img src="{{ asset('frontend/images/qrcode_malishaedu.jpg') }}" class="img-fluid me-3"
                                width="120" alt="malishaedu" style="border-radius: 6px;">
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <p class="mb-1" style="font-weight: 600">Whatsapp</p>
                            <img src="{{ asset('frontend/images/qrcode_whatsapp.jpg') }}" class="img-fluid"
                                width="120" alt="malishaedu-whatsapp-business" style="border-radius: 6px;">
                        </div>
                    </div>
                </div>

                <div class="d-md-flex justify-content-between align-items-start mt-3">
                    <div class="mt-2">
                        <h4 class="footer_title">
                            Hotline
                            <ul class="nav-list list-unstyled mt-2 mb-0">
                                @if (@$footer_contents->phone1 > 0)
                                    <li class="d-flex align-items-start">
                                        <i class="fa fa-solid fa-phone"
                                            style="font-size: 0.9rem; margin-right:5px;"></i>
                                        <a href="tel:{{ @$footer_contents->phone1 }}" class="text"
                                            style="margin-bottom: 10px; line-height:0.85;">
                                            {{ @$footer_contents->phone1 }}</a>
                                    </li>
                                @endif
                                @if (@$footer_contents->phone2 > 0)
                                    <li class="d-flex align-items-start">
                                        <i class="fa fa-solid fa-phone"
                                            style="font-size: 0.9rem; margin-right:5px;"></i>
                                        <a href="tel:{{ @$footer_contents->phone2 }}" class="text"
                                            style="margin-bottom: 10px; line-height:0.85;">
                                            {{ @$footer_contents->phone2 }}</a>
                                    </li>
                                @endif
                            </ul>
                        </h4>
                    </div>
                </div>

                <div class="row justify-content-start align-items-center mt-3">
                    <ul class="nav-list list-unstyled mt-2 mb-0">
                        @if (@$footer_contents->email1 > 0)
                            <li class="d-flex align-items-start">
                                <i class="fa fa-solid fa-envelope" style="font-size: 0.9rem; margin-right:5px"></i>
                                <a href="mailto:{{ @$footer_contents->email1 }}" class="text"
                                    style="margin-bottom: 10px; line-height:0.85;">
                                    {{ @$footer_contents->email1 }}
                                </a>
                            </li>
                        @endif
                        @if (@$footer_contents->email2 > 0)
                            <li class="d-flex align-items-start">
                                <i class="fa fa-solid fa-envelope" style="font-size: 0.9rem; margin-right:5px"></i>
                                <a href="mailto:{{ @$footer_contents->email2 }}" class="text"
                                    style="margin-bottom: 10px; line-height:0.85;">
                                    {{ @$footer_contents->email2 }}
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <style>
                    .footer_social {
                        margin-top: 1.5rem !important;
                    }

                    div.footer_social_icons_container {
                        color: #fff;
                        background-color: var(--secondary_background);
                        padding: 8px !important;
                        margin: 0 3px;
                        margin-top: 5px;
                        border-radius: 50%;
                        transition: 0.3s;
                        text-align: center !important;
                        cursor: pointer;
                    }

                    div.footer_social_icons_container:hover {
                        background-color: white;
                        color: black;
                    }
                </style>
                <script>
                    function openInNewTab(url) {
                        window.open(url, '_blank', 'noopener,noreferrer');
                    }
                </script>

                <div class="footer_social">
                    <h4 class="footer_title">Follow Us</h4>
                    <div class="row text-center">
                        <div class="col-12">
                            <div class="d-flex flex-wrap justify-content-center justify-content-lg-start">
                                @if ($social_url->facebook)
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $social_url->facebook }}')"
                                            style="margin-left: 0">
                                            <svg class="w-[40px] h-[40px] text-gray-800 dark:text-white"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                @if ($social_url->twitter)
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $social_url->twitter }}')">
                                            <svg class="w-[40px] h-[40px] text-gray-800 dark:text-white"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                @if ($social_url->instagram)
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $social_url->instagram }}')">
                                            <svg class="w-[40px] h-[40px] text-gray-800 dark:text-white"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                @if ($social_url->youtube)
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $social_url->youtube }}')">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                @if ($social_url->telegram)
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $social_url->telegram }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24"
                                                height="24" viewBox="0 0 50 50" fill="currentColor">
                                                <path
                                                    d="M46.137,6.552c-0.75-0.636-1.928-0.727-3.146-0.238l-0.002,0C41.708,6.828,6.728,21.832,5.304,22.445	c-0.259,0.09-2.521,0.934-2.288,2.814c0.208,1.695,2.026,2.397,2.248,2.478l8.893,3.045c0.59,1.964,2.765,9.21,3.246,10.758	c0.3,0.965,0.789,2.233,1.646,2.494c0.752,0.29,1.5,0.025,1.984-0.355l5.437-5.043l8.777,6.845l0.209,0.125	c0.596,0.264,1.167,0.396,1.712,0.396c0.421,0,0.825-0.079,1.211-0.237c1.315-0.54,1.841-1.793,1.896-1.935l6.556-34.077	C47.231,7.933,46.675,7.007,46.137,6.552z M22,32l-3,8l-3-10l23-17L22,32z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                @if ($social_url->wechat)
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $social_url->wechat }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24"
                                                height="24" viewBox="0 0 50 50" fill="currentColor">
                                                <path
                                                    d="M 19 6 C 9.625 6 2 12.503906 2 20.5 C 2 24.769531 4.058594 28.609375 7.816406 31.390625 L 5.179688 39.304688 L 13.425781 34.199219 C 15.714844 34.917969 18.507813 35.171875 21.203125 34.875 C 23.390625 39.109375 28.332031 42 34 42 C 35.722656 42 37.316406 41.675781 38.796875 41.234375 L 45.644531 45.066406 L 43.734375 38.515625 C 46.3125 36.375 48 33.394531 48 30 C 48 23.789063 42.597656 18.835938 35.75 18.105469 C 34.40625 11.152344 27.367188 6 19 6 Z M 13 14 C 14.101563 14 15 14.898438 15 16 C 15 17.101563 14.101563 18 13 18 C 11.898438 18 11 17.101563 11 16 C 11 14.898438 11.898438 14 13 14 Z M 25 14 C 26.101563 14 27 14.898438 27 16 C 27 17.101563 26.101563 18 25 18 C 23.898438 18 23 17.101563 23 16 C 23 14.898438 23.898438 14 25 14 Z M 34 20 C 40.746094 20 46 24.535156 46 30 C 46 32.957031 44.492188 35.550781 42.003906 37.394531 L 41.445313 37.8125 L 42.355469 40.933594 L 39.105469 39.109375 L 38.683594 39.25 C 37.285156 39.71875 35.6875 40 34 40 C 27.253906 40 22 35.464844 22 30 C 22 24.535156 27.253906 20 34 20 Z M 29.5 26 C 28.699219 26 28 26.699219 28 27.5 C 28 28.300781 28.699219 29 29.5 29 C 30.300781 29 31 28.300781 31 27.5 C 31 26.699219 30.300781 26 29.5 26 Z M 38.5 26 C 37.699219 26 37 26.699219 37 27.5 C 37 28.300781 37.699219 29 38.5 29 C 39.300781 29 40 28.300781 40 27.5 C 40 26.699219 39.300781 26 38.5 26 Z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                @if ($social_url->line)
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $social_url->line }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24"
                                                height="24" viewBox="0 0 50 50" fill="currentColor">
                                                <path
                                                    d="M 9 4 C 6.24 4 4 6.24 4 9 L 4 41 C 4 43.76 6.24 46 9 46 L 41 46 C 43.76 46 46 43.76 46 41 L 46 9 C 46 6.24 43.76 4 41 4 L 9 4 z M 25 11 C 33.27 11 40 16.359219 40 22.949219 C 40 25.579219 38.959297 27.960781 36.779297 30.300781 C 35.209297 32.080781 32.660547 34.040156 30.310547 35.660156 C 27.960547 37.260156 25.8 38.519609 25 38.849609 C 24.68 38.979609 24.44 39.039062 24.25 39.039062 C 23.59 39.039062 23.649219 38.340781 23.699219 38.050781 C 23.739219 37.830781 23.919922 36.789063 23.919922 36.789062 C 23.969922 36.419063 24.019141 35.830937 23.869141 35.460938 C 23.699141 35.050938 23.029062 34.840234 22.539062 34.740234 C 15.339063 33.800234 10 28.849219 10 22.949219 C 10 16.359219 16.73 11 25 11 z M 23.992188 18.998047 C 23.488379 19.007393 23 19.391875 23 20 L 23 26 C 23 26.552 23.448 27 24 27 C 24.552 27 25 26.552 25 26 L 25 23.121094 L 27.185547 26.580078 C 27.751547 27.372078 29 26.973 29 26 L 29 20 C 29 19.448 28.552 19 28 19 C 27.448 19 27 19.448 27 20 L 27 23 L 24.814453 19.419922 C 24.602203 19.122922 24.294473 18.992439 23.992188 18.998047 z M 15 19 C 14.448 19 14 19.448 14 20 L 14 26 C 14 26.552 14.448 27 15 27 L 18 27 C 18.552 27 19 26.552 19 26 C 19 25.448 18.552 25 18 25 L 16 25 L 16 20 C 16 19.448 15.552 19 15 19 z M 21 19 C 20.448 19 20 19.448 20 20 L 20 26 C 20 26.552 20.448 27 21 27 C 21.552 27 22 26.552 22 26 L 22 20 C 22 19.448 21.552 19 21 19 z M 31 19 C 30.448 19 30 19.448 30 20 L 30 26 C 30 26.552 30.448 27 31 27 L 34 27 C 34.552 27 35 26.552 35 26 C 35 25.448 34.552 25 34 25 L 32 25 L 32 24 L 34 24 C 34.553 24 35 23.552 35 23 C 35 22.448 34.553 22 34 22 L 32 22 L 32 21 L 34 21 C 34.552 21 35 20.552 35 20 C 35 19.448 34.552 19 34 19 L 31 19 z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                @if ($social_url->tiktok)
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $social_url->tiktok }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24"
                                                height="24" viewBox="0 0 50 50" fill="currentColor">
                                                <path
                                                    d="M41,4H9C6.243,4,4,6.243,4,9v32c0,2.757,2.243,5,5,5h32c2.757,0,5-2.243,5-5V9C46,6.243,43.757,4,41,4z M37.006,22.323 c-0.227,0.021-0.457,0.035-0.69,0.035c-2.623,0-4.928-1.349-6.269-3.388c0,5.349,0,11.435,0,11.537c0,4.709-3.818,8.527-8.527,8.527 s-8.527-3.818-8.527-8.527s3.818-8.527,8.527-8.527c0.178,0,0.352,0.016,0.527,0.027v4.202c-0.175-0.021-0.347-0.053-0.527-0.053 c-2.404,0-4.352,1.948-4.352,4.352s1.948,4.352,4.352,4.352s4.527-1.894,4.527-4.298c0-0.095,0.042-19.594,0.042-19.594h4.016 c0.378,3.591,3.277,6.425,6.901,6.685V22.323z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                @endif

                                @if ($social_url->zalo)
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $social_url->zalo }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24"
                                                height="24" viewBox="0 0 50 50" fill="currentColor">
                                                <path
                                                    d="M 9 4 C 6.2504839 4 4 6.2504839 4 9 L 4 41 C 4 43.749516 6.2504839 46 9 46 L 41 46 C 43.749516 46 46 43.749516 46 41 L 46 9 C 46 6.2504839 43.749516 4 41 4 L 9 4 z M 9 6 L 15.580078 6 C 12.00899 9.7156859 10 14.518083 10 19.5 C 10 24.66 12.110156 29.599844 15.910156 33.339844 C 16.030156 33.549844 16.129922 34.579531 15.669922 35.769531 C 15.379922 36.519531 14.799687 37.499141 13.679688 37.869141 C 13.249688 38.009141 12.97 38.430859 13 38.880859 C 13.03 39.330859 13.360781 39.710781 13.800781 39.800781 C 16.670781 40.370781 18.529297 39.510078 20.029297 38.830078 C 21.379297 38.210078 22.270625 37.789609 23.640625 38.349609 C 26.440625 39.439609 29.42 40 32.5 40 C 36.593685 40 40.531459 39.000731 44 37.113281 L 44 41 C 44 42.668484 42.668484 44 41 44 L 9 44 C 7.3315161 44 6 42.668484 6 41 L 6 9 C 6 7.3315161 7.3315161 6 9 6 z M 33 15 C 33.55 15 34 15.45 34 16 L 34 25 C 34 25.55 33.55 26 33 26 C 32.45 26 32 25.55 32 25 L 32 16 C 32 15.45 32.45 15 33 15 z M 18 16 L 23 16 C 23.36 16 23.700859 16.199531 23.880859 16.519531 C 24.050859 16.829531 24.039609 17.219297 23.849609 17.529297 L 19.800781 24 L 23 24 C 23.55 24 24 24.45 24 25 C 24 25.55 23.55 26 23 26 L 18 26 C 17.64 26 17.299141 25.800469 17.119141 25.480469 C 16.949141 25.170469 16.960391 24.780703 17.150391 24.470703 L 21.199219 18 L 18 18 C 17.45 18 17 17.55 17 17 C 17 16.45 17.45 16 18 16 z M 27.5 19 C 28.11 19 28.679453 19.169219 29.189453 19.449219 C 29.369453 19.189219 29.65 19 30 19 C 30.55 19 31 19.45 31 20 L 31 25 C 31 25.55 30.55 26 30 26 C 29.65 26 29.369453 25.810781 29.189453 25.550781 C 28.679453 25.830781 28.11 26 27.5 26 C 25.57 26 24 24.43 24 22.5 C 24 20.57 25.57 19 27.5 19 z M 38.5 19 C 40.43 19 42 20.57 42 22.5 C 42 24.43 40.43 26 38.5 26 C 36.57 26 35 24.43 35 22.5 C 35 20.57 36.57 19 38.5 19 z M 27.5 21 C 27.39625 21 27.29502 21.011309 27.197266 21.03125 C 27.001758 21.071133 26.819727 21.148164 26.660156 21.255859 C 26.500586 21.363555 26.363555 21.500586 26.255859 21.660156 C 26.148164 21.819727 26.071133 22.001758 26.03125 22.197266 C 26.011309 22.29502 26 22.39625 26 22.5 C 26 22.60375 26.011309 22.70498 26.03125 22.802734 C 26.051191 22.900488 26.079297 22.994219 26.117188 23.083984 C 26.155078 23.17375 26.202012 23.260059 26.255859 23.339844 C 26.309707 23.419629 26.371641 23.492734 26.439453 23.560547 C 26.507266 23.628359 26.580371 23.690293 26.660156 23.744141 C 26.819727 23.851836 27.001758 23.928867 27.197266 23.96875 C 27.29502 23.988691 27.39625 24 27.5 24 C 27.60375 24 27.70498 23.988691 27.802734 23.96875 C 28.487012 23.82916 29 23.22625 29 22.5 C 29 21.67 28.33 21 27.5 21 z M 38.5 21 C 38.39625 21 38.29502 21.011309 38.197266 21.03125 C 38.099512 21.051191 38.005781 21.079297 37.916016 21.117188 C 37.82625 21.155078 37.739941 21.202012 37.660156 21.255859 C 37.580371 21.309707 37.507266 21.371641 37.439453 21.439453 C 37.303828 21.575078 37.192969 21.736484 37.117188 21.916016 C 37.079297 22.005781 37.051191 22.099512 37.03125 22.197266 C 37.011309 22.29502 37 22.39625 37 22.5 C 37 22.60375 37.011309 22.70498 37.03125 22.802734 C 37.051191 22.900488 37.079297 22.994219 37.117188 23.083984 C 37.155078 23.17375 37.202012 23.260059 37.255859 23.339844 C 37.309707 23.419629 37.371641 23.492734 37.439453 23.560547 C 37.507266 23.628359 37.580371 23.690293 37.660156 23.744141 C 37.739941 23.797988 37.82625 23.844922 37.916016 23.882812 C 38.005781 23.920703 38.099512 23.948809 38.197266 23.96875 C 38.29502 23.988691 38.39625 24 38.5 24 C 38.60375 24 38.70498 23.988691 38.802734 23.96875 C 39.487012 23.82916 40 23.22625 40 22.5 C 40 21.67 39.33 21 38.5 21 z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <hr>
                <p class="text text-center py-3 mb-0">
                    &copy;{{ date('Y') }} <a href="#" class="text">{{ env('APP_NAME') }}</a>. All
                    Rights Reserved
                </p>
            </div>
        </div>
    </div>
</footer>
