@section('title')
    Admin - Add New Ebook
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('admin.ebook.index')}}"> <i class="icon ion-reply text-22"></i> All Ebook</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> Add New Ebook</h6>
               {{-- validate start  --}}
               @if(count($errors) > 0)
               @foreach($errors->all() as $error)
                   <div class="alert alert-danger">{{ $error }}</div>
               @endforeach
               @endif
               {{-- validate End  --}}

            <!----- Start Add Category Form input ------->
            <div class="col-xl-12 mx-auto">
                <div class="form-layout form-layout-4 py-5">

                    <form action="{{ route('admin.ebook.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row align-items-end">
                            <div class="col-sm-4">
                                <label class="form-control-label"><b>Image: </b><span class="tx-danger">*</span></label>
                                    <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 150px;">
                                        <img class="display-upload-img" style="width: 150px;height: 70px;" src="{{ asset("frontend/images/No-image.jpg")}}" alt="">
                                        <input type="file" accept="image/*" name="image" class="form-control upload-img" placeholder="Enter Activity Image" style="position: absolute;top: 0;opacity: 0;height: 100%;" required>
                                    </div>
                            </div>
                        </div>

                        <div class="row mt-4">

                            <div class="col-sm-6">
                                <label class="form-control-label"><b>Seller :</b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <select id="cat"  class="form-control" name="user_id">
                                        <option value="">Select Seller</option>
                                        @foreach ($selerys as $selery)
                                        <option value="{{ $selery->id }}">{{ $selery->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-control-label"><b>Category :</b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <select id="cat"  class="form-control" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-3">
                                <label class="form-control-label"><b>Sub Category :</b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <select id="subCat"  class="form-control" name="sub_category_id">
                                        <option value="">------ Select Sub category ------</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-3">
                                <label class="form-control-label"><b>Subject: </b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter Subject" required>

                                </div>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <label class="form-control-label"><b>Headline: </b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="text" name="headline" value="{{ old('headline') }}" class="form-control" placeholder="Enter Headline" required>

                                </div>
                            </div>
                            <div class="col-sm-6 mt-3">
                                <label class="form-control-label"><b>Lesson: </b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="text" name="lesson" value="{{ old('lesson') }}" class="form-control" placeholder="Enter Lesson" required>

                                </div>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Price: </b><span class="tx-danger">*</span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="number" name="fee" value="{{ old('fee') }}" class="form-control" placeholder="Enter Price" required>

                                </div>
                            </div>
                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Discount: </b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="number" name="discount" value="{{ old('discount') }}" class="form-control" placeholder="Enter Discount" >

                                </div>
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label class="form-control-label"><b>Discount Type :</b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                  <select class="form-control" name="discounttype">
                                    <option value="">Select Discount type</option>
                                    <option value="0">Percent(%)</option>
                                    <option value="1">Fixed</option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-sm-6 mt-3">
                                <label class="form-control-label"><b>Related Ebook :</b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <select class="form-control multipleSelect2Search custom-select" name="relatedebook_id[]" multiple>
                                      <option value="">Select type</option>
                                      @foreach ($ebooks as $ebook)
                                      <option value="{{ $ebook->id }}">{{ $ebook->title }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                              </div>

                              <div class="col-sm-6 mt-3">
                                <label class="form-control-label"><b>Content Audio: </b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <input type="file" accept="audio/*" name="content_audio" value="{{ old('content_audio') }}" class="form-control" >

                                </div>
                             </div>

                             <div class="col-sm-12 mt-3">
                                <label class="form-control-label"><b>E-Book Description </b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <textarea type="text" name="short_desctiption" value="{{ old('short_desctiption') }}" class="form-control" id="summernote_two" placeholder="Long Description" ></textarea>
                                </div><br>
                            </div>

                            <div class="col-sm-12 mt-3">
                                <label class="form-control-label"><b>E-Book Content </b></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                    <textarea type="text" name="long_desctiption" value="{{ old('long_desctiption') }}" class="form-control" id="summernote" placeholder="Long Description" ></textarea>
                                </div><br>
                            </div>


                              {{-- Audio Content --}}
                                <div class="col-sm-12 mt-3"  style="border: 1px solid;padding:10px">
                                    <label class="form-control-label"><h5>Audio Content:</h5></label>
                                    <div class="mg-t-10 mg-sm-t-0 add-data-content">
                                        <div class="d-flex align-items-center mt-2 row">
                                            <div class="col-md-5">
                                                <label class="form-control-label"><b>Audio Name:</b></label>
                                                <div class="d-flex  align-items-center select-add-section " >
                                                    <input type="text" name="audio_name[]" value="{{ old('$audio_name') }}" class=" form-control" placeholder="Audio Content Name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-control-label"><b>Audio File:</b></label>
                                                <div class="d-flex  align-items-center select-add-section">
                                                    <input type="file" accept="audio/*" name="audio_file[]" value="{{ old('$audio_file') }}" class=" form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label"><b>Is Free:</b></label>
                                                <div class="d-flex  align-items-center select-add-section" style="width: 50%;">
                                                    <input type="checkbox" name="is_free_audio[]" value="1" class=" " >
                                                </div>
                                            </div>
                                            <a id="plus-btn-data-content" href="javascript:void(0)" class="plus-btn-data-content px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>



<br>
<br>
<br>
<br>
<br>
<br>



                                {{-- Video Content --}}
                                <div class="col-sm-12 mt-3"  style="border: 1px solid;padding:10px">
                                    <label class="form-control-label"><h5>Video Content:</h5></label>
                                    <div class="mg-t-10 mg-sm-t-0 add-data-content-video">
                                        <div class="d-flex align-items-center mt-2 row">
                                            <div class="col-md-5">
                                                <label class="form-control-label"><b>Video Name:</b></label>
                                                <div class="d-flex  align-items-center select-add-section " >
                                                    <input type="text" name="video_name[]" value="{{ old('$video_name') }}" class=" form-control" placeholder="Video Content Name">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-control-label"><b>Video File:</b></label>
                                                <div class="d-flex  align-items-center select-add-section">
                                                    <input type="file" accept="video/*" name="video_file[]" value="{{ old('$video_file') }}" class=" form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-control-label"><b>Is Free:</b></label>
                                                <div class="d-flex  align-items-center select-add-section" style="width: 50%;">
                                                    <input type="checkbox" name="is_free_video[]" value="1" class=" " >
                                                </div>
                                            </div>
                                            <a id="plus-btn-data-content-video" href="javascript:void(0)" class="plus-btn-data-content-video px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>


                        <div class="row mt-3">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('admin.teacher.index')}}" type="button" class="btn btn-secondary text-white mr-2" >Cancel</a>
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


<script>
    $(document).ready(function() {
        $('.multipleSelect2Search').select2();
    });
    $(document).ready(function() {
        $('.multipleSelectSearch').select2();
    });
</script>



<script>

//Audio Contents start
$(document).ready(function() {
        $(document).on('click','#plus-btn-data-content',function(){



            var myvar = '<div class="d-flex align-items-center mt-2 row">'+
'                                            <div class="col-md-5">'+
'                                                <label class="form-control-label"><b>Audio Name:</b></label>'+
'                                                <div class="d-flex  align-items-center select-add-section " >'+
'                                                    <input type="text" name="audio_name[]" value="{{ old('$audio_name') }}" class=" form-control" placeholder="Audio Content Name">'+
'                                                </div>'+
'                                            </div>'+
'                                            <div class="col-md-4">'+
'                                                <label class="form-control-label"><b>Audio File:</b></label>'+
'                                                <div class="d-flex  align-items-center select-add-section">'+
'                                                    <input type="file" accept="audio/*" name="audio_file[]" value="{{ old('$audio_file') }}" class=" form-control">'+
'                                                </div>'+
'                                            </div>'+
'                                            <div class="col-md-2">'+
'                                                <label class="form-control-label"><b>Is Free:</b></label>'+
'                                                <div class="d-flex  align-items-center select-add-section" style="width: 50%;">'+
'                                                    <input type="checkbox" name="is_free_audio[]" value="1" class=" " >'+
'                                                </div>'+
'                                            </div>'+
'                                            <a href="javascript:void(0)" class="minus-btn-data-content px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                                        </div>';


$('.add-data-content').prepend(myvar);
            //console.log();
        });

        $(document).on('click','.minus-btn-data-content',function(){
            $(this).parent().remove();
        });


    });

//Audio Contents end
</script>


<script>

    //Video Contents start
    $(document).ready(function() {
            $(document).on('click','#plus-btn-data-content-video',function(){



                var myvar = '<div class="d-flex align-items-center mt-2 row">'+
    '                                            <div class="col-md-5">'+
    '                                                <label class="form-control-label"><b>Video Name:</b></label>'+
    '                                                <div class="d-flex  align-items-center select-add-section " >'+
    '                                                    <input type="text" name="video_name[]" value="{{ old('$video_name') }}" class=" form-control" placeholder="Video Content Name">'+
    '                                                </div>'+
    '                                            </div>'+
    '                                            <div class="col-md-4">'+
    '                                                <label class="form-control-label"><b>Video File:</b></label>'+
    '                                                <div class="d-flex  align-items-center select-add-section">'+
    '                                                    <input type="file" accept="video/*" name="video_file[]" value="{{ old('$video_file') }}" class=" form-control">'+
    '                                                </div>'+
    '                                            </div>'+
    '                                            <div class="col-md-2">'+
    '                                                <label class="form-control-label"><b>Is Free:</b></label>'+
    '                                                <div class="d-flex  align-items-center select-add-section" style="width: 50%;">'+
    '                                                    <input type="checkbox" name="is_free_video[]" value="1" class=" " >'+
    '                                                </div>'+
    '                                            </div>'+
    '                                            <a href="javascript:void(0)" class="minus-btn-data-content-video px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
    '                                        </div>';


    $('.add-data-content-video').prepend(myvar);
                //console.log();
            });

            $(document).on('click','.minus-btn-data-content-video',function(){
                $(this).parent().remove();
            });


        });

    //Video Contents end
    </script>


@endsection
