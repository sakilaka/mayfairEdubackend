@extends('Frontend.layouts.master-layout')
@section('title','- E-Book Details')
@section('head')

@endsection
@section('main_content')
@include('Frontend.layouts.parts.header-menu')

<!-- Main content -->

<div class="content_search" style="margin-top:70px">
    <style>
.preview-accordion .accordion-button::after {
    display: none;
}

/*========== its for feedback reply ==========*/
.media {
    background: #fff;
    box-shadow: 0 3px 10px 0 rgba(#000, 0.1);
    padding: 1rem;

    h2 {
        font-size: 24px;
        font-weight: bold;
    }

    img {
        float: left;
        width: 200px;
        margin-right: 16px;
        border: 1px solid lightgrey;
    }

    &:after {
        content: "";
        display: block;
        clear: both;
    }
}

.media[dir="rtl"] {
    img {
        float: right;
        margin-right: 0;
        margin-left: 16px;
    }
}

.link {
    display: inline-block;
    margin-top: 1rem;
    color: #1d7bb3;
}

.wrapper {
    /*max-width: 800px;*/
    padding-left: 1rem;
    padding-right: 1rem;
}

/*============= close ===========*/
</style>


@php
 $ebook_count=0;
$check_ebook = 0;
if(auth()->check()){
    $save = \App\Models\EbookParticipant::where('ebook_id',$ebook->id)->where('user_id',auth()->user()->id)->first();
    if($save){
        $check_ebook = 1;
    }
}
@endphp

<input type="hidden" id="ebook_id" name="ebook_id" value="CO13RT58I93">
<input type="hidden" id="student_id" name="student_id" value="">
<!--Start ebook Preview Header-->

<div class="hero-header text-white position-relative bg-img hero2">
    <div class="bottom-0 end-0 position-absolute start-0 top-0" style="z-index: -1">
        <img src="{{ @$ebook->image_show }}"
            alt="" class="img-fluid" style="width: 100%; height: 100%;object-fit: cover">
    </div>
    <div class="container-lg hero-header_wrap position-relative">
        <!--Start Breadcrumb-->
        <!-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a
                        href=""
                        class="text-white"></a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"
                        class="text-white"></a>
                </li>

            </ol>
        </nav> -->
        <!--End Breadcrumb-->
        <!--Start Video Icon With Popup Youtube-->
        <div class="text-center my-3 my-md-5 ">
                        {{-- <a class="ebook-preview__play---icon d-inline-block popup-youtube"
                href="{{$ebook->ebooklessons->count() > 0 ? ($ebook->ebooklessons[0]->ebooklessonvideos->count() >0 ?  $ebook->ebooklessons[0]->ebooklessonvideos[0]->lesson_video : '#') : '#' }}">
                <i data-feather="play-circle" class="ebook-preview__play---icon d-inline-block"></i>
            </a> --}}
                    </div>
        <!--End Video Icon With Popup Youtube-->
                <div class="row align-items-end">
            <div class="col col-title">
                <h1 class="fw-semi-bold mb-3" > {{ @$ebook->title }} </h1>
                <div class="row g-4 align-items-center">
                    <div class="col-auto">
                        <div class="avatar d-flex align-items-center">
                            <div class="avatar-img me-3">
                            <img src="{{ @$ebook->user->image_show }}"
                            alt="">
                            </div>
                            <div class="avatar-text">
                                <div class="avatar-designation text-white-50 mb-1 fw-bold ins_txt">
                                    By                                </div>
                                <h5 class="h6 avatar-name mb-0">
                                    <a href=""
                                      >
                                        {{ @$ebook->user->name }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>


                    <div class="col-auto">

                    </div>
                </div>
            </div>
            <div class="col-md-auto">
                <div class="align-items-end g-3 justify-content-md-end row mt-3 mt-xl-0">
                    <div class="col-sm-auto">
                        <div class="d-md-flex save-share-wrap">
                            <span class="text-center">


                            </span>
                            <a href="https://www.facebook.com/sharer.php?u=https://lead.academy/ebook-details/CO13RT58I93"
                                target="_blank" title="Facebook Share" class="text-center ms-md-3"
                                data-bs-toggle="modal" data-bs-target="#shareModal">
                                <i data-feather="share-2" class="share-icon"></i>
                                <div class="share_txt">Share</div>
                            </a>

                        </div>
                    </div>
                    <input type="hidden" name="ebook_id"
                        id="ebook_id_CO13RT58I93"
                        value="CO13RT58I93">
                    <input type="hidden" name="ebook_name"
                        id="ebook_name_CO13RT58I93"
                        value="English for IBA-MBA Admission Preparation">
                    <input type="hidden" name="slug" id="slug_CO13RT58I93"
                        value="english-for-iba-mba-admission-preparation">
                    <input type="hidden" name="qty" id="qty" value="1">
                                        <input type="hidden" name="price"
                        id="price_CO13RT58I93"
                        value="1050">
                    <input type="hidden" name="old_price"
                        id="old_price_CO13RT58I93"
                        value="1500">
                    <input type="hidden" name="picture"
                        id="picture_CO13RT58I93"
                        value="assets/uploads/ebook/Thumb1699870830-f-IBA-MBA-English-thumbnail.html">
                    <input type="hidden" name="is_ebook_type" id="isebook_type" value="0">
                    <input type="hidden" name="affiliator_id" id="affiliator_id" value="">
                    <input type="hidden" name="ebook_price" id="ebook_price"
                        value="1050">
                    <input type="hidden" name="student_discount" id="student_discount"
                        value="">

                 @if ($check_ebook==0)

                <div class="col-6 col-sm-auto text-center">
                    <div class="price-area d-xl-flex align-items-xl-center justify-content-xl-center text-center text-xl-start">
                        @if(@$ebook->discount > 0)
                          @if ($ebook->discounttype=="0")
                            @php
                              $new_price=$ebook->fee -($ebook->fee *$ebook->discount/100);
                            @endphp
                            <div class="purchase-price fs-2">
                                <div class="main-price align-items-center d-flex">
                                    <span class="currency fs-5 fw-semi-bold mt-0"> </span>
                                    <span class="fw-bold ms-1">{{  format_price(@$new_price) }}</span>
                                </div>
                            </div>
                            <div class="product-price ms-2">
                                <del class="prev-price"><span class="hidden position-absolute overflow-hidden">Previous price</span>{{ format_price($ebook->fee) }}</del>
                            </div>
                          @else
                             @php
                              $new_price=$ebook->fee - $ebook->discount;
                            @endphp
                            <div class="purchase-price fs-2">
                                <div class="main-price align-items-center d-flex">
                                    <span class="currency fs-5 fw-semi-bold mt-0"> </span>
                                    <span class="fw-bold ms-1">{{ format_price(@$new_price) }}</span>
                                </div>
                            </div>
                            <div class="product-price ms-2">
                                <del class="prev-price"><span class="hidden position-absolute overflow-hidden">Previous price</span>{{ format_price(@$ebook->fee) }}</del>
                            </div>
                            @endif
                        @else
                        <div class="purchase-price fs-2">
                            <div class="main-price align-items-center d-flex">
                                <span class="currency fs-5 fw-semi-bold mt-0"> </span>
                                <span class="fw-bold ms-1">{{ format_price(@$ebook->fee) }}</span>
                            </div>
                        </div>

                        @endif
                     </div>

                    <button type="button"
                    class="btn btn-light btn-lg fw-medium text-navy-blue w-100 addebookcart" CarId="{{ @$ebook->id }}">
                    Add To Cart
                    </button>
                </div>
                @endif





             </div>
            </div>
        </div>
    </div>
</div>
<!--End ebook Preview Header-->
<!-- Navigation-->
<!-- navbar_top  -->
<div class="bg-dark-cerulean sticky-nav" id="secNavbar">
    <div class="container-lg">
        <ul class="nav" id="navbarResponsive">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger overview_txt active" href="#overview">
                    Overview                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger prerequisites_txt" href="#e-book">E-book</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link js-scroll-trigger outcome_txt" href="#learnings">
                    Video                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger lessons_txt" href="#lessons">
                    E-Audio                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger lessons_txt" href="#video">
                    E-Video                </a>
            </li>

        </ul>
    </div>
</div>

<div class="bg-alice-blue pt-5">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-8 sticky-content">
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="overview">

                    <div class="card-body p-4 p-xl-5">
                        <!--Start Section Header-->
                        <div class="row">
                            <div class="col-md-10">
                                <div class="section-header  position-relative ">
                                    <h4 class="h5 about_this_ebook" style="color: var(--text_color)">
                                        {{ @$ebook->headline }}
                                    </h4>
                                </div>

                                <div class="section-header_divider ">


                                </div>
                            </div>

                            <div class="col-md-2">
                                <a class="btn btn-primary"  data-toggle="modal" data-target="#audio_content"><i class="fa fa-solid fa-microphone"></i> &nbsp; Play</a>
                            </div>
                        </div>
                        {{-- <div class="section-header mb-4 position-relative">
                            <h4 class="h5 about_this_ebook" style="color: var(--text_color)">
                                Short Description
                            </h4>
                            <div class="section-header_divider"></div>
                        </div> --}}

                        <h4 class="h5 about_this_ebook mt-3" style="color: var(--text_color)">
                           Overview
                        </h4>
                        <!--End Section Header-->
                        <div style="text-align: justify; color:var(--text_color)" class="text_ellipse2 moreText">
                            {!! @$ebook->short_desctiption !!}
                        </div>
                        <button onclick="showhide()" class=" read_more_txt btn btn-primary" style="color:white"id="toggle"> Read More</button>
                    </div>
                </div>

                <!--End card-->

                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="e-book">

                    <div class="card-body p-4 p-xl-5">
                        <!--Start Section Header-->
                        <div class="row">
                            <div class="col-md-10">
                                <div class="section-header  position-relative ">
                                    <h4 class="h5 about_this_ebook" style="color: var(--text_color)">
                                        E-Book
                                    </h4>
                                </div>

                                <div class="section-header_divider "></div>
                            </div>


                        </div>
                        {{-- <div class="section-header mb-4 position-relative">
                            <h4 class="h5 about_this_ebook" style="color: var(--text_color)">
                                Short Description
                            </h4>
                            <div class="section-header_divider"></div>
                        </div> --}}

                        <div style="text-align: justify; color:var(--text_color)" class="text_ellipse2 mb-2 moreText">
                            {!! @$ebook->long_desctiption !!}
                        </div>

                        {{-- <button onclick="showhide()" class=" read_more_txt btn btn-primary" style="color:white"
                            id="toggle">
                          Read More
                       </button> --}}


                       {{-- @if(auth()->check()) --}}
                       @if($check_ebook == 1)
                       <button onclick="showhide()" class=" read_more_txt btn btn-primary" style="color:white"
                            id="toggle">
                          Read More
                       </button>
                       <a href="{{ route('frontend.ebook_download', @$ebook->id) }}" class="btn btn-primary float-right mt-5"><i class="fa fa-solid fa-download"></i> Download</a>
                       @else
                       <button  class=" read_more_txt btn btn-primary addebookcart" CarId="{{ @$ebook->id }}"style="color:white">Read More</button>
                       @endif
                      {{-- @endif --}}




                    </div>
                </div>
                <!--End card-->
                <!--Start card-->



                <div class="modal fade" id="audio_content" tabindex="-1" role="dialog" aria-labelledby="audioModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="audioModalLabel">{{ $ebook->title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <!-- Embed your audio here -->
                        <audio controls style="width: 100%">
                            <source src="{{ $ebook->content_audio_show }}" type="audio/mp3">
                            Your browser does not support the audio tag.
                        </audio>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>




 <!--Start card-->
 <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="lessons">
    <div class="card-body p-4 p-xl-5">
        <!--Start Section Header-->
        <div class="section-header mb-4 position-relative">
            <h4 class="h5 topics_for_this_course">Audio
                <span class="h5 float-end">{{ $ebook->audio->count() }} Audios<span>
                    @if($check_ebook == 1)
                    <a href="{{ route('frontend.ebook_audio_download', $ebook->id) }}" class="btn btn-primary"><i class="fa fa-solid fa-download"></i></a>
                    @endif
            </h4>
            <div class="section-header_divider"></div>
        </div>
        <!--End Section Header-->
        <div class="accordion course-content_accordion topics-accordion" id="CourseContent">
                                        <div class="accordion-item">
                <h2 class="accordion-header" id="PanelHeadingOne">
                    {{-- <button
                        class="accordion-button "
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#section_1"
                        aria-expanded="true"
                        aria-controls="section_1">
                        <span>1&nbsp;-&nbsp;Proficiency in Effective Business Meetings</span>
                        <span class="lesson-time ms-auto"><span>4                                            Lessons</span>&nbsp;•&nbsp;<span>
                            1:2:23</span></span>
                    </button> --}}
                </h2>
                <div id="section_1" class="accordion-collapse collapse show" aria-labelledby="PanelHeadingOne">
                    <div class="accordion-body accordion-body py-3 px-4 px-md-0 px-lg-4">
                        <div class="accordion course-content_accordion--sub"
                            id="accordionPanelsStayOpenExample">
                            @foreach ($ebook->audio as $k=> $item)
                            <div class="accordion-item border-0">
                                <div class="d-flex mb-3 mb-md-2 mb-lg-3">
                                    <span> {{ $loop->iteration }}.&nbsp;</span>
                                    <div class="flex-shrink-1 me-3 me-md-2 me-lg-3">
                                        <i data-feather="play-circle" class="accordion-icon"></i>
                                    </div>
                                    <div class="w-100">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">


                                                <button
                                                class="accordion-button fs-13 text-muted fw-normal pt-1 pb-0 px-0 collapsed"
                                                type="button">
                                                <a href="javascript:void(0)" onclick="showCoursePreview('CO07TDK7B23', 'LE085WSXF464')">{{ $item->audio_name }}</a>

                                                            <span class="course-duration ms-auto">
                                                                {{-- @if ($item->is_free == 1) --}}

                                                                @if($ebook_count == 0)
                                                                    @if(auth()->check())
                                                                        @if($check_ebook == 1)
                                                                        <a  data-toggle="modal" data-target="#audioModal{{ $k }}"><u > Play</u> &nbsp;</a>
                                                                        @else
                                                                        @if ($item->is_free == 1)
                                                                        <a  data-toggle="modal" data-target="#audioModal{{ $k }}"><u > FREE Preview</u> &nbsp;</a>
                                                                        @endif
                                                                        @endif
                                                                    @else
                                                                    @if ($item->is_free == 1)
                                                                    <a  data-toggle="modal" data-target="#audioModal{{ $k }}"><u > FREE Preview</u> &nbsp;</a>
                                                                    @endif
                                                                    @endif
                                                                @else
                                                                    @if(auth()->check())
                                                                    {{-- here course check --}}
                                                                        @if($check_ebook == 1)
                                                                        <a  data-toggle="modal" data-target="#audioModal{{ $k }}"><u >Play</u> &nbsp;</a>
                                                                        @endif
                                                                    @endif
                                                                @endif

                                                                {{-- @endif --}}
                                                                {{-- 00:01:34                                                                 --}}
                                                            </span>


                                                </button>


                                        </h2>
                                    </div>
                                </div>
                            </div>

                            @if($item->audio_file_show)
                                <!-- Modal -->
                                <div class="modal fade" id="audioModal{{ $k }}" tabindex="-1" role="dialog" aria-labelledby="audioModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="audioModalLabel">{{ $item->audio_name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <!-- Embed your audio here -->
                                        <audio controls style="width: 100%">
                                            <source src="{{ $item->audio_file_show }}" type="audio/mp3">
                                            Your browser does not support the audio tag.
                                        </audio>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>


                                @endif

                            @endforeach


                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--Start Course Preview Modal -->
        <div class="course-preview__modal modal" id="coursePreviewModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body text-white p-4" id="courseinfo">

                    </div>
                </div>
            </div>
        </div>
        <!--End Course Preview Modal -->
    </div>
</div>
<!--End card-->


 <!--Start card-->
 <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="video">
    <div class="card-body p-4 p-xl-5">
        <!--Start Section Header-->
        <div class="section-header mb-4 position-relative">
            <h4 class="h5 topics_for_this_course">
                Video                                <span class="h5 float-end">
                    {{ $ebook->video->count() }} Videos                                  <span>
                        @if($check_ebook == 1)
                        <a href="{{ route('frontend.ebook_video_download', $ebook->id) }}" class="btn btn-primary"><i class="fa fa-solid fa-download"></i></a>
                        @endif
                    </h4>

            <div class="section-header_divider"></div>
        </div>
        <!--End Section Header-->
        <div class="accordion course-content_accordion topics-accordion" id="CourseContent">
                                        <div class="accordion-item">
                <h2 class="accordion-header" id="PanelHeadingOne">
                    {{-- <button
                        class="accordion-button "
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#section_1"
                        aria-expanded="true"
                        aria-controls="section_1">
                        <span>1&nbsp;-&nbsp;Proficiency in Effective Business Meetings</span>
                        <span class="lesson-time ms-auto"><span>4                                            Lessons</span>&nbsp;•&nbsp;<span>
                            1:2:23</span></span>
                    </button> --}}
                </h2>
                <div id="section_1" class="accordion-collapse collapse show" aria-labelledby="PanelHeadingOne">
                    <div class="accordion-body accordion-body py-3 px-4 px-md-0 px-lg-4">
                        <div class="accordion course-content_accordion--sub"
                            id="accordionPanelsStayOpenExample">
                            @foreach ($ebook->video as $k=> $item)
                            <div class="accordion-item border-0">
                                <div class="d-flex mb-3 mb-md-2 mb-lg-3">
                                    <span> {{ $loop->iteration }}.&nbsp;</span>
                                    <div class="flex-shrink-1 me-3 me-md-2 me-lg-3">
                                        <i data-feather="play-circle" class="accordion-icon"></i>
                                    </div>
                                    <div class="w-100">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">


                                                <button
                                                class="accordion-button fs-13 text-muted fw-normal pt-1 pb-0 px-0 collapsed"
                                                type="button">
                                                <a href="javascript:void(0)" onclick="showCoursePreview('CO07TDK7B23', 'LE085WSXF464')">{{ $item->video_name }}</a>

                                                            <span class="course-duration ms-auto">

                                                            @if($ebook_count == 0)
                                                                @if(auth()->check())
                                                                    @if($check_ebook == 1)
                                                                    <a  data-toggle="modal" data-target="#videoModal{{ $k }}"><u > Play</u> &nbsp;</a>
                                                                    @else
                                                                    @if ($item->is_free == 1)
                                                                    <a data-toggle="modal" data-target="#videoModal{{ $k }}" ><u> FREE Preview </u> &nbsp;</a>
                                                                    @endif
                                                                    @endif
                                                                @else
                                                                    @if ($item->is_free == 1)
                                                                    <a data-toggle="modal" data-target="#videoModal{{ $k }}" ><u> FREE Preview </u> &nbsp;</a>
                                                                    @endif
                                                                @endif
                                                            @else
                                                                @if(auth()->check())
                                                                {{-- here course check --}}
                                                                    @if($check_ebook == 1)
                                                                    <a  data-toggle="modal" data-target="#videoModal{{ $k }}"><u >Play</u> &nbsp;</a>
                                                                    @endif
                                                                @endif
                                                            @endif

                                                                {{-- @if ($item->is_free == 1)

                                                                    <a data-toggle="modal" data-target="#videoModal{{ $k }}" ><u> FREE Preview </u> &nbsp;</a>
                                                                @endif --}}
                                                                {{-- 00:01:34                                                                 --}}

                                                            </span>


                                                </button>


                                        </h2>
                                    </div>
                                </div>
                            </div>
                            @if($item->video_file_show)
                                <!-- Modal -->
                                <div class="modal fade" id="videoModal{{ $k }}" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="videoModalLabel">{{ $item->video_name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <!-- Embed your video here -->
                                        {{-- <iframe width="100%" height="315" src="{{ $item->video_file }}" frameborder="0" allowfullscreen></iframe> --}}
                                        <video controls height="350px" width="460px">
                                            <source src="{{ $item->video_file_show }}" type="video/mp4" autoplay >
                                        </video>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @endif
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--Start Course Preview Modal -->
        <div class="course-preview__modal modal" id="coursePreviewModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body text-white p-4" id="courseinfo">

                    </div>
                </div>
            </div>
        </div>
        <!--End Course Preview Modal -->
    </div>
</div>
<!--End card-->




















                <!--End card-->
            </div>
            <div class="col-md-4 ps-xl-5 sticky-content">
                        @php
                           $com_name = \App\Models\Tp_option::where('option_name', 'theme_option_header')->first();
                           $social_url = \App\Models\Tp_option::where('option_name', 'theme_social_media')->first();
                           $dataObj = json_decode($social_url->option_value);
                        @endphp
                                <div class="sidebar-block text-white mb-3 p-4" style="background: #171725;">
                    <a href="{{ @$dataObj->facebook }}"
                        style="text-decoration: none; color:#FFC107" target="_blank">
                        <!-- Start Section Header -->

                        <div class="section-header mb-4 position-relative">
                            <h4 class="h5">Join {{ $com_name->company_name }} Community</h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <!-- End Section Header -->
                        <!-- Start Tags -->
                        <div class="tags">
                            <span class="tag-link text-white text-decoration-none d-inline-block mb-1 px-3 py-2 bg-prussian-blue"><i
                                    class="fab fa-facebook-f"></i>&nbsp;&nbsp;&nbsp;Facebook</span>
                        </div>
                        <!-- End Tags -->
                    </a>
                </div>
                                <div class="sidebar-block text-white mb-3 p-4 position-relative">
                    {{-- <div class="bottom-0 end-0 overflow-hidden position-absolute start-0 top-0">
                        <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/sidebar-bg-01.jpg"
                            class="img-fluid" alt="">
                    </div> --}}
                    <!--Start Section Header-->
                    {{-- <div class="section-header mb-4 position-relative">
                        <h4 class="h5" style="color: var(--text_color)"> Language </h4>
                        <div class="section-header_divider"></div>
                    </div> --}}
                    <!--End Section Header-->
                    <div class="d-flex align-items-center mb-3 position-relative">
                        <div class="flex-shrink-0">
                        </div>
                        <div class="flex-grow-1 ms-3 text-left">
                            <!-- <a class="text-white"> -->
                                                        <!-- </a> -->

                         <a  style="color: var(--text_color)">
                            {{-- @foreach ($ebook->ebooklanguages as $k => $item  )
                                @if ($k == 0)
                                    <li>{{ $item->name}}</li>
                                @else
                                    <li>{{ $item->name}}</li>
                                @endif

                            @endforeach --}}
                        </a>
                        </div>
                    </div>

                </div>



                <div class="sidebar-block text-white mb-3 p-4 position-relative overflow-hidden">
                    {{-- <div class="bottom-0 end-0 position-absolute start-0 top-0">
                        <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/sidebar-bg-01.jpg"
                            class="img-fluid" alt="">
                    </div> --}}
                    <!--Start Section Header-->
                    {{-- <div class="mb-4 position-relative section-header">
                        <h4 class="h5" style="color: var(--text_color)">Learner Career Outcomes</h4>
                        <div class="section-header_divider"></div>
                    </div> --}}
                    <!--End Section Header-->
                    <ul class="mb-0 ps-4 position-relative">
                        {{-- @foreach ($ebook->ebookcareeroutcomes as $ebookcareeroutcome)
                        <li class="mb-1"  style="color: var(--text_color)">
                            <!-- <a href="https:" class="text-white" target="_new"> -->
                            <span>{{ @$ebookcareeroutcome->name }}</span>
                            <!-- </a> -->
                        </li>
                        @endforeach --}}
                    </ul>



                </div>
            </div>

        </div>














<!--Start Feedback-->
<div class="bg-alice-blue py-4">
    <div class="container-lg">
        <div class="card border-0 shadow-sm rounded-0" id="reviews">
            <div class="card-body p-4">
                <!--Start Section Header-->
                <div class="section-header mb-4 position-relative">
                    <h4 class="h5 student_feedback_txt" style="color: var(--text_color)">Student Feedback</h4>
                    <div class="section-header_divider"></div>
                </div>

                <!--End Section Header-->
                <div class="row">

                    <div class="col-md-4 col-lg-4 text-center">
                        <div class="d-inline-block px-5 py-4 rating-block rounded-3 shadow text-center">
                            <div class="rating-point mb-3 text-center">
                                <h3 class="display-1 fw-light mb-0 fw-semi-bold">{{round(@$ebook->reviews->avg('ratting'),1)}}</h3>

                        @php
                        $avg_round = floor($ebook->reviews->avg('ratting'));
                        @endphp

                        <div class="text-warning">
                            @for ($i=1; $i<=@$avg_round; $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                        </div>

                            </div>
                            <div style="color: var(--text_color)"> E-Book Ratings</div>
                        </div>
                    </div>

                    <div class="col-md-8 col-lg-8">
                        <table class="table table-borderless mb-0 white-space-nowrap">
                        <tbody>
                          @php
                            @$five_count=@$ebook->reviews?->where('ratting',5)?->count();
                            @$five_percent = @$five_count > 0 ? ((@$five_count/@$ebook?->reviews?->count()) * 100) : 0;
                           @endphp
                                <tr>
                                    <td width="70%" class="align-middle">
                                        <div class="rating-percent">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    role="progressbar"
                                                     style="width: {{ @$five_percent }}%"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>

                                    <td width="10%" class="align-middle">
                                        <div class="rating-quantity">
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                        </div>
                                    </td>
                                    <td width="20%" class="align-middle">
                                         <div class="user-rating text-muted">{{ round( @$five_percent),1 }}%</div>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                    @$four_count=@$ebook->reviews?->where('ratting',4)?->count();
                                    @$four_percent = @$four_count > 0 ? ((@$four_count/@$ebook?->reviews?->count()) * 100) : 0;
                                   @endphp
                                    <td width="70%" class="align-middle">
                                        <div class="rating-percent">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    role="progressbar"
                                                    style="width: {{ @$four_percent  }}%"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="10%" class="align-middle">
                                        <div class="rating-quantity">
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                        </div>
                                    </td>
                                    <td width="20%" class="align-middle">
                                        <div class="user-rating text-muted">{{ round( @$four_percent),1 }} % </div>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                    @$three_count=@$ebook->reviews?->where('ratting',3)?->count();
                                    @$three_percent = @$three_count > 0 ? ((@$three_count/@$ebook?->reviews?->count()) * 100) : 0;
                                   @endphp
                                    <td width="70%" class="align-middle">
                                        <div class="rating-percent">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    role="progressbar"
                                                    style="width: {{ @$three_percent  }}%"
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="10%" class="align-middle">
                                        <div class="rating-quantity">
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                        </div>
                                    </td>
                                    <td width="20%" class="align-middle">
                                        <div class="user-rating text-muted">{{ round( @$three_percent),1 }}%</div>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                    @$two_count=@$ebook->reviews?->where('ratting',2)?->count();
                                    @$two_percent = @$two_count > 0 ? ((@$two_count/@$ebook?->reviews?->count()) * 100) : 0;
                                   @endphp
                                    <td width="70%" class="align-middle">
                                        <div class="rating-percent">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    role="progressbar"
                                                    style="width: {{ @$two_percent  }}%"
                                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="10%" class="align-middle">
                                        <div class="rating-quantity">
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star fs-4 " style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4 " style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4 " style="color:#ffe6ad;"></i>
                                        </div>
                                    </td>
                                    <td width="20%" class="align-middle">
                                        <div class="user-rating text-muted">{{ round( @$two_percent),1 }}%</div>
                                    </td>
                                </tr>
                                <tr>

                                 @php
                                    @$one_count=@$ebook->reviews?->where('ratting',1)?->count();
                                    @$one_percent = @$one_count > 0 ? ((@$one_count/@$ebook?->reviews?->count()) * 100) : 0;
                                   @endphp

                                    <td width="70%" class="align-middle">
                                        <div class="rating-percent">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    role="progressbar"
                                                    style="width: {{ @$one_percent  }}%"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="10%" class="align-middle">
                                        <div class="rating-quantity">
                                            <i class="fas fa-star text-warning fs-4" style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                        </div>
                                    </td>
                                    <td width="20%" class="align-middle">
                                        <div class="user-rating text-muted"> {{ round( @$one_percent),1 }}%</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @foreach ($ebook->reviews as $review)
            <div class="card-footer bg-white p-4">
                <div class="row">
                    <div class="col-12 col-sm-auto">
                        <div class="avatar d-flex align-items-center">
                            <div class="avatar-img me-3">
                                <img src="{{ @$review->user->image_show }}"
                                    alt="">
                            </div>
                            <div class="avatar-text">
                                <h5 class="avatar-name mb-1">
                                    <a href="javascript:void(0)" style="color: var(--text_color)">{{ @$review->user->name }}</a>
                                </h5>
                                <div class="avatar-designation" style="color: var(--text_color)">{{ $review->created_at->diffForHumans() }}</div>

                               @php
                                $avg_round = $review->ratting;
                                @endphp

                                <div>
                                    @for ($i=1; $i<=$avg_round; $i++)
                                     <i class="fas fa-star text-warning"></i>
                                    @endfor
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3 mt-sm-0" style="color: var(--text_color); margin-left:90px">
                        <p>{!! @$review->comment !!}</p>
                    </div>
                    <div class="col-md-12">
                </div>
            </div>
            </div>
            @endforeach

             {{-- validate start  --}}
             @if(count($errors) > 0)
             @foreach($errors->all() as $error)
                 <div class="alert alert-danger">{{ $error }}</div>
             @endforeach
             <script>
                setTimeout(function(){
                    $('.alert.alert-success').hide();
                }, 1000);
            </script>
             @endif
             {{-- validate End  --}}
             @php
             $check_course = 0;
             if(auth()->check()){
                 $save = \App\Models\EbookParticipant::where('ebook_id',$ebook->id)->where('user_id',auth()->user()->id)->first();
                 if($save){
                     $check_course = 1;
                 }
             }
             @endphp

          @if ($check_course)
         <form action="{{ route('frontend.review.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-footer bg-white p-4">
                <div class="row">
                    <div class="col-6 col-sm-auto">
                        <div class="avatar d-flex align-items-center">
                            <div class="avatar-text">
                                <div class="rating-input-block">
                                    <input type="hidden" name="ratting" id="input_rating">
                                    <input type="hidden" name="ebook_id" value="{{ $ebook->id }}">
                                    <input type="hidden" value="ebook" name="type"/>
                                    <i data-rating="1" class="fas fa-star fs-4 input-ratting" style="color:#ffe6ad;"></i>
                                    <i data-rating="2" class="fas fa-star fs-4 input-ratting" style="color:#ffe6ad;"></i>
                                    <i data-rating="3" class="fas fa-star fs-4 input-ratting" style="color:#ffe6ad;"></i>
                                    <i data-rating="4" class="fas fa-star fs-4 input-ratting" style="color:#ffe6ad;"></i>
                                    <i data-rating="5" class="fas fa-star fs-4 input-ratting" style="color:#ffe6ad;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <textarea class="bg-white form-control pe-5 box" name="comment" cols="30" rows="2"></textarea>
                        <button class="btn btn-send end-0 position-absolute px-2 rounded-2" type="submit">
                            <svg width="30" height="34" viewBox="0 0 44 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M41.1669 2L20.0835 20.6558" stroke="#A5A5A5" stroke-width="3.83333"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M41.1669 2L27.7502 35.9204L20.0835 20.6562L2.8335 13.8721L41.1669 2Z"
                                    stroke="#A5A5A5" stroke-width="3.83333" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    {{-- <button type="submit" class="btn btn-sm btn-info mt-2" style="width: 10px; height:10px">Submit Review</button> --}}


                </div>
            </div>
         </form>
         @endif
       </div>

    </div>
</div>


<!--End Feedback-->

    </div>
</div>

<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="border-0 rounded-0">

            <div class="d-md-flex align-items-center justify-content-between mb-4">
                <!--Start Section Header-->
                <div class="section-header mb-4 position-relative mb-md-0">
                    <h4 class="related_course_txt" style="color: var(--text_color)">Related Ebook</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
            </div>
            <div class="">
                <div class="row ">
                    @foreach ($ebook->ebooks as $relatedebook)
                    @php
                    $rel_ebook = $relatedebook->ebook;
                    @endphp

                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                            <!--Start Course Card-->
                            <div class="course-card rounded-3 bg-white position-relative overflow-hidden">
                                <div class="position-relative">
                                    <!--Start Course Image-->
                                    <a href="{{ route('frontend.ebook_details',$rel_ebook->id) }}"
                                        class="">
                                        <img src="{{ $rel_ebook->image_show ?? ''}}"
                                            class="img-fluid w-100 imgdiv" alt="">
                                    </a>

                                    <div
                                        class="course-card_body bg-prussian-blue text-white p-3 top_shadow position-relative">
                                        <!--Start Course Title-->
                                        <h3 class="course-card__course--title text-uppercase fs-6 mb-1">
                                            <a href="{{ route('frontend.ebook_details',$rel_ebook->id) }}" class="text-decoration-none" >{{ $rel_ebook->title}}</a>
                                        </h3>
                                        <p class=" text-uppercase fs-6">
                                            <a href="{{ route('frontend.ebook_details',$rel_ebook->id) }}" class="text-decoration-none" >{{ $rel_ebook->headline}}</a>
                                        </p>

                                        <!--End Course Title-->
                                        <!--Start Course Hints-->
                                        <table class="course-card__hints table table-borderless table-sm" >
                                            <tbody>
                                                <tr>
                                                    <td class="ps-0">
                                                        <div class="d-flex align-items-center">
                                                            <div class="course-card__hints--icon me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor"
                                                                stroke-width="3"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="feather feather-share-2">
                                                                <circle cx="18" cy="5" r="3"></circle>
                                                                <circle cx="6" cy="12" r="3"></circle>
                                                                <circle cx="18" cy="19" r="3"></circle>
                                                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                                                </svg>
                                                            </div>
                                                            <div class="course-card__hints--text fw-bold"> By {{ $rel_ebook->user->name ?? ''}} </div>
                                                        </div>
                                                    </td>
                                                </tr>


                                                    </tr>

                                            </tbody>
                                        </table>

                                        <div class="align-items-center d-flex fs-12 justify-content-between pt-1 text-white w-100">
                                            {{-- <div class="d-flex align-items-center">
                                                <div class="course-card__hints--icon me-3">
                                                    <svg id="clock_1_" data-name="clock (1)"
                                                        xmlns="http://www.w3.org/2000/svg" width="16.706"
                                                        height="16.706" viewBox="0 0 16.706 16.706">
                                                        <path id="Path_13" data-name="Path 13"
                                                            d="M8.353,0a8.353,8.353,0,1,0,8.353,8.353A8.363,8.363,0,0,0,8.353,0Zm0,15.662a7.309,7.309,0,1,1,7.309-7.309,7.317,7.317,0,0,1-7.309,7.309Z"
                                                            fill="#B5C5DB" />
                                                        <path id="Path_14" data-name="Path 14"
                                                            d="M208.838,83.118h-1.044v5.437l3.285,3.285.738-.738-2.979-2.979Z"
                                                            transform="translate(-199.963 -79.985)" fill="#B5C5DB" />
                                                    </svg>
                                                </div>
                                                <div class="course-card__hints--text fs-12 fw-bold" > {{ @$course->course_hours }} </div>
                                            </div> --}}
                                            {{-- @php
                                                $students =\App\Models\EbookParticipant::leftJoin('ebooks','ebooks.id','ebook_participants.ebook_id')
                                                ->where('ebooks.user_id',$event->user_id)->get();
                                            @endphp --}}
                                            <div class="course-like d-flex align-items-center">
                                                {{-- <i class="fa-solid fa-microphone fa" style="color:#B5C5DB"></i> --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#e2e5e9" d="M192 0C139 0 96 43 96 96V256c0 53 43 96 96 96s96-43 96-96V96c0-53-43-96-96-96zM64 216c0-13.3-10.7-24-24-24s-24 10.7-24 24v40c0 89.1 66.2 162.7 152 174.4V464H120c-13.3 0-24 10.7-24 24s10.7 24 24 24h72 72c13.3 0 24-10.7 24-24s-10.7-24-24-24H216V430.4c85.8-11.7 152-85.3 152-174.4V216c0-13.3-10.7-24-24-24s-24 10.7-24 24v40c0 70.7-57.3 128-128 128s-128-57.3-128-128V216z"/></svg>
                                                <div class="d-block">
                                                    <div class="reviews fs-12 fw-bold" >


                                                        &nbsp;{{ $rel_ebook->audio->count() }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="course-like d-flex align-items-center">
                                                {{-- <i class="fa fa-solid fa-video" style="color:#B5C5DB"></i>&nbsp;&nbsp; --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#d6dce6" d="M0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2V384c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1V320 192 174.9l14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z"/></svg>
                                                <div class="d-block p-1">
                                                    <div class="reviews fs-12 fw-bold" >
                                                        &nbsp;{{ $rel_ebook->video->count() }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!--Start Star Rating-->
                                            <div class="star-rating__wrap d-flex align-items-center ">
                                                {{-- <i class="fas fa-star me-1 text-warning" style="color:#B5C5DB"></i> --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="22.5" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#FFD43B" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z"/></svg>
                                                <div class="d-block">
                                                    @php
                                                    $avg_round = round($rel_ebook->reviews->avg('ratting'),1);
                                                    @endphp
                                                    <div class="reviews fs-12 fw-bold" >&nbsp;{{ $avg_round }} </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--End Course Hints-->
                                    </div>
                                    <!--End Course Card Body-->
                                </div>
                                <div class="course-card_footer g-2 p-3">

                                    <input type="hidden" name="course_id"
                                        id="course_id_LEO094W9R9"
                                        value="LEO094W9R9">
                                    <input type="hidden" name="course_name"
                                        id="course_name_LEO094W9R9"
                                        value="Web Development with Mern Stack">
                                    <input type="hidden" name="slug" id="slug_LEO094W9R9"
                                        value="">
                                    <input type="hidden" name="qty" id="qty" value="1">
                                    <input type="hidden" name="price"
                                        id="price_LEO094W9R9"
                                        value="0">
                                    <input type="hidden" name="old_price"
                                        id="old_price_LEO094W9R9"
                                        value="0">
                                    <input type="hidden" name="picture"
                                        id="picture_LEO094W9R9"
                                        value="{{ asset('frontend') }}/assets/uploads/course/1699527091-f-Live-class-thumb.png">
                                    <input type="hidden" name="is_course_type" id="iscourse_type" value="4">
                                    {{-- <div class="d-block mb-3 mt-2">
                                        <h5><b>{{ format_price(@$rel_ebook->fee) }}</b></h5>
                                        <input type="hidden" id="course_type" value="4">
                                    </div> --}}
                                    <div class="form-check d-flex align-items-center ps-0">
                                        {{-- <input course_id="{{ $course->id }}" id="course_cart_price{{ $course->id }}" class="me-1 active change_cart_val" name="course_price_type[{{ $course->id }}]" style="width:21px;height:21px" type="radio" checked> --}}
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%"
                                            for="">
                                            <span class="course_price_cart" > Ebook Price <span class="text-success"></span></span>
                                            <span class="align-items-center d-flex  rounded text-center">

                                                @if($rel_ebook->discount > 0)
                                                    @if ($rel_ebook->discount_type=="0")
                                                        @php
                                                            $new_price=$rel_ebook->fee -($rel_ebook->fee *$rel_ebook->discount/100);
                                                        @endphp
                                                        <span class="d-block fs-16 fw-bold me-2 text-success2">{{ format_price($new_price)}}</span>
                                                        <del class="fs-12 fw-bold text-muted2">{{ format_price($rel_ebook->fee) }}</del>
                                                    @else
                                                        @php
                                                            $new_price=$rel_ebook->fee - $rel_ebook->discount;
                                                        @endphp
                                                        <span class="d-block fs-16 fw-bold me-2 text-success2">{{ format_price($new_price) }}</span>
                                                        <del class="fs-12 fw-bold text-muted2">{{ format_price($rel_ebook->fee) }}</del>
                                                    @endif
                                                @else
                                                <span class="d-block fs-16 fw-bold me-2 text-success2"> {{ format_price($rel_ebook->fee) }}</span>
                                                @endif


                                                {{-- <span class="d-block fs-16 fw-bold me-2 text-success2">BDT{{ $course->discount }}</span> --}}
                                                {{-- <del class="fs-12 fw-bold text-muted2">{{ $course->fee }}</del> --}}
                                             </span>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-stretch">
                                        @php
                                        $ebook_count=0;
                                        $check_ebook = 0;
                                        if(auth()->check()){
                                            $save = \App\Models\EbookParticipant::where('ebook_id',$rel_ebook->id)->where('user_id',auth()->user()->id)->first();
                                            if($save){
                                                $check_ebook = 1;
                                            }
                                        }
                                        @endphp
                                        @if ($check_ebook ==0)

                                        <div class="flex-grow-1 me-1">
                                            <a href="javascript:void(0)">
                                            <button type="button"
                                                class="align-items-center btn btn-dark-cerulean d-flex justify-content-between px-2 w-100">
                                                <svg width="30" height="17" viewBox="0 0 30 17" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <rect x="0.516113" y="0.831177" width="15.5325" height="15.5325"
                                                        fill="url(#pattern0)" />
                                                    <rect x="27.1436" y="3.05023" width="2.21893" height="11.0946"
                                                        fill="#5482A7" />
                                                    <defs>
                                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox"
                                                            width="1" height="1">
                                                            <use xlink:href="#image0_1_3" transform="scale(0.00653595)" />
                                                        </pattern>
                                                        <image id="image0_1_3" width="153" height="153"
                                                            xlink:href="data:image/png;base64,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" />
                                                    </defs>
                                                </svg>

                                                <span class="w-100 addebookcart" CarId="{{ $rel_ebook->id }}" style="color: #fff">Add To Cart</span>
                                            </button>
                                        </a>
                                      </div>
                                      @endif


                                        <div class="flex-grow-1">
                                            <a type="button"
                                                class="align-items-center btn btn-dark-cerulean d-flex justify-content-between px-2 w-100"
                                                href="{{ route('frontend.ebook_details',$rel_ebook->id) }}">

                                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <rect width="15.5325" height="15.5325"
                                                        transform="matrix(-1 0 0 1 15.8613 0.721741)"
                                                        fill="url(#pattern0)" />
                                                    <defs>
                                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox"
                                                            width="1" height="1">
                                                            <use xlink:href="#image0_228_160"
                                                                transform="scale(0.00653595)" />
                                                        </pattern>
                                                        <image id="image0_228_160" width="153" height="153"
                                                            xlink:href="data:image/png;base64,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" />
                                                    </defs>
                                                </svg>
                                                <span class="w-100" style="color: #fff">Details</span>
                                            </a>
                                        </div>
                                    </div>



                                    {{-- <div class="d-flex justify-content-between align-items-stretch">
                                        <div class="flex-grow-1 me-1">
                                            <a href="javascript:void(0)">
                                            <button type="button"
                                                class="align-items-center btn btn-dark-cerulean d-flex justify-content-between px-2 w-100">
                                                <svg width="30" height="17" viewBox="0 0 30 17" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <rect x="0.516113" y="0.831177" width="15.5325" height="15.5325"
                                                        fill="url(#pattern0)" />
                                                    <rect x="27.1436" y="3.05023" width="2.21893" height="11.0946"
                                                        fill="#5482A7" />
                                                    <defs>
                                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox"
                                                            width="1" height="1">
                                                            <use xlink:href="#image0_1_3" transform="scale(0.00653595)" />
                                                        </pattern>
                                                        <image id="image0_1_3" width="153" height="153"
                                                            xlink:href="data:image/png;base64,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" />
                                                    </defs>
                                                </svg>

                                                <span class="w-100 addebookcart" CarId="{{ $event->id }}" style="color: #fff">Add To Cart</span>
                                            </button>
                                        </a>
                                        </div>


                                        <div class="flex-grow-1">
                                            <a type="button"
                                                class="align-items-center btn btn-dark-cerulean d-flex justify-content-between px-2 w-100"
                                                href="{{ route('frontend.ebook_details',$event->id) }}">

                                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                                    <rect width="15.5325" height="15.5325"
                                                        transform="matrix(-1 0 0 1 15.8613 0.721741)"
                                                        fill="url(#pattern0)" />
                                                    <defs>
                                                        <pattern id="pattern0" patternContentUnits="objectBoundingBox"
                                                            width="1" height="1">
                                                            <use xlink:href="#image0_228_160"
                                                                transform="scale(0.00653595)" />
                                                        </pattern>
                                                        <image id="image0_228_160" width="153" height="153"
                                                            xlink:href="data:image/png;base64,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" />
                                                    </defs>
                                                </svg>
                                                <span class="w-100" style="color: #fff">Details</span>
                                            </a>
                                        </div>
                                    </div> --}}


                                </div>
                            </div>
                            <!--End Course Card-->
                        </div>
                        @endforeach


                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal share-modal" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="mb-3">Share This ebook</h5>
                <!--Start Share Link Input-->
                <!--End Share Link Input-->
                <!--Start Social Share-->
                <ul class="socail-share list-unstyled d-flex mb-0 justify-content-center">
                    <li><a href="https://www.facebook.com/sharer.php?u=https://lead.academy/ebook-details/CO13RT58I93"
                            target="_blank" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon facebook"><i class="fab fa-facebook-f"></i></div>Facebook
                        </a></li>
                    <li><a href="https://twitter.com/share?text=English%20for%20IBA-MBA%20Admission%20Preparation%20&amp;url=https://lead.academy/ebook-details/CO13RT58I93"
                            target="_blank" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon twitter"><i class="fab fa-twitter"></i></div>Twitter
                        </a></li>
                    <li><a href="https://api.whatsapp.com/send?text=[English%20for%20IBA-MBA%20Admission%20Preparation]%20[https://lead.academy/ebook-details/CO13RT58I93]"
                            class="d-block text-center me-3 text-muted" target="_blank" rel="noopener">
                            <div class="socail-share_icon" style="background-color:#37b546;"><i class="fab fa-whatsapp"
                                    style="color:#fff;"></i></div>WhatsApp
                        </a></li>
                    <li><a href="mailto:?subject=English for IBA-MBA Admission Preparation &body=It is not bad to have the achievement of doing an MBA from IBA in your list of achievements after graduation. You can grab the golden opportunity to work in the world&#39;s leading organizations, and take many steps forward in your career if you complete your post-graduation from IBA. We have brought the ebook “English for IBA-MBA Admission Preparation” to fulfil your dream of doing an MBA in IBA.

                                This ebook is designed by analyzing the question pattern of IBA of universities for those who want to &#39;prepare&#39; for the day or evening program of IBA-MBA of DU, JU or other universities at the post-graduation or post-graduation level.
                                PLEASE VISIT THIS LINK:  https://lead.academy/ebook-details/CO13RT58I93"
                            class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon envelope"><i class="far fa-envelope"></i></div>Email
                        </a></li>
                    <li>
                        <a href="https://www.facebook.com/dialog/send?link=https://lead.academy/ebook-details/CO13RT58I93&amp;app_id=311161661010577&amp;redirect_uri=https://lead.academy/ebook-details/CO13RT58I93"
                            target="_blank" class="fbmsg text-capitalize" style="color: #9ea4a9;">
                            <div class="socail-share_icon" style="background-color: #1976d2;"><i style="color: #fff;"
                                    class="fab fa-facebook-messenger"></i></div>Messenger
                        </a>
                        <!-- https://www.facebook.com/dialog/send?link=https%3A%2F%2Flead.academy&app_id=291494419107518&redirect_uri=https%3A%2F%2Fwww.lead.academy -->
                    </li>
                </ul>
                <!--End Social Share-->
            </div>
        </div>
    </div>
</div>







  <!-- Bootstrap JS and Popper.js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




















<script>
$(document).ready(function() {
    $(".related_hideClass .related_ebook").each(function(index) {
        var p_ebook_id = $(this).attr('id');
        $("#ebook_subscriptions_" + p_ebook_id).first().hide();
        $('#ebook_subscriptions_' + p_ebook_id).first().removeClass('d-flex');
    });
});

function ebookchecedRadios(s) {
    if (!$('#flexRadioDefault21_' + s).is('.checked')) {
        $('#flexRadioDefault21_'  + s).addClass('checked');
        $('#flexRadioDefault21_'  + s).prop('checked', true);
        $('#flexRadioDefault21_'  + s).val("1");

        $('#flexRadioDefault11_' + s).val("0");
        $('#flexRadioDefault11_' + s).removeClass('checked');
        $('#flexRadioDefault11_' + s).prop('checked', false);

        $("#ebook_subscriptions_" + s).hide();
        $('#ebook_subscriptions_' + s).removeClass('d-flex');
        $('#ebook_purchases_' + s).addClass('d-flex');
        $("#ebook_purchases_" + s).show();
    }

}

function subscriptionchecedRadios(s) {
    if (!$('#flexRadioDefault11_' + s).is('.checked')) {
        $('#flexRadioDefault11_' + s).addClass('checked');
        $('#flexRadioDefault11_' + s).prop('checked', true);
        $('#flexRadioDefault11_' + s).val("1");

        $('#flexRadioDefault21_' + s).val("0");
        $('#flexRadioDefault21_' + s).removeClass('checked');
        $('#flexRadioDefault21_' + s).prop('checked', false);
        $("#ebook_subscriptions_" + s).show();
        $('#ebook_subscriptions_' + s).addClass('d-flex');
        $('#ebook_purchases_' + s).removeClass('d-flex');
        $("#ebook_purchases_" + s).hide();
    }

}


</script>

<script>
$(document).ready(function() {
    function scrollNav() {
        $('a[href^="#"]').click(function() {
            $(".active").removeClass("active");
            $(this).addClass("active");

            $('html, body').stop().animate({
                scrollTop: $($(this).attr('href')).offset().top - 140
            }, 1000);
            return false;
        });
    }
    scrollNav();

    // Read More
    function showhide() {

        // $("#toggle").click(function(){
        $(".moreText").toggleClass("opened");

        var elem = $("#toggle").text();
        if (elem == "Read More") {
            //Stuff to do when btn is in the read more state
            $("#toggle").text("Read Less");
            // $("#text").slideDown();
        } else {
            //Stuff to do when btn is in the read less state
            $("#toggle").text("Read More");
            // $("#text").slideUp();
        }
        // });

    }
    // showhide();






});

// var $secNavbar = $("#secNavbar"),
//     y_pos = $secNavbar.offset().top,
//     height = $secNavbar.height();

// $(document).scroll(function() {
//     var scrollTop = $(this).scrollTop();

//     if (scrollTop > y_pos + height) {
//         $secNavbar.addClass("navbar-fixed").animate({
//             top: "70px"
//         });
//     } else if (scrollTop <= y_pos) {
//         $secNavbar.removeClass("navbar-fixed").clearQueue().animate({
//             top: "-48px"
//         }, 0);
//     }
// });

// function instructorReplyArea(sl) {
//     $(".replyArea-" + sl).removeClass('d-none');
//     $('.replyAreaBtn-' + sl).addClass('d-none');
// }

// function instructorReplySubmit(sl) {
//     var fd = new FormData();

//     var ebook_id = $("#ebook_id").val();
//     var instructor_id = $("#student_id").val();
//     var rating_id = $("#rating_id_" + sl).val();
//     var UserId = $('#UserId').val();
//     var reply = $("#reply_" + sl).val();
//     var csrf_test_name = $("[name=csrf_test_name]").val();
//     if (reply == '') {
//         toastrErrorMsg("Empty field not allow");
//         return false;
//     }

//     var inp = document.getElementById("attachment_"+sl);
//         if (inp.files.length >= 1) {
//             var attachmentSize = $("#attachment_" + sl)[0].files[0].size;
//             if (attachmentSize > 1048576) {
//                 toastrErrorMsg("Try to upload file less than 1MB!");
//                 return false;
//             }
//         }

//     fd.append("ebook_id", ebook_id);
//     fd.append("instructor_id", instructor_id);
//     fd.append("rating_id", rating_id);
//     fd.append("UserId", UserId);
//     fd.append("reply", reply);
//     fd.append("attachment", $("#attachment_" + sl)[0].files[0]);
//     fd.append("csrf_test_name", CSRF_TOKEN);
//     $.ajax({
//         url: base_url + "instructor-reply-save",
//         type: "POST",
//         data: fd,
//         enctype: "multipart/form-data",
//         processData: false,
//         contentType: false,
//         success: function(r) {
//             // console.log(r);
//             toastrSuccessMsg(r);
//         },
//     });
// }
</script>
</div>
<!--======== main content close ==========-->
{{-- </div> --}}
@include('Frontend.layouts.parts.news-letter')
@endsection





@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>


//Review start
$('.rating-input-block').on('mouseleave',function(){
    let rm = $($('.input-ratting.active')[0]).attr('data-rating');
    // console.log(rm);
    if(rm == undefined){
        rm =0;
    }
    for(let i= 1;i <=rm;i++){
        $('.input-ratting[data-rating="'+i+'"]').addClass('text-warning');
        $('.input-ratting[data-rating="'+i+'"]').removeClass('btn-grey');
    }

    for(let ram = parseInt(rm)+1;ram <= 5;ram++){
        $('.input-ratting[data-rating="'+ram+'"]').removeClass('text-warning');
        $('.input-ratting[data-rating="'+ram+'"]').addClass('btn-grey');
    }

});
$('.rating-input-block').on('mouseenter',function(){
    console.log("over");
});
$('.input-ratting').on('click',function(){

    $('.input-ratting').not(this).removeClass('active');
    if( $(this).hasClass('active')){
        $('#input_rating').val('');
        $(this).removeClass('active');
    }else{
         $('#input_rating').val( $(this).attr('data-rating'));
        $(this).addClass('active');
    }

})
$('.input-ratting').hover(function() {
    for(let i= 1;i <= $(this).attr('data-rating');i++){
        $('.input-ratting[data-rating="'+i+'"]').addClass('text-warning');
        $('.input-ratting[data-rating="'+i+'"]').removeClass('btn-grey');
    }

    for(let ram = parseInt($(this).attr('data-rating'))+1;ram <= 5;ram++){
        $('.input-ratting[data-rating="'+ram+'"]').removeClass('text-warning');
        $('.input-ratting[data-rating="'+ram+'"]').addClass('btn-grey');
    }
});

//Review end

// Subcripe
$('.change_cart_val').on('change',function(){
    console.log(this.id);
    if(this.id == "ebook_subcribe"+$(this).attr('ebook_id')){
        $('.ebook_subcribe'+$(this).attr('ebook_id')).show();
        $('.ebook_cart_price'+$(this).attr('ebook_id')).hide();
    }else{
        $('.ebook_subcribe'+$(this).attr('ebook_id')).hide();
        $('.ebook_cart_price'+$(this).attr('ebook_id')).show();
    }
    //if($(th)
});



</script>

@endsection
