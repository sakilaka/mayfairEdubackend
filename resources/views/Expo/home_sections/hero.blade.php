<div class="bg-section">
    <div class="container">
        <nav class="navbar navbar-expand-md shadow-none" style="z-index: 3">
            <div class="container d-flex justify-content-between">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('frontend/expo-domain/images/vector_smart_object_3.png') }}" alt="Logo"
                        class="logo">
                </a>

                @include('Expo.components.navbar')
            </div>
        </nav>
    </div>

    {{-- <div class="layer-image"></div> --}}
    <div class="bg-color"></div>

    <div style="width: 100%; height:100%;" class="d-flex justify-content-center align-items-center">
        <div class="container row justify-content-center justify-content-md-start align-items-center mb-md-5 pb-md-5">
            <div class="col-md-10 p-4 pb-5" style="position: relative; z-index: 3;">
                <div>
                    {{-- <h2 class="main-heading text-white fw-semibold">Biggest Expo In Bangladesh</h2> --}}
                    <h1 class="main-title text-white fw-bold">{{ $expo['title'] }}</h1>
                </div>
                <p class="location-text text-white">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                            class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path
                                d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                        </svg>
                    </span>
                    <span class="text-style fw-bold">BICC(Former Bangladesh-China Friendship Conference Center)</span><br>
                    Agargaon, Sher-E-Bangla Nagar, Dhaka-1207, Bangladesh
                </p>

                <div class="rectangle-3-copy-holder text-white">
                    <a href="http://studyinchinaexhibition.com/expo-sign-up" class="btn btn-light fw-bold btn-responsive mb-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-vcard" viewBox="0 0 16 16">
                                <path
                                    d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                                <path
                                    d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z" />
                            </svg>
                        </span>
                        Registration
                    </a>
                    <a href="https://maps.app.goo.gl/Tkx7Et7Lk8gZjbgV6" target="_blank" class="btn text-white fw-bold btn-responsive mb-2">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                class="bi bi-map-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v14a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.5.5 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5zM5 14.09V1.11l.5-.1.5.1v12.98l-.402-.08a.5.5 0 0 0-.196 0zm5 .8V1.91l.402.08a.5.5 0 0 0 .196 0L11 1.91v12.98l-.5.1z" />
                            </svg>
                        </span>
                        View Location
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
