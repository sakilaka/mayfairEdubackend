<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

<div class="container mr-2">

    <div class="card">
        <div class="card-body">
          <div class="container mb-5 mt-3">
            <div class="row d-flex align-items-baseline">
              <div class="col-xl-9">
                <p style="color: #7e8d9f;font-size: 20px;"> Order Number >> <strong>: {{ $orderdetails->order_number }}</strong></p>
              </div>
              <hr>
            </div>
        @php
          $title = \App\Models\Tp_option::where('option_name', 'theme_option_header')->first();
        @endphp
            <div class="container">
              <div class="col-md-12">
                <div class="text-center">
                  <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                  <p class="pt-0">{{ $title->company_name }}</p>
                </div>

              </div>


              <div class="row">
                <div class="col-xl-8">
                  <ul class="list-unstyled">
                    <li class="text-muted">Student Name : <span style="color:#5d9fc5 ;">{{ $orderdetails->name }}</span></li>
                    <li class="text-muted">Email : <span style="color:#5d9fc5 ;">{{ $orderdetails->email }}</span></li>
                    <li class="text-muted">Phone Number : <span style="color:#5d9fc5 ;">{{ $orderdetails->mobile  }}</span></li>
                    <li class="text-muted">Address : <span style="color:#5d9fc5 ;">{{ $orderdetails->address  }}</span></li>
                    <li class="text-muted">city : <span style="color:#5d9fc5 ;">{{ $orderdetails->city }}</span></li>
                    <li class="text-muted">postcode : <span style="color:#5d9fc5 ;">{{ $orderdetails->postcode }}</span></li>

                  </ul>
                </div>
                <div class="col-xl-4">
                  <p class="text-muted">Invoice</p>
                  <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">ID : </span>{{ $orderdetails->student->id }}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="fw-bold">Creation Date: </span> {{date('d,F,Y',strtotime($orderdetails->created_at ))}}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="me-1 fw-bold">Payment Status : </span><span class="badge bg-warning text-black fw-bold">{{ $orderdetails->payment_status }}</span></li>

                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                        class="me-1 fw-bold">Status : </span><span class="badge bg-warning text-black fw-bold">
                            @if($orderdetails->status == "new")
                              New
                           @elseif($orderdetails->status == "process")
                              Process
                            @elseif($orderdetails->status == "delivered")
                               Delivered
                            @elseif($orderdetails->status == "cancel")
                               Cancel
                           @endif

                        </li>
                  </ul>
                </div>
              </div>

              <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                  <thead style="background-color:#84B0CA ;" class="text-white">
                    <tr>
                      {{-- <th scope="col">SL</th>
                      <th scope="col">Teacher Name</th>
                      <th scope="col">Course Name</th>
                      <th scope="col">Course Fee</th>
                      <th scope="col">Course discount</th> --}}
                      <th scope="col">SL</th>
                      <th scope="col">Teacher Name/Seller Name</th>
                      <th scope="col">Course Name / Ebook Title</th>
                      <th scope="col">Type</th>
                      <th scope="col">Fee</th>
                      <th scope="col">discount</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($orderdetails->carts as $cart)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>
                          @if ($cart->cart_type=='course')
                          {{ @$cart->course->teacher->name }}
                          @elseif($cart->cart_type=='ebook')
                          {{ @$cart->ebook->user->name }}
                          @endif
                        </td>

                        <td>
                          @if ($cart->cart_type=='course')
                          {{ @$cart->course->name }}
                          @elseif($cart->cart_type=='ebook')
                          {{ @$cart->ebook->title }}
                          @endif
                         </td>
                         <td>
                          @if ($cart->cart_type=='course')
                            Course
                          @elseif($cart->cart_type=='ebook')
                            Ebook
                          @endif
                         </td>
                        <td>
                          @if ($cart->cart_type=='course')
                          {{ format_price(@$cart->course->fee) }}
                          @elseif($cart->cart_type=='ebook')
                          {{ format_price(@$cart->ebook->fee) }}
                          @endif
                       </td>
                        <td>{{ format_price(@$cart->amount) }}</td>
                      </tr>
                    {{-- <tr>
                      <th scope="row">{{ $i++ }}</th>
                      <td>{{ $cart->course->teacher->name }}</td>
                      <td>{{ $cart->course->name }}</td>
                      <td>{{ $cart->course->fee }}</td>
                      <td>{{ $cart->amount }}</td>
                    </tr> --}}
                    @endforeach
                  </tbody>

                </table>
              </div>
              <div class="row">
                <div class="col-xl-8">
                  {{-- <p class="ms-3">Add additional notes and payment information</p> --}}
                  <p class="">Note: {{ $orderdetails->order_note }}</p>

                </div>
                <div class="col-xl-3">
                  <ul class="list-unstyled">
                    <li class="text-muted ms-3"><span class="text-black me-4">SubTotal </span> : {{ $orderdetails->sub_total }}</li>
                    {{-- <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Tax(15%)</span>$111</li> --}}
                  </ul>
                  <p class="text-black float-start"><span class="text-black me-3"> Total Amount </span><span
                      style="font-size: 25px;">: {{ $orderdetails->total_amount }}</span></p>
                </div>
              </div>
              <hr>
            </div>
          </div>
        </div>
      </div>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        window.print();
        window.onafterprint = back;

        function back() {
            window.close();
            window.history.back();
        }
    </script>

</body>
</html>














{{-- @section('title')
Admin - Order Details
@endsection
@section('head')

@endsection
@extends('Backend.layouts.layouts')

@section('main_contain')


@endsection
@section('script')

@endsection --}}
