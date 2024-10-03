<div class="counter-content pt-3 pb-4" style="margin-top: 4rem;">
    <div class="container-lg">
        <div class="text-center mb-5">
            <h3 class="ca-card-title d-block text-center mb-4 font-dm-sans-title">
                {{ $home_content->counting_title }}</h3>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-6 col-md-3 py-4 text-center {{-- border-end --}}" style="color: var(--text_color)">
                        <div class="mb-2">
                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                aria-hidden="true" style="height: 3rem; fill: var(--secondary_background);">
                                <g id="users1_layer">
                                    <path
                                        d="M320 64c57.99 0 105 47.01 105 105s-47.01 105-105 105-105-47.01-105-105S262.01 64 320 64zm113.463 217.366l-39.982-9.996c-49.168 35.365-108.766 27.473-146.961 0l-39.982 9.996C174.485 289.379 152 318.177 152 351.216V412c0 19.882 16.118 36 36 36h264c19.882 0 36-16.118 36-36v-60.784c0-33.039-22.485-61.837-54.537-69.85zM528 300c38.66 0 70-31.34 70-70s-31.34-70-70-70-70 31.34-70 70 31.34 70 70 70zm-416 0c38.66 0 70-31.34 70-70s-31.34-70-70-70-70 31.34-70 70 31.34 70 70 70zm24 112v-60.784c0-16.551 4.593-32.204 12.703-45.599-29.988 14.72-63.336 8.708-85.69-7.37l-26.655 6.664C14.99 310.252 0 329.452 0 351.477V392c0 13.255 10.745 24 24 24h112.169a52.417 52.417 0 0 1-.169-4zm467.642-107.09l-26.655-6.664c-27.925 20.086-60.89 19.233-85.786 7.218C499.369 318.893 504 334.601 504 351.216V412c0 1.347-.068 2.678-.169 4H616c13.255 0 24-10.745 24-24v-40.523c0-22.025-14.99-41.225-36.358-46.567z">
                                    </path>
                                </g>
                            </svg>
                        </div>

                        <h3 class="fw-bold h1 mb-1">
                            <span class="counter d-inline-block"
                                style="color: var(--primary_background)">{{ $home_content->count_num_1 }}+</span>
                        </h3>
                        <div style="color: var(--primary_background)">{{ $home_content->count_text_1 }}</div>
                    </div>

                    <div class="col-6 col-md-3 py-4 text-center" style="color: var(--text_color)">
                        <div class="mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="online-class"
                                style="height: 3rem; fill: var(--secondary_background);">
                                <g>
                                    <path
                                        d="M59 2H5a3 3 0 0 0-3 3v34a3 3 0 0 0 3 3h54a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3Zm-3 34H31.923A11.121 11.121 0 0 0 9.77 36H8V8h48Z">
                                    </path>
                                    <path
                                        d="M33.058 28.885a1 1 0 0 0 1.278 1.278L38 28.853a10.072 10.072 0 1 0-3.636-3.636Zm10.013-16.806a8.071 8.071 0 1 1-4.4 14.833 1 1 0 0 0-.883-.1l-2.132.761.762-2.132a1 1 0 0 0-.105-.883 8.069 8.069 0 0 1 6.762-12.475Z">
                                    </path>
                                    <circle cx="10" cy="48" r="3"></circle>
                                    <path d="M2.242 61a1 1 0 0 0 1 1h13.209a1 1 0 0 0 1-1 7.6 7.6 0 0 0-15.209 0Z">
                                    </path>
                                    <circle cx="32" cy="48" r="3"></circle>
                                    <path d="M24.242 61a1 1 0 0 0 1 1h13.209a1 1 0 0 0 1-1 7.6 7.6 0 0 0-15.209 0Z">
                                    </path>
                                    <circle cx="54" cy="48" r="3"></circle>
                                    <path
                                        d="M46.242 61a1 1 0 0 0 1 1h13.209a1 1 0 0 0 1-1 7.6 7.6 0 0 0-15.209 0zm-25.16-39.867a4.067 4.067 0 1 0-4.067-4.066 4.071 4.071 0 0 0 4.067 4.066zM41.488 23.6l5.572-2.983a.5.5 0 0 0 .006-.878l-5.572-3.081a.5.5 0 0 0-.742.438v6.063a.5.5 0 0 0 .736.441z">
                                    </path>
                                </g>
                            </svg>
                        </div>

                        <h3 class="fw-bold h1 mb-1">
                            <span class="counter d-inline-block"
                                style="color: var(--primary_background)">{{ $home_content->count_num_2 }}+</span>
                        </h3>
                        <div style="color: var(--primary_background)">{{ $home_content->count_text_2 }}</div>
                    </div>

                    <div class="col-6 col-md-3 py-4 text-center {{-- border-end border-top --}}" style="color: var(--text_color)">
                        <div class="mb-2">
                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"
                                aria-hidden="true" style="height: 3rem; fill: var(--secondary_background);">
                                <g id="language3_layer">
                                    <path
                                        d="M304 416H24c-13.255 0-24-10.745-24-24V120c0-13.255 10.745-24 24-24h280v320zm-120.676-72.622A12 12 0 0 0 194.839 352h22.863c8.22 0 14.007-8.078 11.362-15.861L171.61 167.085a12 12 0 0 0-11.362-8.139h-32.489a12.001 12.001 0 0 0-11.362 8.139L58.942 336.139C56.297 343.922 62.084 352 70.304 352h22.805a12 12 0 0 0 11.535-8.693l9.118-31.807h60.211l9.351 31.878zm-39.051-140.42s4.32 21.061 7.83 33.21l10.8 37.531h-38.07l11.07-37.531c3.51-12.15 7.83-33.21 7.83-33.21h.54zM616 416H336V96h280c13.255 0 24 10.745 24 24v272c0 13.255-10.745 24-24 24zm-36-228h-64v-16c0-6.627-5.373-12-12-12h-16c-6.627 0-12 5.373-12 12v16h-64c-6.627 0-12 5.373-12 12v16c0 6.627 5.373 12 12 12h114.106c-6.263 14.299-16.518 28.972-30.023 43.206-6.56-6.898-12.397-13.91-17.365-20.933-3.639-5.144-10.585-6.675-15.995-3.446l-7.28 4.346-6.498 3.879c-5.956 3.556-7.693 11.421-3.735 17.117 6.065 8.729 13.098 17.336 20.984 25.726-8.122 6.226-16.841 12.244-26.103 17.964-5.521 3.41-7.381 10.556-4.162 16.19l7.941 13.896c3.362 5.883 10.935 7.826 16.706 4.276 12.732-7.831 24.571-16.175 35.443-24.891 10.917 8.761 22.766 17.102 35.396 24.881 5.774 3.556 13.353 1.618 16.717-4.27l7.944-13.903c3.213-5.623 1.37-12.76-4.135-16.171a312.737 312.737 0 0 1-26.06-18.019c21.024-22.425 35.768-46.289 42.713-69.85H580c6.627 0 12-5.373 12-12v-16c0-6.625-5.373-11.998-12-11.998z">
                                    </path>
                                </g>
                            </svg>
                        </div>

                        <h3 class="fw-bold h1 mb-1">
                            <span class="counter d-inline-block"
                                style="color: var(--primary_background)">{{ $home_content->count_num_3 }}+</span>
                        </h3>
                        <div style="color: var(--primary_background)">{{ $home_content->count_text_3 }}</div>
                    </div>

                    <div class="col-6 col-md-3 py-4 text-center {{-- border-top --}}" style="color: var(--text_color)">
                        <div class="mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" id="graduation-cap"
                                style="height: 3rem; fill: var(--secondary_background);">
                                <g>
                                    <path
                                        d="M47,15,24,3,1,15,24,27c11.11-5.79,10-5.12,10-5.41L23.52,15.88a1,1,0,0,1,1-1.76l11,6c1,.58-.54,1.17,2.52-.42Z">
                                    </path>
                                    <path
                                        d="M24 29.26L10 22V29c0 5.24 15.1 8.11 24 4.19V24.05zM38 29V22l-2 1v9.09A4 4 0 0 0 38 29zM34 24.05L36 23V21c0-.37.16-.34-2 .79zM34 39.28c-1.33.77-1 1.91-1 5.72h4V41a2 2 0 0 0-1-1.72V32.09a11 11 0 0 1-2 1.1z">
                                    </path>
                                </g>
                            </svg>
                        </div>

                        <h3 class="fw-bold h1 mb-1">
                            <span class="counter d-inline-block"
                                style="color: var(--primary_background)">{{ $home_content->count_num_4 }}+</span>
                        </h3>
                        <div style="color: var(--primary_background)">{{ $home_content->count_text_4 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
