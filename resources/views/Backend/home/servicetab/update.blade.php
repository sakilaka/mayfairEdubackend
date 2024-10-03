@section('title')
    Admin - Service Tab Edit
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
            <h6 class="br-section-label text-center mb-4">Update Service Tab</h6>
             {{-- validate start  --}}
             @if(count($errors) > 0)
             @foreach($errors->all() as $error)
                 <div class="alert alert-danger">{{ $error }}</div>
             @endforeach
             @endif
             {{-- validate End  --}}

            <!----- Start Add Category Form input ------->
            <div class="col-xl-9 mx-auto">
                <div class="form-layout form-layout-4 py-5">

                    <form action="{{ route('home-servicetab.update', $servicetab->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        {{-- <div class="row">
                            <label class="col-sm-3 form-control-label">Category: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <select class="form-control " name="category_id" id="cat">
                                <option  value="">Select Category</option>
                                @foreach ($servicetabs as $categorie)
                                @if ( $categorie->id == $cat_id )
                                <option selected value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @else
                                <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @endif
                                @endforeach
                            </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Sub Category: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <select class="form-control" name="sub_category_id" id="subCat">
                                <option  value="">Select Sub Category</option>
                                @foreach ($sub_categories as $categorie)
                                @if ( $categorie->id == $sub_cat_id)
                                <option selected value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @else
                                <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @endif
                                @endforeach
                            </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Child Category: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <select class="form-control" name="child_category_id" id="childCat">
                                <option  value="">Select Child Category</option>
                                @foreach ($child_categories as $categorie)
                                @if ( $categorie->id == $child_cat_id)
                                <option selected value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @else
                                <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                @endif
                                @endforeach
                            </select>
                            </div>
                        </div><!-- row --> --}}
                           <div class="row">
                          <label class="col-sm-3 form-control-label mt-3">Link Page : </label>
                          <div class="col-sm-9 mg-t-10 mg-sm-t-0 mt-3">
                            <select style="height:10px" class="form-control select2" name="template">
                                <option value="">Selected Link</option>

                                <option @if($servicetab->template == "service/nany-service") selected @endif value="service/nany-service">Nany</option>
                                <option @if($servicetab->template == "service/diagnostic") selected @endif value="service/diagnostic">Diagnostic</option>
                                <option @if($servicetab->template == "service/care-giver") selected @endif value="service/care-giver">Caregiver</option>
                                <option @if($servicetab->template == "service/doctor-visit") selected @endif value="service/doctor-visit">Doctor Visit</option>
                                <option @if($servicetab->template == "service/burn-service") selected @endif value="service/burn-service">Burn</option>
                                <option @if($servicetab->template == "service/hospital") selected @endif value="service/hospital">Hospital</option>
                                <option @if($servicetab->template == "service/nurse") selected @endif value="service/nurse">Nurse</option>
                                <option @if($servicetab->template == "service/e-clinic") selected @endif value="service/e-clinic">E-clinic</option>
                                <option @if($servicetab->template == "service/ambulance") selected @endif value="service/ambulance">Ambulance</option>
                                <option @if($servicetab->template == "medical-tourism") selected @endif value="medical-tourism">Medical Tourism</option>
                                <option @if($servicetab->template == "shop") selected @endif value="shop">Pharmacy</option>
                                <option @if($servicetab->template == "sc/telimedisince") selected @endif value="sc/telimedisince">Telimedisince</option>
                                <option @if($servicetab->template == "see-all-package") selected @endif value="see-all-package">Heath Package</option>
                                <option @if($servicetab->template == "find-doctor") selected @endif value="find-doctor">Find Doctor</option>
                                <option @if($servicetab->template == "therapy") selected @endif value="therapy">Therapy</option>
                          </select>
                          </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Title: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="title" class="form-control" value="{{ $servicetab->title}}" required>
                            </div>
                        </div><!-- row -->

                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Position: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="position" class="form-control" value="{{ $servicetab->position}}" required>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Current Service Tab Logo: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 150px;">
                                        <img class="display-upload-img" style="width: 150px;height: 70px;" src="{{$servicetab->image_show}}" alt="">
                                        <input type="file" name="image" class="form-control upload-img" placeholder="Enter Activity Image" style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                    </div>
                            </div>
                        </div><!-- row -->
                        {{-- <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Current Banner :</label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <img src="{{asset('upload/banner/'. $banner?->image)}}" alt="" width="60px" height="40px" srcset="">
                            </div>
                        </div><!-- row -->

                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label"> update banner : </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0 float-right">
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div><!-- row --> --}}

                        <div class="row mt-4">
                          <label class="col-sm-3 form-control-label">Status: <span class="tx-danger">*</span></label>
                          <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <select class="form-control select2" name="status">
                              <option @if($servicetab->status == 1) @selected(true) @endif value="1">Active</option>
                              <option @if($servicetab->status == 0) @selected(true) @endif value="0">Inactive</option>
                          </select>
                          </div>
                        </div><!-- row -->

                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('home-servicetab.index')}}" type="button" class="btn btn-secondary text-white mr-2" >Cancel</a>
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

