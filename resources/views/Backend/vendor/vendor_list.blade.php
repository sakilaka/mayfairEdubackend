@section('title')
Admin - All Vendors
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center"> All Vendors</h6>
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
            <div class="mb-3 d-flex justify-content-end">
                <!-- Button trigger modal -->
                {{-- <a href="" class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal" data-target="#homeAddcategory"> <i class="fa fa-plus ml-0 mr-1"></i>Add New </a> --}}
            </div>

            <div class="table-wrapper">
              <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-25p">Id</th>
                    <th class="wd-25p">Vendor Name</th>
                    <th class="wd-25p">Owner Name</th>
                    <th class="wd-25p">Email</th>
                    <th class="wd-25p">Phone</th>
                     <th class="wd-25p">address</th>
                    <th class="wd-25p">Status</th>
                    <th class="wd-25p">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                  @if (count($vendors) > 0)
                    @foreach ($vendors as $vendor)
                      <tr>
                          <td>{{ $i++ }}</td>

                          <td>{{ $vendor->shop_name }}</td>
                            <td>{{ $vendor->fname }} {{ $vendor->lname }}</td>
                            <td>{{ $vendor->email }}</td>
                            <td>{{ $vendor->mobile }}</td>
                            <td>{{ $vendor->address }}</td>
                          <td>
                            @if($vendor->status == 0)
                            <a href="javascript:void(0)" class="btn btn-sm btn-warning">Inactive</a>
                            @elseif($vendor->status == 1)
                            <a href="javascript:void(0)" class="btn btn-sm btn-success">Active</a>
                            @endif
                          </td>
                          <td>
                            <a class="btn text-info" href="{{ route('admin.vendor_user.edit', $vendor->id) }}"><i class="icon ion-compose tx-28"></i></a>
                            <button class="btn text-danger bg-white"  value="{{$vendor->id}}" id="homeCatdelete"><i class="icon ion-trash-a tx-28"></i></button>
                            <button class="btn text-white bg-info changePass"  value="{{$vendor->id}}">Change Password</button>

                          </td>
                      </tr>
                    @endforeach
                  @endif

                </tbody>
              </table>
            </div><!-- table-wrapper -->


          </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
        <footer class="br-footer">
          {{-- <div class="footer-left">
            <div class="mg-b-2">Copyright &copy; <?php echo date('Y');?> NavieaSoft. All Rights Reserved.</div>
            <div>Attentively and carefully made by NavieaSoft.</div>
          </div> --}}
        </footer>
    </div><!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    

    <!--_-- ########### Start Delete Category MODAL ############---->

    <div id="homeDeleteCategory" class="modal fade">
        <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <form action="{{ route('admin.vendor_user.delete') }}" method="post">
                    @csrf
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <i class="icon icon ion-ios-close-outline tx-60 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-danger  tx-semibold mg-b-20 mt-2">Are you sure! you want to delete this?</h4>
                     <input type="hidden" name="user_id" id="category_id">
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

    <!--_-- ########### End Delete Category MODAL ############---->



    <div id="changePassword" class="modal fade">
      <div class="modal-dialog modal-dialog-top" role="document">
      <div class="modal-content tx-size-sm">
          <div class="modal-bodypd-y-20 pd-x-20 p-4">
              <form action="{{ route('admin.vendor_user.change_password') }}" method="post">
                  @csrf
                  <h3>Change Password</h3>
                  <input type="hidden" name="user_id" id="user_id_pass">
                  <div class="row">
                      <div class="col-md-12">
                          <label for="">Password</label>
                          <input type="text" name="password" class="form-control">
                      </div>
                  </div>
                  <div class="mt-3">
                       <button type="submit" class="btn btn-success mr-2 text-white tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                      Submit
                      </button>
                      <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                          Close
                      </button>
                  </div>

              </form>
          </div><!-- modal-body -->
      </div><!-- modal-content -->
      </div><!-- modal-dialog -->
  </div><!-- modal -->


@endsection
