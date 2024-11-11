@section('title')
Admin - all Admin User
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center"> Admin User</h6>
            @if(session()->has('message'))
            <div class="alert alert-success">
            <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true"></button>
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
                    <th class="wd-25p">First Name</th>
                    <th class="wd-25p">Last Name</th>
                    <th class="wd-25p">Email</th>
                    <th class="wd-25p">Phone</th>
                    <th class="wd-25p">Role</th>
                    <th class="wd-25p">Status</th>
                    <th class="wd-25p">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                  @if (count($users) > 0)
                    @foreach ($users as $user)
                      <tr>
                          <td>{{ $i++ }}</td>

                          <td>{{ $user->fname }}</td>
                            <td>{{ $user->lname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user?->role?->name }}</td>
                          <td>
                            @if($user->status == 0)
                            <a href="javascript:void(0)" class="btn btn-sm btn-warning">Inactive</a>
                            @elseif($user->status == 1)
                            <a href="javascript:void(0)" class="btn btn-sm btn-success">Active</a>
                            @endif
                          </td>
                          <td>
                            <a class="btn text-info" href="{{ route('admin.user.edit', $user->id) }}"><i class="icon ion-compose tx-28"></i></a>
                            <button class="btn text-danger bg-white"  value="{{$user->id}}" id="homeCatdelete"><i class="icon ion-trash-a tx-28"></i></button>
                            <button class="btn text-white bg-info changePass"  value="{{$user->id}}">Change Password</button>
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

    <!--_-- ########### Start Add Category MODAL ############---->

    {{-- <div id="homeAddcategory" class="modal fade effect-scale">
    <div class="modal-dialog modal-lg modal-dialog-top" role="document">
        <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Category</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <!----- Start Add Category Form ------->
        <form action="{{ route('home-category.store') }}" method="post">
        @csrf
        <div class="modal-body pd-20">

            <!----- Start Add Category Form input ------->
            <div class="col-xl-12">
                <div class="form-layout form-layout-4">
                    <div class="row">
                        <label class="col-sm-3 form-control-label">Category Name: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Category Name">
                        @error('name')
                        <span class="alert alert-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div><!-- row -->
                    <div class="row mt-3">
                        <label class="col-sm-3 form-control-label">position : <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="number" name="position" class="form-control @error('position') is-invalid @enderror" placeholder="Enter position">
                            @error('position')
                            <span class="alert alert-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- row -->
                </div><!-- form-layout -->
            </div><!-- col-6 -->

            <!----- Start Add Category Form input ------->

        </div><!-- modal-body -->

        <div class="modal-footer">
            <button type="submit" class="btn btn-info tx-size-xs">Save changes</button>
            <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close</button>
        </div>

        </form>
        <!----- End Add Category Form ------->
        </div>
    </div><!-- modal-dialog -->
    </div><!-- modal --> --}}

    <!--_-- ########### End Add Category MODAL ############---->


    <!--_-- ########### Start Delete Category MODAL ############---->

    <div id="homeDeleteCategory" class="modal fade">
        <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <form action="{{ route('admin.user.delete') }}" method="post">
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
    <div id="changePassword" class="modal fade">
        <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-bodypd-y-20 pd-x-20 p-4">
                <form action="{{ route('admin.user.change_password') }}" method="post">
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

    <!--_-- ########### End Delete Category MODAL ############---->




@endsection
@section('script')

@endsection
