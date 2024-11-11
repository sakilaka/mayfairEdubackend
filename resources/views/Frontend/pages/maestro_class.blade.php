
@extends('Frontend.layouts.master-layout')
@section('title','- Master Class')
@section('head')

@endsection
@section('main_content')
@include('Frontend.layouts.parts.header-menu')





    {{-- @include('Frontend.layouts.parts.news-letter') --}}



<main>

<!-- Place favicon.ico in the root directory -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/fab.html">
<!-- CSS here -->
{{-- <link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/bootstrap.min.css"> --}}
{{-- <link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/animate.min.css"> --}}
<!-- <link rel="stylesheet" href=""> -->
<link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/jquery.fancybox.min.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/fontAwesome5Pro.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/default.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/style-latest.css">
<link rel="stylesheet" href="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/css/responsive-latest.css">

<!-- Banner Start -->
<section class="banner">
   <div class="container-fluid p-0 m-0 position-relative">
      <div class="logo">
         <img src="{{ $content->banner_image_show }}" alt="">
      </div>

      <!-- <iframe width="100%" height="500" src="https://www.youtube.com/embed/KlsYjs7UlTk?rel=0&mute=1&autoplay=1&controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; autostop; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->



<!-- <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/850141752?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Prostuti English Trailer"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script> -->


<!-- <video playsinline="playsinline" loop="loop" width="100%" height="100%"  loop="true" autoplay="autoplay" muted>
   <source src="http://localhost/lead_aff/assets/uploads/sliders/2022-01-10/b84022e079eb1fad75cb8b6e3dd306d3.mp4" type="video/mp4">
</video> -->



<!-- <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="http://localhost/lead_aff/assets/uploads/sliders/2022-01-10/b84022e079eb1fad75cb8b6e3dd306d3.mp4" type="video/mp4">
</video> -->

<video playsinline="playsinline" loop="loop" width="100%" height="100%" loop="true" autoplay="autoplay" muted>
               <source src="{{ $content->banner_video_show }}">
            </video>   </div>
</section>
<!-- Banner end -->

<!-- Teacher start -->
<section class="teacher  pt-30 pb-30 mb-60 position-relative">
   <div class="container">
      <ul class="nav nav-tabs mb-80 justify-content-center" id="myTab" role="tablist">
         @foreach ($categories as $k=> $category)
            
         
         <li class="nav-item" role="presentation">
           <button class="nav-link  on_click_category" cat_id="{{ $category->id }}">{{ $category->name }}</button>
         </li>
         @endforeach
       </ul>
      </div>
      <div class="container-fluid m-0 p-0">
         <div class="tab-content" id="myTabContent">
            
            <div class="tab-pane fade show active " id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="teacher__slider owl-carousel course_cat_ajax-show" >
                        @foreach ($master_courses as $master_course)
                        <a href="{{ route('frontend.maestro_class_details', $master_course->id) }}">
                           <div class="card card-body border-0 bg-transparent">
                              <div class="teacher__box">
                                 <div class="teacher__banner">
                                    <img src="{{ $master_course->teacher->image_show ?? '' }}" alt="photo">
                                 </div>
                                 <div class="teacher__box__content">
                                    <h3>{{ $master_course->teacher->name ?? '' }}</h3>
                                    <p>{{ $master_course->teacher->designation ?? '' }}, {{ $master_course->teacher->institution ?? '' }}</p>
                                    <h5>{{ $master_course->name ?? '' }}</h5>
                                 </div>
                              </div>
                           </div>
                        </a>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>

            
            {{-- <div class="tab-pane fade" id="tabMCC0786TCY" role="tabpanel" aria-labelledby="tabMCC0786TCY-tab">

               <div class="row">
                  <div class="col-xxl-12">
                     <div class="teacher__slider owl-carousel">
                                                <a href="maestroclass-detailsMCO07HPML267.html">
                           <div class="div">
                              <div class="teacher__box">
                                 <div class="new__tag">
                                    <span></span>
                                 </div>
                                 <div class="teacher__banner">
                                    <img src="{{ asset('frontend') }}/assets/uploads/maestroclass/course/Cover1691418591-f-Mini%20Thumb.jpg" alt="photo">
                                 </div>
                                 <div class="teacher__box__content">
                                    <h3>Syed Ferhat Anwar</h3>
                                    <p>Former Director, IBA, Dhaka University</p>
                                    <h5><p>In this captivating MaestroClass, the revered Dr. Syed Ferhat Anwar, a distinguished&#8230;</h5>
                                 </div>
                              </div>
                           </div>
                        </a>
                                             </div>
                  </div>
               </div>

            </div> --}}

            
            {{-- <div class="tab-pane fade" role="tabpanel" aria-labelledby="tabMCC05D14G5-tab">

               <div class="row">
                  <div class="col-xxl-12">
                     <div class="teacher__slider owl-carousel">
                                                <a href="maestroclass-detailsMCO05QV51F100.html">
                           <div class="div">
                              <div class="teacher__box">
                                 <div class="new__tag">
                                    <span></span>
                                 </div>
                                 <div class="teacher__banner">
                                    <img src="{{ asset('frontend') }}/assets/uploads/maestroclass/course/Cover1702898831-f-Cover1691418591-f-Mini%20Thumb%20copy.jpg" alt="photo">
                                 </div>
                                 <div class="teacher__box__content">
                                    <h3>Masud Khan</h3>
                                    <p>Chairman, Unilever Consumer Care Limited</p>
                                    <h5><p>In this engaging MaestroClass, Mr. Masud Khan, a seasoned maestro with 43 years&#8230;</h5>
                                 </div>
                              </div>
                           </div>
                        </a>
                                             </div>
                  </div>
               </div>

            </div> --}}

            
<!--             <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">..2.</div>
            <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">..3.</div> -->

          </div>

<!--             <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="teacher__slider owl-carousel">

                        <div class="div">
                           <div class="teacher__box">
                              <div class="new__tag">
                                 <span>New</span>
                              </div>
                              <div class="teacher__banner">
                                 <img src="" alt="">
                              </div>
                              <div class="teacher__box__content">
                                 <h3><a href="">Shabbir Ahmed</a></h3>
                                 <p>Former Director IBA, Dhaka University</p>
                                 <h5>Teaches Scientific Thinking and Communi...</h5>
                              </div>
                           </div>
                        </div>

                        <div class="div">
                           <div class="teacher__box">
                              <div class="new__tag">
                                 <span>New</span>
                              </div>
                              <div class="teacher__banner">
                                 <img src="" alt="">
                              </div>
                              <div class="teacher__box__content">
                                 <h3><a href="">Sania Mahmud</a></h3>
                                 <p>Former Director IBA, Dhaka University</p>
                                 <h5>Teaches Scientific Thinking and Communi...</h5>
                              </div>
                           </div>
                        </div>
                        
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">...</div>
            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">...</div>
            <div class="tab-pane fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">...</div>
          </div> -->

      </div>
       
   </div>
</section>
<!-- Teacher end -->

<!-- Middle content start -->
@if (Auth::check())

@else
<section class="middle__content mb-50">
   <div class="container text-center">
      <div class="title-style-1 mb-50">
         <h3>Start your journey today.</h3>
      </div>
      <p>Full Free learning from the maestros.</p>
      <a href="{{ route('frontend.register') }}" class="btn btn-signup">Sign Up</a>
   </div>
</section>
@endif
<!-- Middle content end -->
</main>


@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
<script>
    $('.teacher__slider').owlCarousel({
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


$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

        //Category

      $(".on_click_category").click(function(e){
      e.preventDefault();
      var id = $(this).attr('cat_id');
      //console.log(id);
      $.ajax({
         type:'GET',
         url:"{{ url('master-course-category-show-ajax') }}/"+id,

         // data:{id:id},

         success:function(data){
         //  document.getElementById("home-proud-hide").style.visibility = "hidden";
            $(".course_cat_ajax-show").html(data);
         }

      });



      });
</script>
@endsection