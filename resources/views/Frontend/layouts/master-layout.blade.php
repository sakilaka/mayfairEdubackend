<!--============ its for header file call start =============-->
<!doctype html>
<html lang="en">

@php
    $results = \App\Models\Tp_option::where('option_name', 'theme_custom_css')->first();
    $custom_html = \App\Models\Tp_option::where('option_name', 'theme_custom_html')->first();
    $custom_js = \App\Models\Tp_option::where('option_name', 'theme_custom_js')->first();
    $theme_seo = \App\Models\Tp_option::where('option_name', 'theme_options_seo')->first();
    $title = \App\Models\Tp_option::where('option_name', 'theme_option_header')->first();
    $logo = \App\Models\Tp_option::where('option_name', 'theme_logo')->first();

    $customCss = json_decode($results->option_value);
    $custom_html = json_decode($custom_html->option_value);
    $custom_js = json_decode($custom_js->option_value);
    $metadata = json_decode($theme_seo->option_value);
@endphp

<head>
    <link rel="shortcut icon" href="{{ @$logo->favicon_show }}" type="image/x-icon">

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @php
        $titles = '';
        $keywords = '';
    @endphp
    @foreach ($metadata->og_title as $k => $item)
        @php
            if (count($metadata->og_title) - 1 == $k) {
                $titles .= $item;
            } else {
                $titles .= $item . ',';
            }
        @endphp
    @endforeach
    <meta property="og:title" content="{{ $titles }}" />

    @foreach ($metadata->og_keywords as $k => $item)
        @php
            if (count($metadata->og_keywords) - 1 == $k) {
                $keywords .= $item;
            } else {
                $keywords .= $item . ',';
            }
        @endphp
    @endforeach
    <meta property="keywords" content="{{ $keywords }}" />

    {{-- open graph --}}
    <meta property="og:site_name" content="{{ $title->company_name }}" />
    <meta property="og:description" content="{{ $metadata->og_description }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('upload/seo/' . $metadata->og_image) }}" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />

    @if ($custom_html)
        {{-- <html> --}}
        {!! $custom_html->custom_headre_html !!}
        {{-- </html> --}}
    @endif

    @if (Route::is('home'))
        <title>MalishaEdu | Study in China | Higher Education Consulting Services</title>
        <meta name="description"
            content="MalishaEdu is an impressive international education consultancy that has a history of partnering with Chinese universities. They have demonstrated dedication to making international educationa...  Study in China | Higher Education Consulting Service" />
        <meta name="keywords" content="Study in China | Higher Education Consulting Service">
    @else
        <title>{{ $title->company_name }} @yield('title')</title>
    @endif
    <link rel="canonical" href="{{ url()->current() }}">

    @if ($customCss)
        <style>
            {!! $customCss->custom_headre_css !!}
        </style>
    @endif

    @if ($custom_js)
        <script>
            {!! $custom_js->custom_head_js !!}
        </script>
    @endif

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap');
    </style>

    @php
        $theme_color_result = App\Models\Tp_option::where('option_name', 'theme_color')->first();
        $theme_color = json_decode($theme_color_result['option_value'], true);
    @endphp

    @if ($theme_color)
        <style>
            :root {
                --primary_background: {{ $theme_color['primary_color'] ?? '#068b76' }};
                --secondary_background: {{ $theme_color['secondary_color'] ?? '#068b76' }};
                --tertiary_background: {{ $theme_color['tertiary_color'] ?? '#f40000' }};

                --btn_primary_color: var(--secondary_background);
                --btn_primary_hover_color: var(--primary_background);

                --btn_secondary_color: var(--primary_background);
                --btn_secondary_hover_color: var(--secondary_background);

                --btn_tertiary_color: var(--tertiary_background);
                --btn_tertiary_hover_color: {{ '#c10000' }};

                --section_background: {{ '#f2fafe' }};
            }
        </style>
    @endif

    @include('Frontend.layouts.parts.header-link')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('frontend/navbar/bootstrap-icons.woff') }}">
    <link rel="stylesheet" href="{{ asset('frontend/navbar/bootstrap-icons.woff2') }}">
    <link rel="stylesheet" href="{{ asset('frontend/navbar/bootstrap-icons.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/navbar/style.css') }}?v={{ rand() }}">
    <link rel="stylesheet" href="{{ asset('frontend/navbar/responsive.css') }}?v={{ rand() }}">
    <link rel="stylesheet" href="{{ asset('frontend/navbar/extra.css') }}?v={{ rand() }}">
    @yield('head')

    <style>
        html {
            scroll-behavior: smooth !important;
        }

        @media screen and (max-width:990px) {
            .col-padding-right {
                padding-right: 0.75rem !important;
            }

            .col-margin-right {
                margin-right: 0.75rem !important;
            }
        }

        /* assign btn theme for this site */
        .btn-primary-light-bg {
            background-color: var(--btn_primary_color) !important;
            color: white !important;
        }

        .btn-primary-bg {
            background-color: var(--btn_primary_color) !important;
            color: white !important;
            font-family: 'DM Sans', sans-serif !important;
        }

        .btn-primary-bg:hover {
            background-color: var(--btn_primary_hover_color) !important;
        }

        .btn-secondary-bg {
            background-color: var(--btn_secondary_color) !important;
            color: white !important;
            font-family: 'DM Sans', sans-serif !important;
        }

        .btn-secondary-bg:hover {
            background-color: var(--btn_secondary_hover_color) !important;
        }

        .btn-tertiary-bg {
            background-color: var(--btn_tertiary_color) !important;
            color: white !important;
            font-family: 'DM Sans', sans-serif !important;
        }

        .btn-tertiary-bg:hover {
            background-color: var(--btn_tertiary_hover_color) !important;
        }

        .section-background {
            background-color: var(--section_background) !important;
        }

        .section-background-img {
            background-image: url('{{ asset('frontend/images/section_bg.webp') }}') !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
        }

        .section {
            padding-top: 1rem;
        }

        .text-capital {
            text-transform: uppercase;
        }

        .typeahead .dropdown-item {
            padding: .25rem 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 26px;
            display: block;
            white-space: break-spaces;
        }

        @media screen and (max-width: 575px) {
            .signup-li {
                display: none;
            }

            .languageLi {
                /* display: none; */
            }

            /* .notificationLi{
            display: none;
        } */
            .languageLi a {
                font-size: 8px;
            }
        }

        .headerMenu li a {
            font-family: 'Inter', sans-serif;
        }

        /* multi language css start */
        .skiptranslate iframe {
            display: none;
        }

        .goog-te-gadget {
            position: relative;
            width: 100px;
            overflow: hidden;
            padding: 10px;
        }

        .goog-te-combo {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 5px;
        }

        /* multi language css End */

        /* VND css start */
        .currency-menu {
            align-items: center;
            display: flex;
            margin-right: 20px;
            position: relative;
        }

        .currency-menu a {
            color: #fff;
            background: var(--currency_frontend_color) !important;
            padding: 5px 10px;
        }

        .currency-dropdown {
            background: var(--currency_background_color);
            /* background: #fff; */

            border: 1px solid #ececec;
            border-radius: 0 0 4px 4px;
            min-width: 120px;
            opacity: 0;
            padding: 10px 15px;
            position: absolute;
            right: 0;
            top: 100%;
            transform: translateY(20px);
            transition: all 0.25s cubic-bezier(0.645, 0.045, 0.355, 1);
            visibility: hidden;
            z-index: 2;
        }

        .currency-dropdown li {
            text-decoration: none;
            list-style: none;
            padding: 5px 10px;
        }

        .currency-menu:hover a {
            color: #000;
            ;
        }

        .currency-menu:hover .currency-dropdown {
            opacity: 1;
            top: 25px;
            transform: translateY(0);
            visibility: visible;
        }

        #goog-gt-tt {
            display: none !important;
        }

        /* VND css End */
    </style>

    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/swiper-slide.min.css') }}">
    <script src="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/js/swiper-slide.min.js') }}">
    </script>

    <style>
        .font-dm-sans {
            font-family: 'DM Sans', sans-serif !important;
        }

        .font-dm-sans-title {
            font-family: 'DM Sans', sans-serif !important;
            font-size: 2rem !important;
        }

        /* custom styles */
        *::-webkit-scrollbar {
            width: 10px;
            height: 0;
        }

        *::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        *::-webkit-scrollbar-thumb {
            background: var(--btn_primary_color);
            border-radius: 10px;
        }

        *::-webkit-scrollbar-thumb:hover {
            background: var(--secondary_background);
        }
    </style>

    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/slick-theme.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/css/slick.css') }}">

    <!-- LightGallery CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/css/lightgallery.min.css">
    <!-- LightGallery JS -->
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/lightgallery.min.js"></script>
    <!-- LightGallery Plugins (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/plugins/thumbnail/lg-thumbnail.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.5.0/plugins/zoom/lg-zoom.min.js"></script>

    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">
</head>

<body>

    @if ($custom_html)
        {!! $custom_html->custom_body_html !!}
    @endif

    <!-- <div class="se-pre-con"></div> -->
    <input type="hidden" id="base_url" value="{{ url('/') }}">
    <input type="hidden" id="enterprise_id" value="1">
    <input type="hidden" id="enterprise_shortname" value="admin">
    <input type="hidden" id="user_type" value="">
    <input type="hidden" id="user_id" value="">
    <input type="hidden" name="CSRF_TOKEN" id="CSRF_TOKEN" value="23b826ad1bc7f991149ab321ac679e99">
    <input type="hidden" id="api_key" value="">
    <input type="hidden" id="cluster" value="">
    <input type="hidden" id="user_ban_login_message" value="">
    <input type="hidden" id="onlynumber_allow"
        value="@!#$%^&amp;*()_+[]{}?:;|\/~`-=abcdefghijklmnopqrstuvwxyz&gt;&lt;">
    <input type="hidden" id="security_character" value="@!#$%^&amp;*()_+[]{}?;|&#039;`/&gt;&lt;">
    <input type="hidden" id="coursespecial_character" value="@$^*_[]{}`&gt;&lt;">
    <input type="hidden" id="mail_specialcharacter_remove" value="!#$%^&amp;*()_+[]{}?:;|&#039;`/&gt;&lt;">
    <input type="hidden" id="examid" value="">
    <input type="hidden" id="popup" value="">
    <input type="hidden" id="segment1" value="home">
    <input type="hidden" id="segment2" value="">
    <input type="hidden" id="segment3" value="">
    <input type="hidden" id="segment4" value="">
    <input type="hidden" id="segment5" value="">

    <style>
        .fixed-buttons {
            position: fixed;
            bottom: 50%;
            right: 0;
            transform: translateY(50%);
            z-index: 999;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            border-radius: 0 0 0 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .fixed-buttons.hidden {
            transform: translateX(100%);
        }

        .fixed-buttons .btn {
            width: 105px;
            font-size: 12px;
            font-weight: bold;
            box-shadow: 0 4px 15px -5px rgba(50, 50, 50, 0.25);
            border-radius: 0;
        }

        #btn-toggle {
            position: fixed;
            bottom: 50%;
            right: 115px;
            transform: translateY(50%);
            z-index: 1000;
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 24px;
            color: var(--primary_background);
            transition: right 0.3s ease;
        }
    </style>

    {{-- <button id="btn-toggle">
        <i class="fa fa-arrow-left"></i>
    </button> --}}

    <div class="fixed-buttons" id="fixed-buttons">
        <a href="{{ route('frontend.university_course_list') }}" class="btn btn-tertiary-bg"
            id="btn-apply-now-fixed">Apply Now</a>
        <a href="{{ route('frontend.get_consultation') }}" class="btn btn-primary-bg"
            id="btn-consultation-fixed">Get A Free <br> Consultation</a>
    </div>
    <script>
        document.getElementById('btn-toggle').addEventListener('click', function() {
            const fixedButtons = document.getElementById('fixed-buttons');
            const toggleButton = document.getElementById('btn-toggle');

            fixedButtons.classList.toggle('hidden');

            if (fixedButtons.classList.contains('hidden')) {
                toggleButton.style.right = '5px';
            } else {
                toggleButton.style.right = '115px';
            }
        });
    </script>


    <!--Start Back to top button -->
    <button type="button" class="btn btn-top d-flex justify-content-center align-items-center" id="btn-back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>
    <!--End Back to top button -->

    @include('Frontend.layouts.parts.navbar')

    @yield('main_content')

    @include('Frontend.layouts.parts.footer')

    <script src="{{ asset('frontend/application/modules/frontend/views/themes/default/assets/js/slick-slider.min.js') }}">
    </script>
    <script>
        $('.section-2-first-row').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2500,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
        $('.section-2-second-row').slick({
            slidesToShow: 4,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
        $('.testimonial-cards-learners').slick({
            slidesToShow: 3,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 2500,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
        $('.testimonial-cards-partners').slick({
            slidesToShow: 3,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>

    <style type="text/css">
        /* body{
            background-color: #1B1464;
            font-family: "Nunito Sans";
        } */
        .bg-custom {
            background-color: #130f40;
        }

        .button-fixed {
            bottom: 0;
            position: fixed;
            right: 0;
            border-radius: 4px;
        }

        .fas {
            cursor: pointer;
            font-size: 24px;
        }

        p {
            font-size: 14px;
        }

        @media screen and (max-width: 600px) {
            .navbar {
                padding: 0 5px !important;
            }

            .currency-menu {
                margin: 0;
            }

            .dropdown-user .nav-link {
                margin: 0 !important;
            }

            .currency-menu:hover .currency-dropdown {
                top: 31px;
            }

            .currency-menu a {
                color: #fff;
                background: #fff;
                padding: 3px 10px !important;
            }

            #google_translate_element {
                margin: 0 !important;
            }

            .goog-te-gadget {
                position: relative;
                width: 87px;
                overflow: hidden;
                padding: 8px;
            }
        }
    </style>

    @include('Frontend.layouts.parts.scripts')
    <script src="{{ asset('frontend/navbar/menu.js') }}"></script>
    <script src="{{ asset('frontend/navbar/navbar-custom.js') }}"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/66f0feab4cbc4814f7dd6175/1i8em5ju9';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    @yield('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if (Session::has('success'))
        <script>
            toastr.success("{{ Session::get('success') }}");
        </script>
        {{ Session::forget('success') }}
    @endif
    @if (Session::has('error'))
        <script>
            toastr.error("{{ Session::get('error') }}");
        </script>
        {{ Session::forget('error') }}
    @endif

    <script>
        $(document).ready(function() {
            $('.card-clickable').on('click', function() {
                var title = $(this).data('title');
                var image = $(this).data('image');
                var date = $(this).data('date');
                var redirectURL = $(this).data('redirect');

                $('#highlighted-card').css('background-image', 'url(' + image + ')');
                $('#highlighted-title').text(title);
                $('#highlighted-date span').text(date);
                $('#highlighted-card').attr('onclick', 'location.href=\'' + redirectURL + '\'');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#search_btn").click(function(event) {
            event.stopPropagation();
            var searchInputArea = $("#search_input_area");
            if (searchInputArea.hasClass("d-none")) {
                searchInputArea.removeClass("d-none").addClass("d-block").fadeIn("slow");
            } else if (searchInputArea.hasClass("d-block")) {
                searchInputArea.removeClass("d-block").addClass("d-none").fadeOut("slow");
            }
        });

        $("#close_btn").click(function(event) {
            event.stopPropagation();
            var searchInputArea = $("#search_input_area");
            if (searchInputArea.hasClass("d-block")) {
                searchInputArea.removeClass("d-block").addClass("d-none").fadeOut("slow");
            }
        });

        $(document).click(function(event) {
            var searchInputArea = $("#search_input_area");
            var searchInput = $(".custom-input");
            if (!searchInputArea.is(event.target) && !searchInput.is(event.target) && searchInputArea.has(event
                    .target).length === 0 && searchInputArea.hasClass("d-block")) {
                searchInputArea.removeClass("d-block").addClass("d-none").fadeOut("slow");
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".delete-button").click(function() {
                $("#delete-modal").show();
                $("#car_id").val($(this).attr('CarId'))

            });
            $("#confirm-no").click(function() {
                $("#delete-modal").hide();
            });
            $("#confirm-yes").click(function() {
                $("#delete-modal").hide();
            });
        });



        $('.addcart').on('click', function() {
            var id = $(this).attr('CarId');

            Swal.fire({
                title: "Add To Cart Successfully!",
                icon: "success",
                confirmButtonText: "Ok",

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "{{ url('/add-to-cart') }}/" + id
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $(".delete-button").click(function() {
                $("#delete-modal").show();
                $("#car_id").val($(this).attr('CarId'))

            });
            $("#confirm-no").click(function() {
                $("#delete-modal").hide();
            });
            $("#confirm-yes").click(function() {
                $("#delete-modal").hide();
            });
        });



        $('.addebookcart').on('click', function() {
            var id = $(this).attr('CarId');

            Swal.fire({
                title: "Add To Cart Successfully!",
                icon: "success",
                confirmButtonText: "Ok",

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "{{ url('/add-to-ebook-cart') }}/" + id
                }
            });
        });
    </script>

    {{-- //card remove start --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/flatpickr.js">
    </script>
    <script
        src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/jquery.serializejson.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tippy.js@6.3.7/dist/tippy.umd.js"></script>
    <script
        src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/plugins/select2/dist/js/select2.min.js">
    </script>
    <script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/dropzone.js"></script>

    @yield('cus_sc')
    <script>
        $(document).ready(function() {
            $(".delete-button").click(function() {
                $("#delete-modal").show();
                $("#car_id").val($(this).attr('CarId'))

            });
            $("#confirm-no").click(function() {
                $("#delete-modal").hide();
            });
            $("#confirm-yes").click(function() {
                $("#delete-modal").hide();
            });
        });



        $('.cartremove').on('click', function() {
            var id = $(this).attr('CarId');
            Swal.fire({
                title: "Do you Want to delete ?",
                icon: "error",
                showCancelButton: true,
                confirmButtonText: "Yes !",
                cancelButtonText: "No !",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "{{ url('/remove-from-cart') }}/" + id
                }
            });
        });
    </script>

    {{-- //card remove end --}}


    {{-- //Course Save Start --}}
    <script>
        $('.add-save').on('click', function() {
            let c_id = $(this).attr('c_id');
            let arg = $(this);
            $.ajax({

                type: 'Get',

                url: "{{ url('add-to-save') }}/" + c_id,

                success: function(data) { //console.log(data);
                    // console.log(data);
                    if (data == "ok") {
                        $(arg).css('color', '#00a662');
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'success',
                            title: 'Course Added To Wishlist',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else if (data == "del") {
                        $(arg).css('color', '#969696');
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'success',
                            title: 'Course Remove From Wishlist',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }

            });
        });
    </script>

    <script type="text/javascript">
        window.gtranslateSettings = window.gtranslateSettings || {};
        window.gtranslateSettings['43217984'] = {
            "default_language": "en",
            "languages": ["en", "zh-CN", "bn", "th", "id", "lo", "ru", "ar", "fr", "es", "pt"],
            "wrapper_selector": "#gt-mordadam-43217984",
            "native_language_names": 1,
            "flag_style": "2d",
            "flag_size": 24,
            "horizontal_position": "inline",
            "flags_location": window.location.origin + "/translate/flags/"
        };
    </script>
    <script src="{{ asset('translate/js/gt.js') }}" data-gt-widget-id="43217984"></script>
    {{-- Multilanguage end  --}}

    <script>
        @if (session()->has('message'))
            toastr.success('{{ session()->get('message') }}');
        @endif
    </script>
    @if ($custom_html)
        {!! $custom_html->custom_footer_html !!}
    @endif

    @if ($custom_js)
        <script>
            {!! $custom_js->custom_body_js !!}
        </script>
    @endif

</body>

@if ($custom_js)
    <script>
        {!! $custom_js->custom_footer_js !!}
    </script>
@endif

</html>
