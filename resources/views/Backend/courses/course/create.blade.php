@section('title')
    Admin - Add New Course

@endsection

@extends('Backend.layouts.layouts')
@section('style')
<style>
    .select2-selection__rendered {
    line-height: 40px !important;
}
.select2-container .select2-selection--single {
    height: 45px !important;
}
.select2-selection__arrow {
    height: 44px !important;
}
form label{
    color: #111;
    font-weight: 500;
}

</style>

@endsection
@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('admin.course.index')}}"> <i class="icon ion-reply text-22"></i> All Course</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> Add New Course</h6>
            {{-- validate start  --}}
            @if(session()->has('error_message'))
            <div class="alert alert-danger">{{ session()->get('error_message') }}</div>
            @endif
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif
            {{-- validate End  --}}
            <!----- Start Add Category Form input ------->
            <div class="col-xl-12 mx-auto">
                <div class="form-layout form-layout-4">

                    <form action="{{ route('admin.course.store') }}" method="post" enctype="multipart/form-data">
                        @csrf


                        <div class="row mt-4">
                            <div class="col-sm-4">
                                <label class="form-control-label"><b>Course Type :</b> <span class="tx-danger">*</span></label>
                                <select  class="form-control" name="is_master" id="type" onchange="showCourseFields()">

                                    <option  value="0">General Course</option>
                                    <option  value="1">Master Course</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-control-label"><b>Course Name :</b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Course Name">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-control-label"><b>Teacher Name :</b><span class="tx-danger">*</span></label>
                                <select  class="form-control" name="teacher_id" >
                                    <option value="">select teacher</option>
                                    @foreach ($teachers as $teacher)
                                    <option  value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Course Fee :</b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="number" name="fee" value="{{ old('fee') }}" class="form-control" placeholder="Enter Course Fee">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Course Discount :</b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="number" name="discount" value="{{ old('discount') }}" class="form-control" placeholder="Enter Course Discount">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Course Discount Type :</b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                  <select class="form-control" name="discounttype">
                                    <option value="">Select Discount type</option>
                                    <option value="0">Percent(%)</option>
                                    <option value="1">Fixed</option>
                                  </select>
                                </div>
                              </div>

                            {{-- <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Course Subject</b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" placeholder="Enter Course subject">
                                </div>
                            </div> --}}

                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Course Level :</b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="text" name="course_level" value="{{ old('course_level') }}" class="form-control" placeholder="Enter Course level">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Course Type :</b> </label>
                                <div class="mg-t-10 mg-sm-t-0">
                                  <select class="form-control" name="coursetype">
                                    <option value="">Select Course type</option>
                                    <option value="1">Popular</option>
                                    <option value="0">Free</option>
                                    <option value="2">Govt</option>
                                  </select>
                                </div>
                              </div>


                              <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Total Course Hours :</b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="text" name="course_hours" value="{{ old('course_hours') }}" class="form-control" placeholder="00:00:00">
                                </div>
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Organization Name :</b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="text" name="organization_name" value="{{ old('organization_name') }}" class="form-control" placeholder="Organization Name">
                                </div>
                            </div>


                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Course Language :</b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <select id="language" class="form-control multipleSelect2Search Select2 add-no-exists" name="language[]" multiple>
                                        <option value="">Enter Language</option>

                                    </select>
                                </div>
                            </div>

                        {{--<div class="row mt-4">
                                <label class="col-sm-3 form-control-label">Tags: </label>
                                <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                    <select id="blog"  class="form-control multipleSelect2Search Select2 add-no-exists" name="tag[]" multiple>
                                        <option value="">Enter Tags</option>

                                    </select>
                                </div>
                            </div> --}}

                            {{-- <div class="col-sm-4 mt-3">
                                <label class="form-control-label">Course Language Type: <span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <select id="language"  class="form-control multipleSelect2Search Select2 add-no-exists" name="language[]" multiple>
                                        <option value="">Enter Language</option>

                                    </select>
                                </div>
                              </div> --}}

                        </div>


                    <div id="generalCourseFields" class="courseFields">


                        <div class="row mt-4">

                            <div class="col-sm-4">
                                <label class="form-control-label"><b>Category :</b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <select id="cat"  class="form-control" name="general_category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categorys as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label class="form-control-label"><b>Sub Category :</b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <select id="subCat"  class="form-control" name="general_sub_category_id">
                                        <option value="">Select Sub category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-control-label"><b>Child Category :</b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <select id="subCat"  class="form-control" name="general_child_category_id">
                                        <option value="">Select Child category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Pro Child Category :</b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <select id="subCat"  class="form-control" name="general_pro_child_category_id">
                                        <option value="">Select Pro Child category</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label class="form-control-label"><b>Related Courses :</b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <select class="form-control multipleSelect2Search custom-select" name="relatedcourse_id[]" multiple>
                                    <option value="">Select type</option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        {{-- Topics for this course Start --}}
                        <h4>Topics for this course:</h4>
                        <div class="show-add-tagline-data">
                            <div class="d-flex mt-3">
                                <div class="" style="border: 1px solid;padding:10px;width: 97%;">
                                    <div class="row mt-3">

                                        <div class="col-sm-9">
                                            <input  value="" type="text" name="capter_name[]" class="form-control" placeholder="Enter Capter Name">
                                        </div>
                                        <hr style="width:95%;">
                                    </div>

                                    <div class="show-add-list-data">
                                        <div class="row mt-3">
                                            <label class="col-sm-3 form-control-label"> </label>
                                            <div class="col-sm-12 mg-t-10 mg-sm-t-0">
                                                <div class="d-flex align-items-center ">
                                                    <input  value="" type="text" name="lesson_names[0][]" class="form-control mr-2" placeholder="Enter Lesson Name">
                                                    <input  value="" type="text" name="lesson_videos[0][]" class="form-control mr-2" placeholder="Enter Video Link">
                                                    <input  value="" type="text" name="video_time[0][]" class="form-control mr-2" placeholder="00:00:00">
                                                    <a tag_id="0" href="javascript:void(0)" class="plus-btn-data-detail plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <a id="plus-btn-data-tagline" href="javascript:void(0)" class="plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                            </div>



                        </div>
                         {{-- Topics for this course End --}}

                         {{-- Pre resource file start --}}
                         <div class="row mt-4">
                            <div class="col-sm-12">
                                <label class="form-control-label">Courses resource files :</label>
                                <div class="mg-t-10 mg-sm-t-0 add-resourcefile">
                                    <div class="d-flex align-items-center mt-2">
                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">
                                        <input type="file" name="resourcefile[]" value="{{ old('resourcefile') }}" class="ml-2 form-control" placeholder="Enter Pre resource files">
                                    </div>
                                    <a id="plus-btn-resourcefile" href="javascript:void(0)" class="plus-btn-resourcefile px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div><!-- row -->
                         {{-- Pre resource file End --}}

                         {{-- Lesson resource files start --}}
                         <div class="row mt-4">
                            <div class="col-sm-12">
                                <label class="form-control-label">Courses Lesson resource files :</label>
                                <div class="mg-t-10 mg-sm-t-0 add-lessonfile">
                                    <div class="d-flex align-items-center mt-2">
                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">
                                        <input type="file" name="lessonfile[]" value="{{ old('lessonfile') }}" class="ml-2 form-control" placeholder="Enter Pre resource files">
                                    </div>
                                    <a id="plus-btn-lessonfile" href="javascript:void(0)" class="plus-btn-lessonfile px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div><!-- row -->
                        {{-- Lesson resource files End --}}

                      {{-- Course Quiz files start --}}
                      <div class="row mt-4">
                        <div class="col-sm-12">
                            <label class="form-control-label">Courses Quiz files :</label>
                            <div class="mg-t-10 mg-sm-t-0 add-quizfile">
                                <div class="d-flex align-items-center mt-2">
                                 <div class="d-flex align-items-center select-add-section" style="width: 97%;">
                                    <input type="file" name="quizfile[]" value="{{ old('quizfile') }}" class="ml-2 form-control" placeholder="Enter Pre resource files">
                                </div>
                                <a id="plus-btn-quizfile" href="javascript:void(0)" class="plus-btn-quizfile px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                    </div><!-- row -->
                     {{-- Course Quiz files End --}}


                     {{-- Course projectfile files start --}}
                     <div class="row mt-4">
                        <div class="col-sm-12">
                            <label class="form-control-label">Courses Project files :</label>
                            <div class="mg-t-10 mg-sm-t-0 add-projectfile">
                                <div class="d-flex align-items-center mt-2">
                                 <div class="d-flex align-items-center select-add-section" style="width: 97%;">
                                    <input type="file" name="projectfile[]" value="{{ old('projectfile') }}" class="ml-2 form-control" placeholder="Enter Pre resource files">
                                </div>
                                <a id="plus-btn-projectfile" href="javascript:void(0)" class="plus-btn-projectfile px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                    </div><!-- row -->
                    {{-- Course projectfile files End --}}

                      {{-- Pre Requisites start --}}
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <label class="form-control-label">Pre Requisites :</label>
                                <div class="mg-t-10 mg-sm-t-0 add-data">
                                    <div class="d-flex align-items-center mt-2">
                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">
                                        <input type="text" name="requisites[]" value="{{ old('$requisites') }}"  class="ml-2 form-control" placeholder="Enter Pre Requisites">
                                    </div>
                                    <a id="plus-btn-data" href="javascript:void(0)" class="plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div><!-- row -->
                      {{-- Pre Requisites End --}}

                       {{-- What Will I Learn start --}}
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <label class="form-control-label">Course Learn :</label>
                                <div class="mg-t-10 mg-sm-t-0 add-data-learn">
                                    <div class="d-flex align-items-center mt-2">
                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">
                                        <input type="text" name="course_learn[]" value="{{ old('$course_learn') }}" class="ml-2 form-control" placeholder="Enter Course Learn">
                                    </div>
                                    <a id="plus-btn-data-learn" href="javascript:void(0)" class="plus-btn-data-learn px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div><!-- row -->
                       {{-- What Will I Learn End --}}


                       {{-- Course Learner Career Outcomes start --}}
                       <div class="row mt-4">
                        <div class="col-sm-12">
                            <label class="form-control-label">Course Learner Career Outcomes :</label>
                            <div class="mg-t-10 mg-sm-t-0 add-data-outcome">
                                <div class="d-flex align-items-center mt-2">
                                 <div class="d-flex align-items-center select-add-section" style="width: 97%;">
                                    <input type="text" name="course_outcome[]" value="{{ old('$course_outcome') }}" class="ml-2 form-control" placeholder="Enter Course outcome">
                                </div>
                                <a id="plus-btn-data-outcome" href="javascript:void(0)" class="plus-btn-data-outcome px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                       </div><!-- row -->
                       {{-- Course Learner Career Outcomes  End --}}

                        {{-- Course Skills you will gain start --}}
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <label class="form-control-label">Skills you will gain:</label>
                                <div class="mg-t-10 mg-sm-t-0 add-data-skill">
                                    <div class="d-flex align-items-center mt-2">
                                    <div class="d-flex align-items-center select-add-section" style="width: 97%;">
                                        <input type="text" name="course_skill[]" value="{{ old('$course_skill') }}" class="ml-2 form-control" placeholder="Enter Course skill">
                                    </div>
                                    <a id="plus-btn-data-skill" href="javascript:void(0)" class="plus-btn-data-skill px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                        </div><!-- row -->

                    </div>
                    {{-- Course Skills you will gain End --}}


                    {{-- Course Contents End--}}
                    <div id="masterCourseFields" class="courseFields" style="display: none;">
                        <div class="row mt-4">
                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Category</b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <select id="cat"  class="form-control" name="master_category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($master_categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-8 mt-3">
                                <label class="form-control-label"><b>Trailer Video URL</b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="text" name="trailer_video_url" value="{{ old('$trailer_video_url') }}" class="form-control" placeholder="Enter Trailer Video URL">
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- Course Contents Start--}}
                        <div class="row mt-4">
                            <div class="col-sm-12">
                                <label class="form-control-label"><b>Course lessons:</b></label>
                                <div class="mg-t-10 mg-sm-t-0 add-data-content">
                                    <div class="d-flex align-items-center mt-2">

                                        <div class="d-flex align-items-center select-add-section p-2" style="width: 50%;">
                                        <input type="text" name="conten_name[]" value="{{ old('$conten_name') }}" class="ml-2 form-control" placeholder="Course lesson Name">
                                    </div>
                                        <div class="d-flex align-items-center select-add-section p-2" style="width: 50%;">
                                        <input type="text" name="conten_url[]" value="{{ old('$conten_url') }}" class="ml-2 form-control" placeholder="Course URL">
                                    </div>

                                    {{-- <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 110px;">
                                        <img class="display-upload-img" style="width: 110px;height: 60px;" src="{{ asset("frontend/images/No-image.jpg")}}" alt="">
                                            <input type="file" name="conten_image[]" value="{{ old('conten_image') }}" class="form-control upload-img" placeholder="Enter Activity Image"
                                            style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                    </div> --}}

                                    <a id="plus-btn-data-content" href="javascript:void(0)" class="plus-btn-data-content px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                    </div>

                                </div>

                            </div>

                        </div><!-- row -->
                            {{-- Course Contents End--}}


                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <label class="form-control-label"><b>Course About </b><span class="tx-danger">*</span></label>
                            <div class="mg-t-10 mg-sm-t-0">
                                <textarea id="summernote" name="about">{{ old('about') }}</textarea>
                            </div>
                        </div>
                    </div>

                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('admin.course.index')}}" type="button" class="btn btn-secondary text-white mr-2" >Close</a>
                            <button type="submit" class="btn btn-info ">Save</button>
                          </div>
                        </div>
                    </form>

                </div><!-- form-layout -->
            </div><!-- col-6 -->
            <!----- Start Add Category Form input ------->
          </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->

    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->







@endsection

@section('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
    $(document).ready(function() {
        $('.multipleSelect2Search').select2();
    });
    $(document).ready(function() {
        $('.multipleSelectSearch').select2();
    });
    </script>
  <script>
    $(document).ready(function() {
    $(".add-no-exists").select2({
         tags: true,
        createTag: function (params) {
            var term = $.trim(params.term);
            console.log(term);
            if (term === '') {
                return null;
            }
            return {
                id: term,
                text: term,
                newTag: true
            }
        },
        //tags: true
    }).on('select2:select', function(e){
        // console.log(e.params.data.tag)
        // console.log(e.params.data.newTag)
        // var select2element = $(this);
        // console.log( $(this).attr('id'));
        // if (e.params.data.newTag === true) {
        //     select2function(e.params.data.text,$(this).attr('id'),select2element)
        // }
    });

    function select2function(val,type,select2element){
        console.log(type);
        let url = '{{ url("add-new-select2-language") }}' ;
        let data = {val:val,'type':type};
        axios({
            method: 'post',
            url: url,
            data: data
        }).then(res => {
            if(res.data.status == "ok"){
                data = {
                    "id":res.data.res_data.id,
                    "text": res.data.res_data.name,
                }
                var selection = select2element.val();

                if ($(select2element).find("option[value='" + res.data.res_data.name + "']").length) {
                    $(select2element).find("option[value='" + res.data.res_data.name + "']").attr('value',res.data.res_data.id);
                    $(select2element).val(res.data.res_data.id).trigger('change');
                } else {
                    var option = new Option(res.data.res_data.name, res.data.res_data.id, true, true);
                    $(select2element).append(option).trigger('change');
                    // console.log("selection =", selection);
                }
                console.log("selection =", selection);
            }
        })
    }
});

</script>



<script>
    function showCourseFields() {
      var generalCourseFields = document.getElementById("generalCourseFields");
      var masterCourseFields = document.getElementById("masterCourseFields");
      var selectedValue = document.getElementById("type").value;

      if (selectedValue === "0") {
        generalCourseFields.style.display = "block";
        masterCourseFields.style.display = "none";
      } else {
        generalCourseFields.style.display = "none";
        masterCourseFields.style.display = "block";
      }
    }
  </script>





<script>

var lesson =1;
    $(document).on('click','.plus-btn-data-detail',function(){
        let out = '<div class="row mt-3">'+
'                                            <label class="col-sm-3 form-control-label"> </label>'+
'                                            <div class="col-sm-12 mg-t-10 mg-sm-t-0">'+
'                                                <div class="d-flex align-items-center ">'+
'                                                    <input  value="" type="text" name="lesson_names['+$(this).attr('tag_id')+'][]" class="form-control mr-2" placeholder="Enter Lesson Names">'+
'                                                    <input  value="" type="text" name="lesson_videos['+$(this).attr('tag_id')+'][]" class="form-control mr-2" placeholder="Enter Video Link">'+
'                                                    <input  value="" type="text" name="video_time['+$(this).attr('tag_id')+'][]" class="form-control mr-2" placeholder="00:00:00">'+
'                                                    <a href="javascript:void(0)" class="minus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                                </div>'+
'                                            </div>'+
'                                        </div>';


       $(this).parent().parent().parent().parent().prepend(out);
    });

    $(document).on('click','.minus-btn-data',function(){
        $(this).parent().parent().parent().remove();
    });





    $('#plus-btn-data-tagline').on('click',function(){

        var myvar = '<div class="d-flex mt-3">'+
'                                <div class="" style="border: 1px solid;padding:10px;width: 97%;">'+
'                                    <div class="row mt-3">'+
''+
'                                        <div class="col-sm-9">'+
'                                            <input  value="" type="text" name="capter_name[]" class="form-control" placeholder="Enter Capter Name">'+
'                                        </div>'+
'                                        <hr style="width:95%;">'+
'                                    </div>'+
''+
'                                    <div class="show-add-list-data">'+
'                                        <div class="row mt-3">'+
'                                            <label class="col-sm-3 form-control-label"> </label>'+
'                                            <div class="col-sm-12 mg-t-10 mg-sm-t-0">'+
'                                                <div class="d-flex align-items-center ">'+
'                                                    <input  value="" type="text" name="lesson_names['+lesson+'][]" class="form-control mr-2" placeholder="Enter Lesson Names">'+
'                                                    <input  value="" type="text" name="lesson_videos['+lesson+'][]" class="form-control mr-2" placeholder="Enter Video Link">'+
'                                                    <input  value="" type="text" name="video_time['+lesson+'][]" class="form-control mr-2" placeholder="00:00:00">'+
'                                                    <a tag_id="'+lesson+'" href="javascript:void(0)" class="plus-btn-data-detail plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>'+
'                                                </div>'+
'                                            </div>'+
'                                        </div>'+
'                                    </div>'+
''+
'                                </div>'+
'                               <a href="javascript:void(0)" class="minus-btn-data-tagline px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                            </div>';


        $('.show-add-tagline-data').prepend(myvar);
        lesson++;
        $(this).focus();
    });
    $(document).on('click','.minus-btn-data-tagline',function(){
        $(this).parent().remove();
    });

// Topics for this course End


//Course resource file start
$(document).ready(function() {
        $('#plus-btn-resourcefile').on('click',function(){

            var myvar = '<div class="d-flex align-items-center mt-2">'+
'                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">'+
'                                       <input type="file" name="resourcefile[]" class="ml-2 form-control" placeholder="Enter Pre Requisites">'+
''+
''+
'                                    </div>'+
''+
'                                      <a href="javascript:void(0)" class="minus-btn-resourcefile px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                    </div>';



        $('.add-resourcefile').prepend(myvar);
            //console.log();
        });
        $(document).on('click','.minus-btn-resourcefile',function(){
            $(this).parent().remove();
        });

    });

    //Course resource file End


    //Course lesson file start
$(document).ready(function() {
        $('#plus-btn-lessonfile').on('click',function(){

            var myvar = '<div class="d-flex align-items-center mt-2">'+
'                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">'+
'                                       <input type="file" name="lessonfile[]" class="ml-2 form-control" placeholder="Enter Pre Requisites">'+
''+
''+
'                                    </div>'+
''+
'                                      <a href="javascript:void(0)" class="minus-btn-lessonfile px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                    </div>';



        $('.add-lessonfile').prepend(myvar);
            //console.log();
        });
        $(document).on('click','.minus-btn-lessonfile',function(){
            $(this).parent().remove();
        });

    });

    //Course lesson file End



      //Course quizfile file start
$(document).ready(function() {
        $('#plus-btn-quizfile').on('click',function(){

            var myvar = '<div class="d-flex align-items-center mt-2">'+
'                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">'+
'                                       <input type="file" name="quizfile[]" class="ml-2 form-control" placeholder="Enter Pre Requisites">'+
''+
''+
'                                    </div>'+
''+
'                                      <a href="javascript:void(0)" class="minus-btn-quizfile px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                    </div>';



        $('.add-quizfile').prepend(myvar);
            //console.log();
        });
        $(document).on('click','.minus-btn-quizfile',function(){
            $(this).parent().remove();
        });

    });

    //Course quizfile file End




        //Course projectfile file start
$(document).ready(function() {
        $('#plus-btn-projectfile').on('click',function(){

            var myvar = '<div class="d-flex align-items-center mt-2">'+
'                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">'+
'                                       <input type="file" name="projectfile[]" class="ml-2 form-control" placeholder="Enter Pre Requisites">'+
''+
''+
'                                    </div>'+
''+
'                                      <a href="javascript:void(0)" class="minus-btn-projectfile px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                    </div>';



        $('.add-projectfile').prepend(myvar);
            //console.log();
        });
        $(document).on('click','.minus-btn-projectfile',function(){
            $(this).parent().remove();
        });

    });

 //Course projectfile file End

//Course Pre Requisites start
$(document).ready(function() {
        $('#plus-btn-data').on('click',function(){

            var myvar = '<div class="d-flex align-items-center mt-2">'+
'                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">'+
'                                       <input type="text" name="requisites[]" class="ml-2 form-control" placeholder="Enter Pre Requisites">'+
''+
''+
'                                    </div>'+
''+
'                                      <a href="javascript:void(0)" class="minus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                    </div>';



        $('.add-data').prepend(myvar);
            //console.log();
        });
        $(document).on('click','.minus-btn-data',function(){
            $(this).parent().remove();
        });

    });

    //Course Pre Requisites End


    //Course What Will I Learn start
$(document).ready(function() {
        $('#plus-btn-data-learn').on('click',function(){

            var myvar = '<div class="d-flex align-items-center mt-2">'+
'                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">'+
'                                       <input type="text" name="course_learn[]" class="ml-2 form-control" placeholder="Enter Course Learn">'+
''+
''+
'                                    </div>'+
''+
'                                      <a href="javascript:void(0)" class="minus-btn-data-learn px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                    </div>';



        $('.add-data-learn').prepend(myvar);
            //console.log();
        });
        $(document).on('click','.minus-btn-data-learn',function(){
            $(this).parent().remove();
        });

    });

    //Course What Will I Learn End


// Course Learner Career Outcomes start
$(document).ready(function() {
        $('#plus-btn-data-outcome').on('click',function(){

            var myvar = '<div class="d-flex align-items-center mt-2">'+
'                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">'+
'                                       <input type="text" name="course_outcome[]" class="ml-2 form-control" placeholder="Enter Course outcome">'+
''+
''+
'                                    </div>'+
''+
'                                      <a href="javascript:void(0)" class="minus-btn-data-outcome px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                    </div>';



        $('.add-data-outcome').prepend(myvar);
            //console.log();
        });
        $(document).on('click','.minus-btn-data-outcome',function(){
            $(this).parent().remove();
        });

    });

    // Course Learner Career Outcomes  End


    // Course Skills you will gain start  start
$(document).ready(function() {
        $('#plus-btn-data-skill').on('click',function(){

            var myvar = '<div class="d-flex align-items-center mt-2">'+
'                                     <div class="d-flex align-items-center select-add-section" style="width: 97%;">'+
'                                       <input type="text" name="course_skill[]" class="ml-2 form-control" placeholder="Enter Course skill">'+
''+
''+
'                                    </div>'+
''+
'                                      <a href="javascript:void(0)" class="minus-btn-data-skill px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                    </div>';



        $('.add-data-skill').prepend(myvar);
            //console.log();
        });
        $(document).on('click','.minus-btn-data-skill',function(){
            $(this).parent().remove();
        });

    });

    // Course Skills you will gain start   End



//Course Contents start
$(document).ready(function() {
        $(document).on('click','#plus-btn-data-content',function(){



var myvar = '<div class="d-flex align-items-center mt-2">'+
''+
'                                     <div class="d-flex align-items-center select-add-section p-2" style="width: 50%;">'+
'                                        <input type="text" name="conten_name[]" class="ml-2 form-control" placeholder="Course lesson Name">'+
'                                    </div>'+
'                                     <div class="d-flex align-items-center select-add-section p-2" style="width: 50%;">'+
'                                        <input type="text" name="conten_url[]" class="ml-2 form-control" placeholder="Course URL">'+
'                                    </div>'+
''+
// '                                    <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 110px;">'+
// '                                        <img class="display-upload-img" style="width: 110px;height: 60px;" src="{{ asset("frontend/images/No-image.jpg")}}" alt="">'+
// '                                            <input type="file" name="conten_image[]" class="form-control upload-img" placeholder="Enter Vontent Image"'+
// '                                            style="position: absolute;top: 0;opacity: 0;height: 100%;">'+
// '                                    </div>'+
''+
'                                   <a href="javascript:void(0)" class="minus-btn-data-content px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                    </div>';


$('.add-data-content').prepend(myvar);
            //console.log();
        });

        $(document).on('click','.minus-btn-data-content',function(){
            $(this).parent().remove();
        });


    });

//Course Contents start

</script>



@endsection
