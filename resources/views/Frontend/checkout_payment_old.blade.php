@extends('layouts.frontend')

@section('title', __('Checkout Payment'))
@php
$gtext = gtext();
$gtax = getTax();
$tax_rate = $gtax['percentage'];
@endphp

@section('meta-content')
	<meta name="keywords" content="{{ $gtext['og_keywords'] }}" />
	<meta name="description" content="{{ $gtext['og_description'] }}" />
	<meta property="og:title" content="{{ $gtext['og_title'] }}" />
	<meta property="og:site_name" content="{{ $gtext['site_name'] }}" />
	<meta property="og:description" content="{{ $gtext['og_description'] }}" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{ url()->current() }}" />
	<meta property="og:image" content="{{ asset('media/'.$gtext['og_image']) }}" />
	<meta property="og:image:width" content="600" />
	<meta property="og:image:height" content="315" />
	@if($gtext['fb_publish'] == 1)
	<meta name="fb:app_id" property="fb:app_id" content="{{ $gtext['fb_app_id'] }}" />
	@endif
	<meta name="twitter:card" content="summary_large_image">
	@if($gtext['twitter_publish'] == 1)
	<meta name="twitter:site" content="{{ $gtext['twitter_id'] }}">
	<meta name="twitter:creator" content="{{ $gtext['twitter_id'] }}">
	@endif
	<meta name="twitter:url" content="{{ url()->current() }}">
	<meta name="twitter:title" content="{{ $gtext['og_title'] }}">
	<meta name="twitter:description" content="{{ $gtext['og_description'] }}">
	<meta name="twitter:image" content="{{ asset('media/'.$gtext['og_image']) }}">
@endsection

@section('header')
@include('frontend.partials.header')
@endsection

@section('content')

<main class="main">
	<!-- Page Breadcrumb -->
	<div class="breadcrumb-section">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
							<li class="breadcrumb-item active" aria-current="page">{{ __('Checkout Payment') }}</li>
						</ol>
					</nav>
				</div>
				<div class="col-lg-6">
					<div class="page-title">
						<h1>{{ __('Checkout Payment') }}</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Breadcrumb/ -->

	<!-- Inner Section -->
	<section class="inner-section inner-section-bg my_card">
		<div class="container">
			<form novalidate="" data-validate="parsley" id="checkout_payment_formid">
				@csrf
				<div class="row">
					<div class="col-lg-7">
                        @php
                        $CartDataArr = array();
                        $Total_Price = 0;
                        @endphp
                        @foreach(session('shopping_cart') as $row)
                            @php

                            $Total_Price += $row['price']*$row['qty'];

                            $data = array(
                                'rowId' => $row['id'],
                                'id' => $row['id'],
                                'qty' => $row['qty'],
                                'name' => $row['name'],
                                'price' => $row['price'],
                                'weight' => $row['weight'],
                                'thumbnail' => $row['thumbnail'],
                                'unit' => $row['unit'],
                                'seller_id' => $row['seller_id'],
                                'seller_name' => $row['seller_name'],
                                'store_name' => $row['store_name'],
                                'store_logo' => $row['store_logo'],
                                'store_url' => $row['store_url'],
                                'seller_email' => $row['seller_email'],
                                'seller_phone' => $row['seller_phone'],
                                'seller_address' => $row['seller_address']
                            );

                            $CartDataArr[$row['seller_id']][] = $data;
                            @endphp
                        @endforeach

                        @php $CartData_Arr = array(); @endphp
                        @foreach($CartDataArr as $aRows)
                            @foreach($aRows as $row)
                                @php $CartData_Arr[] = $row; @endphp
                            @endforeach
                        @endforeach
                        @php
                            $order_master_a=\App\Models\Order_master::find($order_products[$CartData_Arr[0]['seller_id']]);

                        @endphp
						<h5>{{ __('Shipping Information') }}</h5>
                        <div class="row">
                            <div class="col-md-6">
                                 <Label>Name : </Label> {{ $order_master_a->name }}
                            </div>
                             <div class="col-md-6">
                                <Label>Phone : </Label> {{ $order_master_a->phone }}
                            </div>
                            <div class="col-md-6">
                                 <Label>Email : </Label> {{ $order_master_a->email }}
                            </div>
                            <div class="col-md-6">
                                 <Label>Province : </Label> {{ $order_master_a->state }}
                            </div>
                            <div class="col-md-6">
                                 <Label>City : </Label> {{ $order_master_a->city }}
                            </div>
                            <div class="col-md-6">
                                <Label>Post Code : </Label> {{ $order_master_a->zip_code }}
                            </div>
                            <div class="col-md-6">
                                 <Label>Address : </Label> {{ $order_master_a->address }}
                            </div>
                            @if($order_master_a->comments)
                            <div class="col-md-6">
                                <Label>comments : </Label> {{ $order_master_a->comments }}
                            </div>
                            @endif
                        </div>

						<h5 class="mt10">{{ __('Payment Method') }}</h5>
						<div class="row">
							<div class="col-md-12">
								<span class="text-danger error-text payment_method_error"></span>
								@if($gtext['stripe_isenable'] == 1)
								<div class="payment_card">
									<div class="checkboxlist">
										<label class="checkbox-title">
											<input id="payment_method_stripe" name="payment_method" type="radio" value="3"><img src="{{ asset('frontend/images/stripe.png') }}" alt="Stripe" />
										</label>
									</div>
									<div id="pay_stripe" class="row hideclass">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-12">
													<div class="mb-3">
														<div class="form-control" id="card-element"></div>
														<span class="card-errors" id="card-errors"></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								@endif

								@if($gtext['isenable_paypal'] == 1)
								<div class="payment_card">
									<div class="checkboxlist">
										<label class="checkbox-title">
											<input id="payment_method_paypal" name="payment_method" type="radio" value="4"><img src="{{ asset('frontend/images/paypal.png') }}" alt="Paypal" />
										</label>
									</div>
									<p id="pay_paypal" class="hideclass">{{ __('Pay online via Paypal') }}</p>
								</div>
								@endif

								@if($gtext['isenable_razorpay'] == 1)
								<div class="payment_card">
									<div class="checkboxlist">
										<label class="checkbox-title">
											<input id="payment_method_razorpay" name="payment_method" type="radio" value="5"><img src="{{ asset('frontend/images/razorpay.png') }}" alt="Razorpay" />
										</label>
									</div>
									<p id="pay_razorpay" class="hideclass">{{ __('Pay online via Razorpay') }}</p>
								</div>
								@endif

								@if($gtext['isenable_mollie'] == 1)
								<div class="payment_card">
									<div class="checkboxlist">
										<label class="checkbox-title">
											<input id="payment_method_mollie" name="payment_method" type="radio" value="6"><img src="{{ asset('frontend/images/mollie.png') }}" alt="Mollie" />
										</label>
									</div>
									<p id="pay_mollie" class="hideclass">{{ __('Pay online via Mollie') }}</p>
								</div>
								@endif

								@if($gtext['cod_isenable'] == 1)
								<div class="payment_card">
									<div class="checkboxlist">
										<label class="checkbox-title">
											<input id="payment_method_cod" name="payment_method" type="radio" value="1"><img src="{{ asset('frontend/images/cash_on_delivery.png') }}" alt="Cash on Delivery" />
										</label>
									</div>
									<p id="pay_cod" class="hideclass">{{ $gtext['cod_description'] }}</p>
								</div>
								@endif

								@if($gtext['bank_isenable'] == 1)
								<div class="payment_card">
									<div class="checkboxlist">
										<label class="checkbox-title">
											<input id="payment_method_bank" name="payment_method" type="radio" value="2"><img src="{{ asset('frontend/images/bank_transfer.png') }}" alt="Bank Transfer" />
										</label>
									</div>
									<p id="pay_bank" class="hideclass">{{ $gtext['bank_description'] }}</p>
								</div>
								@endif
							</div>
						</div>
						<h5>{{ __('Shipping Method') }}</h5>
                        <span class="text-danger error-text courier_error"></span>
                        <input type="hidden" name="shipping_fee" id="shipping_fee" value="0">
                        <input type="hidden" name="shipping_title" id="shipping_title" value="">
                         <input type="hidden" name="service_courier" id="shipping_service" value="">
                        <div class="courier_res_show">
                            <div class="row">
                                @foreach ($shiping_methods as $shiping_method)


                                <div class="col-md-12 mt-2">
                                    <label class="p-2">
                                        <input cost_rate="{{ $shiping_method['rate'] }}" class="courier_rate" c_service="{{ $shiping_method['service'] }}" c_title="{{ $shiping_method['carrier'].' '.$shiping_method['service'] }}" name="courier" type="radio" value="{{ $shiping_method['rate_id'] }}">
                                        <span class="p-2">{{ $shiping_method['carrier'].' '.$shiping_method['service'] }}</span>
                                    </label>
                                    <div style="display:none;" class="ship_drop form-control ship_drop_{{ $shiping_method['rate_id'] }}">
                                        Courier price : {{ $shiping_method['rate'] }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
					</div>

					<div class="col-lg-5">
						<div class="carttotals-card">
							<div class="carttotals-head">{{ __('Order Summary') }}</div>
							<div class="carttotals-body">
							@if(session('shopping_cart'))
								<table class="table">
									<tbody>


										@php
										$tempSellerId = '';
										$SellerCount = 0;
                                        $ship_fee=0;
										@endphp

										@foreach($CartData_Arr as $row)
											@php
											if($row['unit'] == '0'){
												$unit = '';
											}else{
												$unit = '<strong>'.$row['qty'].' '.$row['unit'].'</strong>';
											}
											@endphp

											@if($tempSellerId != $row['seller_id'])

                                            @php
                                                $order_master=\App\Models\Order_master::find($order_products[$row['seller_id']]);

                                                $ship_fee += $order_master->shipping_fee ?? 0;

                                            @endphp

											<tr>
												<td colspan="2" class="tp_group">
													<div class="store_logo">
														<a href="{{ route('frontend.stores', [$row['seller_id'], str_slug($row['store_name'])]) }}">
															<img src="{{ asset('media/'.$row['store_logo']) }}" alt="{{ $row['store_name'] }}" />
														</a>
													</div>
													<div class="store_name">
														<p><strong>{{ __('Sold By') }}</strong></p>
														<p><a href="{{ route('frontend.stores', [$row['seller_id'], str_slug($row['store_url'])]) }}">{{ $row['store_name'] }}</a></p>
													</div>
												</td>
											</tr>

											@php
											$tempSellerId=$row['seller_id'];
											$SellerCount++;
											@endphp

											@endif

											@if($gtext['currency_position'] == 'left')
											<tr>
												<td>
													<p class="title"><a href="{{ route('frontend.product', [$row['id'], str_slug($row['name'])]) }}">{{ $row['name'] }}</a></p>
													<p class="sub-title">@php echo $unit; @endphp</p>
												</td>
												<td>
													<p class="price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row['price']*$row['qty']) }}</p>
													<p class="sub-price">{{ $gtext['currency_icon'] }}{{ $row['price'] }} x {{ $row['qty'] }}</p>
												</td>
											</tr>
											@else
											<tr>
												<td>
													<p class="title">{{ $row['name'] }}</p>
													<p class="sub-title">@php echo $unit; @endphp</p>
												</td>
												<td>
													<p class="price">{{ NumberFormat($row['price']*$row['qty']) }}{{ $gtext['currency_icon'] }}</p>
													<p class="sub-price">{{ $row['price'] }}{{ $gtext['currency_icon'] }} x {{ $row['qty'] }}</p>
												</td>
											</tr>
											@endif
										@endforeach

										@php

											$TaxCal = ($Total_Price*$tax_rate)/100;
											$TotalPrice = $Total_Price+$TaxCal;

											if($gtext['currency_position'] == 'left'){
												$ShippingFee = $gtext['currency_icon'].'<span class="shipping_fee">'.$ship_fee.'</span>';
												$tax = $gtext['currency_icon'].NumberFormat($TaxCal);
												$total = $gtext['currency_icon'].'<span class="total_amount">'.NumberFormat($TotalPrice).'</span>';
											}else{
												$ShippingFee = '<span class="shipping_fee">'.$ship_fee.'</span>'.$gtext['currency_icon'];
												$tax = NumberFormat($TaxCal).$gtext['currency_icon'];
												$total = '<span class="total_amount">'.NumberFormat($TotalPrice).'</span>'.$gtext['currency_icon'];
											}
										@endphp
                                         <input type="hidden" id="total_c_price" value="{{ NumberFormat($TotalPrice) }}">
										<tr><td colspan="2"><span class="title">{{ __('Shipping Fee') }} </span><span class="price">@php echo $ShippingFee; @endphp</span></td></tr>
										<tr><td colspan="2"><span class="title">{{ __('Tax') }}</span><span class="price">{{ $tax }}</span></td></tr>
										<tr><td colspan="2"><span class="total">{{ __('Total') }}</span><span class="total-price">@php echo $total; @endphp</span></td></tr>
									</tbody>
								</table>


								<input name="customer_id" type="hidden" value="@if(isset(Auth::user()->id)) {{ Auth::user()->id }} @endif" />
								<input name="razorpay_payment_id" id="razorpay_payment_id" type="hidden" />
								<a id="checkout_submit_payment_form" href="javascript:void(0);" class="btn theme-btn mt10 checkout_btn">{{ __('Pay Now') }}</a>

								@if(Session::has('pt_payment_error'))
								<div class="alert alert-danger">
									{{Session::get('pt_payment_error')}}
								</div>
								@endif
							@endif
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
	<!-- /Inner Section/ -->
</main>

@endsection

@push('scripts')
<script src="{{asset('frontend/js/parsley.min.js')}}"></script>
<script type="text/javascript">
    $(document).on('click','.courier_rate',function(){
        $('.ship_drop').hide();
        $('.ship_drop_'+$(this).val()).show();
        $('.shipping_fee').text($(this).attr('cost_rate'));
        $('#shipping_fee').val($(this).attr('cost_rate'));
        $('#shipping_title').val($(this).attr('c_title'));
        $('#shipping_service').val($(this).attr('c_service'));
        var total = parseFloat($('#total_c_price').val());
        var g_total = total+parseFloat($(this).attr('cost_rate'));
        $('.total_amount').text(g_total.toFixed(2));
    });
var theme_color = "{{ $gtext['theme_color'] }}";
var site_name = "{{ $gtext['site_name'] }}";
var validCardNumer = 0;
var TEXT = [];
	TEXT['Please type valid card number'] = "{{ __('Please type valid card number') }}";
</script>
@if($gtext['stripe_isenable'] == 1)
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
	var isenable_stripe = "{{ $gtext['stripe_isenable'] }}";
	var stripe_key = "{{ $gtext['stripe_key'] }}";
</script>
<script src="{{asset('frontend/pages/payment_method.js')}}"></script>
@endif

@if($gtext['isenable_razorpay'] == 1)
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
	var isenable_razorpay = "{{ $gtext['isenable_razorpay'] }}";
	var razorpay_key_id = "{{ $gtext['razorpay_key_id'] }}";
	var razorpay_currency = "{{ $gtext['razorpay_currency'] }}";
</script>
@endif
<script src="{{asset('frontend/pages/checkout.js')}}"></script>
@endpush
