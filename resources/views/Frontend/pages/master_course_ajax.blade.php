{{-- <div class="teacher__slider owl-carousel">
    @foreach ($master_courses as $master_course)
    <a href="{{ route('frontend.maestro_class_details', $master_course->id) }}">
       <div class="div">
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
 </div> --}}

 @foreach ($master_courses as $master_course)
 <a href="{{ route('frontend.maestro_class_details', $master_course->id) }}">
    <div class="card card-body border-0 bg-transparent col-md-4">
       <div class="teacher__box">
          <div class="teacher__banner">
             <img src="{{ $master_course->teacher->image_show ?? '' }}" alt="photo" style="">
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

 {{-- <div class="row">
    <div class="col-xxl-12">
       <div class="teacher__slider owl-carousel ">
          @foreach ($master_courses as $master_course)
          <a href="{{ route('frontend.maestro_class_details', $master_course->id) }}">
             <div class="div">
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
 </div> --}}

 
 {{-- <script>
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
 </script> --}}