@extends('Backend.layouts.layouts')

@section('title', 'Show Purchase')

@section('main_contain')

<div class="br-mainpanel">
<div class="br-pagetitle w-100 p-0" >
    <div class="br-section-wrapper" style="padding: 5px">
            <div class="d--flex justify--content-between">
              <h2 class="text-center">Show Purchase</h2>
              <div class="text-right">
                <a href="{{route('managePurchase')}}" class="btn btn-sm btn-info "><i class="fa fa-angle-left"></i></a>
              </div>
              </div>

    <table class="table--sm table-bordered table table-striped mt-1" width="100%">
      <tr>
        <th> Name</th>
        <td>{{$p->company_name}}</td>
        <th> Email</th>
        <td>{{$p->company_email}}</td>
          <th> Phone</th>
        <td>{{$p->company_phone}}</td>
        <th>Address</th>
        <td colspan="2">{{$p->company_address}}</td>
      </tr>
      <tr>
        <th>Employee Name</th>
        <td>{{$p->company_employee_name}}</td>
        <th>Status</th>
        <td>{{ucwords($p->status)}}</td>
        <th>Product Name</th>
        <td>{{$p->product_name}}</td>
        <th>Product SKU</th>
        <td>{{$p->sku}}</td>
      </tr>
      <tr>
      <th>Type</th>
        <td>{{ucwords($p->type)}}</td>
        <th>Status</th>
        <td>{{ucwords($p->status)}}</td>
         <th>Order Date</th>
        <td colspan="2">{{$p->order_date}}</td>
    </tr>

    </tr>

      <tr>
        <th>Returnable</th>
        <td>{{$p->is_return ? "YES" : "NO"}}</td>
        <th>Refundable</th>
        <td>{{$p->is_refund ? "YES" : "NO"}}</td>
        <th>Duration</th>
        <td colspan="2">{{$p->duration}}</td>
      </tr>

       <tr>
        <td colspan="9" class="text-center">Payment Information</td>
      </tr>
      @php
      $pInfo = getPurchasePayment($p->id);

      @endphp
      <tr>
        <th>Advance</th>
        <td>{{$p->advance}}</td>
        <th>Pay</th>
        <td>{{$p->pay}}</td>
        <th>Due</th>
        <td>{{$p->due}}</td>
        <th>Method</th>
        <td>{{$pInfo->type}}</td>
      </tr>
      <x-backend.purchase.details :info="$pInfo"/>
      <tr>
        <td colspan="9" class="text-center">Purchase Attributes</td>
      </tr>

      @php
      $attributes = getPurchaseAttributes($p->id);
      $total = 0;
      @endphp

      <tr>
        <th>SL</th>
        <th>Size</th>
        <th>Color</th>
        <th>Brand</th>
        <th>Quality</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Total</th>
      </tr>
      @foreach($attributes as $attribute)
      <tr>
        <td>{{ $loop->index + 1}}</td>
        <td> {{ getSingleRow("sizes",$attribute->size_id)->name}} </td>
        <td> {{ getSingleRow("colors",$attribute->color_id)->name}} </td>
        <td> {{ getSingleRow("brands",$attribute->brand_id)->name}} </td>
        <td> {{ getSingleRow("categories",$attribute->category_id)->name}} </td>
        <td> {{ $attribute->qty}} </td>
        <td> {{ $attribute->price}} </td>
        <td> {{ $attribute->discount}} </td>
        @php
  	      $total += ($attribute->total - $attribute->discount)
        @endphp
        <td> {{ $attribute->total - $attribute->discount}} </td>
      </tr>
      @endforeach
      <tr>
        <td colspan="9" class="text-right">Total Amount : {{ $total}}</td>
      </tr>
    </table>
    </div>
</div>
@stop


