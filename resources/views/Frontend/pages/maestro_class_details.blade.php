@extends('Frontend.layouts.master-layout')
@section('title','- Master Class Details')
@section('head')

@endsection
@section('main_content')
@include('Frontend.layouts.parts.header-menu')

<!-- Main content -->
<main><!-- <input type="hidden" id="user_session" value=""> -->
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/fab.html">
    <!-- CSS here -->
    {{-- <link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/animate.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/fontAwesome5Pro.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/default.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/style-latest.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/responsive-latest.css">
    
    <!-- Banner Start -->
    <section class="banner-two">
       <div class="container-fluid p-0 m-0 position-relative">
          <div class="banner-box">
             <div class="banner-box-img">
                <img src="{{ $master_course->teacher->image_show ?? '' }}" alt="">
             </div>
             <div class="banner-box-content text-center">
                <h1>{{ $master_course->teacher->name ?? '' }}</h1>
                <h5>{{ $master_course->teacher->designation ?? '' }}, {{ $master_course->teacher->institution ?? '' }}</h5>
                <h3>{{ $master_course->name ?? '' }}</h3>
                <p><p>{!! $master_course->teacher->description ?? '' !!}</p>
    </p>
                <div class="banner-box-btn mt-30">
                   <div class="d-table m-auto">
                      <div class="d-flex">
                         <div class="pr-10">
                            <a href="{{ $master_course->trailer_video_url }}" class="popup-youtube">
                               <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/maestroclass/icon/trailer.svg" alt="">
                               <p>Trailer</p>
                            </a>
                         </div>
                         <div class="pl-10">
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#shareModal">
                               <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/maestroclass/icon/share.svg" alt="">
                               <p>Share</p>
                            </a>
                         </div>
                         <div class="pl-25">
                            <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/maestroclass/icon/students.svg" alt="">
                            <p>43</p>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    
       <!-- Player Modal -->
       {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog  modal-dialog-centered">
             <div class="modal-content">
                <a href="#" data-bs-dismiss="modal" aria-label="Close" class="close-btn">x</a>
                <div class="modal-body">
                                  <div style="padding:56.25% 0 0 0;position:relative;">
                      <iframe src="{{ $master_course->trailer_video_url }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Subject-Verb Agreement"></iframe>
                   </div>
                </div>
             </div>
          </div>
       </div> --}}
    
       <!-- Social Share Modal -->
       <div class="modal share-modal" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                <div class="modal-body text-center">
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   <h5 class="mb-3">Share This Course</h5>
                   <ul class="socail-share list-unstyled d-flex mb-0 justify-content-center">
                      <li><a href="https://www.facebook.com/sharer.php?u=https://lead.academy/maestroclass-details/MCO05QV51F100" target="_blank" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon facebook"><i class="fab fa-facebook-f"></i></div>Facebook
                         </a></li>
                      <li><a href="https://twitter.com/share?text=Masud%20Khan%20&amp;url=https://lead.academy/maestroclass-details/MCO05QV51F100" target="_blank" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon twitter"><i class="fab fa-twitter"></i></div>Twitter
                         </a></li>
                      <li><a href="https://api.whatsapp.com/send?text=[Masud%20Khan]%20[https://lead.academy/maestroclass-details/MCO05QV51F100]" class="d-block text-center me-3 text-muted" target="_blank" rel="noopener">
                            <div class="socail-share_icon" style="background-color:#37b546;"><i class="fab fa-whatsapp" style="color:#fff;"></i></div>WhatsApp
                         </a></li>
                      <li><a href="mailto:?subject=Masud Khan &body=Masud Khan is the current Chairman of Unilever Consumer Care Ltd. and also of the Board at Crown Cement Group. He is also the Independent Director and Chairman of the Audit Committee at Singer Bangladesh Limited and Community Bangladesh Bank Limited. 
     PLEASE VISIT THIS LINK:  https://lead.academy/maestroclass-details/MCO05QV51F100" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon envelope"><i class="far fa-envelope"></i></div>Email
                         </a></li>
                      <li>
                         <a href="https://www.facebook.com/dialog/send?link=https://lead.academy/maestroclass-details/MCO05QV51F100&amp;app_id=311161661010577&amp;redirect_uri=https://lead.academy/maestroclass-details/MCO05QV51F100" target="_blank" class="fbmsg text-capitalize" style="color: #9ea4a9;">
                            <div class="socail-share_icon" style="background-color: #1976d2;"><i style="color: #fff;" class="fab fa-facebook-messenger"></i></div>Messenger
                         </a>
                         <!-- https://www.facebook.com/dialog/send?link=https%3A%2F%2Flead.academy&app_id=291494419107518&redirect_uri=https%3A%2F%2Fwww.lead.academy -->
                      </li>
                   </ul>
                   <!--End Social Share-->
                </div>
             </div>
          </div>
       </div>
    
    </section>
    <!-- Banner end -->
    
    <!-- About Class start -->
    <section class="about__class">
       <div class="container">
          <nav>
             <div class="nav nav-tabs about-tabs justify-content-center" id="nav-tab" role="tablist">
                <button class="nav-link active" id="class-info-tab" data-bs-toggle="tab" data-bs-target="#class-info" type="button" role="tab" aria-controls="class-info" aria-selected="true">Class Info</button>
                <button class="nav-link" id="related-tab" data-bs-toggle="tab" data-bs-target="#related" type="button" role="tab" aria-controls="related" aria-selected="false">Related</button>
             </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
             <div class="tab-pane fade show active" id="class-info" role="tabpanel" aria-labelledby="class-info-tab">
                <div class="title-style-1 mt-60">
                   <h3 class="text-start">About this Class</h3>
                </div>
                <div class="row p-relative">
                   <div class="col-lg-7">
                      <div class="class__content__left">
                         <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="class-trailer" role="tabpanel" aria-labelledby="class-trailer-tab">
                               <input type="hidden" id="trailer_vdo" value="{{ $master_course->trailer_video_url }}">
                              
                               <div style="padding:56.25% 0 0 0; position:relative;" id="vdo-player"></div>
                               <!-- <div style="padding:56.25% 0 0 0; position:relative;" id="vimeo-player"></div> -->
                               <div class="mt-10">
                                  <h4 id="mc-lesson-name"></h4>
                               </div>
                            </div>
                            <div class="tab-pane fade" id="class-sample" role="tabpanel" aria-labelledby="class-sample-tab">
                               <!-- <h3>Not content found</h3> -->
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="col-lg-5">
                      <div class="class__content__right">
                         <nav>
                            <div class="nav nav-tabs border-0" id="nav-tab" role="tablist">
                               <button class="nav-link active w-100" id="ct_trailer">
                                  <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/maestroclass/icon/play.svg" alt=""> Trailer</button>
                                                       </div>
                         </nav>
                      </div>
                   </div>
                   <div class="col-lg-7">
                      <div class="class__content__left mt-10">
    
                         <p>{!! $master_course->about ?? '' !!}
    </p>
                         <h5>Instructor(s): <strong> {{ $master_course->teacher->name ?? '' }}</strong></h5>
                         <h5>Class Length: <strong> {{ $master_course->course_content->count() ?? '' }}  video lessons ()</strong></h5>
                         <h5>Category: <strong> {{ $master_course->b_category->name ?? '' }}</strong></h5>
                      </div>
                   </div>
                   <div class="col-lg-5">
    
                      
                         <div class="faq lesson__plan mt-35">
                            <h3>Browse Lesson Plans</h3>
                            <div class="accordion mt-20">
                              @foreach ($master_course->course_content as $k=> $lesson)
                                 
                              
                              <div class="accordion-item">
                                     <h2 class="accordion-header">
                                        <button class="accordion-button d-flex gap-3 align-items-center" type="button"
                                           id="btn-lesson-name"
                                           onclick="getVdo('{{ $k }}',
                                                          '{{ $lesson->conten_url }}', 
                                                          'MCO05QV51F100', 
                                                          'MLE05CVMKZ2800',
                                                          '{{ $lesson->name }}',
                                                          '{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/maestroclass/icon/playing.svg',
                                                          '{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/maestroclass/icon/play.svg');">
                                           <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/maestroclass/icon/play.svg" 
                                                 alt=" Leadership in Adverse Situations"
                                                 id="lesson-img-{{ $k }}">     
                                            {{ $lesson->name }}                                   
                                          </button>
                                     </h2>

                                     {{-- <iframe width="695" height="391" src="https://www.youtube.com/embed/CCFmDbUsJRI" title="Best Motivational Speech Compilation Ever - 3 Hours of Motivation To Change Forever" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}
                              </div>
                              @endforeach
                              </div>
                         </div>
    
                      
                   </div>
                </div>
             </div>
             <div class="tab-pane fade" id="related" role="tabpanel" aria-labelledby="related-tab">
                <!-- <h3>Not content found</h3> -->
             </div>
    
          </div>
       </div>
    </section>
    <!-- About Class end -->
    
          <!-- Related Classes start -->
          <section class="teacher related__classes  pt-30 pb-120 position-relative">
             <div class="container">
                <div class="title-style-1 mb-50">
                   <h3>Related Classes</h3>
                </div>
             </div>
             <div class="container-fluid p-0 m-0" style="padding: 3px">
                <div class="row">
                   <div class="col-xxl-12" >
                      <div class="related__class__slider owl-carousel">
                        @foreach ($master_courses as $master_course)
                          <a href="{{ route('frontend.maestro_class_details', $master_course->id) }}">
                              <div class="card card-body border-0 bg-transparent">
                                 <div class="teacher__box">
                                    <div class="new__tag">
                                       <span></span>
                                    </div>
                                    <div class="teacher__banner">
                                       <img src="{{ $master_course->teacher->image_show ?? '' }}" alt="">
                                    </div>
                                    <div class="teacher__box__content">
                                       <h3>{{ $master_course->teacher->name ?? '' }}</h3>
                                       <p>{{ $master_course->teacher->designation ?? '' }}, {{ $master_course->teacher->institution ?? '' }}</p>
                                       <h5>{{ $master_course->name ?? ''}}</h5>
                                    </div>
                                 </div>
                              </div>
                           </a>
                        @endforeach              
                     </div>
                   </div>
                </div>
             </div>
          </section>
          <!-- Related Classes end -->
    
    
    
    <script type="text/javascript">
       let vdo_trailer = $('#trailer_vdo').val();
       var getYouTubeVideoID = vdo_trailer.split('v=')[1];
       var cleanVideoID = getYouTubeVideoID.replace(/(&)+(.*)/, "");
      
       if (cleanVideoID) {
          $('#vdo-player').html('<iframe src="https://www.youtube.com/embed/' + cleanVideoID + '?badge=0&amp;autopause=0&amp;autoplay=1&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Subject-Verb Agreement"></iframe>');
       }
    
       $('#ct_trailer').on('click', function(e) {
         console.log(this);
          e.preventDefault();
          if (cleanVideoID) {
             $('#vdo-player').html('<iframe src="https://www.youtube.com/embed/' + cleanVideoID + '?badge=0&amp;autopause=0&amp;autoplay=1&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Subject-Verb Agreement"></iframe>');
          }
       });
    
       var previousImgId = '';
       function getVdo(imgTagId, vdo_url, courseId, currentLessonId, currentLessonName, playingImage, playImage) {
          let vdo_id = vdo_url.replace("https://youtube.com/", "");
          var getYouTubeVideoID2 = vdo_url.split('v=')[1];
          var cleanVideoID2 = getYouTubeVideoID2.replace(/(&)+(.*)/, "");
          $('#vdo-player').html('<iframe src="https://www.youtube.com/embed/' + cleanVideoID2 + '?badge=0&amp;autopause=0&amp;autoplay=1&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Subject-Verb Agreement"></iframe>');
             $('html, body').animate({
                scrollTop: $(".about__class").offset().top
             }, 1000);
             
          changeClickedLessonImage(imgTagId, currentLessonName, playingImage, playImage);   
    
         //  var player = new Vimeo.Player('vdo-player', '');
    
         //  var nextVideoId = '';
    
         //  player.on('ended', function() {
         //     $.ajax({
         //        type: 'POST',
         //        url: base_url + "maestroclass-next-lesson",
         //        dataType: 'json',
         //        cache: false,
         //        data: {
         //           courseId: courseId,
         //           currentLessonId: nextVideoId != '' ? nextVideoId : currentLessonId,
         //           csrf_test_name: CSRF_TOKEN
         //        },
         //        success: function(response) {
         //           let next_video_id = response['provider_url'].replace("https://youtube.com/", "");
         //           nextVideoId = response['lesson_id'];
         //           // Load the next video
         //           player.loadVideo(next_video_id).then(function(id) {
         //              // Autoplay the next video
         //              player.play();
         //              var dynamicContent = response['lesson_name']; 
    
         //              var imgId;
         //              var matchingElements = document.querySelectorAll('[id^="lesson-img-"]');
         //              matchingElements.forEach(function(element) {
         //                 var elementId = element.id;
         //                 // console.log(elementId); 
         //                 var lName = document.getElementById(elementId).getAttribute('alt');
         //                 // console.log(lName); 
         //                 if(dynamicContent == lName){
         //                    var splitId = elementId.split('-');
         //                    imgId = splitId[2];
         //                 }
         //              });
    
         //              changeClickedLessonImage(imgId, dynamicContent, playingImage, playImage); 
         //           });
         //        }
         //     });
         //  });
       }
    
       function changeClickedLessonImage(id, currentLessonName, playingImage, playImage){
          document.getElementById('mc-lesson-name').innerHTML = currentLessonName;
             
          if(previousImgId != '') {
             document.getElementById('lesson-img-'+previousImgId).src = playImage;
          }
          previousImgId = id;
          
          const playing = document.getElementById('lesson-img-'+id).src = playingImage;
          // Scroll to the top
          // playing.style.transform = 'translateX(0)';
       }
    
       function classSample(csvdo_url) {
          let csvdo_id = csvdo_url.replace("https://youtube.com/", "");
          $('#vdo-player').html('<iframe src="https://www.youtube.com/embed/' + csvdo_id + '?badge=0&amp;autopause=0&amp;autoplay=1&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Subject-Verb Agreement"></iframe>');
       }
    </script></main>
    <!--======== main content close ==========-->

@endsection

@section('script')
<script>
    $('.related__class__slider').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            autoHeight: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1100: {
                    items: 3
                }
            }
        });
</script>
@endsection