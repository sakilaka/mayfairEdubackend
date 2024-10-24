@php
    $additional_contents = json_decode($expo->additional_contents, true) ?? [];
    $footer_contents = json_decode($expo->footer_contents, true) ?? [];
@endphp
<section class="red-section-bg py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                @if ($footer_contents['organizer_name'])
                    <p class="text-light text-center mb-0">
                        <span class="fw600">Organizer:</span> {{ $footer_contents['organizer_name'] ?? '' }}
                    </p>
                @endif

                @if ($footer_contents['co_organizer_name'])
                    <p class="text-light text-center mb-0">
                        <span class="fw600">Co-Organizer:</span> {{ $footer_contents['co_organizer_name'] ?? '' }}
                    </p>
                @endif

                @if ($footer_contents['supported_by'])
                    <p class="text-light text-center mb-0">
                        <span class="fw600">Supported by:</span> {{ $footer_contents['supported_by'] ?? '' }}
                    </p>
                @endif

            </div>

            <div class="row justify-content-center align-items-center mt-3">
                <div class="col-md-3">
                    <div class="text-center">
                        <a href="{{ $additional_contents['organizerDetails']['redirect_url'] }}" target="_blank"
                            class="text-decoration-none">
                            <img class="vector-smart-object-3 img-fluid" width="150"
                                src="{{ $footer_contents['organizerLogo'] ?? '' }}" alt="">
                            <p class="text-light mt-2">{{ $additional_contents['organizerDetails']['redirect_url'] }}
                            </p>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <a href="{{ $additional_contents['co_organizerDetails']['redirect_url'] }}" target="_blank"
                            class="text-decoration-none">
                            <img class="vector-smart-object-3 img-fluid" width="150"
                                src="{{ $footer_contents['co_organizerLogo'] ?? '' }}" alt="">
                            <p class="text-light mt-2">{{ $additional_contents['co_organizerDetails']['redirect_url'] }}
                            </p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center align-items-center mt-3">
                <style>
                    .footer_social {
                        margin-top: 1.5rem !important;
                    }

                    div.footer_social_icons_container {
                        color: var(--primary_background);
                        background-color: #fff;
                        padding: 8px !important;
                        margin: 0 3px;
                        margin-top: 5px;
                        border-radius: 50%;
                        transition: 0.3s;
                        text-align: center !important;
                        cursor: pointer;
                    }

                    div.footer_social_icons_container:hover {
                        background-color: var(--primary_background_hover);
                        color: white;
                        transform: scale(1.05);
                    }
                </style>
                <script>
                    function openInNewTab(url) {
                        window.open(url, '_blank', 'noopener,noreferrer');
                    }
                </script>

                <div class="col-12">
                    <div class="d-flex flex-wrap justify-content-center">
                        @foreach ($footer_contents['social']['type'] ?? [] as $key => $social_type)
                            @switch($social_type)
                                @case('facebook')
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $footer_contents['social']['url'][$key] ?? '#' }}')"
                                            data-toggle="tooltip"
                                            title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
                                            <svg class="w-[40px] h-[40px] text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                @break

                                @case('instagram')
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $footer_contents['social']['url'][$key] ?? '#' }}"
                                            data-toggle="tooltip"
                                            title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
                                            <svg class="w-[40px] h-[40px] text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </div>
                                @break

                                @case('twitter')
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $footer_contents['social']['url'][$key] ?? '#' }}')"
                                            data-toggle="tooltip"
                                            title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
                                            <svg class="w-[40px] h-[40px] text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                @break

                                @case('linkedin')
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $footer_contents['social']['url'][$key] ?? '#' }}')"
                                            data-toggle="tooltip"
                                            title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M12.51 8.796v1.697a3.738 3.738 0 0 1 3.288-1.684c3.455 0 4.202 2.16 4.202 4.97V19.5h-3.2v-5.072c0-1.21-.244-2.766-2.128-2.766-1.827 0-2.139 1.317-2.139 2.676V19.5h-3.19V8.796h3.168ZM7.2 6.106a1.61 1.61 0 0 1-.988 1.483 1.595 1.595 0 0 1-1.743-.348A1.607 1.607 0 0 1 5.6 4.5a1.601 1.601 0 0 1 1.6 1.606Z"
                                                    clip-rule="evenodd" />
                                                <path d="M7.2 8.809H4V19.5h3.2V8.809Z" />
                                            </svg>

                                        </div>
                                    </div>
                                @break

                                @default
                                    {{ '&nbsp;' }}
                            @endswitch
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
