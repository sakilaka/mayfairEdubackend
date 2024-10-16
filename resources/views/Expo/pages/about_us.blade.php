<!DOCTYPE html>
<html lang="en">

<head>
    @include('Expo.components.head')
    <title>{{ env('APP_NAME') }} - About Us</title>
</head>

<body>

    <div class="bg-section" style="height:auto;">
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
    </div>

    <div class="container mt-5">
        <div class="text-center">
            <h2 class="section-title">About US</h2>
        </div>
    </div>

    <section class="red-section-bg mt-5 py-5">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title text-light">Organizer Profile</h2>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-md-3">
                    <div class="d-flex flex-column justify-content-center align-items-center align-items-md-end">
                        <img src="{{ asset('frontend/expo-domain/images/image_20240924085451.png') }}" alt=""
                            class="img-fluid me-md-3" width="150">
                        <div class="text-center mt-4 me-md-3">
                            <a href="https://www.studyinchina.edu.cn/"
                                class="btn btn-light mx-auto px-5 rounded-0" target="_blank">Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 mt-4 mt-md-0">
                    <p class="text-23 text-light"><strong class="fw700">Chinese Service Center for Scholarly
                            Exchange(CSCSE)</strong><br>CSCSE was founded on March 31st, 1989. It is a public
                        institution
                        affiliated to the Ministry of Education (MOE) of the People’s Republic of China. As a legal
                        entity,
                        CSCSE specializes in offering professional services for international scholarly exchanges,
                        including
                        Chinese students and scholars studying abroad, returnees from abroad, and international
                        students and
                        scholars studying in China.<br><span class="text-style-3">&nbsp;</span><br>CSCSE is also
                        dedicated
                        to promoting the internationalization and capacity building of Chinese higher education
                        institutions, as well as introducing the best practice of education resources through
                        international
                        exchanges and collaboration.</p>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>

    <section class="my-5">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title">Co-Organizer Profile</h2>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-md-3">
                    <div class="d-flex flex-column justify-content-center align-items-center align-items-md-end">
                        <img src="{{ asset('frontend/expo-domain/images/malishaedu-logo.png') }}" alt=""
                            class="img-fluid me-md-3" style="width: 50%">
                        <div class="text-center mt-4 me-md-3">
                            <a href="https://www.malishaedu.com/"
                                class="btn btn-danger mx-auto px-5 rounded-0" target="_blank">Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 mt-4 mt-md-0">
                    <p class="text-25"><strong class="fw700">MalishaEdu</strong><br>Founded in 2012, MalishaEdu is a
                        prominent
                        educational consultancy based in Guangzhou, China and other countries including Bangladesh.
                        Specializing
                        in the global promotion of Chinese education, we assist international students in securing
                        admissions to
                        Chinese Universities, serving as abridge between Chinese and overseas students.<br><span
                            class="text-style-3">&nbsp;</span><br>We have established the Belt &amp; Road Chinese
                        Center (BRCC)
                        and started Chinese language and culture instruction to the international community &amp;
                        foundation
                        courses indifferent countries to nurture qualified students for Chinese
                        Universities.<br>Additionally,
                        we have established "EasyLink" to provide assistance with job placement for graduates in
                        Chinese
                        enterprises and assist foreigners in registering their company &amp;running it smoothly in
                        China.<br><span class="text-style-3">&nbsp;</span><br>MalishaEdu is dedicated to advancing
                        Chinese
                        education on a global scale, with a primary focus on Belt and Road Countries.</p>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>

    @include('Expo.home_sections.footer')
    @include('Expo.components.footer')
</body>

</html>
