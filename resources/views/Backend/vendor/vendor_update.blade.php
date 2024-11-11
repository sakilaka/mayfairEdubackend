@section('title')
    Admin - Edit Vendor Info
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('admin.vendor_user.list')}}"> <i class="icon ion-reply text-22"></i> All Admin Vendors</a>
          </nav>
        </div><!-- br-pageheader -->






        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> Update Vandor Info</h6>
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @endif

             {{-- success message start --}}
              @if(session()->has('message'))
              <div class="alert alert-success">
              {{session()->get('message')}}
              </div>
              <script>
                  setTimeout(function(){
                      $('.alert.alert-success').hide();
                  }, 3000);
              </script>
              @endif
              {{-- success message start --}}

            <!----- Start Add Category Form input ------->
            <div class="col-xl-7 mx-auto">
                <div class="form-layout form-layout-4 py-5">

                    <form action="{{ route('admin.vendor_user.update', $vendor->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <h3>Shop Information</h3>
                        <hr>

                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Update Shop Image: <span class="tx-danger">*</span></label>
                            <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 150px;">
                                <img class="display-upload-img" style="width: 150px;height: 70px;" src="{{ $vendor->shop_image_show }}" alt="">
                                <input type="file" name="shop_image" class="form-control upload-img" placeholder="Enter Activity Image" style="position: absolute;top: 0;opacity: 0;height: 100%;">
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Shop Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="shop_name" value="{{ $vendor->shop_name }}" class="form-control" placeholder="Enter shop name">
                            </div>
                        </div><!-- row -->

                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Phone: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="mobile" value="{{ $vendor->mobile }}" class="form-control" placeholder="Enter phone">
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Email: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="email" name="email" value="{{ $vendor->email }}" class="form-control" placeholder="Enter email">
                            </div>
                        </div><!-- row -->

                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Shop Address: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="shop_address" value="{{ $vendor->shop_address }}" class="form-control" placeholder="Enter shop address">
                            </div>
                        </div><!-- row -->


                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Trade Licence Number: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="trade_licence_number" value="{{ $vendor->trade_licence_number }}" class="form-control" placeholder="Enter trade licence number">
                            </div>
                        </div><!-- row -->


                        <hr>
                        <h3>Owner Information</h3>
                        <hr>
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">First Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="fname" value="{{ $vendor->fname }}" class="form-control" placeholder="Enter fist name" required>
                            </div>
                        </div><!-- row -->
                          <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Last Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="lname"  value="{{ $vendor->lname }}" class="form-control" placeholder="Enter last name">
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">NID: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="nid"  value="{{ $vendor->nid }}" class="form-control" placeholder="Owner NID number" required>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Date of Birth: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="date" name="dob"  value="{{ date('Y-d-m',strtotime($vendor->dob)) }}" class="form-control" >
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Gender: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                              <select  class="form-control" name="gender" required>
                                <option value="">Select Gender</option>
                                <option @if ($vendor->gender == '0') selected @endif value="0">Male</option>
                                <option @if ($vendor->gender == '1') selected @endif value="1">Female</option>
                            </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Address: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="address"  value="{{ $vendor->address }}" class="form-control" placeholder="Address" required>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('admin.vendor_user.list')}}" type="button" class="btn btn-secondary text-white mr-2" >Close</a>
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
    $('#color_code').on('input',function(){
        $('#show_color_code').val(this.value.replace('#',""));
       // console.log(this.value.replace('#',""));
    });
    // $('#color_code').on('change',function(){
    //     console.log(this.value.replace('#',""));
    // })
</script>
@endsection
