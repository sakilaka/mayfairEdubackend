@section('title')
Withdrawal Request Update
@endsection
@extends('Backend.layouts.layouts')
@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center">Withdrawal Request Update</h6>
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
              

                           
            <form action="{{ route('backend.update_withdrawal_request', $withdrawal->id) }}" method="post">
                @csrf
            <div class="card card-body shadow">
               <div class="row">
                <div class="col-md-4">
                    <label class="mb-2">Name</label>
                    <input type="text" class="form-control  mb-2 " disabled value="{{ $withdrawal->user->name }}"  name=""  placeholder="Enter Amount" required/>
                </div>
                <div class="col-md-4">
                    <label class="mb-2">Total Amount </label>
                    <input type="text" class="form-control  mb-2 " disabled value="${{ $withdrawal->user->current_balance }}"  name=""  placeholder="Enter Amount" required/>
                </div>
                <div class="col-md-4">
                    <label class="mb-2">Withdrawal Amount </label>
                    <input type="text" class="form-control  mb-2 " disabled value="${{ $withdrawal->amount }}"  name="amount"  placeholder="Enter Amount" required/>
                </div>
                <div class="col-md-4">
                    <label class="mb-2">Fee($) <span style="color: red" >*</span></label>
                    <input type="text" disabled class="form-control  mb-2 " value="${{ $withdrawal->fee }}" name="fee"/>
                    <input type="hidden" class="form-control  mb-2 " value="{{ $withdrawal->fee }}" name="fee"/>
                </div>
                <div class="col-md-4">
                    <label class="mb-2">Payment Method</label>
                    {{-- <input type="text" class="form-control  mb-2 " disabled value="{{ auth()->user()->bank_name }}" name="bank_name"  placeholder="Bank Name"/>
                    <input type="hidden" class="form-control  mb-2 " value="{{ auth()->user()->bank_name }}" name="bank_name"  placeholder="Bank Name"/> --}}
                
                    <select class="form-select form-control" disabled name="payment_method" required>
                        <option value="">select Method</option>
                        <option @if ($withdrawal->payment_method == 0) Selected @endif value="0"> Bank Transaction </option>
                        <option  @if ($withdrawal->payment_method == 1) Selected @endif value="1" >PayPal</option>
                    </select>
                
                </div>

                @if ($withdrawal->payment_method == 0)
                <div class="col-md-4">
                    <label class="mb-2">Bank Name</label>
                    <input type="text" disabled class="form-control  mb-2 " value="{{ $withdrawal->user->bank_name }}" name="fee"/>
                </div>
                <div class="col-md-4">
                    <label class="mb-2">Bank Code/IFSC</label>
                    <input type="text" disabled class="form-control  mb-2 " value="{{ $withdrawal->user->bank_code_ifsc }}" name="fee"/>
                </div>
                <div class="col-md-4">
                    <label class="mb-2">Account Number</label>
                    <input type="text" disabled class="form-control  mb-2 " value="{{ $withdrawal->user->bank_account_number }}" name="fee"/>
                </div>
                <div class="col-md-4">
                    <label class="mb-2">Account Holder Name</label>
                    <input type="text" disabled class="form-control  mb-2 " value="{{ $withdrawal->user->bank_ac_holder_name }}" name="fee"/>
                </div>

                @elseif ($withdrawal->payment_method == 1)
                <div class="col-md-4">
                    <label class="mb-2">PayPal ID</label>
                    <input type="text" disabled class="form-control  mb-2 " value="{{ $withdrawal->user->paypal_id_num }}" name="fee"/>
                </div>
               
                    
                @endif




                <div class="col-md-8 mt-3">
                    <label class="mb-2">Transaction ID</label>
                    <input type="text" class="form-control  mb-2 " value="{{ $withdrawal->transaction_id }}" name="transaction_id" />
                </div>

                <div class="col-md-4 mt-3">
                    <label class="mb-2">Status</label>
                    <select class="form-select form-control" name="status" required>
                        <option value="">Select Status</option>
                        <option @if ($withdrawal->status == 0) Selected @endif value="0"> Processing </option>
                        <option  @if ($withdrawal->status == 1) Selected @endif value="1" >Complete</option>
                        <option  @if ($withdrawal->status == 2) Selected @endif value="2" >Cancel</option>
                    </select>
                </div>


                <div class="col-md-12 mt-3">
                    <label class="mb-2">Note:</label>
                    <textarea type="text" class="form-control  mb-2 " name="note"  placeholder="You can add a note, if you have!">{{ $withdrawal->note }}</textarea>
                </div>
                <div class="col-md-12 mt-3">
                   <button type="submit" class="btn btn-primary">Save</button>
                </div>
               </div>

            </div>
            </form>





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


@endsection
