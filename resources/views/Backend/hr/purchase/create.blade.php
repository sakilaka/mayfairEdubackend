@extends('Backend.layouts.layouts')

@section('title', 'Add Purchase')
@push('css')
  <style>
    .form-control, .dataTables_filter input {
      padding: 0 3px!important;
    }
  </style>
@endpush
@section('main_contain')

<div class="br-mainpanel p-0">
<div class="br-pagetitle p-0">
    <div class="br-section-wrapper p-3" style="z-index:100">
      <div class="">
      <h3 class="text-center ">Create Purchase</h3>

        <div class="text-right">
            <a href="{{route('managePurchase')}}" class="btn btn-sm btn-info "><i class="fa fa-angle-left"></i></a>
          </div>
      </div>
                <form action="{{route('storePurchase')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row no-gutters">
                        <div class="col-md-2 my-2">
                            <label for=""><b>Company Name :</b> </label>
                           <input type="text" name="company_name" placeholder="company Name" class="form-control" value="{{old('company_name'
                            )}}">
                           @error('company_name')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>

                         <div class="col-md-2 my-2">
                            <label for=""><b>Employee Name :</b> </label>
                           <input type="text" name="company_employee_name" class="form-control"  value="{{old('company_employee_name'
                            )}}">
                           @error('company_employee_name')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>

                         <div class="col-md-2 my-2">
                            <label for=""><b>Phone :</b> </label>
                           <input type="text" name="company_phone"  class="form-control"  value="{{old('company_phone'
                            )}}">
                           @error('company_phone')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                        <div class="col-md-3 my-2">
                            <label for=""><b>Email : </b></label>
                           <input type="email" name="company_email"  class="form-control"  value="{{old('company_email'
                            )}}">
                           @error('company_email')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>


                         <div class="col-md-3 my-2">
                            <label for=""><b>Payment Address :</b> </label>
                            <textarea name="company_address" id="" cols="30" rows="2" class="form-control"></textarea>

                           @error('company_address')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>

                       <div class="col-md-3 my-2">
                            <label for=""><b>Product Name :</b> </label>
                           <input type="text" name="product_name" placeholder="Product Name" class="form-control"  value="{{old('product_name'
                            )}}">
                           @error('product_name')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                          <div class="col-md-3 my-2">
                            <label for=""><b>Product Type :</b> </label>
                           <select name="type" id="" class="form-control">
                            <option value="">Select a Type</option>
                            <option value="physical">Physical</option>
                            <option value="virtual">Virtual</option>
                           </select>
                           @error('type')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                        <div class="col-md-3 my-2">
                            <label for=""><b>Product SKU :</b> </label>
                           <input type="text" name="sku" placeholder="SKU" class="form-control"  value="{{generateSKU()}}" readonly>
                           @error('sku')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>

              <table class="table table-bordered table-sm">
              <tbody id="dynamicField">
                <tr class="dynamicField">
                <td>
                  <label for=""><b>Size</b></label>
                  <select name="sizes[]" id="" class="form-control">
                    @foreach($sizes as $size)
                       <option value="{{$size->id}}">{{strtoupper($size->name)}}</option>
                    @endforeach
                  </select>
                </td>
                 <td>
                  <label for=""><b>Color</b></label>
                    <select name="colors[]" id="" class="form-control">
                    @foreach($colors as $color)
                       <option value="{{$color->id}}">{{ucwords($color->name)}}</option>
                    @endforeach
                  </select>
                </td>
                  <td>
                  <label for=""><b>Brand</b></label>
                    <select name="brands[]" id="" class="form-control">
                    @foreach($brands as $brand)
                       <option value="{{$color->id}}">{{ucwords($brand->name)}}</option>
                    @endforeach
                  </select>
                </td>
                   <td>
                  <label for=""><b>Quality</b></label>
                    <select name="categories[]" id="" class="form-control">
                    @foreach($categories as $category)
                       <option value="{{$category->id}}">{{ucwords($category->name)}}</option>
                    @endforeach
                  </select>
                </td>
                 <td>
                  <label for=""><b>Quantity</b></label>
                  <input type="number" class="form-control quantity" name="quantities[]" onkeyup="change(event,this)">
                </td>
                 <td>
                  <label for=""><b>Price</b></label>
                  <input type="number" class="form-control price" name="prices[]" onkeyup="change(event,this)">
                </td>
                 <td>
                  <label for=""><b>Discount</b></label>
                  <input type="number" class="form-control discount" name="discounts[]" onfocusout="discount(event,this)" value="0">
                </td>
                 <td>
                  <label for=""><b>Total</b></label>
                  <input type="number" class="form-control total" name="totals[]" readonly>
                </td>
                <td>
                  <button style="margin-top:35px!important" class="btn btn-sm btn-success mt-4" id="addNewField"><i class="fa fa-plus" ></i></button>
                </td>
              </tr>
              </tbody>

             </table>

                        <div class="col-md-3 my-2">
                           <label for=""><b>Payment Type</b> : </label>
                           <select name="payment" id="payment_type" class="form-control" >
                            <option value="">Select a Type</option>
                            <option value="cash">Cash</option>
                            <option value="mobile">Mobile Banking</option>
                            <option value="internet">Internet Banking</option>
                            <option value="cheque">Cheque</option>
                           </select>
                           @error('type')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                        <x-backend.purchase.mobile-banking/>
                        <x-backend.purchase.cheque/>
                        <x-backend.purchase.internet/>
    	                <div class="col-md-3 my-2">
                            <label for=""> <b>Advance Amount:</b> </label>
                           <input type="number" name="advance" placeholder="Advance"  class="form-control"  value="{{old('advance'
                            )}}" id="advance" readonly>
                           @error('advance')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>

                        <div class="col-md-3 my-2">
                            <label for=""> <b>Paid Amount :</b> </label>
                           <input type="number" name="pay" placeholder="Paid Amount"  class="form-control"  value="{{old('pay'
                            )}}" id="pay">
                           @error('pay')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>

                         <div class="col-md-3 my-2">
                            <label for=""><b> Due Amount:</b> </label>
                           <input type="number" name="due" placeholder="Due"  class="form-control"  value="{{old('due'
                            )}}" id="due" readonly>
                           @error('due')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>

                        <div class="col-md-3 my-2">
                            <label for=""><b>Status :</b> </label>
                           <select name="status" id="" class="form-control">
                            <option value="">Select  Status</option>
                            <option value="pending">Pending</option>
                            <option value="received">Received</option>
                           </select>
                           @error('status')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>

                        <div class="col-md-3 my-2">
                            <label for=""> <b>Order Date :</b> </label>
                           <input type="date" name="order_date"   class="form-control"  value="{{now()->format('Y-m-d')}}">
                           @error('pay')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>

                        <div class="col-md-3 my-2 align-self-center px-2">
                        <label for=""> <b>Is Refundable? :</b> </label>
                           <input type="checkbox" name="is_refund"   class="form--control"  value="1">
                            <label for="">Not Refundable</label>
                           <input type="checkbox" name=""   class="form--control"  value="1">
                           @error('is_refund')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>

                         <div class="col-md-3 my-2 align-self-center px-2">
                        <label for=""> <b>Is Returnable? :</b> </label>
                           <input type="checkbox" name="is_return"   class="form--control"  value="1">
                           <label for=""><b>Not Returnable</b></label>
                           <input type="checkbox" name=""   class="form--control"  value="1">
                           @error('is_return')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                         <div class="col-md-3 my-2">
                            <label for=""><b>Duration :</b> </label>
                           <input type="date" name="duration"   class="form-control"  value="{{now()->addMonth(2)->format('Y-m-d')}}">
                           @error('duration')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                    </div>

                    <center>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-info">
                        Submit</button>
                        <a href="{{route('managePurchase')}}" class="btn  btn-danger">Cancel</a>
                    </div>
                    </center>
                </form>
        <!-- </div> -->

    </div>
</div>
@stop



@push('script')
    <script>
      const log = (el) => console.log(el);

      $('body').on('click','#addNewField',function(e){
        e.preventDefault();

        let html = `<tr>
                <td>
                  <label for="">Size</label>
                  <select name="sizes[]" id="" class="form-control">
                    @foreach($sizes as $size)
                       <option value="{{$size->id}}">{{strtoupper($size->name)}}</option>
                    @endforeach
                  </select>
                </td>
                 <td>
                  <label for="">Color</label>
                    <select name="colors[]" id="" class="form-control">
                    @foreach($colors as $color)
                       <option value="{{$color->id}}">{{ucwords($color->name)}}</option>
                    @endforeach
                  </select>
                </td>
                  <td>
                  <label for="">Brand</label>
                    <select name="brands[]" id="" class="form-control">
                    @foreach($brands as $brand)
                       <option value="{{$color->id}}">{{ucwords($brand->name)}}</option>
                    @endforeach
                  </select>
                </td>
                   <td>
                  <label for="">Quality</label>
                    <select name="categories[]" id="" class="form-control">
                    @foreach($categories as $category)
                       <option value="{{$category->id}}">{{ucwords($category->name)}}</option>
                    @endforeach
                  </select>
                </td>
                 <td>
                  <label for="">Quantity</label>
                  <input type="number" class="form-control quantities" name="quantities[]" onkeyup="change(event,this)">
                </td>
                 <td>
                  <label for="">Price</label>
                  <input type="number" class="form-control price" name="prices[]" onkeyup="change(event,this)">
                </td>
                 <td>
                  <label for="">Discount</label>
                  <input type="number" class="form-control discount" name="discounts[]" onfocusout="discount(event,this)" value="0">
                </td>
                 <td>
                  <label for="">Total</label>
                  <input type="number" class="form-control total" name="totals[]" readonly>
                </td>
                <td>
                  <button style="margin-top:35px!important" class="btn btn-sm btn-danger mt-4 deleteRow"><i class="fa fa-trash" ></i></button>
                </td>
              </tr>
        `;
         $('.dynamicField').after(html);
      });

      $('body').on('click',".deleteRow",function(e){
        e.preventDefault();
        $(this).parents("tr").remove();
    });

  $('body').on('change',"#payment_type",function(e){

   let method = $(this).val();

   const mobileBanking = $('#mobileBanking');
   const cheque = $('#cheque');
   const internet = $('#internetBanking');

   if(method === "cash"){
      mobileBanking.addClass('d-none');
      cheque.addClass('d-none');
      internet.addClass('d-none');
   }
   if(method === "mobile"){
      mobileBanking.toggleClass('d-none');
      cheque.addClass('d-none');
      internet.addClass('d-none')
   }
    if(method === "internet"){

      internet.toggleClass('d-none')
      mobileBanking.addClass('d-none');
      cheque.addClass('d-none');
   }
    if(method === "cheque"){
      cheque.toggleClass('d-none');
      mobileBanking.addClass('d-none');
      internet.addClass('d-none')
   }

});

let totalAmount = 0;
const calculation = (event,el) => {

}

const change = (event,el) => {
  let qty = event.target.value;
  const tr = el.parentElement.parentElement.children;

  let quantityEl = tr[4];
  let quantity = quantityEl.children[1].value;

  let priceEl = tr[5];
  let price = priceEl.children[1].value;

  let discountEl = tr[6];
  let discount = discountEl.children[1].value;

  let totalEl = tr[7];
  let total = totalEl.children[1].value;

 let temp = quantity * price;

 totalEl.children[1].value = temp;

  calculateTotalAmount()
}

const discount = (event,el) => {
    const tr = el.parentElement.parentElement.children;

    let quantityEl = tr[4];
    let quantity = quantityEl.children[1].value;

    let priceEl = tr[5];
    let price = priceEl.children[1].value;

    let discountEl = tr[6];
    let discount = discountEl.children[1].value;

    let totalEl = tr[7];
    let total = totalEl.children[1].value;

  	let temp = quantity * price;

    let discountedPrice = temp - discount;
    totalEl.children[1].value = discountedPrice;

    calculateTotalAmount()
}

const calculateTotalAmount = () => {

  let items = document.querySelectorAll(".total");

  let sum = 0;
  items.forEach(function(item){
    sum += +item.value;
  });

  $("#due").val(sum);
  totalAmount = 0;
  totalAmount = sum;

}

        let price = $("#price");
        let totalPrice = $("#totalPrice");
        let quantity = $("#quantity");
        let due = $("#due");
        let advance = $("#advance");
        let pay = $("#pay");


        $('body').on('focusout','#advance',function(){
           let add = advance.val();
           let dueAmount = due.val();

           let temp =  dueAmount - add;
           due.val(temp)
        });

         $('body').on('focusout','#pay',function(){
           let payAmount = pay.val();

           let temp = totalAmount - payAmount;



           if(temp < 0){
            $('#due').val(0);
            advance.val(temp * -1)
           }else{
             $('#due').val(temp);
             advance.val(0)
           }


        });

    </script>

@endpush
