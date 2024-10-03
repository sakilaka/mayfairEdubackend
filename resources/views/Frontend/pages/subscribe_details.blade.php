@extends('Frontend.layouts.master-layout')
@section('title','- Subscribe Details')
@section('head')

@endsection
@section('main_content')
@include('Frontend.layouts.parts.header-menu')

    <!-- Main content -->

<div class="content_search" style="margin-top:70px">
        <div class="pricing-content bg-alice-blue py-5">
		<div class="container-lg">
			<div class="text-center mb-5">
				<h3 class="fw-bold mb-1">Ready To Start?</h3>
				<!-- <div class="">Save 30% an annual plan.we support bKASH/ Nagad for an individual<br> annual plan only.Any Question ? <a href="#">Contact Us</a></div> -->
			</div>
			<div class="row justify-content-center">
				<div class="col-xl-10">
					<div class="pricing-container">
						<ul class="bounce-invert d-flex g-3 justify-content-center list-unstyled mb-0 mt-5 pricing-list row">
                            @php
                            $monthlyPackage = \App\Models\BusinessPackages::where('type_name', 'monthly')->first();
                            @endphp
							<li class="col-sm-6 col-md-6 col-lg-4 d-flex exclusive">
								<ul class="pricing-wrapper list-unstyled position-relative" style="width: 100%">
									<li class="d-flex flex-wrap h-100 align-content-between">
                                        <header class="pricing-header text-center pt-5 pb-4 w-100" style="width:77%;font-size: 3rem;">
                                                <h2>{{ @$monthlyPackage->name }}</h2>
                                                <div class="align-items-center d-flex justify-content-center price">
												<span class="currency fs-5 fw-bold mt-0"></span>
												<span class="fw-bold value" style="width:77%;color: var(--header_text_color);font-size: 2rem;">{{ format_price(@$monthlyPackage->price) }}</span>
												<span class="duration fw-bold text-lowercase" style="width:35%;color: var(--header_text_color)">Monthly</span>
											</div>
										  	<!-- <p class="mb-0">Per Month / billed Monthly</p> -->
										</header>
										<div class="pricing-body w-100">
                                         <ul class="list-unstyled pricing-features px-5 text-start" >

                                        @foreach ($monthlyPackage->options as $k=>$item)
                                        <li>
                                            <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="12.574"
                                                height="9.234" viewBox="0 0 12.574 9.234">
                                                <path id="Path_8" data-name="Path 8"
                                                    d="M12.389,68.182a.629.629,0,0,0-.889,0L3.968,75.714l-2.9-2.9a.629.629,0,0,0-.889.889l3.34,3.34a.629.629,0,0,0,.889,0l7.977-7.977A.629.629,0,0,0,12.389,68.182Z"
                                                    transform="translate(0 -67.997)" fill="#fff"></path>
                                            </svg>
                                            {{ $item->title }}
                                        </li>
                                        @endforeach
								</ul>
											<p class="mx-5"></p>
										</div>
										<footer class="pricing-footer" >
                                            <a class="select d-inline-flex justify-content-center align-items-center" href="javascript:void(0)">
											{{-- <a class="select d-inline-flex justify-content-center align-items-center" href="{{ route('course.use.subscriptions',$monthlyPackage->id) }}"> --}}
												<div class="btn-icon d-flex align-items-center justify-content-center me-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="15.793" height="15.793" viewBox="0 0 15.793 15.793">
														<path data-name="Path 357" d="M15.3,1.922,13.87.491a1.679,1.679,0,0,0-2.372,0L.851,11.139a.471.471,0,0,0-.128.243L.008,15.246a.463.463,0,0,0,.539.539l3.864-.716a.471.471,0,0,0,.243-.128L15.3,4.294A1.676,1.676,0,0,0,15.3,1.922ZM1.04,14.753l.433-2.338,1.9,1.9Zm3.287-.792L1.833,11.466l9.106-9.107,2.494,2.494ZM14.647,3.639l-.56.56L11.593,1.705l.56-.56a.752.752,0,0,1,1.063,0l1.431,1.431A.751.751,0,0,1,14.647,3.639Z" transform="translate(0 0)" fill="#fff"></path>
													</svg>
												</div>
												Subscribe
											</a>
										</footer>
									</li>
								</ul>
							</li>
                            @php
                            $yearlyPackage = \App\Models\BusinessPackages::where('type_name', 'yearly')->first();
                            @endphp
							<li class="col-sm-6 col-md-6 col-lg-4 d-flex exclusive">
								<ul class="pricing-wrapper list-unstyled position-relative">
									<li class="d-flex flex-wrap h-100 align-content-between">

										<h6 class=" p-2 position-absolute rounded-pill start-50 text-capitalize text-center translate-middle w-sub text-white" style="background-color:#fe0000;">{{ @$yearlyPackage->text }}</h6>
                                        <header class="pricing-header text-center pt-5 pb-4 w-100">
                                                <h2>{{ @$yearlyPackage->name }}</h2>

											<h6 class="mx-auto p-2 rounded text-capitalize text-center text-warning w-sub" style="background-color: #15243a;" >Before : <del>{{ format_price(@$yearlyPackage->price) }}</del>/yearly</h6>
												<div class="align-items-center d-flex justify-content-center price">
												<span class="currency fs-5 fw-bold mt-0"></span>
												<span class="fw-bold value" style="width:77%;color: var(--header_text_color);font-size: 2rem;">{{ format_price(@$yearlyPackage->discount) }}</span>
												<span class="duration fw-bold text-lowercase" style="width:35%;color: var(--header_text_color)">Yearly</span>
											</div>
										  											<!-- <p class="mb-0">Per Month / billed Monthly</p> -->
										</header>
										<div class="pricing-body w-100">

											<ul class="list-unstyled pricing-features px-5 text-start">

                                                @foreach ($yearlyPackage->options as $k=>$item)
                                                <li>
                                                    <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="12.574"
                                                        height="9.234" viewBox="0 0 12.574 9.234">
                                                        <path id="Path_8" data-name="Path 8"
                                                            d="M12.389,68.182a.629.629,0,0,0-.889,0L3.968,75.714l-2.9-2.9a.629.629,0,0,0-.889.889l3.34,3.34a.629.629,0,0,0,.889,0l7.977-7.977A.629.629,0,0,0,12.389,68.182Z"
                                                            transform="translate(0 -67.997)" fill="#fff"></path>
                                                    </svg>
                                                        {{ $item->title }}
                                                </li>
                                                @endforeach



											</ul>
											<p class="mx-5"></p>
										</div>
											<footer class="pricing-footer" >
											{{-- <a class="select d-inline-flex justify-content-center align-items-center" href="{{ route('course.use.subscriptions',$yearlyPackage->id) }}"> --}}
                                                <a class="select d-inline-flex justify-content-center align-items-center" href="javascript:void(0)">
												<div class="btn-icon d-flex align-items-center justify-content-center me-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="15.793" height="15.793" viewBox="0 0 15.793 15.793">
														<path data-name="Path 357" d="M15.3,1.922,13.87.491a1.679,1.679,0,0,0-2.372,0L.851,11.139a.471.471,0,0,0-.128.243L.008,15.246a.463.463,0,0,0,.539.539l3.864-.716a.471.471,0,0,0,.243-.128L15.3,4.294A1.676,1.676,0,0,0,15.3,1.922ZM1.04,14.753l.433-2.338,1.9,1.9Zm3.287-.792L1.833,11.466l9.106-9.107,2.494,2.494ZM14.647,3.639l-.56.56L11.593,1.705l.56-.56a.752.752,0,0,1,1.063,0l1.431,1.431A.751.751,0,0,1,14.647,3.639Z" transform="translate(0 0)" fill="#fff"></path>
													</svg>
												</div>
												Subscribe
											</a>
										</footer>
									</li>
								</ul>
							</li>

						</ul>
					</div>
				</div>
			</div>
			<div class="text-center mt-5">{{ $home_content->package_text }}<br>
            <a href="{{ $home_content->package_btn_url }}" class="contact_us">{{ $home_content->package_btn }}</a>
            </div>
		</div>
	</div>

	<script>
		$(body).on('#checkusertype',function(){
          alert('test');
		})
	</script></div>
<!--======== main content close ==========-->

@include('Frontend.layouts.parts.news-letter')

@endsection
