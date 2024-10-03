@section('title')
    Admin - Edit Package
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('admin.all_package')}}"> <i class="icon ion-reply text-22"></i> All Package</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4">Edit Package</h6>

            <!----- Start Add Category Form input ------->
            <div class="col-xl-12 mx-auto">
                <div class="form-layout form-layout-4 pt-3 py-5">

                    <form action="{{ route('admin.update_package', $packages->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Package Name: </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <input type="text" name="name" value="{{ $packages->name }}" class="form-control" placeholder="Enter Banner Name">
                            </div>
                        </div><!-- row -->

                         <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Title: </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <input type="text" name="text" value="{{ $packages->text }}" class="form-control" placeholder="Enter Banner Name">
                            </div>
                        </div><!-- row -->

                         <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Price: </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <input type="text" name="price" value="{{ $packages->price }}" class="form-control" placeholder="Enter Price/month">
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Discount:  <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <input type="text" value="{{ $packages->discount }}" name="discount" class="form-control" placeholder="Enter Package Price Discount">
                            </div>
                        </div><!-- row -->
                        {{-- <div class="row mb-4 mt-4">
                            <label class="col-sm-3 form-control-label">Pacake Type: </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">

                                <select id="cat" class="form-control custom-select" name="package_type" >
                                    <option @if($packages->package_type == 1) selected @endif value="1">Monthly</option>

                                    <option @if($packages->package_type == 2) selected @endif value="2">Yearly</option>
                                </select>
                            </div>
                        </div><!-- row --> --}}
                        {{-- <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Description: </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <textarea id="summernote" name="item">{{ $packages->item }}</textarea>
                            </div>
                        </div><!-- row --> --}}

                        <div class="row mt-4">
                            <label class="col-sm-3 form-control-label">Status: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select class="form-control select2" name="package_status">
                                <option @if($packages->package_status == 1) @selected(true) @endif value="1">Active</option>
                                <option @if($packages->package_status == 0) @selected(true) @endif value="0">Inactive</option>
                            </select>
                            </div>
                        </div><!-- row -->
                        <style>
                            .plus-btn-pkg{
                                font-size: 25px;
                                color: #336eab!important;
                                background: #dee2e6;
                                border: 1px solid;
                            }
                            .minus-btn-pkg{
                                font-size: 20px;
                                color: #dc3545!important;
                                background: #fff;
                                border: 1px solid;
                            }
                        </style>
                        <hr/>

                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Package Options: </label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0 add-pack-opt-show">
                                @if($packages->options->count() > 0)
                                    @foreach ($packages->options as $k=>$option)
                                        @if($k==0)
                                            <div class="d-flex align-items-center">
                                                <input value="{{$option->title}}" type="text" name="package_option[]" class="form-control" placeholder="Enter Package Option">
                                                <a id="plus-btn-pkg" href="javascript:void(0)" class="plus-btn-pkg px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                            </div>
                                            @else
                                            <div class="d-flex align-items-center mt-3">
                                                <input value="{{$option->title}}" type="text" name="package_option[]" class="form-control" placeholder="Enter Package Option">
                                                <a href="javascript:void(0)" class="minus-btn-pkg px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                <div class="d-flex align-items-center">
                                                <input value="" type="text" name="package_option[]" class="form-control" placeholder="Enter Package Option">
                                                <a id="plus-btn-pkg" href="javascript:void(0)" class="plus-btn-pkg px-1 p-0 m-0 ml-2"><i class="fas fa-plus"></i></a>
                                            </div>
                                @endif


                            </div>
                        </div><!-- row -->

                        <div class="row mt-4 ">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('admin.all_package')}}" type="button" class="btn btn-secondary text-white mr-2" >Close</a>
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
@section('script')
<script>
    $('#plus-btn-pkg').on('click',function(){
        let pack_add_out = '<div class="d-flex align-items-center mt-3">';
            pack_add_out += '<input type="text" name="package_option[]" class="form-control" placeholder="Enter Package Option">';
            pack_add_out += '<a href="javascript:void(0)" class="minus-btn-pkg px-1 p-0 m-0 ml-2"><i class="fas fa-minus-circle"></i></a>';
            pack_add_out += '</div>';
        $('.add-pack-opt-show').append(pack_add_out);
    });
    $(document).on('click','.minus-btn-pkg',function(){
        $(this).parent().remove();
    });
</script>
@endsection
