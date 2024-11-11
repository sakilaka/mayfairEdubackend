<style>
    .university {
        transition: 0.3s;
        height: 100% !important;
    }

    .university-showcase-container .university-image-container .university-image {
        transition: transform 0.3s;
        transform-origin: center center;
        opacity: 1;
        width: 6.125rem !important;
        height: 5.375rem !important;
        object-fit: contain !important;
        -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
        transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
    }

    .university:hover {
        border-color: var(--secondary_background);

        .university-showcase-container .university-image-container .university-image {
            -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1.05) scaleY(1.05);
            transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1.05) scaleY(1.05);
        }
    }

    .university_name:hover {
        color: var(--secondary_background) !important;
    }

    .university-course-container {
        height: 330px !important;
    }

    @media (min-width: 1260px) and (max-width: 1430px) {
        .university-course-container {
            height: 375px !important;
        }
    }

    .course-nav-tab .btn-dark-cerulean {
        color: #fff;
        background-color: var(--secondary_background) !important;
        border-color: var(--secondary_background) !important;
    }

    .course-nav-tab .btn-dark-cerulean:hover {
        color: #fff;
        background-color: var(--primary_background) !important;
        border-color: var(--primary_background) !important;
    }

    .course_nav_tabs::-webkit-scrollbar {
        width: 0px;
        display: none;
    }

    .course-nav-tab-subtitle {
        position: relative;
        display: flex;
        align-items: center;
        color: var(--btn_primary_color);
    }

    .course-nav-tab-subtitle .line {
        width: 30px;
        height: 1px;
        background-color: var(--btn_primary_color);
        margin-right: 10px;
    }

    .course-nav-tab-subtitle .text-uppercase {
        font-weight: 500;
    }

    .browse-more-btn.btn-dark-cerulean {
        color: #fff;
        background-color: var(--secondary_background) !important;
        border-color: var(--secondary_background) !important;
    }

    .browse-more-btn.btn-dark-cerulean:hover {
        color: #fff;
        background-color: var(--primary_background) !important;
        border-color: var(--primary_background) !important;
    }

    .course-university-image-container img {
        transition: transform 0.3s;
        transform-origin: center center;
        opacity: 1;
        width: 6.125rem !important;
        height: 5.375rem !important;
        object-fit: contain !important;
        -webkit-transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
        transform: perspective(0px) rotateX(0deg) rotateY(0deg) scaleX(1) scaleY(1);
    }
</style>

<div>
    <div class="row justify-content-start gy-4 gx-3">
        @foreach ($university_courses as $course)
            @php
                // Retrieve partner_ref_id and applied_by from session or query parameters
                $partnerRef = session('partner_ref_id') ?? request()->query('partner_ref_id');
                $appliedBy = session('applied_by') ?? request()->query('applied_by');

                // Set up the URL parameters
                $apply_url_params = ['id' => $course->id];
                $course_details_url_params = ['id' => $course->id];
                $course_list_url_params = [];

                // Add partner_ref_id and applied_by to the parameters if they are set
                if ($partnerRef) {
                    $apply_url_params['partner_ref_id'] = $partnerRef;
                    $course_details_url_params['partner_ref_id'] = $partnerRef;
                    $course_list_url_params['partner_ref_id'] = $partnerRef;
                }

                if ($appliedBy) {
                    $apply_url_params['applied_by'] = $appliedBy;
                    $course_details_url_params['applied_by'] = $appliedBy;
                    $course_list_url_params['applied_by'] = $appliedBy;
                }

                // Add is_anonymous if it is set in the session
                if (session('is_anonymous')) {
                    $apply_url_params['is_anonymous'] = 'true';
                    $course_details_url_params['is_anonymous'] = 'true';
                    $course_list_url_params['is_anonymous'] = 'true';
                }

                // Generate the routes with the parameters
                $apply_url = route('apply_cart', $apply_url_params);
                $course_details_url = route('frontend.course.details', $course_details_url_params);
                $course_list_url = route('frontend.university_course_list', $course_list_url_params);
            @endphp

            @if ($course->university)
                <div class="col-12 col-md-6 col-lg-4 col-auto mt-sm-3 mt-md-4">
                    <div class="text-center card university" style="border-radius:8px; cursor: pointer;"
                        onclick="window.location.href='{{ $course_details_url }}'">
                        <div class="card-body university-course-container" style="padding: 1rem 0.65rem !important">
                            <div class="course-university-image-container">
                                <a href="{{ $course_details_url }}">
                                    <img decoding="async" src="{{ @$course->university?->image_show ?? '' }}"
                                        alt="{{ $course->university?->name ?? '' }}"
                                        title="{{ $course->university?->name ?? '' }}" style="border-radius: 8px"
                                        class="university-image">
                                </a>
                            </div>
                            <div class="mt-3">
                                <div>
                                    <a href="{{ $course_details_url }}" class="text-dark university_name"
                                        style="text-decoration: none">
                                        <h5 style="font-size: 0.95rem;" class="fw-bold mb-2">
                                            {{ Illuminate\Support\Str::limit($course->name, 30, '...') }}
                                        </h5>
                                    </a>
                                    <div style="font-size: 0.9rem">
                                        {{ Illuminate\Support\Str::limit($course->university?->address, 30, '...') }}
                                    </div>
                                </div>
                                <div style="position: absolute; bottom: 0.65rem; width: 90%;">
                                    <!--Start Course Hints-->
                                    <table class="course-card__hints table table-borderless table-sm mb-2">
                                        <tbody>
                                            <tr>
                                                <td width="80" class="ps-0 border-0">
                                                    <div class="d-flex align-items-start">
                                                        <div class="course-card__hints--icon me-2">
                                                            <div class="d-flex align-items-start">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span></span>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="course-card__hints--text fs-12 fw-bold"
                                                            style="color: #131313">
                                                            {{ Illuminate\Support\Str::limit($course->university?->name, 35, '...') }}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="80" class="ps-0 border-0">
                                                    <div class="d-flex align-items-start">
                                                        <div class="course-card__hints--icon me-2">
                                                            <div class="d-flex align-items-start">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span></span>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="course-card__hints--text fs-12 fw-bold"
                                                            style="color: #131313">
                                                            Major:
                                                            {{ Illuminate\Support\Str::limit($course->department?->name, 25, '...') }}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="ps-0 border-0">
                                                    <div class="d-flex align-items-start">
                                                        <div class="course-card__hints--icon me-2">
                                                            <svg id="document" xmlns="http://www.w3.org/2000/svg"
                                                                width="17.26" height="14.926"
                                                                viewBox="0 0 17.26 14.926">
                                                                <path id="Path_148" data-name="Path 148"
                                                                    d="M16.065,17.081H1.2a1.2,1.2,0,0,0-1.2,1.2V28.364a1.2,1.2,0,0,0,1.2,1.2h8.67l-.262,1.6a.69.69,0,0,0,1.041.75l1.871-.985a.393.393,0,0,1,.248,0l1.871.985a.834.834,0,0,0,.388.1.656.656,0,0,0,.387-.123.726.726,0,0,0,.266-.728l-.262-1.6h.651a1.2,1.2,0,0,0,1.2-1.2V18.277A1.2,1.2,0,0,0,16.065,17.081ZM12.64,27.511a2.084,2.084,0,1,1,2.084-2.084A2.086,2.086,0,0,1,12.64,27.511Zm.6,2.5a1.383,1.383,0,0,0-1.2,0l-1.323.7.42-2.565a3.1,3.1,0,0,0,3.007,0l.164,1v.005l.256,1.56Zm2.994-1.651a.173.173,0,0,1-.171.171h-.819l-.187-1.142s0-.009,0-.013a3.108,3.108,0,1,0-4.831,0l0,.013-.187,1.142H1.2a.173.173,0,0,1-.171-.171V18.277a.173.173,0,0,1,.171-.171H16.065a.173.173,0,0,1,.171.171Z"
                                                                    transform="translate(0 -17.081)"
                                                                    fill="var(--secondary_background)" />
                                                                <path id="Path_149" data-name="Path 149"
                                                                    d="M43.246,60.243H31.631a.512.512,0,0,0,0,1.025H43.246a.512.512,0,0,0,0-1.025Z"
                                                                    transform="translate(-28.993 -57.295)"
                                                                    fill="var(--secondary_background)" />
                                                                <path id="Path_150" data-name="Path 150"
                                                                    d="M36.55,100.911H31.631a.512.512,0,0,0,0,1.025H36.55a.512.512,0,0,0,0-1.025Z"
                                                                    transform="translate(-28.993 -95.184)"
                                                                    fill="var(--secondary_background)" />
                                                            </svg>
                                                        </div>
                                                        <div class="course-card__hints--text fs-12 fw-bold"
                                                            style="color: #131313">
                                                            Degree:
                                                            {{ Illuminate\Support\Str::limit($course->degree?->name, 25, '...') }}
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <!--End Course Hints-->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="fw-bold">
                                            @php
                                                $scholarship = $course->scholarship;

                                                // Calculate yearly tuition fee
                                                $yearly_tuition_fee =
                                                    $scholarship?->tuition_fee == 1
                                                        ? 'Free'
                                                        : $course->year_fee - ($scholarship?->tuition_fee ?? 0);

                                                // Calculate accommodation fee
                                                $accommodation_fee =
                                                    $scholarship?->accommodation_fee == 1
                                                        ? 'Free'
                                                        : $course->accommodation_fee -
                                                            ($scholarship?->accommodation_fee ?? 0);

                                                // Calculate insurance fee
                                                $insurance_fee =
                                                    $scholarship?->insurance_fee == 1
                                                        ? 'Free'
                                                        : $course->insurance_fee - ($scholarship?->insurance_fee ?? 0);

                                                // Check if all fees are 'Free'
                                                $all_free =
                                                    $yearly_tuition_fee == 'Free' &&
                                                    $accommodation_fee == 'Free' &&
                                                    $insurance_fee == 'Free';

                                                if ($all_free) {
                                                    $main_value = 'Free';
                                                } else {
                                                    $main_value = 0;

                                                    $main_value +=
                                                        $yearly_tuition_fee != 'Free' ? $yearly_tuition_fee : 0;
                                                    $main_value +=
                                                        $accommodation_fee != 'Free' ? $accommodation_fee : 0;
                                                    /* $main_value += $insurance_fee != 'Free' ? $insurance_fee : 0;
                                                    $main_value += $course->visa_extension_fee;
                                                    $main_value += $course->medical_in_china_fee; */
                                                }

                                                // Calculate the original total fee before scholarships
                                                $cut_value =
                                                    ($course->year_fee ?? 0) + ($course->accommodation_fee ?? 0);
                                            @endphp

                                            <p class="mb-0 text-start"
                                                style="color: var(--primary_color); font-size:14px;">Yearly Fee</p>
                                            <p class="mb-0" style="color: var(--primary_color)">
                                                <span style="font-size: 14px" class="fw-bold">
                                                    {{ $main_value == 0 || $main_value == 'Free' ? 'Free' : convertCurrency($main_value) }}
                                                </span>
                                                <span style="font-size: 11px">
                                                    <del>
                                                        @convertCurrency($cut_value ?? 0)
                                                    </del>
                                                </span>
                                            </p>
                                        </div>
                                        @if (strtotime(@$course->application_deadline) < strtotime(now()))
                                            <a href="javascript:void(0)" class="btn btn-secondary-bg px-2 py-1"
                                                style="text-decoration: none; background-color: #6c757d; cursor: not-allowed; pointer-events: none;">
                                                Apply Now
                                            </a>
                                        @else
                                            <a href="{{ $apply_url }}" class="btn btn-secondary-bg px-2 py-1"
                                                style="text-decoration: none">
                                                Apply Now
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($loop->iteration == 3)
                @php
                    break;
                @endphp
            @endif
        @endforeach
    </div>

    <div class="university-aside-item__body text-center mt-3">
        @php
            $partnerRef_2 = session('partner_ref_id') ?? request()->query('partner_ref_id');
            $appliedBy_2 = session('applied_by') ?? request()->query('applied_by');

            $apply_url_params_2['id'] = $university->id;

            if ($partnerRef_2) {
                $apply_url_params_2['partner_ref_id'] = $partnerRef_2;
            }

            if ($appliedBy_2) {
                $apply_url_params_2['applied_by'] = $appliedBy_2;
            }

            if (session('is_anonymous')) {
                $apply_url_params_2['is_anonymous'] = 'true';
            }

            $all_programs_url_2 = route('frontend.single_course', $apply_url_params_2);
        @endphp

        <button class="university-header__btn btn btn--primary btn--md px-3 js-call-modal"
            onclick="window.location.href='{{ $all_programs_url_2 }}'">
            View All Programs
        </button>
    </div>
</div>
