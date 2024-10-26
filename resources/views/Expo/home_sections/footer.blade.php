@php
    $additional_contents = json_decode($expo->additional_contents, true) ?? [];
    $footer_contents = json_decode($expo->footer_contents, true) ?? [];
@endphp
<section class="red-section-bg py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                @if (isset($footer_contents['organizer_name']))
                    <p class="text-light text-center mb-0">
                        <span class="fw600">Organizer:</span> {{ $footer_contents['organizer_name'] ?? '' }}
                    </p>
                @endif

                @if (isset($footer_contents['co_organizer_name']))
                    <p class="text-light text-center mb-0">
                        <span class="fw600">Co-Organizer:</span> {{ $footer_contents['co_organizer_name'] ?? '' }}
                    </p>
                @endif

                @if (isset($footer_contents['supported_by']))
                    <p class="text-light text-center mb-0">
                        <span class="fw600">Supported by:</span> {{ $footer_contents['supported_by'] ?? '' }}
                    </p>
                @endif

            </div>

            <div class="row justify-content-center align-items-center mt-3">
                <div class="col-md-3">
                    <div class="text-center">
                        <a href="javascript:void(0)" target="_blank" class="text-decoration-none">
                            <img class="vector-smart-object-3 img-fluid" width="200"
                                src="{{ $footer_contents['organizerLogo'] ?? '' }}" alt="organizer-logo">
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <a href="javascript:void(0)" target="_blank" class="text-decoration-none">
                            <img class="vector-smart-object-3 img-fluid" width="200"
                                src="{{ $footer_contents['co_organizerLogo'] ?? '' }}" alt="co-organizer-logo">
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
                                            data-toggle="tooltip" title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
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
                                            data-toggle="tooltip" title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
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

                                @case('youtube')
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $footer_contents['social']['url'][$key] ?? '#' }}')"
                                            data-toggle="tooltip"
                                            title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                @break

                                @case('whatsapp')
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $footer_contents['social']['url'][$key] ?? '#' }}')"
                                            data-toggle="tooltip"
                                            title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z"
                                                    clip-rule="evenodd" />
                                                <path fill="currentColor"
                                                    d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z" />
                                            </svg>

                                        </div>
                                    </div>
                                @break

                                @case('whatsapp')
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $footer_contents['social']['url'][$key] ?? '#' }}')"
                                            data-toggle="tooltip"
                                            title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z"
                                                    clip-rule="evenodd" />
                                                <path fill="currentColor"
                                                    d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z" />
                                            </svg>
                                        </div>
                                    </div>
                                @break

                                @case('telegram')
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $footer_contents['social']['url'][$key] ?? '#' }}')"
                                            data-toggle="tooltip"
                                            title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" id="telegram">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="m20.665 3.717-17.73 6.837c-1.21.486-1.203 1.161-.222 1.462l4.552 1.42 10.532-6.645c.498-.303.953-.14.579.192l-8.533 7.701h-.002l.002.001-.314 4.692c.46 0 .663-.211.921-.46l2.211-2.15 4.599 3.397c.848.467 1.457.227 1.668-.785l3.019-14.228c.309-1.239-.473-1.8-1.282-1.434z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                @break

                                @case('wechat')
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $footer_contents['social']['url'][$key] ?? '#' }}')"
                                            data-toggle="tooltip"
                                            title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 30 26.567"
                                                viewBox="0 0 30 26.567" width="24" height="24" fill="none"
                                                id="wechat">
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="M30,17.792C30,13.488,25.772,10,20.556,10s-9.444,3.488-9.444,7.792c0,4.303,4.228,7.792,9.444,7.792c1.257,0,2.454-0.206,3.551-0.574l3.021,1.558l-0.844-2.59C28.539,22.553,30,20.316,30,17.792z M17.25,16.611c-0.782,0-1.417-0.634-1.417-1.417c0-0.782,0.634-1.417,1.417-1.417s1.417,0.634,1.417,1.417C18.667,15.977,18.032,16.611,17.25,16.611z M23.861,16.611c-0.782,0-1.417-0.634-1.417-1.417c0-0.782,0.634-1.417,1.417-1.417s1.417,0.634,1.417,1.417C25.278,15.977,24.644,16.611,23.861,16.611z">
                                                </path>
                                                <path fill="currentColor" fill-rule="evenodd"
                                                    d="M20.556,8.666c0.558,0,1.103,0.047,1.638,0.117C21.948,3.9,17.09,0,11.111,0C4.975,0,0,4.104,0,9.167c0,2.97,1.719,5.601,4.373,7.276L3.38,19.491l3.554-1.833c0.903,0.303,1.869,0.501,2.871,0.6c-0.009-0.155-0.028-0.308-0.028-0.465C9.778,12.76,14.613,8.666,20.556,8.666z M15,4.444c0.92,0,1.667,0.746,1.667,1.667S15.92,7.778,15,7.778s-1.667-0.746-1.667-1.667S14.08,4.444,15,4.444z M7.222,7.778c-0.92,0-1.667-0.746-1.667-1.667s0.746-1.667,1.667-1.667s1.667,0.746,1.667,1.667S8.143,7.778,7.222,7.778z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                @break

                                @case('bilibili')
                                    <div class="footer_social_item">
                                        <div class="footer_social_icons_container"
                                            onclick="openInNewTab('{{ $footer_contents['social']['url'][$key] ?? '#' }}')"
                                            data-toggle="tooltip"
                                            title="{{ $footer_contents['social']['title'][$key] ?? '' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24" id="bilibli">
                                                <path stroke="#141520" fill="currentColor" fill-rule="evenodd"
                                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10C3 8.93913 3.42143 7.92172 4.17157 7.17157 4.92172 6.42143 5.93913 6 7 6H17C18.0609 6 19.0783 6.42143 19.8284 7.17157 20.5786 7.92172 21 8.93913 21 10V16C21 17.0609 20.5786 18.0783 19.8284 18.8284 19.0783 19.5786 18.0609 20 17 20H7C5.93913 20 4.92172 19.5786 4.17157 18.8284 3.42143 18.0783 3 17.0609 3 16V10zM8 3L10 6M16 3L14 6M9 13V11M15 11V13">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                @break

                                @default
                            @endswitch
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
