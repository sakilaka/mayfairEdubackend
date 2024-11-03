@extends('Frontend.layouts.master-layout')

@section('head')
    <style>
        .cities-card-top {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 1fr;
            gap: 0px 0px;
            grid-template-areas:
                ". . . ";
        }

        .cities-card-top .card {
            width: 23.5rem;
        }

        .cities-card-top {
            display: block;
        }

        .cities-card-top .card {
            width: 100%;
        }

        .cities-card-top .card {
            min-width: 19em !important;
        }

        .ca-card-title {
            font-weight: 700;
            color: #484848;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }


        .uni-showcase * {
            text-align: center;
        }

        .uni-showcase a {
            display: inline-block;
            margin-top: 20px;
        }

        .uni-showcase img {
            max-width: 100%;
            height: auto;
        }

        .uni-showcase .unibox p {
            display: none;
        }

        /* .btn-txt {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    color: #fff !important;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  } */

        .btn-txt:hover {
            text-decoration: none;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        .swal2-popup {
            width: 70vw;
            /* height: 80vh; */
            max-width: 100%;
            max-height: 100%;
            padding: 0;
        }

        .swal2-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .swal2-content {
            overflow: auto;
        }

        .swal2-title {
            text-align: center;
        }

        .swal2-html-container {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
        }

        .swal2-html-container figure {
            margin: 0 auto;
            width: 100% !important;
            height: 100% !important;
        }

        .swal2-html-container figure img {
            width: 100% !important;
            height: 100% !important;
            object-fit: contain !important;
        }
    </style>

    <style>
        .custom-close {
            position: absolute;
            top: 5px;
            right: 10px;
            background: transparent;
            border: none;
            font-size: 36px;
            color: var(--secondary_background);
            cursor: pointer;
            z-index: 1051;
            transition: 0.35s;
        }

        .custom-close:hover {
            color: var(--tertiary_background);
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endsection

@section('main_content')
    <div class="modal m-t-40 " id="modal_info">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h6 class="modal-title modal_ttl"></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body" id="info">

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @php
        $popupContentKey = App\Models\Tp_option::where('option_name', 'theme_option_home_popup')->first();
        $popupContent = json_decode($popupContentKey->option_value, true) ?? [];
    @endphp

    @if ($popupContent['photo'] != '' && $popupContent['show_hide'] == 'show')
        <div class="modal fade" id="popupModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true"
            style="z-index: 99999999">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-2">
                        <button type="button" class="custom-close" data-bs-dismiss="modal" aria-label="Close">
                            &times;
                        </button>

                        @if ($popupContent['photo'])
                            <img src="{{ $popupContent['photo'] }}"
                                onclick="window.open('{{ $popupContent['redirect_url'] ?? '#' }}', '_blank')"
                                class="img-fluid" alt="Popup Image" style="cursor: pointer">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('Frontend.layouts.parts.home-header')

    <!-- University showcase -->
    @include('Frontend.layouts.parts.university-showcase')
    <!-- End of University Showcase -->

    <!--Start Course Content-->
    @include('Frontend.layouts.parts.courses-filter')
    <!--End Course Content-->


    <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/owl.carousel.min.css"
        rel="stylesheet">
    <link
        href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/owl.theme.default.min.css"
        rel="stylesheet">
    <style>
        /* Collabration Text */

        .coll_text {
            padding-top: 50px;
            font-family: 'Times New Roman', Times, serif;
        }

        #counter .logo-holder {
            width: 100%;
            display: block;
        }

        #counter .logo-holder img {
            height: 40px;
            max-width: inherit;
            width: auto;
            float: left;
            margin-right: 15px;
        }

        #counter .logo-holder h3 {
            display: inline-block;
            background: linear-gradient(90deg, #EA7D26 18.98%, #EDAC1F 81.39%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-emphasis-color: transparent;
            font-weight: 600;
            padding-top: 15px;
        }

        #counter .logo-holder .justify-content-center {
            display: inline-flex;
            margin-bottom: 5px;
            margin-top: 10px;
        }

        .logo-container ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: inline-block;
        }

        .logo-container {
            padding: 0px 50px;
        }

        .logo-container .logo-holder {
            background: #fff;
            border-radius: 10px;
            margin: 20px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.25);
            display: flex;
            height: 120px;
        }

        .logo-container .logo-holder img {
            max-height: 60px;
            max-width: 50%;
            width: auto;
            margin: auto;
        }

        .owl-dots {
            position: absolute;
            bottom: -30px;
            left: 50%;
            -webkit-transform: translate(-50%, 0);
            transform: translate(-50%, 0);
        }

        .owl-dots .owl-dot {
            background: #C4C4C4;
            border-radius: 50%;
            width: 10px;
            height: 10px;
            float: left;
            margin-right: 10px;
        }

        .owl-dots .owl-dot.active {
            background: #494CA2;
        }

        .s_img1,
        .s_img2,
        .s_img3,
        .s_img4 {
            width: 30%;
        }

        .s_text1 {
            background: linear-gradient(90deg, #EA7D26 18.98%, #EDAC1F 81.39%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-emphasis-color: transparent;
            font-weight: 600;
        }


        /* Collabration Text */
    </style>

    <script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/owl.carousel.min.js">
    </script>
    <script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/main.js"></script>

    <!-- Seach by City -->
    @include('Frontend.layouts.parts.find-university')
    <!-- End of Seach by City -->

    <!-- start of University apply steps -->
    {{-- @include('Frontend.layouts.parts.universities-apply') --}}
    <!-- End of University apply steps -->

    <!-- Start of Learnings -->
    {{-- @include('Frontend.layouts.parts.learning') --}}
    <!-- End of University apply steps -->

    <!-- Start of Learnings -->
    @include('Frontend.layouts.parts.services-section')
    <!-- End of Learnings -->


    <!--Start Counter-->
    {{-- @include('Frontend.layouts.parts.counter') --}}
    <!--End Counter-->

    <!--Start Testimonial-->
    @include('Frontend.layouts.parts.testimonials')
    <!--End Testimonial-->

    <script>
        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function checkCookie() {
            var cname = getCookie("cname");
            if (cname != "") {
                alert("Welcome again " + cname);
            }
        }

        function readmoreshowhide1(sl) {
            $(".moreText-" + sl).toggleClass("opened");
            //var set_lang = $('#set_language').val();
            var elem = $("#toggle-" + sl).text();


            // alert(elem);
            // return false;

            if (elem == "Read More") {
                //Stuff to do when btn is in the read more state
                // $("#toggle-" + sl).text('');

                // $("#toggle-" + sl).text('');
                $("#toggle-" + sl).text("Read More");
                $("#text").slideDown();

            } else {
                //Stuff to do when btn is in the read less state
                // $("#toggle-" + sl).text("Read More");

                // $("#toggle-" + sl).text('');

                $("#toggle-" + sl).text("Read Less");
                $("#text").slideUp();

            }

        }

        function readmoreshowhide(sl) {
            $(".moreText-" + sl).toggleClass("opened");
            var set_lang = $('#set_language').val();
            var elem = $("#toggle-" + sl).text();
            if (elem == "আরও পড়ুন") {
                //Stuff to do when btn is in the read more state
                $("#toggle-" + sl).text("সংক্ষিপ্ত করুন");
                $("#text").slideDown();
            } else if (elem == "সংক্ষিপ্ত করুন") {
                //Stuff to do when btn is in the read less state
                $("#toggle-" + sl).text("আরও পড়ুন");
                $("#text").slideUp();
            } else if (elem == "Read More") {
                //Stuff to do when btn is in the read less state
                $("#toggle-" + sl).text("Read Less");
                $("#text").slideUp();
            } else if (elem == "Read Less") {
                //Stuff to do when btn is in the read less state
                $("#toggle-" + sl).text("Read More");
                $("#text").slideUp();
            } else {
                $("#toggle-" + sl).text(set_lang === 'bn' ? "সংক্ষিপ্ত করুন" : "Read Less");
                $("#text").slideUp();
            }

        }


        // showhide(sl);
    </script>
    </div>
    <!--======== main content close ==========-->

    @include('Frontend.layouts.parts.news-letter')

    @include('Frontend.layouts.parts.footer_showcase')
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#popupModal').modal('show');
        });
    </script>

    <script script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
    <script>
        $(".course_price_cart").change(function(e) {
            // $(".course_price_cart").click(function(e){
            e.preventDefault();
            let id = $(this).val();
            console.log(id);

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //Home Sub Category
        $(".home_on_click_subcategory").click(function(e) {
            e.preventDefault();
            var id = $(this).attr('home_subcat_id');
            $.ajax({

                type: 'GET',

                url: "{{ url('home_course-type-ajax') }}/" + id,

                // data:{id:id},

                success: function(data) {
                    //  document.getElementById("home-proud-hide").style.visibility = "hidden";
                    $(".popular_ajax-show").html(data);
                }

            });



        });
        $('.change_cart_val').on('change', function() {
            console.log(this.id);
            if (this.id == "course_subcribe" + $(this).attr('course_id')) {
                $('.course_subcribe' + $(this).attr('course_id')).show();
                $('.course_cart_price' + $(this).attr('course_id')).hide();
            } else {
                $('.course_subcribe' + $(this).attr('course_id')).hide();
                $('.course_cart_price' + $(this).attr('course_id')).show();
            }
            //if($(th)
        });
    </script>
@endsection
