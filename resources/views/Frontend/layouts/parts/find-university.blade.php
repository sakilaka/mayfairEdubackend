<div class="section-background-img py-4 pb-5 mt-5">

    @php
        $count = 0;
        $total = $homecontentlocations->count();
    @endphp

    @if ($total > 0)
        <div class="pt-4 d-none d-lg-block container">
            <h3 class="fw-bold text-dark-cerulean text-center font-dm-sans-title" style="margin-bottom: 2rem;">
                {{ $home_content->university_location_title }}
            </h3>

            @foreach ($homecontentlocations as $homecontentlocation)
                @php
                    $link = '';
                    $name = '';
                    $image = '';

                    switch ($homecontentlocation->type_loction_id) {
                        case '1':
                            $link = route('frontend.all_universities_list', [
                                'continent' => $homecontentlocation->continent?->id,
                            ]);
                            $name = $homecontentlocation->continent?->name;
                            $image = $homecontentlocation->continent?->image_show;
                            break;
                        case '2':
                            $link = route('frontend.all_universities_list', [
                                'continent' => $homecontentlocation->country?->continent_id,
                                'country' => $homecontentlocation->country?->id,
                            ]);
                            $name = $homecontentlocation->country?->name;
                            $image = $homecontentlocation->country?->image_show;
                            break;
                        case '3':
                            $link = route('frontend.all_universities_list', [
                                'continent' => $homecontentlocation->state?->country?->continent_id,
                                'country' => $homecontentlocation->state?->country_id,
                                'state' => $homecontentlocation->state?->id,
                            ]);
                            $name = $homecontentlocation->state?->name;
                            $image = $homecontentlocation->state?->image_show;
                            break;
                        case '4':
                            $link = route('frontend.all_universities_list', [
                                'continent' => $homecontentlocation->city?->state?->country?->continent_id,
                                'country' => $homecontentlocation->city?->state?->country_id,
                                'state' => $homecontentlocation->city?->state?->id,
                                'city' => $homecontentlocation->city?->id,
                            ]);
                            $name = $homecontentlocation->city?->name;
                            $image = $homecontentlocation->city?->image_show;
                            break;
                    }
                    $count++;
                @endphp

                @if ($count == 1)
                    <div class="row justify-content-center flex-nowrap">
                @endif

                @if ($count <= 2)
                    <div style="width: 50%">
                        <div class="embed-responsive embed-responsive-16by9" style="position: relative;">
                            <a href="{{ $link }}" class="d-flex justify-content-center align-items-center"
                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                                <p class="text-decoration-none text-white text-uppercase text_ellipse blog_title"
                                    style="font-size:1.2rem; text-align: center; font-weight: bold; text-shadow:2px 2px 4px rgba(0, 0, 0, 0.65);">
                                    {{ $name }}
                                </p>
                            </a>
                            <img style="height: 325px; border-radius:6px;"
                                src="{{ $image ?? asset('frontend/images/No-image.jpg') }}"
                                class="card-img-top embed-responsive-item lazyload" alt="">
                        </div>
                    </div>
                @else
                    @if ($count == 3)
        </div>
        <div class="row justify-content-center mt-3">
    @endif

    @if ($count > 2 && $count % 5 == 3)
</div>
<div class="row justify-content-center mt-3 {{ $count > 7 ? 'hidden-row' : '' }}"
    data-hidden-items="{{ $count > 7 ? 'hidden-item' : '' }}">
    @endif
    <div style="width: 20%; height:145.65px;">
        <div class="embed-responsive embed-responsive-1by1" style="position: relative;width: 100%; height: 100%;">
            <a href="{{ $link }}" class="d-flex justify-content-center align-items-center"
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                <p class="text-decoration-none text-white text-uppercase text_ellipse blog_title"
                    style="font-size:1.2rem; text-align: center; font-weight: bold; text-shadow:2px 2px 4px rgba(0, 0, 0, 0.65)">
                    {{ $name }}
                </p>
            </a>
            <img style="width: 100%; height: 100%; border-radius:6px; object-fit: cover;"
                src="{{ $image ?? asset('frontend/images/No-image.jpg') }}"
                class="card-img-top embed-responsive-item lazyload" alt="">
        </div>
    </div>

    @if ($count == $total)
</div>
@endif
@endif
@endforeach

@if ($count > 7)
    <div class="row justify-content-center">
        <div class="text-center mt-3 firstbutton">
            <button id="view-more-btn" class="btn btn-lg browse-more-btn btn-dark-cerulean" style="color: #fff">
                View More
            </button>
        </div>
    </div>
@endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.row[data-hidden-items="hidden-item"]');
        const button = document.getElementById('view-more-btn');

        let hasHiddenRows = false;
        rows.forEach(row => {
            if (row.classList.contains('hidden-row')) {
                hasHiddenRows = true;
            }
        });

        button.textContent = hasHiddenRows ? 'View More' : 'View Less';

        button.addEventListener('click', function() {
            if (button.textContent === 'View More') {
                rows.forEach(row => {
                    row.classList.remove('hidden-row');
                });
                button.textContent = 'View Less';
            } else {
                rows.forEach(row => {
                    row.classList.add('hidden-row');
                });
                button.textContent = 'View More';
            }
        });
    });
</script>

<style>
    .hidden-row {
        display: none;
    }
</style>
@endif

</div>
