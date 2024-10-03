@section('title')
 Theme Social Login
@endsection
@extends('Backend.layouts.layouts')
@section("style")
<style>
    .tabs-area {
	background-color: #f9f9f9;
}
ul.tabs-nav {
    width: 200px;
	float: left;
}
ul.tabs-nav li {
	border-bottom: 1px solid #ddd;
	border-left: none;
	position: relative;
}
ul.tabs-nav li a {
	padding: 15px 15px;
	display: block;
	color: #ece4e4;
}
ul.tabs-nav li a i.fa {
	margin-right: 10px;
}
ul.tabs-nav li a:hover,
ul.tabs-nav li a.active {
	background-color: var(--theme_hover_color);
	width: 101%;
	left: 0;
	right: 0;
}
.tabs-body {
	width: calc(100% - 200px);
	float: left;
	padding: 30px;
	border-left: 1px solid #ddd;
	background: #fff;
	min-height: 675px;
}
.tabs-body-full {
	width: 100%;
	float: left;
	padding: 30px;
	border-left: 1px solid #ddd;
	background: #fff;
	min-height: 500px;
}
.tabs-head {
	margin-bottom: 20px;
	display: inline-block;
	width: 100%;
}
.tabs-head h4 {
	float: left;
	font-size: 18px;
	padding-top: 10px;
}
.tabs-footer {
	border-top: 1px solid #ddd;
	padding: 30px 0px 0px 0px;
	margin-top: 30px;
}
li {
    list-style: none;
}
</style>
@endsection
@section('main_contain')
<div class="br-mainpanel">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
<div class="main-body">
	<div class="container-fluid">
        <div class="row mt-25">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header" style="background-color:var(--theme_color); height:auto">
						<div class="row">
							<div class="col-lg-12" style="color: var(--theme_text_color)">
								{{ __('Social Login') }}
							</div>
						</div>
					</div>
					<div class="card-body tabs-area p-0" style="background-color:var(--theme_color); height:auto">
					<div class="card-body tabs-area p-0">
						@include('Backend.setting.appearance.theme_options_tabs_nav')
						<div class="tabs-body">
							{{-- success message start --}}
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
							@if(session()->has('error-message'))
							<div class="alert alert-danger">
							{{session()->get('error-message')}}
							</div>
							<script>
								setTimeout(function(){
									$('.alert.alert-danger').hide();
								}, 3000);
							</script>
							@endif
							{{-- success message start --}}
							<!--Data Entry Form-->
							<form novalidate="" action="{{ route('backend.theme-options-payment-gateway-save') }}" method="POST" data-validate="parsley" id="DataEntry_formId" enctype="multipart/form-data">
								@csrf
							 <div class="row">
								<h3 style="margin-left: 10px" class="mb-3">Stripe</h3>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="address">{{ __('Publice Key') }}</label>
											<input type="text" value="{{ $datalist['stripe_publice_key'] }}" name="stripe_publice_key" id="address" class="form-control">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="address">{{ __('Secret Key') }}</label>
											<input type="text" value="{{ $datalist['stripe_secret_key'] }}" name="stripe_secret_key" id="address" class="form-control">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="address">{{ __('Currency') }}</label>
											<input type="text" value="{{ $datalist['stripe_currency'] }}" name="stripe_currency" id="address" class="form-control">
										</div>
									</div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="og_image">{{ __('Stripe Icon') }}</label>
                                                <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                                    <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 76px;">
                                                        <img class="display-upload-img" style="width: 76px;height: 70px;" src="{{ asset('upload/paymentgateway/'.$datalist['stripe_icon']) }}" alt="">
                                                            <input type="file" name="stripe_icon" class="form-control upload-img" placeholder="Enter Activity Image"
                                                            style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                                    </div>
                                                </div>
                                                <em>Recommended image size width: 600px and height: 315px.</em>
                                                {{-- <div id="remove_og_image" class="select-image dnone">
                                                    <div class="inner-image" id="view_og_image">
                                                    </div>
                                                    <a onClick="onMediaImageRemove('og_image')" class="media-image-remove" href="javascript:void(0);"><i class="fa fa-remove"></i></a>
                                                </div> --}}
                                            </div>
                                        </div>




                                    <div class="col-lg-12">
										<div class="form-group">
                                            <label for="address">{{ __('Stripe Checked Box Active/Inactive') }}   :   </label>
                                            <input @if ($datalist['stripe_status'] == 1) checked @endif type="checkbox" name="stripe_status" value="1">
											{{-- <label>
												<input @if ($datalist['stripe_status'] == 1) checked @endif type="radio" name="stripe_status" value="1">
												Active
											</label>

											<label>
												<input @if ($datalist['stripe_status'] == 2) checked @endif type="radio" name="stripe_status" value="2">
												Inactive
											</label> --}}
										</div>
									</div>

							 </div>

							 <div class="row ">
								<div class="col-lg-12">
									<button type="submit" class="btn blue-btn btn-info">Save</button>
									{{-- <a id="submit-form" href="javascript:void(0);" class="btn blue-btn">{{ __('Save') }}</a> --}}
								</div>
							</div>
							<hr/>

							 <div class="row mt-4">

								<h3 style="margin-left: 10px" class="mb-3">Paypal</h3>

									<div class="col-lg-12">
										<div class="form-group">
											<label for="address">{{ __('Client Id') }}</label>
											<input type="text" value="{{ $datalist['paypal_client_id'] }}" name="paypal_client_id" id="address" class="form-control">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="address">{{ __('Secret Key') }}</label>
											<input type="text" value="{{ $datalist['paypal_secret_key'] }}" name="paypal_secret_key" id="address" class="form-control">
										</div>
									</div>
									<div class="col-lg-12">
										<div class="form-group">
											<label for="address">{{ __('Currency') }}</label>
											<input type="text" value="{{ $datalist['paypal_currency'] }}" name="paypal_currency" id="address" class="form-control">
										</div>
									</div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="og_image">{{ __('Paypal Icon') }}</label>
                                            <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                                                <div class="mt-1 mr-2" style="position:relative;box-shadow: 0px 0px 1px 1px;width: 76px;">
                                                    <img class="display-upload-img" style="width: 76px;height: 70px;" src="{{ asset('upload/paymentgateway/'.$datalist['paypal_icon']) }}" alt="">
                                                        <input type="file" name="paypal_icon" class="form-control upload-img" placeholder="Enter Activity Image"
                                                        style="position: absolute;top: 0;opacity: 0;height: 100%;">
                                                </div>
                                            </div>
                                            <em>Recommended image size width: 600px and height: 315px.</em>
                                            {{-- <div id="remove_og_image" class="select-image dnone">
                                                <div class="inner-image" id="view_og_image">
                                                </div>
                                                <a onClick="onMediaImageRemove('og_image')" class="media-image-remove" href="javascript:void(0);"><i class="fa fa-remove"></i></a>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
										<div class="form-group">
                                            <label for="address">{{ __('Paypal Checked Box Active/Inactive') }} : </label>
                                            <input @if ($datalist['paypal_status'] == 1) checked @endif type="checkbox" name="paypal_status" value="1">
											{{-- <label>
												<input @if ($datalist['paypal_status'] == 1) checked @endif type="radio" name="paypal_status" value="1">
												Active
											</label>

											<label>
												<input @if ($datalist['paypal_status'] == 2) checked @endif type="radio" name="paypal_status" value="2">
												Inactive
											</label> --}}
										</div>
									</div>

                                    <div class="col-lg-12">
										<div class="form-group">
											<label for="address">{{ __('Sand Box Mode') }} : </label>
                                            <input @if ($datalist['sand_box_mode'] == 1) checked @endif type="checkbox" name="sand_box_mode" value="1">
										</div>
									</div>



								</div>

								<div class="row ">
									<div class="col-lg-12">
										<button type="submit" class="btn blue-btn btn-info">Save</button>
										{{-- <a id="submit-form" href="javascript:void(0);" class="btn blue-btn">{{ __('Save') }}</a> --}}
									</div>
								</div>
							</form>
							<!--/Data Entry Form/-->
						</div>
					</div>
				</div>
			</div>


		</div>


    </div>
</div>
</div>
@endsection
