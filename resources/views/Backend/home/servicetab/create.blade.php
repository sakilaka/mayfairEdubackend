@section('title')
    Admin - Add New Service Tab
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('home-servicetab.index')}}"> <i class="icon ion-reply text-22"></i> All Service Tab</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> Add New Service Tab</h6>
               {{-- validate start  --}}
               @if(count($errors) > 0)
               @foreach($errors->all() as $error)
                   <div class="alert alert-danger">{{ $error }}</div>
               @endforeach
               @endif
               {{-- validate End  --}}

            <!----- Start Add Category Form input ------->
            <div class="col-xl-7 mx-auto">
                <div class="form-layout form-layout-4 py-5">

                    <form action="{{ route('home-servicetab.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="row">
                            <label class="col-sm-3 form-control-label">Category: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select id="cat"  class="form-control" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categorys as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Sub Category: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select id="subCat"  class="form-control" name="sub_category_id">
                                    <option value="">------ Select Sub category ------</option>
                                </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Child Category: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select id="childCat"  class="form-control" name="child_category_id">
                                    <option value="">------ Select Child category ------</option>
                                </select>
                            </div>
                        </div><!-- row --> --}}
                          <div class="row">
                            <label class="col-sm-3 form-control-label ">Link Page : </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0 mt-3">
                              <select style="height:10px" class="form-control select2" name="template">
                                <option value="">Select Template</option>
                                  <option value="service/nany-service">Nany</option>
                                <option value="service/diagonstic">Diagonstic</option>
                                <option value="service/care-giver">Caregiver</option>
                                <option value="service/doctor-visit">Doctor Visit</option>
                                <option value="service/hospital">Hospital</option>
                                <option value="service/burn-service">Burn</option>
                                <option value="service/nurse">Nurse</option>
                                <option value="service/e-clinic">E-clinic</option>
                                <option value="service/ambulance">Ambulance</option>
                                <option value="medical-tourism">Medical Tourism</option>
                                <option value="shop">Pharmacy</option>
                                <option value="sc/telimedisince">Telimedisince</option>
                                <option value="find-doctor">Find Doctor</option>
                                <option value="see-all-package">Heath Package</option>
                                <option value="therapy">Therapy</option>
                            </select>
                            </div>
                        </div><!-- row -->
                          <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Title: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input value="{{ old('title') }}" type="text" name="title" class="form-control" placeholder="Enter Title Name" required>
                        </div>
                        </div><!-- row -->

                         <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">position : <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <input value="{{ old('postion') }}" type="number" name="position" class="form-control" placeholder="Enter position" required>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Logo: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 150px;">
                                        <img class="display-upload-img" style="width: 150px;height: 70px;" src="{{ asset("frontend/images/No-image.jpg")}}" alt="">
                                        <input type="file" name="image" class="form-control upload-img" placeholder="Enter Activity Image" style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                    </div>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('home-servicetab.index')}}" type="button" class="btn btn-secondary text-white mr-2" >Cancel</a>
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


