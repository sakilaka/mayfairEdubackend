@section('title')
    Admin - Edit Year Package
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('admin.all_year_package')}}"> <i class="icon ion-reply text-22"></i> All Year Package</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4">Edit Year Package</h6>

            <!----- Start Add Category Form input ------->
            <div class="col-xl-7 mx-auto">
                <div class="form-layout form-layout-4 pt-3 py-5">

                    <form action="{{ route('admin.update_year_package', $Year_packages->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Package Name: </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <input type="text" name="name" value="{{ $Year_packages->name }}" class="form-control" placeholder="Enter Banner Name">
                            </div>
                        </div><!-- row -->

                         <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Title: </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <input type="text" name="text" value="{{ $Year_packages->text }}" class="form-control" placeholder="Enter Banner Name">
                            </div>
                        </div><!-- row -->

                         <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Price: </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <input type="text" name="price" value="{{ $Year_packages->price }}" class="form-control" placeholder="Enter Price/month">
                            </div>
                        </div><!-- row -->

                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Description: </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <textarea id="summernote" name="item">{{ $Year_packages->item }}</textarea>
                            </div>
                        </div><!-- row -->

                              <div class="row mt-4">
                          <label class="col-sm-3 form-control-label">Status: <span class="tx-danger">*</span></label>
                          <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <select class="form-control select2" name="package_status">
                              <option @if($Year_packages->package_status == 1) @selected(true) @endif value="1">Active</option>
                              <option @if($Year_packages->package_status == 0) @selected(true) @endif value="0">Inactive</option>
                          </select>
                          </div>
                        </div><!-- row -->

                        <div class="row mt-4 ">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('admin.all_year_package')}}" type="button" class="btn btn-secondary text-white mr-2" >Close</a>
                            <button type="submit" class="btn btn-info">Update changes</button>
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
