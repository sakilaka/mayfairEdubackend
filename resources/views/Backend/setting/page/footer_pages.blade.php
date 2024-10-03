@section('title')
    Admin - Footer Pages
@endsection

@extends('Backend.layouts.layouts')

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
            <h6 class="br-section-label text-center mb-4"> Home Content Setup</h6>
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif
            <!----- Start Add Category Form input ------->
            <div class="col-xl-12 mx-auto">
                <div class="form-layout form-layout-4 py-5">

                    <form action="{{ route('backend.home_content.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <h2>Footer column</h2>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label class=" form-control-label">Title 1:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text" value="" name="home_content_title_1" class="form-control" placeholder="Enter Title 1">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Title 2:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input  value="" type="text" name="home_content_title_2" class="form-control" placeholder="Enter Title 2">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Question 1:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input  value="" type="text" name="home_content_qus_1" class="form-control" placeholder="Enter Question 1">
                                </div>
                            </div>


                           <div class="col-sm-6">
                                <label class=" form-control-label">Question 2:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text"  value="" name="home_content_qus_2" class="form-control" placeholder="Enter Question 2">
                                </div>
                            </div>
                        </div><!-- row -->
                        <hr/>

                        <h2>Home Content Section</h2>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <label class=" form-control-label">Title 1:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text" value="" name="home_content_title_1" class="form-control" placeholder="Enter Title 1">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Title 2:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input  value="" type="text" name="home_content_title_2" class="form-control" placeholder="Enter Title 2">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class=" form-control-label">Question 1:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input  value="" type="text" name="home_content_qus_1" class="form-control" placeholder="Enter Question 1">
                                </div>
                            </div>


                           <div class="col-sm-6">
                                <label class=" form-control-label">Question 2:<span class="tx-danger"></span></label>
                                <div class="mg-t-10 mg-sm-t-0">
                                <input type="text"  value="" name="home_content_qus_2" class="form-control" placeholder="Enter Question 2">
                                </div>
                            </div>
                        </div><!-- row -->
                        <hr/>



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
     $(document).on('change','.upload-img',function(){
            var files = $(this).get(0).files;
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            var arg=this;
            reader.addEventListener("load", function(e) {
                var image = e.target.result;
                $(arg).parent().find('.display-upload-img').attr('src', image);
            });
        });
</script>
@endsection
