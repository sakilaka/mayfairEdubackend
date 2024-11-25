<div class="bg-section">
    <div class="container">
        <nav class="navbar navbar-expand-lg shadow-none" style="z-index: 3">
            <div class="container d-flex justify-content-between">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ $additional_contents['nav_logo'] ?? '' }}" alt="Logo"
                        class="logo">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @include('Expo.components.navbar')
            </div>
        </nav>
    </div>

    {{-- <div class="layer-image"></div> --}}
    <div class="bg-color"></div>

    <div style="width: 100%; height:100%;" class="d-flex justify-content-center align-items-center">
        <div
            class="container mx-auto row justify-content-center justify-content-md-around align-items-center mb-md-5 pb-md-5">
            <div class="col-md-12 p-4 pb-5 pt-md-0" style="position: relative; z-index: 3;">
                <div>
                    @if ($additional_contents['pre_title'])
                        <h2 class="main-heading text-white fw-bold">{{ $additional_contents['pre_title'] }}</h2>
                    @endif

                    <h1 class="main-title text-white fw-bold">
                        {{ $expo->title }}
                    </h1>
                </div>
                <div>
                    <div>
                        <p style="font-size: 16px; color: var(--secondary_background);" class="mb-0 fw-600">Organizer:
                        </p>
                        <p class="location-text text-white">
                            <span class="text-style fw-bold">
                                {{ $additional_contents['organizerDetails']['name'] ?? '' }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p style="font-size: 16px; color: var(--secondary_background);" class="mb-0 fw-600">
                            Co-Organizer:</p>
                        <p class="location-text text-white">
                            <span class="text-style fw-bold">
                                {{ $additional_contents['co_organizerDetails']['name'] ?? '' }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <p style="font-size: 16px; color: var(--secondary_background);" class="mb-0 fw-600">Venue:
                        </p>
                        <p class="location-text text-white">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                    class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                </svg>
                            </span>
                            <span class="text-style fw-bold">
                                {{ $place['venue'] ?? '' }}
                            </span>
                            <br>
                            {{ $place['address'] ?? '' }}
                        </p>
                    </div>
                </div>

                <div
                    class="d-flex flex-column flex-md-row mx-auto align-items-center justify-content-center p-2 px-4 border hero-bottom-location-container">
                    <div class="d-flex align-items-center me-md-3">
                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="currentColor" viewBox="0 0 24 24"
                            style="fill: var(--secondary_background)">
                            <path fill-rule="evenodd"
                                d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="ms-2">{{ $datetime['date'] ?? '' }}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            style="fill: var(--secondary_background)" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="ms-2">{{ $datetime['time_from'] . ' to ' . $datetime['time_to'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
