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
        <div class="container row justify-content-center justify-content-md-around align-items-center mb-md-5 pb-md-5">
            <div class="col-md-11 p-4 pb-5 pt-md-0" style="position: relative; z-index: 3;">
                <div>
                    <h2 class="main-heading text-white fw-bold">The 2nd</h2>
                    <h1 class="main-title text-white fw-bold">
                        Belt and Road Chinese University and Overseas Partner Exchange Conference
                    </h1>
                </div>
                <div>
                    <div>
                        <p style="font-size: 16px;" class="text-white mb-0">Organizer:</p>
                        <p class="location-text text-white">
                            <span class="text-style fw-bold">Guangzhou MalishaEdu Co. Ltd.</span>
                        </p>
                    </div>
                    <div>
                        <p style="font-size: 16px;" class="text-white mb-0">Co-Organizer:</p>
                        <p class="location-text text-white">
                            <span class="text-style fw-bold">The Belt and Road Chinese Center (BRCC) and Easy
                                Link</span>
                        </p>
                    </div>
                    <div>
                        <p style="font-size: 16px;" class="text-white mb-0">Venue:</p>
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
                            Agargaon, Sher-E-Bangla Nagar, Dhaka-1207, Bangladesh
                        </p>
                    </div>
                </div>

                <div
                    class="d-flex flex-column flex-md-row mx-auto align-items-center justify-content-center p-2 border hero-bottom-location-container">
                    <div class="d-flex align-items-center me-3">
                        <i class="bi bi-calendar2-event" style="color: #4CAF50;"></i>
                        <span class="ms-2">21<sup>st</sup> & 22<sup>nd</sup> November, 2024</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="bi bi-geo-alt" style="color: #4CAF50;"></i>
                        <span class="ms-2">Guangzhou, China</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
