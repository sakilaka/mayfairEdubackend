@section('title')
    Admin - Maestor Class Setup
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
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> MaestroClass Content Setup</h6>
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif
            <!----- Start Add Category Form input ------->
            <div class="col-xl-12 mx-auto">
                <div class="form-layout form-layout-4 py-5">

                    <form action="{{ route('admin.maestor_class_setup') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <h2>Banner Section</h2>
                        


                        <div class="row mt-4 mb-4">
                            <label class="col-sm-3 mt-4 form-control-label">Banner Image: <span class="tx-danger"></span></label>
                            <div class="col-sm-3 mt-4 mg-t-10 mg-sm-t-0">
                                <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 150px;">
                                    <img class="display-upload-img" style="width: 150px;height: 70px;" src="{{ $home_content->banner_image_show}}" alt="">
                                        <input type="file" name="banner_image" class="form-control upload-img" placeholder="Enter Activity Image"
                                        style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                </div>
                            </div>

                            <div class="col-sm-6 mt-4">
                                <label class=" form-control-label">Banner Video:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="file" name="banner_video" value="{{ $home_content->banner_video }}"/>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div class="row mt-4 mb-4">
                            <div class="col-sm-12">
                                <label class=" form-control-label">Banner Title:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <textarea  type="text" name="banner_title" class="form-control" placeholder="Enter Banner Text">{{ $home_content->banner_title ?? '' }}</textarea>
                                </div>
                            </div>
                            <hr>
                        </div>
{{-- 
                        @if($faqs->count() == 0)

                        <div class="row">
                            <div class="col-sm-5">
                                <label class=" form-control-label">Button Text:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input  value="" type="text" name="home_content_ques[]" class="form-control" placeholder="Enter Question">
                                </div>
                            </div>
                            <div class="col-sm-7 d-flex align-items-center ">
                                <div style="width: 97%;">
                                    <label class=" form-control-label">Button URL:<span class="tx-danger"></span></label>
                                    <div class="mg-t-10 mg-sm-t-0">
                                    <input type="text"  value="" name="home_content_ans[]" class="form-control" placeholder="Enter Answer ">
                                    </div>
                                </div>
                                <div>
                                    <label class=" form-control-label"></label>
                                    <a id="plus-btn-data-question" href="javascript:void(0)" class="plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div><!-- row -->


                        @else
                        <div class="add-question-data-show">
                            @foreach ($faqs as $k=>$faq)
                            <div class="row">
                                <div class="col-sm-5 mt-3">
                                    <label class=" form-control-label">Button Text:<span class="tx-danger"></span></label>
                                    <div class="mg-t-10 mg-sm-t-0">
                                    <input  type="text" value="{{ $faq->question }}" name="home_content_old_ques[{{ $faq->id }}]" class="form-control" placeholder="Enter Question">
                                    </div>
                                </div>
                                <div class="col-sm-7 mt-3 d-flex align-items-center ">
                                    <div style="width: 97%;">
                                        <label class=" form-control-label">Button URL:<span class="tx-danger"></span></label>
                                        <div class="mg-t-10 mg-sm-t-0">
                                        <input value="{{ $faq->answer }}" type="text"   name="home_content_old_ans[{{ $faq->id }}]" class="form-control" placeholder="Enter Answer ">
                                        </div>
                                    </div>
                                    <div>
                                        <label class=" form-control-label"></label>
                                        @if($k==0)
                                        <a id="plus-btn-data-question" href="javascript:void(0)" class="plus-btn-data px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                        @else
                                        <a faq_id="{{ $faq->id }}" href="javascript:void(0)" class="minus-btn-question-old-data px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>
                                        @endif
                                    </div>

                                </div>
                            </div><!-- row -->
                            @endforeach
                        </div>
                        @endif --}}
                        <hr/>

                        <div class="row mt-4 mb-4">
                            <div class="col-sm-12">
                                <label class=" form-control-label">Title 2:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input  type="text" name="title2" value="{{ $home_content->title2 }}" class="form-control" placeholder="Enter Title 2">{{ $home_content->banner_text ?? '' }}
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="row mt-4 mb-4">
                            <div class="col-sm-12">
                                <label class=" form-control-label">Title 3:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input  type="text" name="title3" value="{{ $home_content->title3 }}" class="form-control" placeholder="Enter Title 3">
                                </div>
                            </div>
                            <hr>
                        </div>
                        

                        <div class="row mt-4">
                            <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
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
    $(document).ready(function() {height: 150

            /*** summernote editor two ***/
            $('#summernote_three').summernote({
                height: 150
            })

        });
    $('#plus-btn-data-question').on('click',function(){

        var out = '<div class="row">'+
                 '<div class="col-sm-5 mt-3">'+
                 '<label class=" form-control-label">Button Text:<span class="tx-danger"></span></label>'+
                 '<div class="mg-t-10 mg-sm-t-0">'+
                    '<input  value="" type="text" name="home_content_ques[]" class="form-control" placeholder="Enter Question">'+
                    '</div></div>'+
                    ' <div class="col-sm-7 mt-3 d-flex align-items-center ">'+
                    '<div style="width: 97%;">'+
                        ' <label class=" form-control-label">Button URL:<span class="tx-danger"></span></label>'+
                        ' <div class="mg-t-10 mg-sm-t-0">'+
                        '<input type="text"  value="" name="home_content_ans[]" class="form-control" placeholder="Enter Answer ">'+
                        '</div>'+
                        '</div><div>'+
                            '<label class=" form-control-label"></label>'+
                            '<a href="javascript:void(0)" class="minus-btn-question-data px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
                            '</div></div></div>';

                            console.log(out);
        $('.add-question-data-show').append(out);

    });
    $(document).on('click','.minus-btn-question-data',function(){
        $(this).parent().parent().parent().remove();
    });
     $(document).on('click','.minus-btn-question-old-data',function(){

        $(this).parent().parent().parent().parent().append("<input type='hidden' name='old_delete_faq_data[]' value='"+$(this).attr('faq_id')+"'>");
        $(this).parent().parent().parent().remove();
    });








    $('#plus-btn-data-tagline').on('click',function(){

        var myvar = '<div class="d-flex mt-3">'+
'                                    <div class="" style="border: 1px solid;padding:10px;width: 97%;">'+
'                                        <div class="row mt-3">'+
'                                            <label class="col-sm-2 mt-3">Title</label>'+
'                                            <div class="col-sm-10">'+
'                                                <input  value="" type="text" name="title[]" class="form-control" placeholder="Enter Title">'+
'                                            </div>'+
'                                            <label class="col-sm-2 mt-3">URL</label>'+
'                                            <div class="col-sm-10 mt-2">'+
'                                                <input  value="" type="text" name="url[]" class="form-control" placeholder="Enter URL">'+
'                                            </div>'+
'                                            <label class="col-sm-2 mt-3">Description</label>'+
'                                            <div class="col-sm-10 mt-2">'+
'                                                <textarea  value="" type="text" name="description[]" class="form-control" placeholder="Enter Short Description"></textarea>'+
'                                           </div>'+
'                                     </div>'+
'                                  </div>'+
'                                   <a href="javascript:void(0)" class="minus-btn-data-tagline px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>'+
'                               </div>';

    $('.show-add-tagline-data').append(myvar);
    tagline++;
    $(this).focus();
    });
    $(document).on('click','.minus-btn-data-tagline',function(){
        $(this).parent().remove();
    });

    $(document).on('click','.minus-btn-learn-old-data',function(){

    $(this).parent().parent().parent().parent().append("<input type='hidden' name='old_delete_learn_data[]' value='"+$(this).attr('learn_id')+"'>");
    $(this).parent().parent().parent().remove();
    });

</script>

@endsection
