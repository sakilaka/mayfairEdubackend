@section('title')
    Admin - slider Edit
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('home-slider.index')}}"> <i class="icon ion-reply text-22"></i> All Caslider</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4">Update slider</h6>
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

                    <form action="{{ route('home-slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <label class="col-sm-3 form-control-label">Category: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <select class="form-control " name="category_id" id="cat">
                                <option  value="">Select Category</option>
                                @foreach ($categories as $categorie)
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
                        </div><!-- row -->

                        {{-- <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Title: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="title" class="form-control" value="{{ $slider->title}}">
                            </div>
                        </div><!-- row --> --}}

                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Current slider Image: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 150px;">
                                        <img class="display-upload-img" style="width: 150px;height: 70px;" src="{{ $slider->image_show }}" alt="">
                                        <input type="file" name="image" class="form-control upload-img" placeholder="Enter Activity Image" style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                    </div>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                          <label class="col-sm-3 form-control-label">Status: <span class="tx-danger">*</span></label>
                          <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <select class="form-control select2" name="status">
                              <option @if($slider->status == 1) @selected(true) @endif value="1">Active</option>
                              <option @if($slider->status == 0) @selected(true) @endif value="0">Inactive</option>
                          </select>
                          </div>
                        </div><!-- row -->

                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('home-slider.index')}}" type="button" class="btn btn-secondary text-white mr-2" >Cancel</a>
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

