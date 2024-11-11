@section('title')
    Admin - Category Edit
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('phar-sub-category.index')}}"> <i class="icon ion-reply text-22"></i> All Sub Category</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4">Update Sub Category</h6>

            <!----- Start Add Category Form input ------->
            <div class="col-xl-7 mx-auto">
                <div class="form-layout form-layout-4 py-5">

                    <form action="{{ route('phar-sub-category.update', $sub_category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}

                        <div class="row ">
                          <label class="col-sm-3 form-control-label mb-4">Icon: <span class="tx-danger">*</span></label>
                          <div class="col-sm-9 mg-t-10 mg-sm-t-0 mb-4">
                              <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 150px;">
                                      <img class="display-upload-img" style="width: 150px;height: 70px;" src="{{ $sub_category->icon_show }}" alt="">
                                      <input type="file" name="image" class="form-control upload-img" placeholder="Enter Activity Image" style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                  </div>
                          </div>
                        </div><!-- row -->

                        <div class="row">
                            <label class="col-sm-3 form-control-label">Category: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select class="form-control select2" name="category">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)

                                    <option @if($category->id == $sub_category->parent_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Sub Category Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" value="{{ $sub_category->name }}" name="name" class="form-control" placeholder="Enter Sub Category Name" required>
                        </div>
                        </div><!-- row -->

                        <div class="row mt-3">
                          <label class="col-sm-3 form-control-label">Api Color Code: <span class="tx-danger">*</span></label>
                          <div class="col-sm-4 mg-t-10 mg-sm-t-0">
                          <input style="padding: 4px;" type="color" id="color_code" name="" class="form-control" value="#{{ $sub_category->color_code }}">
                          </div>
                          <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                          <input style="padding: 4px;" type="text" name="color_code" id="show_color_code" class="form-control" value="{{ $sub_category->color_code }}">
                          </div>
                        </div><!-- row -->

                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">position : <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <input value="{{ $sub_category->position }}" type="number" name="position" class="form-control" placeholder="Enter position">
                            </div>
                        </div><!-- row -->

                        <div class="row mt-4">
                          <label class="col-sm-3 form-control-label">Status: <span class="tx-danger">*</span></label>
                          <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <select class="form-control select2" name="status">
                              <option @if($sub_category->status == 1) @selected(true) @endif value="1">Active</option>
                              <option @if($sub_category->status == 0) @selected(true) @endif value="0">Inactive</option>
                          </select>
                          </div>
                        </div><!-- row -->

                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('phar-sub-category.index')}}" type="button" class="btn btn-secondary text-white mr-2" >Close</a>
                            <button type="submit" class="btn btn-info ">Update changes</button>
                          </div>
                        </div>
                    {{-- </form> --}}

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
  $('#color_code').on('input',function(){
      $('#show_color_code').val(this.value.replace('#',""));
     // console.log(this.value.replace('#',""));
  });
  // $('#color_code').on('change',function(){
  //     console.log(this.value.replace('#',""));
  // })
</script>
@endsection