@section('title')
    Admin - Add New Country
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
          <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Home</a>
            <a class="breadcrumb-item" href="{{route('admin.country.index')}}"> <i class="icon ion-reply text-22"></i> All Country</a>
          </nav>
        </div><!-- br-pageheader -->

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center mb-4"> Add New Country</h6>
               {{-- validate start  --}}
               @if(count($errors) > 0)
               @foreach($errors->all() as $error)
                   <div class="alert alert-danger">{{ $error }}</div>
               @endforeach
               @endif
               {{-- validate End  --}}

            <!----- Start Add Category Form input ------->
            <div class="col-xl-8 mx-auto">
                <div class="form-layout form-layout-4 py-5">

                    <form action="{{ route('admin.country.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                          <div class="row">
                            <label class="col-sm-3 form-control-label">Country Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input value="{{ old('name') }}" type="text" name="name" class="form-control" placeholder="Enter Country Name" required>
                        </div>
                        </div><!-- row -->
                        {{-- <div class="row">
                            <label class="col-sm-3 form-control-label">Type : <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select id="cat"  class="form-control" name="type">
                                    <option value="">Select Type</option>
                                    <option value="1">Car</option>
                                    <option value="2">Flight</option>
                                </select>
                            </div>
                        </div><!-- row --> --}}
                        <div class="row mt-3">
                          <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                            <a href="{{route('admin.country.index')}}" type="button" class="btn btn-secondary text-white mr-2" >Cancel</a>
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

