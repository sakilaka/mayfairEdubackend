<style>
    .blog-card {
        border-radius: 8px;
        overflow: hidden;
        transition: 0.35s;
        cursor: pointer;
    }

    .blog-card:hover {
        box-shadow: 0px 0px 20px -10px rgb(120 200 159);
    }

    .blog-title {
        font-weight: bold !important;
        color: var(--secondary_background);
        font-size: 20px;
    }

    .latest-date {
        background-color: var(--primary_background);
        border-radius: 50%;
        height: 50px;
        width: 50px;
    }

    .latest-date span {
        color: #fff;
        font-size: 1.75rem;
        font-weight: 700;
    }

    .latest-month {
        margin: 8px auto 0;
        text-align: center;
    }

    .latest-month span {
        font-size: 1rem;
        font-weight: 600;
    }

    .image-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: flex-end;
    }

    .image-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .image-wrapper * {
        position: relative;
        z-index: 2;
    }

    .latest-highlight-content p,
    .latest-highlight-content .blog-title {
        color: #fff;
    }
</style>

@php
    $home_content = App\Models\HomeContentSetup::first();
@endphp
<section class="blog-section" style="margin-bottom: 5rem; margin-top:3rem;">
    <div class="container">
        <div class="row" style="margin-top: 1.5rem;">
            <div class="col-12">
                <h2 style="color: var(--secondary_background); font-family:'DM Sans', sans-serif; font-weight:700">
                    Latest Updates
                </h2>
                <hr>
            </div>
        </div>

        <div class="row justify-content-center section-background px-md-3 py-4" style="border-radius: 8px">
            @php
                $latest_updates = json_decode($home_content['latest_updates'], true);
                if (!empty($latest_updates)) {
                    $firstUpdate = $latest_updates[0];
                    $firstCategory = array_key_first($firstUpdate);
                    $firstItemId = $firstUpdate[$firstCategory];

                    if ($firstCategory == 'blog') {
                        $firstDetails = $home_content->getBlogDetails($firstItemId);
                        $redirectURL = route('frontend.blog_details', ['id' => $firstItemId]);
                    } elseif ($firstCategory == 'event') {
                        $firstDetails = $home_content->getEventDetails($firstItemId);
                        $redirectURL = route('frontend.event.details', ['id' => $firstItemId]);
                    } elseif ($firstCategory == 'expo') {
                        $firstDetails = $home_content->getExpoDetails($firstItemId);
                        $redirectURL = route('expo.details', ['id' => $firstItemId]);
                    }
                }
            @endphp

            @if (!empty($latest_updates))
                <!-- Left Side - Highlighted Content -->
                <div class="col-md-6 px-md-3 latest-highlight">
                    <div id="highlighted-card" class="image-wrapper p-4 px-md-3 px-lg-5"
                        style="cursor: pointer; background-image: url('{{ $firstDetails->image_show ?? asset('frontend/images/header-banner.webp') }}')"
                        onclick="location.href='{{ $redirectURL ?? 'javascript:void(0)' }}'">
                        <div class="latest-highlight-content">
                            <div class="border-bottom border-light mb-3">
                                <p class="fw-bold" id="highlighted-date">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                                    </svg>
                                    <span>{{ $firstDetails->date ?? (date('d M, Y', strtotime($firstDetails->created_at)) ?? 'N/A') }}</span>
                                </p>
                            </div>

                            <div>
                                <h4 class="blog-title" id="highlighted-title">
                                    {{ Illuminate\Support\Str::limit($firstDetails->title ?? ($firstDetails->name ?? 'Untitled'), 100, '...') }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Other Updates -->
                <div class="col-md-6 px-md-3 mt-4 bg-white mt-md-0">
                    <div class="d-flex flex-column px-0 mx-0">
                        @foreach ($latest_updates as $key => $latest_update)
                            @if ($key != 0)
                                @php
                                    $category = array_key_first($latest_update);
                                    $itemId = $latest_update[$category];

                                    if ($category == 'blog') {
                                        $details = $home_content->getBlogDetails($itemId);
                                        $redirectURL = route('frontend.blog_details', ['id' => $itemId]);
                                    } elseif ($category == 'event') {
                                        $details = $home_content->getEventDetails($itemId);
                                        $redirectURL = route('frontend.event.details', ['id' => $itemId]);
                                    } elseif ($category == 'expo') {
                                        $details = $home_content->getExpoDetails($itemId);
                                        $redirectURL = route('expo.details', ['id' => $itemId]);
                                    }
                                @endphp

                                <div class="row justify-content-between px-0 py-3 mx-0 my-2 blog-card card-clickable"
                                    data-title="{{ $details->title ?? $details->name }}"
                                    data-image="{{ $details->image_show ?? asset('frontend/images/header-banner.webp') }}"
                                    data-date="{{ \Carbon\Carbon::parse($details->created_at)->format('d M, Y') }}"
                                    data-redirect="{{ $redirectURL }}">
                                    <div class="col-2">
                                        <div
                                            class="mx-auto latest-date d-flex justify-content-center align-items-center">
                                            <span>{{ \Carbon\Carbon::parse($details->created_at)->format('d') }}</span>
                                        </div>
                                        <div class="mx-auto latest-month">
                                            <span>{{ \Carbon\Carbon::parse($details->created_at)->format('M') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-10">
                                        <h4 class="blog-title">
                                            {{ Illuminate\Support\Str::limit($details->title ?? $details->name, 100, '...') }}
                                        </h4>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

    </div>
</section>
