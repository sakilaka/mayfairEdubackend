<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - Exhibitors</title>
</head>

<body>

    <div class="bg-section" style="height:auto;">
        <div class="container">
            <nav class="navbar navbar-expand-md shadow-none" style="z-index: 3">
                <div class="container d-flex justify-content-between">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ $ }}" alt="Logo"
                            class="logo">
                    </a>

                    @include('Expo.components.navbar')
                </div>
            </nav>
        </div>

        {{-- <div class="layer-image"></div> --}}
        <div class="bg-color"></div>
    </div>

    <section class="university-highlights my-5">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">Exhibitors</h2>
            </div>

            <div class="row justify-content-center mt-5">
                @forelse ($exhibitors as $exhibitor)
                    @php
                        $courses = App\Models\Course::where([
                            'university_id' => $exhibitor->id,
                            'status' => 1,
                        ])->get();

                        $course_count = count($courses) > 0 ? count($courses) : 100;

                        $available_scholarship = json_decode($exhibitor->scholarships, true) ?? [];
                    @endphp
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card university-card rounded-0 overflow-hidden" style="position: relative;">
                            <div class="card-body p-2" style="background-color: var(--primary_background)">
                                <div class="bg-white">
                                    <div style="position: relative;" class="overflow-hidden">
                                        <!-- Banner Image -->
                                        <img src="{{ env('APP_MAIN_DOMAIN') . '/upload/university/' . $exhibitor->banner_image }}"
                                            class="card-img-top banner-image rounded-0" alt="{{ $exhibitor->name }}"
                                            style="height: 150px; object-fit: cover; transition: transform 0.3s;">

                                        <!-- University Logo (Top-right corner) -->
                                        <img src="{{ env('APP_MAIN_DOMAIN') . '/upload/university/' . $exhibitor->image }}"
                                            alt="{{ $exhibitor->name }} Logo"
                                            style="position: absolute; top: 10px; right: 10px; width: 50px; height: 50px;">

                                        <div class="d-flex justify-content-center align-items-center mb-2 position-absolute w-100"
                                            style="bottom: 5px; left: 0; display: flex; justify-content: center; gap: 4px;">
                                            <div class="badge bg-primary"
                                                style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                                Bachelor</div>
                                            <div class="badge bg-success"
                                                style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                                Masters</div>
                                            <div class="badge bg-warning"
                                                style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                                Phd</div>
                                            <div class="badge bg-info"
                                                style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                                                Language</div>
                                        </div>
                                    </div>

                                    <div class="p-2">
                                        <h4 class="card-title"
                                            style="font-size: 16px; font-weight: bold; min-height: 40px;">
                                            {{ Illuminate\Support\Str::limit($exhibitor->name, 60, '...') }}
                                        </h4>
                                        <p class="card-subtitle" style="font-size: 15px;">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z" />
                                                </svg>
                                            </span>
                                            {{ Illuminate\Support\Str::limit($exhibitor->address, 30, '...') }}
                                        </p>

                                        <!-- Black border as divider -->
                                        <hr class="my-2" style="border-top: 2px solid black;">


                                        <p class="card-text">
                                            @php
                                                $uni_data = json_decode($exhibitor->display_data, true) ?? [];
                                            @endphp

                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                                                </svg>
                                            </span>
                                            World Ranking: {{ $uni_data['world_rank'] ?? 'N/A' }}<br>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12 12 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A20 20 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a20 20 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                                                </svg>
                                            </span>
                                            Country Ranking: {{ $uni_data['national_rank'] ?? 'N/A' }}<br>

                                            {{-- <span class="me-2">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-mortarboard-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917z" />
                                                    <path
                                                        d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466z" />
                                                </svg>
                                            </span>
                                            University type: {{ $uni_data['university_type'] ?? 'N/A' }} <br>
                                        </span> --}}
                                            <span class="me-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-book-half"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                                                    </svg>
                                                </span>
                                                Program: {{-- {{ $course_count }} --}} 50+ <br>
                                            </span>
                                            <span class="me-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-bell-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901" />
                                                    </svg>
                                                </span>
                                                Scholarships:
                                                {{ count($available_scholarship) > 0 ? 'Available' : 'Unavailable' }}
                                                <br>
                                            </span>
                                            <span class="me-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-people-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                                    </svg>
                                                </span>
                                                Total Students:
                                                {{ isset($uni_data['total_students']) ? $uni_data['total_students'] . '+' : 'N/A' }}
                                                <br>
                                            </span>
                                            <span class="me-2">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-translate"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286zm1.634-.736L5.5 3.956h-.049l-.679 2.022z" />
                                                        <path
                                                            d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm7.138 9.995q.289.451.63.846c-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6 6 0 0 1-.415-.492 2 2 0 0 1-.94.31" />
                                                    </svg>
                                                </span>
                                                Teaching language: English, Chinese
                                            </span>
                                        </p>
                                        <div class="text-center">
                                            <a href="{{ env('APP_MAIN_DOMAIN') . '/exhibitor/' . $exhibitor->id . '/details' }}"
                                                class="btn btn-primary-bg mx-auto px-5 rounded-0"
                                                target="_blank">Details</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">No Exhibitors Found!</p>
                @endforelse
            </div>

        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
