@section('title')
Admin - Order list
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center">All Orders</h6>
               {{-- success message start --}}
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
            {{-- success message End --}}

            <div class="table-wrapper">
              <table id="datatable1" class="table display responsive nowrap">
                <thead>
                  <tr>
                    <th class="wd-10p">Id</th>
                    <th class="wd-15p">Order Number</th>
                    <th class="wd-15p">Student Name</th>
                    <th class="wd-15p">Student Mobile</th>
                    <th class="wd-15p">Student Email</th>
                    <th class="wd-15p">Course Amound</th>
                    <th class="wd-10p">Payment Status</th>
                    <th class="wd-10p">Status</th>
                    <th class="wd-10p">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $order->order_number }}</td>
                          <td>{{ $order->name }}</td>
                          <td>{{ $order->mobile }}</td>
                          <td>{{ $order->email }}</td>
                          <td>{{ $order->total_amount }}</td>
                          <td>
                            @if($order->payment_status == "paid")
                               Paid
                            @elseif($order->payment_status == "unpaid")
                               Unpaid
                            @endif
                          </td>

                          <td>
                            @if($order->status == "new")
                            New
                         @elseif($order->status == "process")
                            Process
                          @elseif($order->status == "delivered")
                             Delivered
                          @elseif($order->status == "cancel")
                             Cancel
                         @endif
                        </td>

                          <td>
                            <button class="btn text-success bg-white"  value="{{$order->id}}" id="dataDeleteModal"><i class="icon ion-compose tx-28"></i></button>
                            <a class="btn text-info" href="{{ route('course.order.details', $order->id) }}"><i class="fa fa-eye tx-28"></i></a>
                          </td>


                      </tr>





                      <div id="datamodalshow" class="modal fade">
                        <div class="modal-dialog modal-dialog-top" role="document">
                        <div class="modal-content tx-size-sm">
                            <div class="modal-body tx-center pd-y-20 pd-x-20">
                                <form action="{{ route('status.change',$order->id) }}">
                                {{-- <form action="{{ route('status.change.index') }}" method="post"> --}}
                                    @csrf
                                    <h4 class="tx-success  tx-semibold mg-b-20 mt-2">Change Status</h4>
                                    <select class="form-control" name="status">
                                        <option value="">Select Status type</option>
                                        {{-- <option value="new">New</option> --}}
                                        <option @if ($order->status == 'processing') Selected @endif value="processing">Processing</option>
                                        <option @if ($order->status == 'delivered') Selected @endif value="delivered">Delivered</option>
                                        <option @if ($order->status == 'cancel') Selected @endif value="cancel">Cancel</option>
                                      </select>
                                     <input type="hidden" name="paymentstatus_id" id="modal_data_id">
                
                                     <button type="submit" class="btn btn-success mr-2 text-white tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                                        yes
                                    </button>
                                    <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                                        No
                                    </button>
                                </form>
                            </div><!-- modal-body -->
                        </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div>














                    @endforeach
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


    <!--_-- ########### End Add Category MODAL ############---->


    <!--_-- ########### Start Delete Category MODAL ############---->

    !-- modal -->

    <!--_-- ########### End Delete Category MODAL ############---->

@endsection
