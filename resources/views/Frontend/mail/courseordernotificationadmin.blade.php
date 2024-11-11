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
                <p style="color: #7e8d9f;font-size: 20px;"> Order Number >> <strong>: {{ @$order->order_number }}</strong></p>
                <p style="color: #7e8d9f;font-size: 15px;"> Order  Date >> <strong>: {{date('d,F,Y',strtotime(@$order->created_at ))}}</strong></p>
              </div>
            </div>
        @php
            $title = \App\Models\Tp_option::where('option_name', 'theme_option_header')->first();
        @endphp
            <div class="container">
              <div class="col-md-12">
                <div class="text-center">
                  <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                 <p class="pt-0">Organization Name : {{ @$title->company_name }}</p>
                </div>

              </div>

                <table>
                    <tbody>
                        <tr>
                            <td>
                                {{-- <div class="row"> --}}
                                <div class="col-xl-8">
                                    <ul class="list-unstyled">
                                    <li class="text-muted">Student Name : <span style="color:#5d9fc5 ;">{{ @$order->name }}</span></li>
                                    <li class="text-muted">Email : <span style="color:#5d9fc5 ;">{{ @$order->email }}</span></li>
                                    <li class="text-muted">Phone Number : <span style="color:#5d9fc5 ;">{{ @$order->mobile  }}</span></li>
                                    <li class="text-muted">Address : <span style="color:#5d9fc5 ;">{{ @$order->address  }}</span></li>
                                    <li class="text-muted">city : <span style="color:#5d9fc5 ;">{{ @$order->city }}</span></li>
                                    <li class="text-muted">postcode : <span style="color:#5d9fc5 ;">{{ @$order->postcode }}</span></li>

                                    </ul>
                                {{-- </div> --}}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

              <div class="row my-2 mx-1 justify-content-center">
                <table class="table table-striped table-borderless">
                  <thead style="background-color:#84B0CA ;" class="text-white">
                    <tr>
                        <th scope="col">SL</th>
                        <th scope="col">Teacher Name/Seller Name</th>
                        {{-- <th scope="col">Course Name</th> --}}
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
                    @foreach ($order->carts as $cart)
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
                          {{-- {{ @$cart->course->name }} --}}
                         </td>
                         <td>
                          @if ($cart->cart_type=='course')
                            Course
                          @elseif($cart->cart_type=='ebook')
                            Ebook
                          @endif
                          {{-- {{ $cart->cart_type }} --}}
                         </td>
                        <td>
                          @if ($cart->cart_type=='course')
                          {{ format_price(@$cart->course->fee) }}
                          @elseif($cart->cart_type=='ebook')
                          {{ format_price(@$cart->ebook->fee) }}
                          @endif
                          {{-- {{ format_price(@$cart->course->fee) }} --}}
                       </td>
                        <td>{{ format_price(@$cart->amount) }}</td>
                      </tr>
                    {{-- <tr>
                      <th scope="row">{{ $i++ }}</th>
                      <td>{{ @$cart->course->teacher->name }}</td>
                      <td>{{ @$cart->course->name }}</td>
                      <td>{{ @$cart->course->fee }}</td>
                      <td>{{ @$cart->amount }}</td>
                    </tr> --}}
                    @endforeach
                  </tbody>

                </table>
              </div>
              <div class="row">
                <div class="col-xl-3">
                  <p class="text-black float-start"><span class="text-black me-3"> Total Amount </span><span
                      style="font-size: 25px;">: {{ @$order->total_amount }}</span></p>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

































































