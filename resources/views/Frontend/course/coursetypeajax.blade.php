@foreach ($courses as $course)
<div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 hideClass" id="50">
    <!--Start Course Card-->
    <div
        class="course-card course-card-shadow rounded-6 bg-white position-relative overflow-hidden">
        <div class="position-relative overflow-hidden bg-prussian-blue">
            <!--Start Course Image-->
            <a href="{{ route('frontend.course.details',$course->id) }}"
                class="course-card_img">
                <img src="{{ @$course->university->image_show ?? ''}}"
                    class="img-fluid w-100" alt="">
            </a>
            <!--End Course Image-->
            <div
                class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100 z-index-2">
                <input type="hidden" value="CO09ICCG850"
                    id="course_id">
                <input type="hidden" value="" id="student_id">
                <input type="hidden" value="" id="user_type">
                {{-- <span class="badge-new me-1">
                    @if ($course->coursetype=='1')
                    Our Top Picks
                    @elseif ($course->coursetype=='2')
                    Most Popular
                    @elseif ($course->coursetype=='3')
                    Fastest Admissions
                    @elseif ($course->coursetype=='4')
                    Highest Rating
                    @elseif ($course->coursetype=='5')
                    Top Ranked
                    @else
                    @endif
                </span> --}}

                {{-- <span class="badge-business" >
                    {{ @$course->language->name }}
                </span> --}}

            @php
                $is_save = 0;
                if(auth()->check()){
                    $save = \App\Models\CourseSave::where('course_id',$course->id)->where('user_id',auth()->user()->id)->first();
                    if($save){
                        $is_save = 1;
                    }
                }
            @endphp

            <a href="javascript:void(0)" @if($is_save == 1) style="color: #00a662;" @endif class="text-center add-save" c_id="{{ $course->id }}">
                <i class="far fa-bookmark ml-4" style="cursor: pointer;font-size: 30px;"></i>

            </a>

                {{-- <span  class="ms-auto">
                        <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/bookmark-1.png"
                        class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                </span> --}}
            </div>
            {{-- @if($course->discount > 0)
            <span class="px-0 badge m-3 position-absolute start-0 z-index-2 polygon-shape" style="top:25px; color: var(--product_text_color)">
                <span class="d-block fs-13 mb-1">
                    @if ($course->discounttype == "0")
                    Off {{ @$course->discount}}%
                    @else
                      Off ${{ @$course->discount}}
                    @endif
                </span>

            </span>
            @endif --}}

            <!--Start Course Card Body-->
            <div class="bg-prussian-blue course-card_body course_middle px-3 py-2 text-white py-12">
                <!--Start Course Title-->
                <h3 class="course-card__course--title  mb-0">
                    <!-- <a href=""
                        class="text-decoration-none text-white"></a> -->
                        <a href="{{ route('frontend.course.details',$course->id) }}"
                                class="text-decoration-none" >{{ $course->name }}</a></h3>
                <!--End Course Title-->
                <div class="course-card__instructor d-flex align-items-center">
                    <div class="card__instructor--name my-2">
                        <a class="text-capitalize instructor-name" 
                            href="{{ route('frontend.course.details',$course->id) }}">{{ @$course->teacher->name }}</a>
                    </div>
                </div>
                <!--Start Course Hints-->
                <table
                    class="course-card__hints table table-borderless table-sm text-white mb-0">
                    <tbody>
                        <tr>
                            <td width="80" class="ps-0">
                                <div class="d-flex align-items-center">
                                    <div class="course-card__hints--icon me-3">
                                        <div class="d-flex align-items-center" >
                                            <div class="bar-custom me-2">
                                                <span class="fill"></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-card__hints--text fs-12 fw-bold" >{!! substr(@$course->university->name,0,30)!!}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="80" class="ps-0">
                                <div class="d-flex align-items-center">
                                    <div class="course-card__hints--icon me-3">
                                        <div class="d-flex align-items-center" >
                                            <div class="bar-custom me-2">
                                                <span class="fill"></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-card__hints--text fs-12 fw-bold" >{{ @$course->department->name }}</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="ps-0">
                                <div class="d-flex align-items-center">
                                    <div class="course-card__hints--icon me-3">
                                        <svg id="document" 
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="17.26" height="14.926"
                                            viewBox="0 0 17.26 14.926">
                                            <path id="Path_148" data-name="Path 148"
                                                d="M16.065,17.081H1.2a1.2,1.2,0,0,0-1.2,1.2V28.364a1.2,1.2,0,0,0,1.2,1.2h8.67l-.262,1.6a.69.69,0,0,0,1.041.75l1.871-.985a.393.393,0,0,1,.248,0l1.871.985a.834.834,0,0,0,.388.1.656.656,0,0,0,.387-.123.726.726,0,0,0,.266-.728l-.262-1.6h.651a1.2,1.2,0,0,0,1.2-1.2V18.277A1.2,1.2,0,0,0,16.065,17.081ZM12.64,27.511a2.084,2.084,0,1,1,2.084-2.084A2.086,2.086,0,0,1,12.64,27.511Zm.6,2.5a1.383,1.383,0,0,0-1.2,0l-1.323.7.42-2.565a3.1,3.1,0,0,0,3.007,0l.164,1v.005l.256,1.56Zm2.994-1.651a.173.173,0,0,1-.171.171h-.819l-.187-1.142s0-.009,0-.013a3.108,3.108,0,1,0-4.831,0l0,.013-.187,1.142H1.2a.173.173,0,0,1-.171-.171V18.277a.173.173,0,0,1,.171-.171H16.065a.173.173,0,0,1,.171.171Z"
                                                transform="translate(0 -17.081)"
                                                fill="var(--button2_color)" />
                                            <path id="Path_149" data-name="Path 149"
                                                d="M43.246,60.243H31.631a.512.512,0,0,0,0,1.025H43.246a.512.512,0,0,0,0-1.025Z"
                                                transform="translate(-28.993 -57.295)"
                                                fill="var(--button2_color)" />
                                            <path id="Path_150" data-name="Path 150"
                                                d="M36.55,100.911H31.631a.512.512,0,0,0,0,1.025H36.55a.512.512,0,0,0,0-1.025Z"
                                                transform="translate(-28.993 -95.184)"
                                                fill="var(--button2_color)" />
                                        </svg>
                                    </div>
                                    <div class="course-card__hints--text fs-12 fw-bold" >{{ @$course->degree->name }}</div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <!--End Course Hints-->
                <div class="align-items-center d-flex fs-12 justify-content-between pt-1 text-white w-100">
                    {{-- <div class="d-flex align-items-center">
                        <div class="course-card__hints--icon me-3">
                            <svg id="clock_1_" data-name="clock (1)"
                                xmlns="http://www.w3.org/2000/svg" width="16.706"
                                height="16.706" viewBox="0 0 16.706 16.706">
                                <path id="Path_13" data-name="Path 13"
                                    d="M8.353,0a8.353,8.353,0,1,0,8.353,8.353A8.363,8.363,0,0,0,8.353,0Zm0,15.662a7.309,7.309,0,1,1,7.309-7.309,7.317,7.317,0,0,1-7.309,7.309Z"
                                    fill="var(--button2_color)" />
                                <path id="Path_14" data-name="Path 14"
                                    d="M208.838,83.118h-1.044v5.437l3.285,3.285.738-.738-2.979-2.979Z"
                                    transform="translate(-199.963 -79.985)"
                                    fill="var(--button2_color)" />
                            </svg>
                        </div>
                        <div class="course-card__hints--text fs-12 fw-bold" >{{ @$course->course_hours }}</div>
                    </div>
                     --}}
                    @php
                    $students =\App\Models\CourseParticipant::leftJoin('courses','courses.id','course_participants.course_id')
                        ->where('courses.teacher_id',$course->teacher_id)->get();
                    @endphp


                    {{-- <div class="course-like d-flex align-items-center">
                        <i class="fas fa-graduation-cap fs-20 me-1 mt-1"
                            style="color:var(--button2_color); "></i>
                        <div class="d-block">
                            <div class="reviews fs-12 fw-bold" >{{ $students->count() }}</div>
                        </div>
                    </div> --}}


                    <!--Start Star Rating-->
                    {{-- <div class="star-rating__wrap d-flex align-items-center mt-1">
                        <i class="fas fa-star me-1 text-warning"
                            style="color:var(--button2_color)"></i>
                        <div class="d-block">
                            @php
                            $avg_round = round($course->reviews->avg('ratting'),1);
                            @endphp
                            <div class="reviews fs-12 fw-bold" >{{$avg_round }}</div>
                        </div>
                    </div> --}}



                </div>
            </div>
            <!--End Course Card Body-->
            <!--Start Course Card Hover Content-->
            
        </div>
        <div class="course-card_footer g-2 px-3 py-12">
        <!-- before purchase  -->
            <!-- add to cart  -->
            <input type="hidden" name="course_id" id="course_id_CO09ICCG850" value="CO09ICCG850">
            <input type="hidden" name="course_name" id="course_name_CO09ICCG850" value="Fast Track Spoken English &amp; Fluency">
            <input type="hidden" name="slug" id="slug_CO09ICCG850" value="fast-track-spoken-english-&amp;-fluency">
            <input type="hidden" name="qty" id="qty" value="1">
            <input type="hidden" name="price" id="price_CO09ICCG850" value="1200">
            <input type="hidden" name="old_price" id="old_price_CO09ICCG850" value="2000">
            <input type="hidden" name="picture" id="picture_CO09ICCG850" value="{{ asset('frontend') }}/assets/uploads/course/Thumb1681378103-f-Spoken-English-Mini-thumb.png">
            <input type="hidden" name="is_course_type" id="iscourse_type" value="0">
            <input type="hidden" name="affiliator_id" id="affiliator_id" value="">
            <input type="hidden" name="course_price" id="course_price" value="1200">
            <input type="hidden" name="student_discount" id="student_discount" value="">
            <!-- add to cart  -->
            <div class="d-block">

                {{-- <div class="align-items-center d-flex form-check ps-0">
                    <input name="course_price_type[{{ $course->id }}]" class="me-1 change_cart_val @if(Auth::check()) active @endif" style="width:21px;height:21px" course_id="{{ $course->id }}" id="course_subcribe{{ $course->id }}" type="radio"  @if (Auth::check() == false) disabled @endif>
                    <label class="form-check-label fw-bold @if (Auth::check() == false) opa-half @endif course_price_cart" for="course_subcribe{{ $course->id }}">Subscription</label>
                </div> --}}

                <div class="form-check d-flex align-items-center ps-0">
                    {{-- <input course_id="{{ $course->id }}" id="course_cart_price{{ $course->id }}" class="me-1 active change_cart_val" name="course_price_type[{{ $course->id }}]" style="width:21px;height:21px" type="radio" checked> --}}
                    <label
                        class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                        style="width:100%"
                        for="course_cart_price{{ $course->id }}">
                        <span class="course_price_cart" >Yearly Fee <span class="text-success"></span></span>
                        <span class="align-items-center d-flex  rounded text-center">
                        <span class="d-block fs-16 fw-bold me-2 text-success2">{{ convertCurrency($course->year_fee) }}</span>


                            {{-- @if($course->discount > 0)
                                @if ($course->discounttype=="0")
                                    @php
                                        $new_price=$course->tuition_fee -($course->tuition_fee *$course->discount/100);
                                    @endphp
                                    <span class="d-block fs-16 fw-bold me-2 text-success2">${{ format_price($new_price)}}</span>
                                    <del class="fs-12 fw-bold text-muted2">${{ format_price($course->tuition_fee) }}</del>
                                @else
                                    @php
                                        $new_price=$course->tuition_fee - $course->discount;
                                    @endphp
                                    <span class="d-block fs-16 fw-bold me-2 text-success2">${{ format_price($new_price)}}</span>
                                    <del class="fs-12 fw-bold text-muted2">${{ format_price($course->tuition_fee)}}</del>
                                @endif
                            @else
                            <span class="d-block fs-16 fw-bold me-2 text-success2">${{ format_price($course->tuition_fee) }}</span>
                            @endif --}}


                            {{-- <span class="d-block fs-16 fw-bold me-2 text-success2">BDT{{ $course->discount }}</span> --}}
                            {{-- <del class="fs-12 fw-bold text-muted2">{{ $course->fee }}</del> --}}
                         </span>
                    </label>
                </div>

                <div class="d-flex justify-content-between align-items-stretch mt-2">

                  @php
                    $check_course = 0;
                    if(auth()->check()){
                        $save = \App\Models\CourseParticipant::where('course_id',$course->id)->where('user_id',auth()->user()->id)->first();
                        if($save){
                            $check_course = 1;
                        }
                    }
                  @endphp
                {{-- @if ($check_course==0) --}}
                    
                    {{-- @endif --}}
                    <div class="flex-grow-1">
                        <a href="{{ route('frontend.course.details',$course->id) }}"
                            class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img class="me-1"
                                    src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/details.png"
                                    style="width: 14px;">
                            </span>
                            <span class="text-center w-100 fw-bold fs-13" style="color: #fff">Details</span>
                        </a>
                    </div>

                    <div class="flex-grow-1 me-2 w-sub" style="margin-left: 20px">

                        <a href="{{ route('apply_cart', $course->id) }}"
                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14 ">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/img/cart.png"
                                    style="width: 14px;">
                            </span>
                            <span class="text-center w-100 fw-bold fs-13" style="color: #fff!important">
                                Apply Now
                            </span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
        <!--Start End Card Hover Content-->
    </div>
    <!--End Course Card-->
</div>
@endforeach



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>


$(document).ready(function() {
    $(".delete-button").click(function() {
        $("#delete-modal").show();
        $("#car_id").val($(this).attr('CarId'))

    });
    $("#confirm-no").click(function() {
        $("#delete-modal").hide();
    });
    $("#confirm-yes").click(function() {
        $("#delete-modal").hide();
    });
});



$('.addcart').on('click',function(){
    var id=$(this).attr('CarId');

    Swal.fire({
title: "Add To Cart Successfully!",
icon: "success",
confirmButtonText: "Ok",

}).then((result) => {
    if (result.isConfirmed) {
        window.location ="{{ url('/add-to-cart') }}/"+id
    }
    });
});


</script>



{{-- //Course Save Start --}}
<script>
$('.add-save').on('click',function(){
    let c_id = $(this).attr('c_id');
    let arg = $(this);
    $.ajax({

        type:'Get',

        url:"{{ url('add-to-save') }}/"+c_id,

        success:function(data){   //console.log(data);
            // console.log(data);
            if(data == "ok"){
                $(arg).css('color','#00a662');
                Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: 'Course Added To Wishlist',
                    showConfirmButton: false,
                    timer: 1500
                });
            }else if(data == "del"){
                $(arg).css('color','#969696');
                 Swal.fire({
                    // position: 'top-end',
                    icon: 'success',
                    title: 'Course Remove From Wishlist',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }

     });
});

$('.change_cart_val').on('change',function(){
    console.log(this.id);
    if(this.id == "course_subcribe"+$(this).attr('course_id')){
        $('.course_subcribe'+$(this).attr('course_id')).show();
        $('.course_cart_price'+$(this).attr('course_id')).hide();
    }else{
        $('.course_subcribe'+$(this).attr('course_id')).hide();
        $('.course_cart_price'+$(this).attr('course_id')).show();
    }
    //if($(th)
});


</script>
