<style>
    .red-section-bg {
        /* background-image: url('{{ asset('frontend/expo-domain/images/rectangle_1.png') }}'); */
        background-color: var(--primary_background);
        background-size: cover;
        background-position: center;
        position: relative;
    }
</style>

<section class="red-section-bg py-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @php
                    $contents = json_decode($expo->additional_contents, true) ?? [];
                @endphp
                <p class="text-light text-center" style="font-size: 1rem;"><span
                        style="font-weight: bold">Organizer:</span>
                    {{ $contents['organizerDetails']['name'] }}
                    <span style="font-weight: bold">Co-Organizer:</span>
                    {{ $contents['co_organizerDetails']['name'] }}<br>
                    <span style="font-weight: bold">Supported by:</span>
                    Embassy of the People’s Republic of China in the People’s Republic of Bangladesh
                </p>
            </div>

            <div class="row justify-content-center align-items-center mt-3">
                <div class="col-md-6">
                    <div class="text-center">
                        <a href="https://studyinchina.edu.cn" target="_blank">
                            <img class="vector-smart-object-3 img-fluid" width="100"
                                src="{{ asset('frontend/expo-domain/images/vector_smart_object_2.png') }}"
                                alt="">
                            <p class="text-light mt-2">www.studyinchina.edu.cn</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center">
                        <a href="https://malishaedu.com" target="_blank">
                            <img class="vector-smart-object-2 img-fluid" width="160"
                                src="{{ asset('frontend/expo-domain/images/vector_smart_object.png') }}" alt="">
                            <p class="text-light mt-2">www.malishaedu.com</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
