@extends('Frontend.layouts.master-layout-app')
@section('title', ' - All Universities')
@section('head')
    <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/application-style.css"
        rel="stylesheet">
    <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/tippy.css"
        rel="stylesheet">
    <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/wnoty.css"
        rel="stylesheet">

    <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/application.css"
        rel="stylesheet">
    <link
        href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/application-bootstrap.css"
        rel="stylesheet">
    <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/flatpickr.css"
        rel="stylesheet">
    <link href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/dropzone.css"
        rel="stylesheet">

    <style>
        .item {
            border: 1px solid #efefef;
            box-shadow: 0 0 20px -5px rgba(150, 150, 150, 0.25);
        }

        #scrollbarr {
            overflow-y: scroll;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #scrollbarr::-webkit-scrollbar {
            display: none;
        }

        #family {
            overflow-y: scroll;
            -ms-overflow-style: none;
            scrollbar-width: none;
            max-height: 1200px;
            overflow-y: auto;
            height: 100%;
        }

        #family::-webkit-scrollbar {
            display: none;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/css/intlTelInput.css">
    <style>
        .iti--inline-dropdown {
            display: flex;
            position: relative;
            z-index: 1000 !important;
        }

        .iti--inline-dropdown .iti__dropdown-content {
            z-index: 9999 !important;
        }

        .top-layer {
            z-index: 3 !important;
        }
    </style>
@endsection

@section('main_content')
    <div class="container d-lg-flex p-0" style="flex-flow: row-reverse; margin-top:12rem;">

        <div class="col-lg-4">
            <div class="center">
                <div class="applicationList_wrapper mb-4">
                    <h4 class="text-center mb-4">Application Summary</h4>
                    <span class="arrow d-lg-none active" (click)="toggleOpen($event)">
                        <span></span>
                        <span></span>
                    </span>
                    <div class="d-none d-lg-block app-summary">
                        <hr>

                        <div class="program">
                            {{-- @foreach ($programs as $program) --}}
                            <div class="d-md-flex item p-4" id="prog-250787">
                                <div style="position: absolute;right: 10px;z-index: 999;top: 10px;">
                                    <div class="delete-container">
                                        <button type="button" title="Delete program" data-program-id="{{ $program->id }}"
                                            data-program-name="{{ $program->name }}" data-program-id="{{ $program->id }}"
                                            class="delete-prog-btn close" aria-label="Delete program" data-toggle="modal"
                                            data-target="#delete_program">
                                            <span style="font-size:16px">
                                                <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="uniLogo d-inline-block">
                                        <img src="{{ $program->university?->image_show }}" style="width:50px;height:50px">

                                    </div>
                                    <div class="d-md-flex flex-column justify-content-between mainContentArea">
                                        <div class="">
                                            <a href="{{ env('FRONTEND_URL', 'http://localhost:5173') . 'course/' . $program->id }}"
                                                class="title" style="font-size: 1.2rem;">
                                                {{ $program->name }}
                                            </a>


                                            <div class="status">
                                                <div class="d-flex justify-content-between">Deadline:
                                                    <div class="d-flex flex-column">
                                                        <strong
                                                            data-tippy-content="Note: Submitting earlier increases your chances of being accepted. If you leave your application to close the deadline it increases your risk of being rejected because the university is very busy and there may not be enough time for your documents to be corrected if there are problems.">
                                                            {{ date('Y M d', strtotime($program->application_deadline)) }}
                                                        </strong>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="status d-flex justify-content-between">
                                                <div class="">Current Status:</div>
                                                <div class="">
                                                    <strong>
                                                        @if (0 == 0)
                                                            Applicationn Started
                                                        @elseif(1 == 1)
                                                            Application Completed
                                                        @endif
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            {{-- @endforeach --}}
                        </div>


                        <div class="mt-2 mb2 d-flex flex-column">
                            <button class="btn-add-prog btn mb-4"
                                onclick="window.location.href='{{ env('FRONTEND_URL', 'http://localhost:5173') . 'course' }}'">Add
                                another program
                                <i class="fa fa-plus" aria-hidden="true"></i> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="block applicationStatus_wrapper mr-md-2 ml-md-2 main position-relative mb-md-5 col-lg-8 loading d-none">

            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>


        <div class="mr-md-2 ml-md-2  main position-relative mb-md-5 col-lg-8">
            <div class="m-auto col-12 p-0" style="max-width: 800px;">
                <div class="missing-docs container d-none">
                    <div class="alert alert-warning alert-dismissible fade show m-2" role="alert">
                        <strong style="color:#363636;font-weight:700"> Your application is missing some required documents.
                            Please click <a href="#" style="color: #d71f27;font-weight:700"
                                onclick="setActivePanel(2);setActiveStep(2)">here</a> to upload.</strong> <br>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>

                <div class="states d-none">
                    <!--State 1-->
                    <div class="block applicationStatus_wrapper d-none">
                        <div class="topPart green">
                            <div class="currentStatus">Current Status</div>
                            <h1 class=""><strong class="status-current-step">Application Started</strong></h1>
                            <br><strong>Next Step: <span class="status-next-step"></span></strong>
                            <!-- class: onStep1 / onStep2 / onStep3 is how you control the circle current stage -->
                            <div class="stepsWrapper onStep1">
                                <div class="movingDots"></div>
                                <div class="line"></div>
                                <div class="steps passed">
                                    <div class="circle"></div>
                                    <div class="name">1. Application</div>
                                </div>
                                <div class="steps">
                                    <div class="circle"></div>
                                    <div class="name">2. University Review</div>
                                </div>
                                <div class="steps">
                                    <div class="circle"></div>
                                    <div class="name">3. Registration Confirmation</div>
                                </div>
                            </div>

                        </div>

                        <div class="contentWrapper">
                            <hr>
                            <p class="nameOfSection">
                            </p>
                            <h3>Notes from China Admissions<br> Applications Officer:</h3>
                            <p></p>
                            <h2 class="notes"></h2>
                            <div class="button red solid sml" onclick="window.location.href = '/survey/contact/'">
                                Upload additional Files</div>
                        </div>
                    </div>

                    <!--State 2-->
                    <div class="block applicationStatus_wrapper d-none step-2">
                        <div class="topPart green">
                            <div class="currentStatus">Current Status</div>
                            <h1 class=""><strong class="status-current-step">Application Started</strong></h1>
                            <br><strong>Next Step: <span class="status-next-step"></span></strong>
                            <!-- class: onStep1 / onStep2 / onStep3 is how you control the circle current stage -->
                            <div class="stepsWrapper onStep1">
                                <div class="movingDots"></div>
                                <div class="line"></div>
                                <div class="steps passed">
                                    <div class="circle"></div>
                                    <div class="name">1. Application</div>
                                </div>
                                <div class="steps">
                                    <div class="circle"></div>
                                    <div class="name">2. University Review</div>
                                </div>
                                <div class="steps">
                                    <div class="circle"></div>
                                    <div class="name">3. Registration Confirmation</div>
                                </div>
                            </div>

                        </div>

                        <div class="contentWrapper">
                            <hr>
                            <p class="nameOfSection">
                            </p>
                            <h3>Notes from China Admissions<br> Applications Officer:</h3>
                            <p></p>
                            <h2 class="">
                                Thank you for your application.
                                <hr>
                                <div class="mt-2">
                                    <div id="video_392645" preload="none"
                                        class="swarm-fluid smartvideo-player vjs-swarmify-theme fitvidsignore dimensions-video_392645 vjs-paused vjs-controls-enabled vjs-user-inactive"
                                        src="" style=""><video
                                            src="blob:https://apply.china-admissions.com/f2f1ad8e-740d-48b0-b245-84672f1b2b7c"
                                            class="vjs-tech" preload="none" id="video_392645_html5_api">
                                        </video>
                                        <div></div>
                                        <div class="vjs-poster" tabindex="-1"
                                            data-background-image="https://video-node.swarmcdn.com/8391afc9-113c-49fc-baa4-f9a6ad26b160/e975e2f50d7a9f952aa60736d39311f8dd77b8d060ff8de5779f70afd4a0c9af.jpg">
                                        </div>
                                        <div class="vjs-loading-spinner"></div>
                                        <div class="vjs-swarmify-disabled" role="button" aria-live="polite"
                                            tabindex="0" aria-label="disabled">
                                            <div class="vjs-control-content"><span class="vjs-control-text">Need
                                                    Text</span></div>
                                        </div>
                                        <div class="vjs-swarmify-play-button" role="button" aria-live="polite"
                                            tabindex="0" aria-label="play video"><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 294 336"
                                                class="swarmify-play-button hexagon">
                                                <defs>
                                                    <path id="h" d="M158 0l136.83 79v158L158 316 21.168 237V79z">
                                                    </path>
                                                    <path id="t" d="M53.499 7.951l51.961 90H1.539z"></path>
                                                </defs>
                                                <g stroke-linejoin="round" fill-rule="evenodd" stroke-linecap="round">
                                                    <g id="hex" transform="translate(-11 10)">
                                                        <use xlink:href="#h" height="100%" width="100%"></use>
                                                        <path stroke-width="10"
                                                            d="M158-5.774l141.83 81.888v163.77L158 321.774l-141.83-81.88V76.124L158-5.77z">
                                                        </path>
                                                    </g>
                                                    <g transform="rotate(-30 289.199 -57.894)" id="tri">
                                                        <use xlink:href="#t" height="100%" width="100%"></use>
                                                        <path stroke-width="4"
                                                            d="M53.499 3.951l55.424 96H-1.927l55.429-96z"></path>
                                                    </g>
                                                </g>
                                            </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 294 336"
                                                class="swarmify-play-button rectangle">
                                                <defs>
                                                    <path id="h" d="M158 0l136.83 79v158L158 316 21.168 237V79z">
                                                    </path>
                                                    <path id="t" d="M53.499 7.951l51.961 90H1.539z"></path>
                                                </defs>
                                                <g stroke-linejoin="round" fill-rule="evenodd" stroke-linecap="round">
                                                    <g id="hex">
                                                        <rect width="280" height="174" x="50%" y="50%"
                                                            transform="translate(-140,-87)" id="svg_3"
                                                            stroke-width="10"></rect>
                                                    </g>
                                                    <g transform="rotate(-30 289.199 -57.894)" id="tri">
                                                        <use xlink:href="#t" height="100%" width="100%"></use>
                                                        <path stroke-width="4"
                                                            d="M53.499 3.951l55.424 96H-1.927l55.429-96z"></path>
                                                    </g>
                                                </g>
                                            </svg><svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 294 336"
                                                class="swarmify-play-button circle">
                                                <defs>
                                                    <path id="h" d="M158 0l136.83 79v158L158 316 21.168 237V79z">
                                                    </path>
                                                    <path id="t" d="M53.499 7.951l51.961 90H1.539z"></path>
                                                </defs>
                                                <g stroke-linejoin="round" fill-rule="evenodd" stroke-linecap="round">
                                                    <g id="hex">
                                                        <circle cx="50%" cy="50%" r="125" id="svg_3"
                                                            stroke-width="10"></circle>
                                                    </g>
                                                    <g transform="rotate(-30 289.199 -57.894)" id="tri">
                                                        <use xlink:href="#t" height="100%" width="100%"></use>
                                                        <path stroke-width="4"
                                                            d="M53.499 3.951l55.424 96H-1.927l55.429-96z"></path>
                                                    </g>
                                                </g>
                                            </svg></div>
                                        <div class="vjs-swarmify-watermark vjs-swarmify-watermark-bottom-right"
                                            role="button" aria-live="polite" tabindex="0" aria-label="watermark"><a
                                                rel="noopener" target="_blank"
                                                href="https://swarmify.com/player/learn-more/?utm_campaign=wtrmrk&amp;utm_medium=player&amp;utm_source=apply.china-admissions.com"><img
                                                    src="https://assets.swarmcdn.com/cross/images/swarmify_logo_grey.png"
                                                    loading="lazy" width="2265" height="567"
                                                    alt="Swarmify Video Hosting"></a></div>
                                        <div class="vjs-control-bar" style="">
                                            <div class="vjs-play-control vjs-control " role="button" aria-live="polite"
                                                tabindex="0">
                                                <div class="vjs-control-content"><span
                                                        class="vjs-control-text">Play</span></div>
                                            </div>
                                            <div class="vjs-current-time vjs-time-controls vjs-control"
                                                style="display: none;">
                                                <div class="vjs-current-time-display" aria-live="off"><span
                                                        class="vjs-control-text">Current Time</span> 0:00</div>
                                            </div>
                                            <div class="vjs-time-divider" style="display: none;">
                                                <div><span>/</span></div>
                                            </div>
                                            <div class="vjs-duration vjs-time-controls vjs-control"
                                                style="display: none;">
                                                <div class="vjs-duration-display" aria-live="off"><span
                                                        class="vjs-control-text">Duration Time</span> 0:00</div>
                                            </div>
                                            <div class="vjs-remaining-time vjs-time-controls vjs-control"
                                                style="display: block;">
                                                <div class="vjs-remaining-time-display" aria-live="off"><span
                                                        class="vjs-control-text">Remaining Time</span> -0:00</div>
                                            </div>
                                            <div class="vjs-live-controls vjs-control">
                                                <div class="vjs-live-display" aria-live="off"><span
                                                        class="vjs-control-text">Stream Type</span>LIVE</div>
                                            </div>
                                            <div class="vjs-progress-control vjs-control">
                                                <div role="slider" aria-valuenow="NaN" aria-valuemin="0"
                                                    aria-valuemax="100" tabindex="0"
                                                    class="vjs-progress-holder vjs-slider" aria-label="video progress bar"
                                                    aria-valuetext="0:00">
                                                    <div class="vjs-load-progress"><span
                                                            class="vjs-control-text"><span>Loaded</span>: 0%</span></div>
                                                    <div class="vjs-play-progress" style="width: 0%;"><span
                                                            class="vjs-control-text"><span>Progress</span>: 0%</span></div>
                                                    <div class="vjs-seek-handle vjs-slider-handle" aria-live="off"
                                                        style="left: 0%;"><span class="vjs-control-text">0:00</span></div>
                                                </div>
                                            </div>
                                            <div class="vjs-fullscreen-control vjs-control " role="button"
                                                aria-live="polite" tabindex="0">
                                                <div class="vjs-control-content"><span
                                                        class="vjs-control-text">Fullscreen</span></div>
                                            </div>
                                            <div class="vjs-swarmify-signal-icon vjs-menu-button vjs-control swarm-on"
                                                style="display: none;">
                                                <div class="signal-popup vjs-menu"><a rel="noopener" target="_blank"
                                                        href="https://swarmify.com/player/learn-more/">
                                                        <div class="vjs-menu-content">
                                                            <div class="signal-title">Video Acceleration:</div>
                                                            <div class="signal-on-text">On</div>
                                                            <div class="signal-off-text">Off</div><br>
                                                        </div>
                                                    </a></div>
                                            </div>
                                            <div class="vjs-volume-control vjs-control">
                                                <div role="slider" aria-valuenow="100" aria-valuemin="0"
                                                    aria-valuemax="100" tabindex="0" class="vjs-volume-bar vjs-slider"
                                                    aria-label="volume level" aria-valuetext="100%">
                                                    <div class="vjs-volume-level" style="width: 100%;"><span
                                                            class="vjs-control-text"></span></div>
                                                    <div class="vjs-volume-handle vjs-slider-handle" style="left: 100%;">
                                                        <span class="vjs-control-text">00:00</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vjs-mute-control vjs-control vjs-vol-3" role="button"
                                                aria-live="polite" tabindex="0">
                                                <div><span class="vjs-control-text">Mute</span></div>
                                            </div>
                                            <div class="vjs-playback-rate vjs-menu-button vjs-control"
                                                aria-haspopup="true" role="button">
                                                <div class="vjs-control-content"><span class="vjs-control-text">Playback
                                                        Rate</span></div>
                                                <div class="vjs-playback-rate-value">1x</div>
                                                <div class="vjs-menu">
                                                    <ul class="vjs-menu-content">
                                                        <li class="vjs-menu-item" role="button" aria-live="polite"
                                                            tabindex="0" aria-selected="false">2x</li>
                                                        <li class="vjs-menu-item" role="button" aria-live="polite"
                                                            tabindex="0" aria-selected="false">1.5x</li>
                                                        <li class="vjs-menu-item" role="button" aria-live="polite"
                                                            tabindex="0" aria-selected="false">1.25x</li>
                                                        <li class="vjs-menu-item vjs-selected" role="button"
                                                            aria-live="polite" tabindex="0" aria-selected="true">1x
                                                        </li>
                                                        <li class="vjs-menu-item" role="button" aria-live="polite"
                                                            tabindex="0" aria-selected="false">0.75x</li>
                                                        <li class="vjs-menu-item" role="button" aria-live="polite"
                                                            tabindex="0" aria-selected="false">0.5x</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="vjs-subtitles-button vjs-menu-button vjs-control " role="button"
                                                aria-live="polite" tabindex="0" aria-haspopup="true"
                                                aria-label="Subtitles Menu" style="display: none;">
                                                <div class="vjs-control-content"><span
                                                        class="vjs-control-text">Subtitles</span>
                                                    <div class="vjs-menu">
                                                        <ul class="vjs-menu-content">
                                                            <li class="vjs-menu-item vjs-selected" role="button"
                                                                aria-live="polite" tabindex="0" aria-selected="true">
                                                                subtitles off</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vjs-captions-button vjs-menu-button vjs-control " role="button"
                                                aria-live="polite" tabindex="0" aria-haspopup="true"
                                                aria-label="Captions Menu" style="display: none;">
                                                <div class="vjs-control-content"><span
                                                        class="vjs-control-text">Captions</span>
                                                    <div class="vjs-menu">
                                                        <ul class="vjs-menu-content">
                                                            <li class="vjs-menu-item vjs-selected" role="button"
                                                                aria-live="polite" tabindex="0" aria-selected="true">
                                                                captions off</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="vjs-chapters-button vjs-menu-button vjs-control " role="button"
                                                aria-live="polite" tabindex="0" aria-haspopup="true"
                                                aria-label="Chapters Menu" style="display: none;">
                                                <div class="vjs-control-content"><span
                                                        class="vjs-control-text">Chapters</span>
                                                    <div class="vjs-menu">
                                                        <ul class="vjs-menu-content">
                                                            <li class="vjs-menu-title">Chapters</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vjs-error-display">
                                            <div></div>
                                        </div>
                                    </div>

                                </div>
                                <p class="text-justify mt-2">For the next step: <br><br>
                                    1) Please watch the video to learn more about the process and <br>
                                    <br>
                                    2) Please send us an email at <a
                                        href="mailto:apply@china-admissions.com">apply@china-admissions.com</a> with
                                    your application ID
                                    and we will give you the update for the next steps.
                                </p>

                            </h2>


                        </div>
                    </div>

                    <!--State 3-->
                    <div class="block applicationStatus_wrapper d-none step-3">
                        <div class="topPart pink">
                            <div class="currentStatus">Current Status</div>
                            <h1 class=""><strong class="status-current-step">Application Started</strong></h1>
                            <br><strong>Next Step: <span class="status-next-step"></span></strong>
                            <!-- class: onStep1 / onStep2 / onStep3 is how you control the circle current stage -->
                            <div class="stepsWrapper onStep1">
                                <div class="movingDots"></div>
                                <div class="line"></div>
                                <div class="steps notPassed">
                                    <div class="circle"></div>
                                    <div class="name">1. Application</div>
                                </div>
                                <div class="steps">
                                    <div class="circle"></div>
                                    <div class="name">2. University Review</div>
                                </div>
                                <div class="steps">
                                    <div class="circle"></div>
                                    <div class="name">3. Registration Confirmation</div>
                                </div>
                            </div>

                        </div>

                        <div class="contentWrapper">
                            <hr>
                            <p class="nameOfSection">
                            </p>
                            <h3>Notes from China Admissions<br> Applications Officer:</h3>
                            <p></p>
                            <h2 class="notes"></h2>
                            <div class="button red solid sml" onclick="showForms()">
                                Complete your application</div>
                        </div>
                    </div>

                    <!--State 4-->
                    <div class="block applicationStatus_wrapper d-none step-4">
                        <div class="topPart green">
                            <div class="currentStatus">Current Status</div>
                            <h1 class=""><strong class="status-current-step">Application Started</strong></h1>
                            <br><strong>Next Step: <span class="status-next-step"></span></strong>
                            <!-- class: onStep1 / onStep2 / onStep3 is how you control the circle current stage -->
                            <div class="stepsWrapper onStep2">
                                <div class="movingDots"></div>
                                <div class="line"></div>
                                <div class="steps passed">
                                    <div class="circle"></div>
                                    <div class="name">1. Application</div>
                                </div>
                                <div class="steps">
                                    <div class="circle"></div>
                                    <div class="name">2. University Review</div>
                                </div>
                                <div class="steps">
                                    <div class="circle"></div>
                                    <div class="name">3. Registration Confirmation</div>
                                </div>
                            </div>

                        </div>

                        <div class="contentWrapper">
                            <hr>
                            <p class="nameOfSection">
                            </p>
                            <h3>Notes from China Admissions<br> Applications Officer:</h3>
                            <p></p>
                            <h2 class="notes"></h2>

                        </div>
                    </div>

                    <!--State 5-->
                    <div class="block applicationStatus_wrapper d-none step-5">
                        <div class="topPart green">
                            <div class="currentStatus">Current Status</div>
                            <h1 class=""><strong class="status-current-step">Application Started</strong></h1>
                            <br><strong>Next Step: <span class="status-next-step"></span></strong>
                            <!-- class: onStep1 / onStep2 / onStep3 is how you control the circle current stage -->
                            <div class="stepsWrapper onStep2">
                                <div class="movingDots"></div>
                                <div class="line"></div>
                                <div class="steps passed">
                                    <div class="circle"></div>
                                    <div class="name">1. Application</div>
                                </div>
                                <div class="steps passed">
                                    <div class="circle"></div>
                                    <div class="name">2. University Review</div>
                                </div>
                                <div class="steps">
                                    <div class="circle"></div>
                                    <div class="name">3. Registration Confirmation</div>
                                </div>
                            </div>

                        </div>

                        <div class="contentWrapper">
                            <hr>
                            <p class="nameOfSection">
                            </p>
                            <h3>Notes from China Admissions<br> Applications Officer:</h3>
                            <p></p>
                            <h2 class="notes"></h2>
                            <div class="button red solid sml" onclick="confirmArriEmail()"> Confirm Your Arrival</div>

                        </div>
                    </div>

                    <!--State 6-->
                    <div class="block applicationStatus_wrapper d-none step-6">
                        <div class="topPart pink">
                            <div class="currentStatus">Current Status</div>
                            <h1 class=""><strong class="status-current-step">Application Started</strong></h1>
                            <br><strong>Next Step: <span class="status-next-step"></span></strong>
                            <!-- class: onStep1 / onStep2 / onStep3 is how you control the circle current stage -->
                            <div class="stepsWrapper onStep2">
                                <div class="movingDots"></div>
                                <div class="line"></div>
                                <div class="steps passed">
                                    <div class="circle"></div>
                                    <div class="name">1. Application</div>
                                </div>
                                <div class="steps notPassed">
                                    <div class="circle"></div>
                                    <div class="name">2. University Review</div>
                                </div>
                                <div class="steps">
                                    <div class="circle"></div>
                                    <div class="name">3. Contact China Admissions</div>
                                </div>
                            </div>

                        </div>

                        <div class="contentWrapper">
                            <hr>
                            <p class="nameOfSection">
                            </p>
                            <h3>Notes from China Admissions<br> Applications Officer:</h3>
                            <p></p>
                            <h2 class="notes"></h2>
                            <div class="button red solid sml">Contact Us</div>

                        </div>
                    </div>

                    <!--State 7-->
                    <div class="block applicationStatus_wrapper d-none step-7">
                        <div class="topPart green">
                            <div class="currentStatus">Current Status</div>
                            <h1 class=""><strong class="status-current-step">Application Started</strong></h1>
                            <br><strong>Next Step: <span class="status-next-step"></span></strong>
                            <!-- class: onStep1 / onStep2 / onStep3 is how you control the circle current stage -->
                            <div class="stepsWrapper onStep3">
                                <div class="movingDots"></div>
                                <div class="line"></div>
                                <div class="steps passed">
                                    <div class="circle"></div>
                                    <div class="name">1. Application</div>
                                </div>
                                <div class="steps passed">
                                    <div class="circle"></div>
                                    <div class="name">2. University Review</div>
                                </div>
                                <div class="steps">
                                    <div class="circle"></div>
                                    <div class="name">3. Registration Confirmation</div>
                                </div>
                            </div>

                        </div>

                        <div class="contentWrapper">
                            <hr>
                            <p class="nameOfSection">
                            </p>
                            <h3>Notes from China Admissions<br> Applications Officer:</h3>
                            <p></p>
                            <h2 class="notes"></h2>
                            <div class="button red solid sml" onclick="confirmRegEmail()">Confirm Registration</div>
                        </div>
                    </div>

                    <!--State 8-->
                    <div class="block applicationStatus_wrapper d-none step-8">
                        <div class="topPart green">
                            <div class="currentStatus">Current Status</div>
                            <h1 class=""><strong class="status-current-step">Application Started</strong></h1>
                            <br><strong>Next Step: <span class="status-next-step"></span></strong>
                            <!-- class: onStep1 / onStep2 / onStep3 is how you control the circle current stage -->
                            <div class="stepsWrapper onStep3">
                                <div class="movingDots"></div>
                                <div class="line"></div>
                                <div class="steps passed">
                                    <div class="circle"></div>
                                    <div class="name">1. Application</div>
                                </div>
                                <div class="steps passed">
                                    <div class="circle"></div>
                                    <div class="name">2. University Review</div>
                                </div>
                                <div class="steps passed">
                                    <div class="circle"></div>
                                    <div class="name">3. Registration Confirmation</div>
                                </div>
                            </div>

                        </div>

                        <div class="contentWrapper">
                            <hr>
                            <p class="nameOfSection">
                            </p>
                            <h3>Notes from China Admissions<br> Applications Officer:</h3>
                            <p></p>
                            <h2 class="notes"></h2>
                            <div class="button red solid sml" onclick="leaveFeedback()">Leave Your Feedback</div>
                        </div>
                    </div>
                </div>

                <div class="content__inner application_forms">
                    <div class="container">
                        <!--content title-->
                        <h3 class="text-center mb-4">Your Application</h3>
                    </div>
                    <div class="container overflow-hidden">
                        <!--multisteps-form-->
                        <div class="multisteps-form">

                            <!--progress bar-->

                            {{-- <div class="row">
                                <div class="col-12 ml-auto mr-auto mb-4">
                                    <div class="multisteps-form__progress">

                                        <button class="multisteps-form__progress-btn js-active" type="button"
                                            title="Your information">
                                            Your Information
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Family">Your
                                            Family
                                        </button>
                                        <button id="agreement-nav" class="multisteps-form__progress-btn" type="button"
                                            title="Agreement">Declaration and Agreement
                                        </button>
                                        <button class="multisteps-form__progress-btn confirm-nav" type="button"
                                            title="Upload Documents">Upload Documents
                                        </button>
                                        <button id="" class="multisteps-form__progress-btn disabled"
                                            type="button" title="Final Step">Final Step
                                        </button>
                                    </div>
                                </div>
                            </div> --}}



                            <!--form panels-->
                            <div class="row">

                                <div class="col-12  m-auto p-0">
                                    <div class="multisteps-form__form">

                                        <!--about you panel-->
                                        <div id="scrollbarr" style="max-height: 100vh; overflow-y: auto;"
                                            class="multisteps-form__panel shadow p-4 rounded bg-white js-active"
                                            data-animation="scaleIn">

                                            <form action="{{ route('application.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <h5 class="multisteps-form__title">Contact Information</h5>

                                                <div class="multisteps-form__content">
                                                    <div class="form-row">

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="email" id="email" name="email"
                                                                    data-name="email" required="" placeholder="Email"
                                                                    class="form-control" maxlength=""
                                                                    value="{{ auth()->user()->email ?? '' }}">
                                                                <label for="email"
                                                                    class="form-control-placeholder">Email</label>

                                                                <div class="invalid-feedback">
                                                                    This field is required.
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">
                                                                <input type="tel" id="phone" name="phone"
                                                                    data-name="phone" required=""
                                                                    placeholder="Enter Phone Number"
                                                                    class="form-control form-control-lg pt-0 phone-input @error('phone') is-invalid @enderror"
                                                                    value="{{ auth()->user()->phone ?? '' }}">
                                                                <label for="phone" class="form-control-placeholder">
                                                                    Phone</label>

                                                                {{-- <span class="text-danger" id="output"></span> --}}
                                                                <div class="invalid-feedback">Please provide a valid
                                                                    contact
                                                                    number.
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <select name="country_of_residence" class="form-control"
                                                                    id="">
                                                                    <option value="Select country">Select Country</option>
                                                                    @foreach ($countries as $country)
                                                                        <option value="{{ $country->id }}">
                                                                            {{ $country->name }}</option>
                                                                    @endforeach


                                                                </select>
                                                                <label for="contact_id" class="form-control-placeholder">
                                                                    Country Of Residence
                                                                </label>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="text" id="address" name="address"
                                                                    data-name="address" required=""
                                                                    placeholder="address" class="form-control"
                                                                    maxlength="" value="">
                                                                <input type="hidden" name="program_name"
                                                                    value="{{ $program->name }}">
                                                                <label for="address"
                                                                    class="form-control-placeholder">Address</label>

                                                                <div class="invalid-feedback">
                                                                    This field is required.
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="text" id="postal_code" name="postal_code"
                                                                    data-name="postal_code" required=""
                                                                    placeholder="postal_code" class="form-control"
                                                                    maxlength="" value="">
                                                                <label for="postal_code"
                                                                    class="form-control-placeholder">Postal code</label>

                                                                <div class="invalid-feedback">
                                                                    This field is required.
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <h5 class="multisteps-form__title">Personal Information</h5>
                                                <div class="multisteps-form__content">
                                                    <div class="form-row ">
                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="text" id="full_name" name="full_name"
                                                                    data-name="full_name" required=""
                                                                    placeholder="full name (Given Name)"
                                                                    class="form-control" maxlength="" value="">
                                                                <label for="full_name" class="form-control-placeholder">
                                                                    Full name (Given Name)</label>

                                                                <div class="invalid-feedback">
                                                                    This field is required.
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="text" id="forenames" name="forenames"
                                                                    data-name="forenames" placeholder="ForeNames"
                                                                    class="form-control" maxlength="" value="">
                                                                <label for="forenames" class="form-control-placeholder">
                                                                    ForeNames</label>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="text" id="surname" name="surname"
                                                                    data-name="surname" required=""
                                                                    placeholder="Surname (Family name)"
                                                                    class="form-control" maxlength="" value="">
                                                                <label for="surname" class="form-control-placeholder">
                                                                    Surname (Family name)</label>

                                                                <div class="invalid-feedback">
                                                                    This field is required.
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="text" id="nationality" name="nationality"
                                                                    data-name="nationality" placeholder="nationality"
                                                                    class="form-control" maxlength="" value="">
                                                                <label for="nationality" class="form-control-placeholder">
                                                                    Nationality</label>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="date" id="date_of_birth"
                                                                    name="date_of_birth" data-name="date_of_birth"
                                                                    date-field="" data-date="Y-m-d" required=""
                                                                    placeholder="Date of birth"
                                                                    class="form-control flatpickr-input" maxlength=""
                                                                    value="">
                                                                <label for="date_of_birth"
                                                                    class="form-control-placeholder">
                                                                    Date of birth</label>

                                                                <div class="invalid-feedback">
                                                                    This field is required.
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="text" id="place_of_birth"
                                                                    name="place_of_birth" data-name="place_of_birth"
                                                                    placeholder="Place of birth" class="form-control"
                                                                    maxlength=""
                                                                    value="{{ $application->birth_place ?? '' }}">
                                                                <label for="place_of_birth"
                                                                    class="form-control-placeholder">
                                                                    Place of birth</label>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>



                                                <h5 class="multisteps-form__title">Passport Information</h5>

                                                <div class="multisteps-form__content">
                                                    <div class="form-row ">

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="text" id="passport_no" name="passport_no"
                                                                    data-name="passport_no" placeholder="Passport number"
                                                                    class="form-control" maxlength=""
                                                                    value="{{ $application->passport_number ?? '' }}">
                                                                <label for="passport_no" class="form-control-placeholder">
                                                                    Passport number</label>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="date" id="passport_issue_date"
                                                                    name="passport_issue_date"
                                                                    data-name="passport_issue_date" date-field=""
                                                                    data-date="Y-m-d" placeholder="Passport issue date"
                                                                    class="form-control flatpickr-input" maxlength=""
                                                                    value="">
                                                                <label for="passport_issue_date"
                                                                    class="form-control-placeholder">
                                                                    Passport expiry date</label>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="date" id="passport_expiration_date"
                                                                    name="passport_expiration_date"
                                                                    data-name="passport_expiration_date" date-field=""
                                                                    data-date="Y-m-d" placeholder="Passport expiry date"
                                                                    class="form-control flatpickr-input" maxlength=""
                                                                    value="">
                                                                <label for="passport_expiration_date"
                                                                    class="form-control-placeholder">
                                                                    Passport expiry date</label>

                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-sm-6">
                                                            <div class=" form-label-group mt-2">

                                                                <input type="text" id="issuing_authority"
                                                                    name="issuing_authority" data-name="issuing authority"
                                                                    date-field="" data-date="Y-m-d"
                                                                    placeholder="Issuing Authority"
                                                                    class="form-control flatpickr-input" maxlength=""
                                                                    value="">
                                                                <label for="issuing authority"
                                                                    class="form-control-placeholder">
                                                                    Issuing Authority</label>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <h5 class="multisteps-form__title">Emergency Contact Details</h5>
                                                <div class="form-row ">
                                                    <div class="col-12 col-sm-6">
                                                        <div class=" form-label-group mt-2">

                                                            <input type="text" id="emergency_name"
                                                                name="emergency_name" data-name="emergency_name"
                                                                required="" placeholder="emergency_name"
                                                                class="form-control" maxlength="" value="">
                                                            <label for="emergency_name"
                                                                class="form-control-placeholder">Emergency name</label>

                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class=" form-label-group mt-2">
                                                            <input type="tel" id="phone" name="emergency_phone"
                                                                data-name="phone" required=""
                                                                placeholder="Enter Phone Number"
                                                                class="form-control form-control-lg pt-0 phone-input @error('phone') is-invalid @enderror"
                                                                value="">
                                                            <label for="phone" class="form-control-placeholder">
                                                                Phone</label>

                                                            {{-- <span class="text-danger" id="output"></span> --}}
                                                            <div class="invalid-feedback">Please provide a valid
                                                                contact
                                                                number.
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class=" form-label-group mt-2">

                                                            <input type="text" id="relationship" name="relationship"
                                                                data-name="relationship" required=""
                                                                placeholder="relationship" class="form-control"
                                                                maxlength="" value="">
                                                            <label for="relationship"
                                                                class="form-control-placeholder">Relationship</label>

                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="col-12 col-sm-6">
                                                        <div class=" form-label-group mt-2">

                                                            <select name="relation_country" class="form-control"
                                                                id="relation_country">
                                                                <option value="Select country">Select Country
                                                                </option>

                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}">
                                                                        {{ $country->name }}</option>
                                                                @endforeach

                                                            </select>
                                                            <label for="relationship"
                                                                class="form-control-placeholder">Country</label>

                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                                <h5 class="multisteps-form__title">Higher Education Details</h5>
                                                <div class="form-row ">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" id="year_of_completion"
                                                                name="higher_year_of_completion"
                                                                data-name="year_of_completion" required
                                                                placeholder="Year of Completion" class="form-control"
                                                                maxlength="" value="">
                                                            <label for="year_of_completion"
                                                                class="form-control-placeholder">Year of
                                                                Completion</label>
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" id="degree_name"
                                                                name="higher_degree_name" data-name="degree_name" required
                                                                placeholder="Degree Name" class="form-control"
                                                                maxlength="" value="">
                                                            <label for="degree_name"
                                                                class="form-control-placeholder">Degree Name</label>
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" id="student_number"
                                                                name="higher_student_number" data-name="student_number"
                                                                required placeholder="Student Number" class="form-control"
                                                                maxlength="" value="">
                                                            <label for="student_number"
                                                                class="form-control-placeholder">Student Number</label>
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" id="major_subject"
                                                                name="higher_major_subject" data-name="major_subject"
                                                                required placeholder="Major Subject" class="form-control"
                                                                maxlength="" value="">
                                                            <label for="major_subject"
                                                                class="form-control-placeholder">Major Subject</label>
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" id="cgpa" name="higher_cgpa"
                                                                data-name="cgpa" required
                                                                placeholder="Cumulative Grade Point Average / Percentage"
                                                                class="form-control" maxlength="" value="">
                                                            <label for="cgpa"
                                                                class="form-control-placeholder">Cumulative Grade Point
                                                                Average / Percentage</label>
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="date" id="certificate_issue_date"
                                                                name="higher_certificate_issue_date"
                                                                data-name="certificate_issue_date" required
                                                                class="form-control" value="">
                                                            <label for="certificate_issue_date"
                                                                class="form-control-placeholder">Certificate Issue
                                                                Date</label>
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" id="school_university"
                                                                name="higher_school_university"
                                                                data-name="school_university" required
                                                                placeholder="School/University" class="form-control"
                                                                maxlength="" value="">
                                                            <label for="school_university"
                                                                class="form-control-placeholder">School/University</label>
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" id="country_of_completion"
                                                                name="higher_country_of_completion"
                                                                data-name="country_of_completion" required
                                                                placeholder="Country of Completion" class="form-control"
                                                                maxlength="" value="">
                                                            <label for="country_of_completion"
                                                                class="form-control-placeholder">Country of
                                                                Completion</label>
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" id="institution_address"
                                                                name="higher_institution_address"
                                                                data-name="institution_address" required
                                                                placeholder="Street Address of Institution"
                                                                class="form-control" maxlength="" value="">
                                                            <label for="institution_address"
                                                                class="form-control-placeholder">Street Address of
                                                                Institution</label>
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" id="institution_email"
                                                                name="higher_institution_email"
                                                                data-name="institution_email" required
                                                                placeholder="Street email of Institution"
                                                                class="form-control" maxlength="" value="">
                                                            <label for="institution_email"
                                                                class="form-control-placeholder">Email of
                                                                Institution</label>
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" id="institution_website"
                                                                name="higher_institution_website"
                                                                data-name="institution_website" required
                                                                placeholder="Street website of Institution"
                                                                class="form-control" maxlength="" value="">
                                                            <label for="institution_website"
                                                                class="form-control-placeholder">Website of
                                                                Institution</label>
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="d-flex justify-content-between w-100">
                                                    <h5 class="multisteps-form__title">Education Information</h5>
                                                    <div class="mt-3">
                                                        <button type="button" class="btn btn-primary"
                                                            id="add-school">Add School</button>
                                                    </div>
                                                </div>

                                                <div id="schools-container">
                                                    <div class="school-entry">
                                                        <div class="form-row">
                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-label-group mt-2">
                                                                    <input type="text" name="year_of_completion[]"
                                                                        required placeholder="Year of Completion"
                                                                        class="form-control">
                                                                    <label class="form-control-placeholder">Year of
                                                                        Completion</label>
                                                                    <div class="invalid-feedback">This field is required.
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-label-group mt-2">
                                                                    <input type="text" name="degree_name[]" required
                                                                        placeholder="Degree Name" class="form-control">
                                                                    <label class="form-control-placeholder">Degree
                                                                        Name</label>
                                                                    <div class="invalid-feedback">This field is required.
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-label-group mt-2">
                                                                    <input type="text" name="student_roll_number[]"
                                                                        required placeholder="Student Roll Number"
                                                                        class="form-control">
                                                                    <label class="form-control-placeholder">Student Roll
                                                                        Number</label>
                                                                    <div class="invalid-feedback">This field is required.
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-label-group mt-2">
                                                                    <input type="text" name="major_subject[]" required
                                                                        placeholder="Major Subject" class="form-control">
                                                                    <label class="form-control-placeholder">Major
                                                                        Subject</label>
                                                                    <div class="invalid-feedback">This field is required.
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-label-group mt-2">
                                                                    <input type="text" name="cgpa[]" required
                                                                        placeholder="Cumulative Grade Point Average / Percentage"
                                                                        class="form-control">
                                                                    <label class="form-control-placeholder">Cumulative
                                                                        Grade Point Average / Percentage</label>
                                                                    <div class="invalid-feedback">This field is required.
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-label-group mt-2">
                                                                    <input type="date"
                                                                        name="certificate_issue_date[]" required
                                                                        class="form-control">
                                                                    <label class="form-control-placeholder">Certificate
                                                                        Issue Date</label>
                                                                    <div class="invalid-feedback">This field is required.
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-label-group mt-2">
                                                                    <input type="text" name="school_university[]"
                                                                        required placeholder="School/University"
                                                                        class="form-control">
                                                                    <label
                                                                        class="form-control-placeholder">School/University</label>
                                                                    <div class="invalid-feedback">This field is required.
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-label-group mt-2">
                                                                    <input type="text" name="country_of_completion[]"
                                                                        required placeholder="Country of Completion"
                                                                        class="form-control">
                                                                    <label class="form-control-placeholder">Country of
                                                                        Completion</label>
                                                                    <div class="invalid-feedback">This field is required.
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-label-group mt-2">
                                                                    <input type="text" name="institution_address[]"
                                                                        required
                                                                        placeholder="Street Address of Institution"
                                                                        class="form-control">
                                                                    <label class="form-control-placeholder">Street Address
                                                                        of Institution</label>
                                                                    <div class="invalid-feedback">This field is required.
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-sm-6">
                                                                <div class="form-label-group mt-2">
                                                                    <input type="text" name="institution_website[]"
                                                                        placeholder="Institution Website"
                                                                        class="form-control">
                                                                    <label class="form-control-placeholder">Institution
                                                                        Website</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 text-right mt-3">
                                                                <button type="button"
                                                                    class="btn btn-danger remove-school">Remove
                                                                    School</button>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>

                                                <h5 class="multisteps-form__title">Language Proficiency Test</h5>
                                                <div class="form-row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" name="ielts_pte_score" required
                                                                placeholder="IELTS/PTE Academic Score"
                                                                class="form-control">
                                                            <label class="form-control-placeholder">IELTS/PTE Academic
                                                                Score</label>
                                                            <div class="invalid-feedback">This field is required.</div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" name="score_report_code" required
                                                                placeholder="Score Report Code" class="form-control">
                                                            <label class="form-control-placeholder">Score Report
                                                                Code</label>
                                                            <div class="invalid-feedback">This field is required.</div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="date" name="language_test_date" required
                                                                class="form-control">
                                                            <label class="form-control-placeholder">Date of the PTE/IELTS
                                                                Language Test</label>
                                                            <div class="invalid-feedback">This field is required.</div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" name="test_taker_id" required
                                                                placeholder="Test Taker ID" class="form-control">
                                                            <label class="form-control-placeholder">Test Taker ID</label>
                                                            <div class="invalid-feedback">This field is required.</div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-label-group mt-2">
                                                            <input type="text" name="registration_id" required
                                                                placeholder="Registration ID" class="form-control">
                                                            <label class="form-control-placeholder">Registration
                                                                ID</label>
                                                            <div class="invalid-feedback">This field is required.</div>
                                                        </div>
                                                    </div>
                                                </div>



                                                @if (!auth()->check())
                                                    <h5 class="multisteps-form__title">Complete Registration</h5>

                                                    <div class="form-row">
                                                        <div class="mb-3 col-12 col-sm-6 position-relative">
                                                            <label class="form-label mb-1" for="user_password">
                                                                Password
                                                                <!-- <small class="fs-sm text-muted">(min. 8 char)</small> -->
                                                            </label>
                                                            <input class="form-control form-control-lg" type="password"
                                                                id="user_password" name="password"
                                                                placeholder="Enter password" required="">
                                                            <span
                                                                style="position: absolute;    right: 10px;    top: 36px;    font-size: 20px;">
                                                                <a href="javascript:void(0)" onclick="viewpassword(1)">
                                                                    <div class="change-icon-1">
                                                                        <i class="fas fa-eye"></i>
                                                                    </div>
                                                                </a>
                                                            </span>

                                                            <div id="pswd_info" style="display: none">
                                                                <p id="length" class="invalid">Be at least <strong>8
                                                                        characters</strong></p>
                                                            </div>
                                                        </div>


                                                        <div class="mb-3 col-12 col-sm-6 position-relative">
                                                            <label class="form-label mb-1" for="user_cpassword">
                                                                Confirm Password </label>
                                                            <input class="form-control form-control-lg" type="password"
                                                                id="user_cpassword" name="user_cpassword"
                                                                placeholder="Confirm Password" required="">
                                                            <span
                                                                style="position: absolute; right: 10px; top: 36px; font-size: 20px;">
                                                                <a href="javascript:void(0)" onclick="viewpassword(2)">
                                                                    <div class="change-icon-2">
                                                                        <i class="fas fa-eye"></i>
                                                                    </div>
                                                                </a>
                                                            </span>


                                                            <div id="confirm-pswd_info" style="display: none">
                                                                <p id="length" class="invalid">Be at least <strong>8
                                                                        characters</strong></p>
                                                            </div>


                                                        </div>
                                                    </div>
                                                @endif


                                                <div class="button-row d-flex mt-4">

                                                    <button id="    " class="btn btn-primary-light-bg ml-auto"
                                                        type="submit">Submit
                                                        {{-- <i class="fa fa-arrow-right" aria-hidden="true"></i> --}}
                                                    </button>

                                                </div>
                                            </form>



                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="tooltip-container no-display" role="alertdialog" id="tooltipText" aria-hidden="true"
        aria-live="polite"></div>

    {{-- </main> --}}




    <div class="modal fade" id="delete_program" tabindex="-1" role="dialog" aria-labelledby="delete_program"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Program</h5>
                    <button type="button" class="close close-delete-program-modal" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body scroll-modal">
                    Are you sure you want to delete this program <strong id="program-name"></strong>
                    <!-- Form inside modal -->
                    <form id="delete-program-form" action="{{ route('application.program.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="application_id" id="application-id" value="">
                        <input type="hidden" name="program_id" id="program-id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-delete-program-modal"
                        data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary-light-bg" id="confirm-delete">Confirm</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="freeSrvModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">About Our Basic Service</h5>
                </div>
                <div class="modal-body">
                    <p>China Admissions basic service is limited to helping you apply to the university.</p>
                    <p>As part of our service, we will give you a document review and provide email support within 1-3 days.
                    </p>
                    <p>They will inform you directly about your application status.</p>
                    <p>If you would like more support please upgrade to our “Guaranteed Application Service”.</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="checkFreeSrv">
                        <label class="form-check-label" for="checkFreeSrv">
                            I confirm I understand the conditions and will continue with the basic service.
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-upgrade-srv"
                        data-bs-dismiss="modal">Upgrade</button>
                    <button type="button" class="btn btn-primary-light-bg ml-auto btn-confirm-free-srv"
                        title="Next">
                        <span class="title">Next</span>
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('cus_sc')


    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/intlTelInput.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const phoneInputs = document.querySelectorAll(".phone-input");

            phoneInputs.forEach((input) => {
                const output = document.createElement('div');
                output.className = 'validation-output';
                input.parentNode.insertBefore(output, input.nextSibling);

                const iti = window.intlTelInput(input, {
                    initialCountry: "auto",
                    nationalMode: true,
                    geoIpLookup: callback => {
                        fetch("https://ipapi.co/json")
                            .then(res => res.json())
                            .then(data => callback(data.country_code.toLowerCase()))
                            .catch(() => callback("bd"));
                    },
                    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@24.6.0/build/js/utils.js"
                });

                const handleChange = () => {
                    let text = "";
                    if (input.value) {
                        if (iti.isValidNumber()) {
                            text = `Valid number detected. International format: ${iti.getNumber()}`;
                            output.classList.remove('text-danger');
                            output.classList.add('text-success');
                        } else {
                            text = "Please enter a valid number";
                            output.classList.remove('text-success');
                            output.classList.add('text-danger');
                        }
                    } else {
                        text = "Please enter a valid number";
                        output.classList.remove('text-success');
                        output.classList.add('text-danger');
                    }
                    output.innerHTML = text;
                };

                input.addEventListener('change', handleChange);
                input.addEventListener('keyup', handleChange);
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.delete-prog-btn').on('click', function() {
                var programId = $(this).data('program-id');
                var programName = $(this).data('program-name');
                var applicationId = $(this).data('application-id');

                $('#program-id').val(programId);
                $('#application-id').val(applicationId);
                $('#program-name').text(programName + '?');

                $('#delete_program').modal('show');
            });

            $('#confirm-delete').on('click', function() {
                $('#delete-program-form').submit();
            });

            $('.close-delete-program-modal').on('click', function() {
                $('#delete_program').modal('hide');
            });
        });
    </script>

    <script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/application.js">
    </script>

    <script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/wnoty.js"></script>

    {{-- <script>
        var base_url = "{{ url('/') }}";
        var application_id = "{{ $application->id }}";
        var date = "{{ date('Y-m-d') }}";
    </script> --}}

    <script src="{{ asset('backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="{{ asset('backend/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('backend/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('backend/assets/js/misc.js') }}"></script>
    <script src="{{ asset('backend/assets/js/settings.js') }}"></script>
    <script src="{{ asset('backend/assets/js/todolist.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('backend/assets/js/toastDemo.js') }}"></script>
    <script src="{{ asset('backend/assets/js/tooltips.js') }}"></script>
    <script src="{{ asset('backend/assets/js/popover.js') }}"></script>
    <script
        src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/application_details.js">
    </script>
    <script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/new_application_d.js">
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add School Button
            document.getElementById("add-school").addEventListener("click", function() {
                let container = document.getElementById("schools-container");
                let newEntry = document.querySelector(".school-entry").cloneNode(true);
                newEntry.querySelectorAll("input").forEach(input => input.value =
                ""); // Clear cloned inputs
                container.appendChild(newEntry);

                // Enable all "Remove School" buttons after adding a new entry
                document.querySelectorAll(".remove-school").forEach(button => button.disabled = false);
            });

            // Remove School Button
            document.getElementById("schools-container").addEventListener("click", function(event) {
                if (event.target.classList.contains("remove-school")) {
                    let container = document.getElementById("schools-container");
                    let schoolEntries = container.querySelectorAll(".school-entry");

                    // Ensure at least one school entry remains
                    if (schoolEntries.length > 1) {
                        event.target.closest(".school-entry").remove();
                    }

                    // Disable "Remove School" button if only one entry is left
                    if (schoolEntries.length === 2) { // Check before removal
                        document.querySelectorAll(".remove-school").forEach(button => button.disabled =
                            true);
                    }
                }
            });

            // Disable "Remove School" button on page load if only one entry exists
            let initialSchoolEntries = document.querySelectorAll(".school-entry");
            if (initialSchoolEntries.length === 1) {
                document.querySelector(".remove-school").disabled = true;
            }
        });
    </script>

    @if (session('success'))
        <script>
            setTimeout(function() {
                showSuccessToast('{{ session('success') }}');
            }, 500);
        </script>
    @endif

    @if (session('error'))
        <script>
            setTimeout(function() {
                showDangerToast('{{ session('error') }}');
            }, 500);
        </script>
    @endif


    {{--
  "country_of_residence" => "141"
  "address" => "Nulla adipisci anim"
  "postal_code" => "Dolore laboriosam i"
  "full_name" => "Nora Olson"
  "forenames" => "Nomlanga Rodriguez"
  "surname" => "Joyner"
  "date_of_birth" => "23-Apr-2014"
  "place_of_birth" => "Incididunt alias fug"
  "passport_no" => "616"
  "passport_issue_date" => "10-Jun-2003"
  "passport_expiration_date" => "25-Dec-1988"
  "issuing_authority" => "Omnis molestiae et e"
  "emergency_name" => "Declan Sexton"
  "emergency_phone" => "+1 365-611-4717"
  "relationship" => "Consectetur tempore"
  "relation_country" => "4"
  "higher_year_of_completion" => "1974"
  "higher_degree_name" => "Jayme Burgess"
  "higher_student_number" => "834"
  "higher_major_subject" => "Aut voluptates animi"
  "higher_cgpa" => "Quos et reprehenderi"
  "higher_certificate_issue_date" => "2015-10-20"
  "higher_school_university" => "Ipsam aut ducimus v"
  "higher_country_of_completion" => "Magna commodi laboru"
  "higher_institution_address" => "Qui pariatur Modi s"
  "higher_institution_email" => "lemuhy@mailinator.com"
  "higher_institution_website" => "https://www.xasomogizofu.in"
  "ielts_pte_score" => "At et quia dolorem a"
  "score_report_code" => "Quo ab eu labore rep"
  "language_test_date" => "1976-07-28"
  "test_taker_id" => "Amet facere volupta"
  "registration_id" => "Laborum ea quibusdam"

   "year_of_completion" => array:2 [▶]
  "degree_name" => array:2 [▶]
  "student_roll_number" => array:2 [▶]
  "major_subject" => array:2 [▶]
  "cgpa" => array:2 [▶]
  "certificate_issue_date" => array:2 [▶]
  "school_university" => array:2 [▶]
  "country_of_completion" => array:2 [▶]
  "institution_address" => array:2 [▶]
  "institution_website" => array:2 [▶] --}}

@endsection
