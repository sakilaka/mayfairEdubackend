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
        height: 370px !important;
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

    .program-top-right-degree {
        position: absolute;
        top: 0;
        right: 0;
        font-size: 14px;
        color: #fff;
        padding: 3px 8px;
        font-weight: 600;
    }

    .university-tag {
        background-color: #ff0015b5;
        padding: 2px 4px;
        border-radius: 4px;
        font-size: 12px;
        color: #fff;
        font-weight: 600;
        white-space: nowrap;
    }
</style>

<div class="container-lg">
    <div class="row justify-content-center gy-4 gx-3">
        @if (count($related_courses) > 0)
            <div class="text-center">
                <h3 class="ca-card-title d-block text-center mb-4 font-dm-sans-title">Related Programs</h3>
            </div>
        @endif

        @foreach ($related_courses as $item)
            @php
                $course = App\Models\Course::find($item->relatedcourse_id);
            @endphp

            @php
                if (session('partner_ref_id')) {
                    $partnerRef = session('partner_ref_id');
                } elseif (request()->query('partner_ref_id')) {
                    $partnerRef = request()->query('partner_ref_id');
                } else {
                    $partnerRef = null;
                }

                if ($partnerRef) {
                    $apply_url_params = ['id' => $course->id, 'partner_ref_id' => $partnerRef];
                    $course_details_url_params = [
                        'id' => $course->id,
                        'partner_ref_id' => $partnerRef,
                    ];
                    $course_list_url_params = ['partner_ref_id' => $partnerRef];

                    if (session('is_anonymous')) {
                        $apply_url_params['is_anonymous'] = 'true';
                        $course_details_url_params['is_anonymous'] = 'true';
                        $course_list_url_params['is_anonymous'] = 'true';
                    }

                    if (session('is_applied_partner')) {
                        $apply_url_params['is_applied_partner'] = true;
                        $course_details_url_params['is_applied_partner'] = true;
                        $course_list_url_params['is_applied_partner'] = true;
                    }

                    $apply_url = route('apply_cart', $apply_url_params);
                    $course_details_url = route('frontend.course.details', $course_details_url_params);
                    $course_list_url = route('frontend.university_course_list', $course_list_url_params);
                } else {
                    $apply_url = route('apply_cart', [
                        'id' => $course->id,
                    ]);

                    $course_details_url = route('frontend.course.details', [
                        'id' => $course->id,
                    ]);

                    $course_list_url = route('frontend.university_course_list');
                }
            @endphp

            @if ($course->university)
                <div class="col-12 col-md-6 col-lg-3 col-auto mt-sm-3 mt-md-4">
                    <div class="text-center card university overflow-hidden" style="border-radius:8px; cursor: pointer;"
                        onclick="window.location.href='{{ $course_details_url }}'">
                        <div class="card-body university-course-container mt-4">
                            <div class="course-university-image-container">
                                <a href="{{ $course_details_url }}">
                                    <img decoding="async" src="{{ @$course->university?->image_show }}"
                                        alt="{{ $course->university?->name }}" title="{{ $course->university?->name }}"
                                        style="border-radius: 8px" class="university-image">
                                </a>
                            </div>
                            <div class="mt-4">
                                <div class="mt-3">
                                    <a href="{{ $course_details_url }}" class="text-dark university_name">
                                        <h5 style="font-size: 1.25rem;" class="fw-bold">
                                            {{ Illuminate\Support\Str::limit($course->name, 35, '...') }}
                                        </h5>
                                    </a>
                                </div>
                                <div style="position: absolute; bottom: 0.85rem; width: 90%;">

                                    <div class="tags py-0 pt-2 d-flex flex-column">
                                        <div class="mobile-title">
                                            <div class="d-flex flex-column">
                                                <div class="my-2 mt-4 text-center">
                                                    @forelse (json_decode($course->university?->tags, true) ?? [] as $index => $tag)
                                                        @php
                                                            $colors = ['#357A61', '#302C61'];
                                                            $backgroundColor = $colors[$index % count($colors)];
                                                        @endphp
                                                        <span class="university-tag mx-1 mt-2"
                                                            style="background-color: {{ $backgroundColor }};">
                                                            {{ $tag }}
                                                        </span>
                                                    @empty
                                                        <span>&nbsp;</span>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>

                                        <span class="mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-mortarboard-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z" />
                                                <path
                                                    d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z" />
                                            </svg>
                                            {{ Illuminate\Support\Str::limit($course->university?->name, 35, '...') }}
                                        </span>
                                        <span class="mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                class="bi bi-geo-alt-fill" viewBox="0 0 16 16" style="fill:#494949">
                                                <path
                                                    d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                            </svg>
                                            @php
                                                $locationParts = array_filter([
                                                    /* $course->university?->continent?->name ?? '', */
                                                    /* $course->university?->country?->name ?? '', */
                                                    $course->university?->state?->name ?? '',
                                                    $course->university?->city?->name ?? '',
                                                ]);
                                            @endphp

                                            {{ implode(', ', $locationParts) }}
                                        </span>

                                        <div class="mt-1">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    class="bi bi-translate" viewBox="0 0 16 16" style="fill:#494949">
                                                    <path
                                                        d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286zm1.634-.736L5.5 3.956h-.049l-.679 2.022z" />
                                                    <path
                                                        d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm7.138 9.995q.289.451.63.846c-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6 6 0 0 1-.415-.492 2 2 0 0 1-.94.31" />
                                                </svg>
                                                {{ @$course->language?->name }}
                                            </span>

                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                                                </svg>
                                                @php
                                                    $display_data = json_decode(
                                                        $course->university?->display_data,
                                                        true,
                                                    );
                                                @endphp

                                                World Ranking:
                                                {{ $display_data['world_rank'] ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <div class="fw-bold"
                                            style="color: var(--secondary_background); font-size:0.85rem;">
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
                                                    /* $main_value +=
                                                                            $insurance_fee != 'Free'
                                                                                ? $insurance_fee
                                                                                : 0;
                                                                        $main_value += $course->visa_extension_fee;
                                                                        $main_value += $course->medical_in_china_fee; */
                                                }

                                                // Calculate the original total fee before scholarships
                                                $cut_value =
                                                    ($course->year_fee ?? 0) + ($course->accommodation_fee ?? 0);
                                            @endphp

                                            <p class="mb-0 text-start">Yearly Fee</p>
                                            <p class="mb-0">
                                                <span style="font-size: 16px">
                                                    {{ $main_value == 0 || $main_value == 'Free' ? 'Free' : convertCurrency($main_value) }}
                                                </span>
                                                <span style="font-size: 13px">
                                                    <del>
                                                        @convertCurrency($cut_value ?? 0)
                                                    </del>
                                                </span>
                                            </p>
                                        </div>
                                        @if (strtotime(@$course->application_deadline) < strtotime(now()))
                                            <a href="javascript:void(0)" class="btn btn-dark-cerulean"
                                                style="background-color: #6c757d !important; border-color: #6c757d !important; cursor: not-allowed !important; pointer-events: none !important;">
                                                <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/cart.png"
                                                    style="width: 14px;">
                                                Apply Now
                                            </a>
                                        @else
                                            <a href="{{ $apply_url }}" class="btn btn-dark-cerulean">
                                                <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/cart.png"
                                                    style="width: 14px;">
                                                Apply Now
                                            </a>
                                        @endif

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="position-absolute program-top-right-degree"
                            style="background-color: var(--primary_background)">
                            {{ $course->degree?->name }}
                        </div>
                    </div>
                </div>
            @endif

            @if ($loop->iteration == 8)
                @php
                    break;
                @endphp
            @endif
        @endforeach
    </div>
</div>
