<div class="bg-section">
    <div class="container">
        <nav class="navbar navbar-expand-lg shadow-none" style="z-index: 3">
            <div class="container d-flex justify-content-between">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('frontend/expo-domain/images/vector_smart_object_3.png') }}" alt="Logo"
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
                    <h2 class="main-heading text-white fw-bold">The 2nd</h2>
                    <h1 class="main-title text-white fw-bold">
                        Belt and Road Chinese University and Overseas Partner Exchange Conference
                    </h1>
                </div>
                <div>
                    <div>
                        <p style="font-size: 16px; color: var(--secondary_background);" class="mb-0 fw-600">Organizer:
                        </p>
                        <p class="location-text text-white">
                            <span class="text-style fw-bold">Guangzhou MalishaEdu Co. Ltd.</span>
                        </p>
                    </div>
                    <div>
                        <p style="font-size: 16px; color: var(--secondary_background);" class="mb-0 fw-600">
                            Co-Organizer:</p>
                        <p class="location-text text-white">
                            <span class="text-style fw-bold">The Belt and Road Chinese Center (BRCC) and Easy
                                Link</span>
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
                            <span class="text-style fw-bold">BICC(Former Bangladesh-China Friendship Conference
                                Center)</span>
                            <br>
                            Agargaon, Sher-E-Bangla Nagar, Dhaka-1207, Bangladesh
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

                        <span class="ms-2">21<sup>st</sup> & 22<sup>nd</sup> November, 2024</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 70 70" viewBox="0 0 70 70"
                            id="map" width="24" height="24" style="fill: var(--secondary_background)">
                            <path d="M36.1,31.4v18.5l11-6.1V20.4l-4.7,2.5C40.4,26.5,37.2,30.2,36.1,31.4z"></path>
                            <polygon points="22.9 46.3 33.9 50.2 33.9 39 22.9 36.7"></polygon>
                            <polygon points="9.6 51.8 20.7 46.4 20.7 37.8 9.6 47.6"></polygon>
                            <path
                                d="M35,10c-4,0-7.2,3.2-7.2,7.2c0,3.1,4.7,9.1,7.2,12.1c2.6-3,7.2-9.1,7.2-12.1C42.2,13.2,39,10,35,10z M35,21.1
                                c-2.1,0-3.8-1.7-3.8-3.8c0-2.1,1.7-3.8,3.8-3.8s3.8,1.7,3.8,3.8C38.8,19.4,37.1,21.1,35,21.1z">
                            </path>
                            <polygon points="36.1 60 47.1 54.1 47.1 46.3 36.1 52.4"></polygon>
                            <polygon points="22.9 54.1 33.9 60 33.9 52.6 22.9 48.6"></polygon>
                            <polygon points="9.6 60 20.7 54.1 20.7 48.9 9.6 54.3"></polygon>
                            <path d="M22.9,20.4v14.1l11,2.3v-5.3c-1.1-1.2-4.3-4.9-6.4-8.6L22.9,20.4z"></path>
                            <polygon points="49.3 20.3 49.3 54.1 60.4 60 60.4 26.2"></polygon>
                            <polygon points="9.6 44.6 20.7 34.9 20.7 20.3 9.6 26.2"></polygon>
                        </svg>
                        <span class="ms-2">Guangzhou, China</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
