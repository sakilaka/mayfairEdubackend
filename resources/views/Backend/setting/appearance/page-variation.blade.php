@extends('layouts.backend')

@section('title', __('Page Variation'))

@section('content')
<!-- main Section -->
<div class="main-body">
	<div class="container-fluid">
		@php $vipc = vipc(); @endphp
		@if($vipc['bkey'] == 0)
		@include('backend.partials.vipc')
		@else
		<div class="row mt-25">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-lg-12">
								{{ __('Page Variation') }}
							</div>
						</div>
					</div>
					<div class="card-body tabs-area p-0">
						@include('backend.partials.theme_options_tabs_nav')
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
							{{-- success message start --}}
							<div class="divider_heading">{{ __('Homepage Variation') }}</div>
							<div class="row">
								<div class="col-lg-3 mb-30">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/home-1.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">Home Page 1</div>
											<a id="home_variation_home_1" onclick="onHomepageVariations('home_1', 'home')" href="javascript:void(0);" class="active-btn home_variation {{ $datalist['home_variation'] =='home_1' ? 'active' : '' }}">{{ $datalist['home_variation'] =='home_1' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 mb-30">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/home-2.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">Home Page 2</div>
											<a id="home_variation_home_2" onclick="onHomepageVariations('home_2', 'home')" href="javascript:void(0);" class="active-btn home_variation {{ $datalist['home_variation'] =='home_2' ? 'active' : '' }}">{{ $datalist['home_variation'] =='home_2' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>

								<div class="col-lg-3 mb-30">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/home-3.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">Home Page 3</div>
											<a id="home_variation_home_3" onclick="onHomepageVariations('home_3', 'home')" href="javascript:void(0);" class="active-btn home_variation {{ $datalist['home_variation'] =='home_3' ? 'active' : '' }}">{{ $datalist['home_variation'] =='home_3' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-3 mb-30">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/home-4.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">Home Page 4</div>
											<a id="home_variation_home_4" onclick="onHomepageVariations('home_4', 'home')" href="javascript:void(0);" class="active-btn home_variation {{ $datalist['home_variation'] =='home_4' ? 'active' : '' }}">{{ $datalist['home_variation'] =='home_4' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
							</div>

							<div class="divider_heading">{{ __('Products Page Variation') }}</div>
							<div class="row mb-30">
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/full_width.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Full width without sidebar') }}</div>
											<a id="products_page_full_width" onclick="onProductsPageVariation('full_width', 'products')" href="javascript:void(0);" class="active-btn products_page {{ $datalist['products_variation'] =='full_width' ? 'active' : '' }}">{{ $datalist['products_variation'] =='full_width' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/left_sidebar.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Left Sidebar') }}</div>
											<a id="products_page_left_sidebar" onclick="onProductsPageVariation('left_sidebar', 'products')" href="javascript:void(0);" class="active-btn products_page {{ $datalist['products_variation'] =='left_sidebar' ? 'active' : '' }}">{{ $datalist['products_variation'] =='left_sidebar' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/right_sidebar.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Right Sidebar') }}</div>
											<a id="products_page_right_sidebar" onclick="onProductsPageVariation('right_sidebar', 'products')" href="javascript:void(0);" class="active-btn products_page {{ $datalist['products_variation'] =='right_sidebar' ? 'active' : '' }}">{{ $datalist['products_variation'] =='right_sidebar' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-6"></div>
							</div>

                            <div class="divider_heading">{{ __('Category Page Variation') }}</div>
							<div class="row mb-30">
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/full_width.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Full width without sidebar') }}</div>
											<a id="category_page_full_width" onclick="onCategoryPageVariation('full_width', 'category')" href="javascript:void(0);" class="active-btn category_page {{ $datalist['category_variation'] =='full_width' ? 'active' : '' }}">{{ $datalist['category_variation'] =='full_width' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/left_sidebar.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Left Sidebar') }}</div>
											<a id="category_page_left_sidebar" onclick="onCategoryPageVariation('left_sidebar', 'category')" href="javascript:void(0);" class="active-btn category_page {{ $datalist['category_variation'] =='left_sidebar' ? 'active' : '' }}">{{ $datalist['category_variation'] =='left_sidebar' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/right_sidebar.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Right Sidebar') }}</div>
											<a id="category_page_right_sidebar" onclick="onCategoryPageVariation('right_sidebar', 'category')" href="javascript:void(0);" class="active-btn category_page {{ $datalist['category_variation'] =='right_sidebar' ? 'active' : '' }}">{{ $datalist['category_variation'] =='right_sidebar' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-6"></div>
							</div>

							<div class="divider_heading">{{ __('Brand Page Variation') }}</div>
							<div class="row mb-30">
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/full_width.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Full width without sidebar') }}</div>
											<a id="brand_page_full_width" onclick="onBrandPageVariation('full_width', 'brand')" href="javascript:void(0);" class="active-btn brand_page {{ $datalist['brand_variation'] =='full_width' ? 'active' : '' }}">{{ $datalist['brand_variation'] =='full_width' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/left_sidebar.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Left Sidebar') }}</div>
											<a id="brand_page_left_sidebar" onclick="onBrandPageVariation('left_sidebar', 'brand')" href="javascript:void(0);" class="active-btn brand_page {{ $datalist['brand_variation'] =='left_sidebar' ? 'active' : '' }}">{{ $datalist['brand_variation'] =='left_sidebar' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/right_sidebar.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Right Sidebar') }}</div>
											<a id="brand_page_right_sidebar" onclick="onBrandPageVariation('right_sidebar', 'brand')" href="javascript:void(0);" class="active-btn brand_page {{ $datalist['brand_variation'] =='right_sidebar' ? 'active' : '' }}">{{ $datalist['brand_variation'] =='right_sidebar' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-6"></div>
							</div>

							<div class="divider_heading">{{ __('Seller Page Variation') }}</div>
							<div class="row">
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/full_width.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Grid View') }}</div>
											<a id="seller_page_grid_view" onclick="onSellerPageVariation('grid_view', 'seller')" href="javascript:void(0);" class="active-btn seller_page {{ $datalist['seller_variation'] =='grid_view' ? 'active' : '' }}">{{ $datalist['seller_variation'] =='grid_view' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
                                <div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/right_sidebar.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('List View') }}</div>
											<a id="seller_page_list_view" onclick="onSellerPageVariation('list_view', 'seller')" href="javascript:void(0);" class="active-btn seller_page {{ $datalist['seller_variation'] =='list_view' ? 'active' : '' }}">{{ $datalist['seller_variation'] =='list_view' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								{{-- <div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/left_sidebar.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Left Sidebar') }}</div>
											<a id="seller_page_left_sidebar" onclick="onSellerPageVariation('left_sidebar', 'seller')" href="javascript:void(0);" class="active-btn seller_page {{ $datalist['seller_variation'] =='left_sidebar' ? 'active' : '' }}">{{ $datalist['seller_variation'] =='left_sidebar' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/right_sidebar.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Right Sidebar') }}</div>
											<a id="seller_page_right_sidebar" onclick="onSellerPageVariation('right_sidebar', 'seller')" href="javascript:void(0);" class="active-btn seller_page {{ $datalist['seller_variation'] =='right_sidebar' ? 'active' : '' }}">{{ $datalist['seller_variation'] =='right_sidebar' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div> --}}
								<div class="col-lg-6"></div>
							</div>
                            <div class="divider_heading">{{ __('Blog Page Variation') }}</div>
							<div class="row">
								<div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/full_width.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Grid View') }}</div>
											<a id="blog_page_grid_view" onclick="onBlogPageVariation('grid_view', 'blog')" href="javascript:void(0);" class="active-btn blog_page {{ $datalist['blog_variation'] =='grid_view' ? 'active' : '' }}">{{ $datalist['blog_variation'] =='grid_view' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
                                <div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/full_width.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('List View') }}</div>
											<a id="blog_page_list_view" onclick="onBlogPageVariation('list_view', 'blog')" href="javascript:void(0);" class="active-btn blog_page {{ $datalist['blog_variation'] =='list_view' ? 'active' : '' }}">{{ $datalist['blog_variation'] =='list_view' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
                                <div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/full_width.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Big View') }}</div>
											<a id="blog_page_big_view" onclick="onBlogPageVariation('big_view', 'blog')" href="javascript:void(0);" class="active-btn blog_page {{ $datalist['blog_variation'] =='big_view' ? 'active' : '' }}">{{ $datalist['blog_variation'] =='big_view' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>
                                <div class="col-lg-2">
									<div class="theme-view-card">
										<div class="theme-image">
											<img src="{{asset('backend/images/full_width.jpg')}}" />
										</div>
										<div class="theme-footer">
											<div class="theme-title">{{ __('Wide View') }}</div>
											<a id="blog_page_wide_view" onclick="onBlogPageVariation('wide_view', 'blog')" href="javascript:void(0);" class="active-btn blog_page {{ $datalist['blog_variation'] =='wide_view' ? 'active' : '' }}">{{ $datalist['blog_variation'] =='wide_view' ? __('Activated') : __('Activate') }}</a>
										</div>
									</div>
								</div>

								<div class="col-lg-6"></div>
							</div>

							<input id="home_page_variation" type="hidden" class="dnone" value="{{ $datalist['home_variation'] }}" />
							<input id="products_page_variation" type="hidden" class="dnone" value="{{ $datalist['products_variation'] }}" />
                            <input id="category_page_variation" type="hidden" class="dnone" value="{{ $datalist['category_variation'] }}" />
							<input id="brand_page_variation" type="hidden" class="dnone" value="{{ $datalist['brand_variation'] }}" />
							<input id="seller_page_variation" type="hidden" class="dnone" value="{{ $datalist['seller_variation'] }}" />
                            <input id="blog_page_variation" type="hidden" class="dnone" value="{{ $datalist['blog_variation'] }}" />

						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
<!-- /main Section -->

@endsection

@push('scripts')
<!-- css/js -->
<script type="text/javascript">
var Activated = "{{ __('Activated') }}";
var Activate = "{{ __('Activate') }}";
</script>
<script src="{{asset('backend/pages/page_variation.js')}}"></script>
@endpush
