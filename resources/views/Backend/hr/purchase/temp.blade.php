@extends('Backend.layouts.layouts')

@section('title', 'Add Purchase')

@section('main_contain')

@push('css')
  <style>
    .form-control, .dataTables_filter input {
      padding: 0!important;
    }
  </style>
@endpush
<div class="br-mainpanel">
<div class="br-pagetitle">
    <div class="br-section-wrapper mt-4" style="z-index:100">

            <div class="text-center ">
                    <h1 class="">Add Purchase</h1>
                    <br>
                </div>
             <table class="table table-bordered table-sm">
              <tbody id="dynamicField">
                <tr class="dynamicField">
                <td>
                  <label for="">Size</label>
                  <select name="size[]" id="" class="form-control">
                    @foreach($sizes as $size)
                       <option value="{{$size->id}}">{{strtoupper($size->name)}}</option>
                    @endforeach
                  </select>
                </td>
                 <td>
                  <label for="">Color</label>
                    <select name="color[]" id="" class="form-control">
                    @foreach($colors as $color)
                       <option value="{{$color->id}}">{{ucwords($color->name)}}</option>
                    @endforeach
                  </select>
                </td>
                  <td>
                  <label for="">Brand</label>
                    <select name="brand[]" id="" class="form-control">
                    @foreach($brands as $brand)
                       <option value="{{$color->id}}">{{ucwords($brand->name)}}</option>
                    @endforeach
                  </select>
                </td>
                   <td>
                  <label for="">Category</label>
                    <select name="category[]" id="" class="form-control">
                    @foreach($categories as $category)
                       <option value="{{$category->id}}">{{ucwords($category->name)}}</option>
                    @endforeach
                  </select>
                </td>
                 <td>
                  <label for="">Quantity</label>
                  <input type="text" class="form-control" name="quantity[]">
                </td>
                 <td>
                  <label for="">Price</label>
                  <input type="text" class="form-control" name="price[]">
                </td>
                 <td>
                  <label for="">Discount</label>
                  <input type="text" class="form-control" name="discount[]">
                </td>
                 <td>
                  <label for="">Total</label>
                  <input type="text" class="form-control" name="total[]">
                </td>
                <td>
                  <button class="btn btn-sm btn-success mt-4" id="addNewField"><i class="fa fa-plus" ></i></button>
                </td>
              </tr>
              </tbody>

             </table>

    </div>
</div>
@stop



@push('script')
    <script>

      $('body').on('click','#addNewField',function(e){
        e.preventDefault();

        let html = `<tr>
                <td>
                  <label for="">Size</label>
                  <select name="size[]" id="" class="form-control">
                    @foreach($sizes as $size)
                       <option value="{{$size->id}}">{{strtoupper($size->name)}}</option>
                    @endforeach
                  </select>
                </td>
                 <td>
                  <label for="">Color</label>
                    <select name="color[]" id="" class="form-control">
                    @foreach($colors as $color)
                       <option value="{{$color->id}}">{{ucwords($color->name)}}</option>
                    @endforeach
                  </select>
                </td>
                  <td>
                  <label for="">Brand</label>
                    <select name="brand[]" id="" class="form-control">
                    @foreach($brands as $brand)
                       <option value="{{$color->id}}">{{ucwords($brand->name)}}</option>
                    @endforeach
                  </select>
                </td>
                   <td>
                  <label for="">Category</label>
                    <select name="category[]" id="" class="form-control">
                    @foreach($categories as $category)
                       <option value="{{$category->id}}">{{ucwords($category->name)}}</option>
                    @endforeach
                  </select>
                </td>
                 <td>
                  <label for="">Quantity</label>
                  <input type="text" class="form-control" name="quantity[]">
                </td>
                 <td>
                  <label for="">Price</label>
                  <input type="text" class="form-control" name="price[]">
                </td>
                 <td>
                  <label for="">Discount</label>
                  <input type="text" class="form-control" name="discount[]">
                </td>
                 <td>
                  <label for="">Total</label>
                  <input type="text" class="form-control" name="total[]">
                </td>
                <td>
                  <button class="btn btn-sm btn-danger mt-4 deleteRow"><i class="fa fa-trash" ></i></button>
                </td>
              </tr>
        `;
         $('.dynamicField').after(html);
      });

      $('body').on('click',".deleteRow",function(e){
        e.preventDefault();
        $(this).parents("tr").remove();
    })
        let price = $("#price");
        let totalPrice = $("#totalPrice");
        let quantity = $("#quantity");
        let due = $("#due");
        let advance = $("#advance");
        let pay = $("#pay");

        $('body').on('keyup','#price',function(){
           changeTotalPrice();
        });

        $('body').on('keyup','#quantity',function(){
           changeTotalPrice();
        });

        const changeTotalPrice = () => {
            let temp = price.val() * quantity.val();
            totalPrice.val(temp);
            due.val(temp);
        }

        $('body').on('focusout','#advance',function(){
           let add = advance.val();
           let dueAmount = due.val();

           let temp =  dueAmount - add;
           due.val(temp)
        });

         $('body').on('focusout','#pay',function(){
           let payAmount = pay.val();
           let dueAmount = due.val();
           let totalAmount = totalPrice.val();

           let temp = totalAmount - payAmount;


           if(payAmount > totalAmount){
            console.log(payAmount);
               due.val(0);
               advance.val(payAmount - totalAmount);
           }else{
               if(temp < 0){
                  due.val(0);
                  advance.val(temp * -1);
                  return;
               }
               due.val(temp);
               advance.val(0);
           }
        });

    </script>

@endpush
