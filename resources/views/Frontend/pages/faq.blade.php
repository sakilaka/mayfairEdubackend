@extends('Frontend.layouts.master-layout')
@section('title', '- FAQ')
@section('head')
    <style>
        .content_search {
            margin-top: 3.5rem;
        }

        /* @media screen and (min-width:391px) {
                .content_search {
                    margin-top: 6rem;
                }
            } */
    </style>
@endsection
@section('main_content')


    <div class="content_search">
        <!--Start Course Preview Header-->
        <div class="hero-header text-white position-relative classic_header">
            <div class="bottom-0 end-0 overflow-hidden position-absolute start-0 top-0">
                <img src="{{ $faq_content->banner_image_show ?? asset('frontend/images/No-image.jpg') }}"
                    class="img-fluid wh_sm_100" alt="">
            </div>
            <div class="container-lg hero-header_wrap position-relative">
                <div class="row align-items-end my-5">
                    <div class="col-12">
                        <h1 class="fw-semi-bold">{{ $faq_content->title1 ?? '' }}</h1>
                        <span class="m-1">{{ $faq_content->description1 ?? '' }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!--End Course Preview Header-->
        <!--Start F.A.Q-->
        <div class="bg-alice-blue py-4" id="faq">
            <div class="container-lg">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4>{{ $faq_content->title2 ?? '' }}</h4>
                    <div class="section-header_divider mb-3"></div>
                    <span class="m-1">{{ $faq_content->description2 ?? '' }}</span>
                </div>
                <!--End Section Header-->

                <div class="row">
                    @foreach ($faqs as $k => $faq)
                        <div class="col-sm-6 col-md-6">
                            <div class="accordion faq-accordion" id="faqAccordion{{ $k }}">
                                <div class="accordion-item border-0 shadow-sm mb-2">
                                    <h2 class="accordion-header" id="headingFive-{{ $k }}">
                                        <button class="accordion-button fw-medium collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFive-{{ $k }}"
                                            aria-expanded="true" aria-controls="collapseFive-{{ $k }}">
                                            <strong>{{ $faq->question }}</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseFive-{{ $k }}" class="accordion-collapse collapse"
                                        aria-labelledby="headingFive-{{ $k }}"
                                        data-bs-parent="#faqAccordion{{ $k }}">
                                        <div class="accordion-body">
                                            <p>{{ $faq->answer }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--End F.A.Q-->
    </div>
    <!--======== main content close ==========-->


    @include('Frontend.layouts.parts.news-letter')

@endsection
