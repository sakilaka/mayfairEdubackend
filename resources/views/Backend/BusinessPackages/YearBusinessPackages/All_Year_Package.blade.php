@section('title')
Admin - all Year Package
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center"> All Year Package</h6>
            <div class="mb-3 d-flex justify-content-end">
                <!-- Button trigger modal -->
                <a href="" class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal" data-target="#homeAddpackage"> <i class="fa fa-plus ml-0 mr-1"></i>Add New </a>
            </div>
            @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <div class="table-wrapper">
              <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-15p">Id</th>
                    <th class="wd-15p">Name</th>
                    <th class="wd-15p">Text</th>
                    <th class="wd-15p">Price</th>
                    <th class="wd-15p">item</th>
                    <th class="wd-15p">Status</th>
                    <th class="wd-15p">Action</th>
                  </tr>
                </thead>
                <tbody>
                @php
                    $i = 1;
                @endphp
                  @if (count($Year_packages) > 0)
                    @foreach ($Year_packages as $Year_package)
                      <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ $Year_package->name }}</td>
                          <td>{{  $Year_package->text  }}</td>
                          <td>{{  $Year_package->price  }}</td>
                           <td>{!! $Year_package->item !!}</td>

                           <td>
                            @if($Year_package->package_status == 0)
                            <a href="{{ route('admin.year_package_toggle',$Year_package->id) }}" class="btn btn-sm btn-warning">Inactive</a>
                            @elseif($Year_package->package_status == 1)
                            <a href="{{ route('admin.year_package_toggle',$Year_package->id) }}" class="btn btn-sm btn-success">Active</a>
                            @endif
                          </td>


                           {{-- <td>

                            @if ($Year_package->package_status == 1)
                                Active
                              @else
                                Inactive
                            @endif

                          </td> --}}

                          <td>
                            <a class="btn text-info" href="{{ route('admin.edit_year_package', $Year_package->id) }}"><i class="icon ion-compose tx-28"></i></a>
                            <button class="btn text-danger bg-white" value="{{$Year_package->id}}" id="yehomepackageDelete"><i class="icon ion-trash-a tx-28"></i></button>
                          </td>
                      </tr>
                    @endforeach
                  @endif

                </tbody>
              </table>
            </div><!-- table-wrapper -->


          </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->

    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <!--_-- ########### Start Add partner MODAL ############---->

    <div id="homeAddpackage" class="modal fade effect-scale">
    <div class="modal-dialog modal-lg modal-dialog-top" role="document">
        <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add New Package</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!----- Start Add partner Form ------->
        <form action="{{ route('admin.add_year_package') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="modal-body pd-20">

            <!----- Start Add partner Form input ------->
            <div class="col-xl-12">
                <div class="form-layout form-layout-4">
                    <div class="row mt-3">
                        <label class="col-sm-3 form-control-label">Package Name:  <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="name" class="form-control" placeholder="Enter Package Name" required>
                        </div>
                    </div><!-- row -->

                     <div class="row mt-3">
                        <label class="col-sm-3 form-control-label">Title:  <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="text" class="form-control" placeholder="Enter Package Title" required>
                        </div>
                    </div><!-- row -->

                     <div class="row mt-3">
                        <label class="col-sm-3 form-control-label">Price:  <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="text" name="price" class="form-control" placeholder="Enter Package Price" required>
                        </div>
                    </div><!-- row -->

                    <div class="row mt-3">
                        <label class="col-sm-3 form-control-label">Description: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <textarea id="summernote" name="item" required></textarea>
                        </div>
                    </div><!-- row -->

                </div><!-- form-layout -->
            </div><!-- col-6 -->
            <!----- Start Add partner Form input ------->

        </div><!-- modal-body -->

        <div class="modal-footer">
            <button type="submit" class="btn btn-info tx-size-xs">Save changes</button>
            <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close</button>
        </div>

        </form>
        <!----- End Add partner Form ------->
        </div>
    </div><!-- modal-dialog -->
    </div><!-- modal -->

    <!--_-- ########### End Add partner MODAL ############---->


    <!--_-- ########### Start Delete partner MODAL ############---->

    <div id="homeDeletepackageyear" class="modal fade">
        <div class="modal-dialog modal-dialog-top" role="document">
          <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <form action="{{ route('admin.delete_year_package') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="icon icon ion-ios-close-outline tx-60 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-danger  tx-semibold mg-b-20 mt-2">Are you sure! you want to delete this?</h4>
                    <input type="hidden" name="year_pack_id" id="year_pack_id">
                    <button type="submit" class="btn btn-danger mr-2 text-white tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                        yes
                    </button>
                    <button type="button" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                        No
                    </button>
                </form>
            </div><!-- modal-body -->
          </div><!-- modal-content -->
        </div><!-- modal-dialog -->
      </div><!-- modal -->

    <!--_-- ########### End Delete partner MODAL ############---->




@endsection
