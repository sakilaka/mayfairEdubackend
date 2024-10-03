@section('title')
    Admin - Edit Customer Info
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('admin.customer_user.list')}}"> <i class="icon ion-reply text-22"></i> All Admin Customer</a>
          </nav>
        </div><!-- br-pageheader -->


       



        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> Update Customer Info</h6>
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

                    <form action="{{ route('admin.customer_user.update', $customer->id) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">First Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="fname" value="{{ $customer->fname }}" class="form-control" placeholder="Enter Fist Name">
                            </div>
                        </div><!-- row -->
                          <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Last Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="lname" value="{{ $customer->lname }}" class="form-control" placeholder="Enter Last Name">
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Email: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="email" name="email" value="{{ $customer->email }}" class="form-control" placeholder="Enter Email">
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Phone: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="mobile" value="{{ $customer->mobile }}" class="form-control" placeholder="Enter Phone">
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">NID: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="number" name="nid" value="{{ $customer->nid }}" class="form-control" placeholder="Enter NID Number">
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Age: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="number" name="age" value="{{ $customer->age }}" class="form-control" placeholder="Enter Age">
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Date of Birth: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="date" name="dob" value="{{ date('Y-d-m',strtotime($customer->dob)) }}" class="form-control" placeholder="Enter Age">
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Gender: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                              <select  class="form-control" name="gender" required>
                                <option value="">Select Gender</option>
                                <option @if($customer->gender == '0') selected @endif value="0">Male</option>
                                <option @if($customer->gender == '1') selected @endif value="1">Female</option>
                            </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mt-3">
                            <label class="col-sm-3 form-control-label">Address: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="address" value="{{ $customer->address }}" class="form-control" placeholder="Enter Address">
                            </div>
                        </div><!-- row -->
                        <div class="row mt-4">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('admin.customer_user.list')}}" type="button" class="btn btn-secondary text-white mr-2" >Close</a>
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
