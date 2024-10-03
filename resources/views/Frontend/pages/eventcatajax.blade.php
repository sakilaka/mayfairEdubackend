@foreach ($events as $event)
    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
        <div class="course-card rounded-3 bg-white position-relative overflow-hidden">
            <div class="position-relative">
                <a href="{{ route('frontend.event.details', $event->id) }}" class="">
                    <img src="{{ $event->image_show ?? '' }}" class="img-fluid w-100 imgdiv" alt=""
                        style="object-fit: cover">
                    <div class="end-0 p-2 position-absolute start-0 top-1">
                        <span class="fw-semi-bold mb-1 py-1 px-2  rounded"
                            style="background-color: var(--secondary_background); color:#fff">
                            @if (@$event->release_id == '0')
                                Passed Event
                            @elseif(@$event->release_id == '1')
                                Upcoming Event
                            @else
                                Live Event
                            @endif
                        </span>
                    </div>

                    <div class="course-card_body bg-prussian-blue  p-3 top_shadow position-relative">
                        <h3 class="course-card__course--title text-uppercase fs-6 mb-3">
                            <a href="{{ route('frontend.event.details', $event->id) }}" class="text-decoration-none"
                                style="color: var(--btn_primary_color)">{{ $event->name }}</a>
                        </h3>
                        <table class="course-card__hints table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <div class="course-card__hints--icon me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12.354" height="17.188"
                                                    viewBox="0 0 12.354 17.188">
                                                    <path data-name="Path 9"
                                                        d="M72.537,15.308A.537.537,0,0,1,72,14.771V2.216A2.218,2.218,0,0,1,74.216,0h9.6a.537.537,0,0,1,.537.537V12.891a.537.537,0,1,1-1.074,0V1.074H74.216a1.143,1.143,0,0,0-1.141,1.141V14.771A.537.537,0,0,1,72.537,15.308Z"
                                                        transform="translate(-72)" fill="var(--btn_primary_color)" />
                                                    <path data-name="Path 10"
                                                        d="M83.817,372.834h-9.4a2.417,2.417,0,1,1,0-4.834h9.4a.537.537,0,1,1,0,1.074h-9.4a1.343,1.343,0,0,0,0,2.686h9.4a.537.537,0,1,1,0,1.074Z"
                                                        transform="translate(-72 -355.646)"
                                                        fill="var(--btn_primary_color)" />
                                                    <path data-name="Path 11"
                                                        d="M137.937,425.074h-9.4a.537.537,0,1,1,0-1.074h9.4a.537.537,0,0,1,0,1.074Z"
                                                        transform="translate(-126.12 -409.766)"
                                                        fill="var(--btn_primary_color)" />
                                                    <path data-name="Path 12"
                                                        d="M144.537,13.428a.537.537,0,0,1-.537-.537V.537a.537.537,0,1,1,1.074,0V12.891A.537.537,0,0,1,144.537,13.428Z"
                                                        transform="translate(-141.582)"
                                                        fill="var(--btn_primary_color)" />
                                                </svg>
                                            </div>
                                            <div class="fw-bold">
                                                {{ date('d F', strtotime($event->startdate)) }}-{{ date('d F', strtotime($event->enddate)) }}
                                                {{-- ( 1 days) --}}

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            <div class="course-card__hints--icon me-2">
                                                <svg data-name="clock (1)" xmlns="http://www.w3.org/2000/svg"
                                                    width="16.706" height="16.706" viewBox="0 0 16.706 16.706">
                                                    <path data-name="Path 13"
                                                        d="M8.353,0a8.353,8.353,0,1,0,8.353,8.353A8.363,8.363,0,0,0,8.353,0Zm0,15.662a7.309,7.309,0,1,1,7.309-7.309,7.317,7.317,0,0,1-7.309,7.309Z"
                                                        fill="var(--btn_primary_color)" />
                                                    <path data-name="Path 14"
                                                        d="M208.838,83.118h-1.044v5.437l3.285,3.285.738-.738-2.979-2.979Z"
                                                        transform="translate(-199.963 -79.985)"
                                                        fill="var(--btn_primary_color)" />
                                                </svg>
                                            </div>
                                            <div class="course-card__hints--text fw-bold">
                                                {{ date('h:i A', strtotime($event->startdate)) }}-{{ date('h:i A', strtotime($event->enddate)) }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">

                                            <div class="course-card__hints--icon me-3">
                                                <svg id="document" xmlns="http://www.w3.org/2000/svg" width="17.26"
                                                    height="14.926" viewBox="0 0 17.26 14.926">
                                                    <path id="Path_148" data-name="Path 148"
                                                        d="M16.065,17.081H1.2a1.2,1.2,0,0,0-1.2,1.2V28.364a1.2,1.2,0,0,0,1.2,1.2h8.67l-.262,1.6a.69.69,0,0,0,1.041.75l1.871-.985a.393.393,0,0,1,.248,0l1.871.985a.834.834,0,0,0,.388.1.656.656,0,0,0,.387-.123.726.726,0,0,0,.266-.728l-.262-1.6h.651a1.2,1.2,0,0,0,1.2-1.2V18.277A1.2,1.2,0,0,0,16.065,17.081ZM12.64,27.511a2.084,2.084,0,1,1,2.084-2.084A2.086,2.086,0,0,1,12.64,27.511Zm.6,2.5a1.383,1.383,0,0,0-1.2,0l-1.323.7.42-2.565a3.1,3.1,0,0,0,3.007,0l.164,1v.005l.256,1.56Zm2.994-1.651a.173.173,0,0,1-.171.171h-.819l-.187-1.142s0-.009,0-.013a3.108,3.108,0,1,0-4.831,0l0,.013-.187,1.142H1.2a.173.173,0,0,1-.171-.171V18.277a.173.173,0,0,1,.171-.171H16.065a.173.173,0,0,1,.171.171Z"
                                                        transform="translate(0 -17.081)"
                                                        fill="var(--btn_primary_color)" />
                                                    <path id="Path_149" data-name="Path 149"
                                                        d="M43.246,60.243H31.631a.512.512,0,0,0,0,1.025H43.246a.512.512,0,0,0,0-1.025Z"
                                                        transform="translate(-28.993 -57.295)"
                                                        fill="var(--btn_primary_color)" />
                                                    <path id="Path_150" data-name="Path 150"
                                                        d="M36.55,100.911H31.631a.512.512,0,0,0,0,1.025H36.55a.512.512,0,0,0,0-1.025Z"
                                                        transform="translate(-28.993 -95.184)"
                                                        fill="var(--btn_primary_color)" />
                                                </svg>
                                            </div>
                                            <div class="course-card__hints--text fs-12 fw-bold">
                                                {{ @$event->organization_name }}</div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </a>
            </div>
            <div class="course-card_footer g-2 p-3">
                <div class="d-flex justify-content-between align-items-stretch">
                    @php
                        $check_event = 0;
                        if (auth()->check()) {
                            $save = \App\Models\EventCart::where('event_id', $event->id)
                                ->where('user_id', auth()->user()->id)
                                ->first();
                            if ($save) {
                                $check_event = 1;
                            }
                        }
                    @endphp

                    <div class="flex-grow-1">
                        <a type="button"
                            class="align-items-center btn btn-dark-cerulean d-flex justify-content-between px-2 w-100"
                            href="{{ route('frontend.event.details', $event->id) }}">

                            <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect width="15.5325" height="15.5325" transform="matrix(-1 0 0 1 15.8613 0.721741)"
                                    fill="url(#pattern0)" />
                                <defs>
                                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                        height="1">
                                        <use xlink:href="#image0_228_160" transform="scale(0.00653595)" />
                                    </pattern>
                                    <image id="image0_228_160" width="153" height="153"
                                        xlink:href="data:image/png;base64,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" />
                                </defs>
                            </svg>
                            <span class="w-100" style="color: #fff">Details</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@if ($events->count() == 0)
    <div class="text-center">
        <h2>Events Not Found !</h2>
    </div>
@endif
