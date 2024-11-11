@extends('Frontend.layouts.master-layout')
@section('title', ' - Event Details')
@section('head')
    <style>
        .shadow-inner::before {
            border-radius: 0.75rem;
        }

        .content_search {
            margin-top: 3.5rem;
        }

        /* @media screen and (min-width:391px) {
                .content_search {
                    margin-top: 6rem;
                }
            } */
    </style>

    <link rel="stylesheet" href="{{ asset('frontend/ckeditor5-rendered.css') }}">
@endsection
@section('main_content')

    <div class="content_search">
        <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/blog.css"
            rel="stylesheet">
        <div class="bg-alice-blue pt-5">
            <div class="container-xl">
                <div class="row justify-content-center">

                    <div class="col-12">
                        <!--Start Category Banner-->
                        <div class="category-banner shadow-inner position-relative text-white px-4 py-5 px-sm-5 mb-4 text-center"
                            style="height:200px!important;">
                            <div class="bottom-0 end-0 overflow-hidden position-absolute start-0 top-0"
                                style="border-radius: 0.75rem;">
                                <img src="{{ @$event->image_show }}" class="img-fluid wh_sm_100" alt=""
                                    style="object-fit:cover">
                            </div>
                        </div>
                        <!--End Category Banner-->
                    </div>

                    <div class="col-lg-8">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}"
                                        class="text_bluish-black fw-semi-bold">Home </a></li>
                                <!-- <li class="breadcrumb-item text_bluish-black fw-semi-bold" aria-current="page">Live</li> -->
                                <li class="breadcrumb-item active" aria-current="page">
                                    @if (@$event->release_id == '0')
                                        Passed Event
                                    @elseif(@$event->release_id == '1')
                                        Upcoming Event
                                    @else
                                        Live Event
                                    @endif
                                </li>
                            </ol>
                        </nav>

                        <h4 class="fs-4 fw-bold my-4" style="color: var(--btn_primary_color)">{{ $event->name }}</h4>

                        <div class="d-xl-flex">
                            <h6 class="fw-semi-bold text_bluish-black mb-0">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                {{ date('d F Y', strtotime($event->startdate)) }}
                            </h6>
                            <span class="d-none d-xl-block mx-4 middle_border"></span>
                            <h6 class="fw-semi-bold text_bluish-black mb-0">
                                {{ $event->location }}
                            </h6>
                        </div>
                        <div class="d-block my-4">
                            <img src="{{ $event->host->image_show ?? '' }}" class="img-fluid" alt="">
                        </div>
                        <div class="d-flex flex-wrap justify-content-xl-between mb-4 text-muted bg-white shadow-sm rounded">
                            <div class="d-block neat_block px-5 py-3 rounded-1 my-1 me-2 me-xl-0 text-center font_open">
                                <div class="fs-6 fw-semi-bold mb-2 title">Speakers</div>
                                {{-- <div class="fs-6 fw-bold">12</div> --}}
                                <div class="fs-6 fw-bold">
                                    {{ $event->eventschedules->groupBy('instrutor_id')->count() }}
                                </div>
                            </div>
                            <div class="d-block neat_block px-5 py-3 rounded-1 my-1 me-2 me-xl-0 text-center font_open">
                                <div class="fs-6 fw-semi-bold mb-2 title">Sessions</div>
                                <div class="fs-6 fw-bold">{{ $event->eventschedules->count() }}</div>
                            </div>
                            <div class="d-block neat_block px-5 py-3 rounded-1 my-1 me-2 me-xl-0 text-center font_open">
                                <div class="fs-6 fw-semi-bold mb-2 title">Days</div>
                                <div class="fs-6 fw-bold">{{ $event->eventschedules->count() }}</div>
                            </div>
                            <div class="d-block neat_block px-5 py-3 rounded-1 my-1 me-2 me-xl-0 text-center font_open">
                                <div class="fs-6 fw-semi-bold mb-2 title">Recording</div>
                                <div class="fs-6 fw-bold">
                                    @if (@$event->recording == 0)
                                        No
                                    @else
                                        Yes
                                    @endif
                                </div>
                            </div>
                            <div class="d-block neat_block px-5 py-3 rounded-1 my-1 me-2 me-xl-0 text-center font_open">
                                <div class="fs-6 fw-semi-bold mb-2 title">Language</div>
                                <div class="fs-6 fw-bold">
                                    @if (@$event->language_id == '0')
                                        Bangla
                                    @else
                                        English
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div
                            class="align-items-center d-md-flex text-muted justify-content-between shadow-sm bg-white mb-3 rounded pass_block p-3 rounded-1">
                            <div class="fs-5 fw-bold text-uppercase">Get Event Pass!</div>
                            <div class="align-items-center d-flex justify-content-between">
                                <h5 class="p-2"><b> {{ format_price(@$event->fee) }}</b></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Start About Event -->
        <div class="bg-alice-blue pt-2">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <!--Start Section Header-->
                        <!--Start card-->
                        @if ($event->about)
                            <div class="card border-0 rounded shadow-sm mb-3 page-section" id="overview">
                                <div class="card-body p-4">
                                    <!--Start Section Header-->
                                    <div class="section-header mb-4 position-relative">
                                        <h4 class="h5 about_this_course" style="color: var(--text_color)">About this event
                                        </h4>
                                        <div class="section-header_divider"></div>
                                    </div>
                                    <!--End Section Header-->
                                    <div style="text-align: justify;" class="ckeditor5-rendered">
                                        {!! @$event->about !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--End About Event -->

        <div class="bg-alice-blue py-5" style="color: var(--text_color)">
            <div class="container-xl">
                <div class="justify-content-center row">
                    <div class="col-lg-8">
                        <div class="section-header mb-4">
                            <h5 class="fw-semi-bold">Event Schedule</h5>
                            <div class="section-header_divider"></div>
                        </div>
                        <div class="row g-3">
                            @foreach ($event->eventschedules as $eventschedule)
                                @php
                                    // dd($eventschedule);
                                @endphp
                                <div class="col-lg-12">
                                    <div class="d-block my-0.5">
                                        <div
                                            class="align-items-center bg-white border-dc rounded-1 d-sm-flex fs-6 px-3 py-2 text-dark-cerulean">
                                            <div class="d-block me-5 cLast br-dc fw-bold">
                                                {{ $eventschedule->day_id }}
                                            </div>

                                            <div class="d-block fw-bold">
                                                {{ date('d,F,Y', strtotime(@$eventschedule->scheduledate)) }}</div>
                                        </div>
                                        <div class="border-dc fs-6 px-3 py-2">
                                            <div class="d-sm-flex align-items-center mb-1">
                                                <div class="d-block me-5 cLast br-dc">
                                                    {{ $eventschedule->schedulestart_time }}-{{ $eventschedule->scheduleend_time }}
                                                </div>
                                                <div class="d-block">{!! @$eventschedule->schedulename !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-dc fs-6 px-3 py-2">
                                            <div class="d-sm-flex align-items-center mb-1">
                                                <div class="d-block me-5 cLast br-dc">
                                                    Speakers/Partners
                                                </div>
                                                <div class="d-block">
                                                    {{ $eventschedule->instrutor_id }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-alice-blue py-5" style="color: var(--text_color)">
            <div class="container-xl">
                <div class="justify-content-center row">
                    <div class="col-lg-8">
                        <div class="section-header mb-4">
                            <h5 class="fw-semi-bold">Leave a Comment</h5>
                            <div class="section-header_divider"></div>
                        </div>
                        <form action="{{ route('event.details.massage') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <textarea class="bg-white form-control pe-5 box" name="details" cols="30" rows="2"></textarea>
                                <input type="hidden" name="event_id" value="{{ $event->id }}" />
                                <button class="btn btn-send end-0 position-absolute px-2 rounded-2" type="submit">
                                    <svg width="30" height="34" viewBox="0 0 44 38" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M41.1669 2L20.0835 20.6558" stroke="#A5A5A5" stroke-width="3.83333"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M41.1669 2L27.7502 35.9204L20.0835 20.6562L2.8335 13.8721L41.1669 2Z"
                                            stroke="#A5A5A5" stroke-width="3.83333" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                        <div class="load-comments"></div>

                    </div>
                </div>
            </div>
        </div>



        <script src="../application/modules/frontend/views/themes/default/assets/js/countdown.js"></script>

        <script>
            $(document).ready(function() {
                $("#commentSubmits").on('click', function() {


                    var enterprise_shortname = $("#enterprise_shortname").val();
                    var enterprise_id = $("#enterprise_id").val();
                    var user_id = $("#user_id").val();
                    var user_type = $("#user_type").val();
                    var comments = $("#commenteditor").val();
                    var course_id = "LEO094W9R9";
                    var comment_type = 3;
                    if (user_id == '') {
                        toastr.error("Please Login First!");
                        return false;
                    }

                    $.ajax({
                        url: base_url + enterprise_shortname + "/comment-save",
                        type: "POST",
                        data: {
                            csrf_test_name: CSRF_TOKEN,
                            user_id: user_id,
                            user_type: user_type,
                            project_id: course_id,
                            enterprise_id: enterprise_id,
                            comments: comments,
                            comment_type: comment_type,
                        },
                        success: function(r) {
                            $("#commenteditor").val('');
                            console.log(r);
                            toastr.success(r);
                            loadcomments();
                        },
                    });

                });
                loadcomments();
            });

            function loadcomments() {

                var project_id = "LEO094W9R9";
                $.ajax({
                    url: base_url + enterprise_shortname + "/loadcomments",
                    type: "POST",
                    data: {
                        csrf_test_name: CSRF_TOKEN,
                        // user_id: user_id,
                        // user_type: user_type,
                        enterprise_id: enterprise_id,
                        project_id: project_id,
                        comment_type: 3
                    },
                    success: function(r) {
                        console.log(r);
                        $(".load-comments").html(r);
                    },
                });
            }


            // Read More
            function instredmoreshowhide(sl) {

                // $("#toggle").click(function(){
                $(".moreText-" + sl).toggleClass("opened");

                var elem = $("#toggle-" + sl).text();
                if (elem == "Read More") {
                    //Stuff to do when btn is in the read more state
                    $("#toggle-" + sl).text("Read Less");
                    // $("#text").slideDown();
                } else {
                    //Stuff to do when btn is in the read less state
                    $("#toggle-" + sl).text("Read More");
                    // $("#text").slideUp();
                }
                // });

            }
        </script>
    </div>

@endsection



@section('script')

    {{-- <script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/countdown.js"></script> --}}
    <script>
        function makeTimer() {


            // var countdowntime = "{{ date('d F Y H:i:s', strtotime($event->eventstarttime)) }}";
            var countdowntime = "{{ date('d F Y H:i:s', strtotime($event->startdate)) }}";


            var endTime = new Date(countdowntime);
            endTime = (Date.parse(endTime) / 1000);

            var now = new Date();
            now = (Date.parse(now) / 1000);

            if (now < endTime) {

                var timeLeft = endTime - now;

                var days = Math.floor(timeLeft / 86400);
                var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
                var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

                if (hours < "10") {
                    hours = "0" + hours;
                }
                if (minutes < "10") {
                    minutes = "0" + minutes;
                }
                if (seconds < "10") {
                    seconds = "0" + seconds;
                }

                $("#days").html(days + "<p class='timeText fs-6 mb-0'>Days</p>");
                $("#hours").html(hours + "<p class='timeText fs-6 mb-0'>Hours</p>");
                $("#minutes").html(minutes + "<p class='timeText fs-6 mb-0'>Mins</p>");
                if (days == '0' && hours == '00' && minutes == '00' && seconds == '01') {
                    $("#seconds").html("00" + "<p class='timeText fs-6 mb-0'>Sec</p>");
                } else {
                    $("#seconds").html(seconds + "<p class='timeText fs-6 mb-0'>Sec</p>");
                }
            }

        }
        setInterval(function() {
            makeTimer();

        }, 1000);
    </script>
@endsection
