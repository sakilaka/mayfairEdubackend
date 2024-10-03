@extends('Frontend.layouts.master-layout')
@section('title','- Cart')
@section('head')

@endsection
@section('main_content')

<!-- Main content -->

<div class="content_search" style="margin-top:70px">
    <div class="bg-alice-blue py-5">
		<div class="container-lg p-0">
			<div class="row g-1">
				<div class="col-md-4 col-lg-3 order-md-last sticky-content">
					<div class="card border-0 rounded-0 shadow-sm mb-3 page-section">
						<div class="card-body p-3 p-xl-4">
							<h5 class="d-flex justify-content-between align-items-center mb-3">
								<span class="text-dark-cerulean">Cart Totals</span>
							</h5>
							@if(session('cart') !=null)

							@if(session('cart'))
							<ul class="list-group list-unstyled">
                                @php
                                    $total=0;
                                @endphp
                                @foreach(session('cart') as $id => $details)
                                @php
                                   $total =$total+ $details['fee']
                                   @endphp
                                @endforeach
								<li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2">
									<div><h6 class="my-0">Subtotal</h6></div>
									<span class="text-muted" id="cart-subtotal"> {{ format_price( $total) }}</span>
								</li>

								<li class="d-flex justify-content-between lh-sm mb-2 pb-2">
									<div><h6 class="my-0">Grand Total</h6></div>
									<span class="text-muted" id="cart-total"> {{ format_price($total) }}</span>
								</li>

								<li>
		                            <a href="{{ route('checkout') }}" class="btn btn-dark-cerulean w-100 btn-lg mt-3">Proceed to checkout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-8 col-lg-9 sticky-content">
					<div class="card border-0 rounded-0 shadow-sm page-section">
						<div class="card-body p-3 p-xl-4">
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Image</th>
											<th class="min_width_340p">Course</th>
											<th>Price</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
                                    <form action="#" method="post">
                                {{-- @if(session('cart')!=null)

                                  @if(session('cart')) --}}
                                    @foreach(session('cart') as $id => $details)
                                      <tr>

                                        <td>
                                            <img src="{{ @$details['image'] }}" alt="" width="80px" height="50px" srcset="">
                                        </td>
                                        <td>{{ $details['name'] }} </td>
                                        <td>{{ format_price($details['fee']) }} </td>
                                        <td>
                                            {{-- <a class="btn text-danger bg-white 21*963 cartremove" CarId="{{ $id }}" href="{{route('remove.from.cart',$id)}}"> --}}
                                                <a class="btn text-danger bg-white 21*963" style=" color: #df2020; background-color: #db2335;border-color: #dc3545;">
                                                <i class="fa fa-trash cartremove"  CarId="{{ $id }}" aria-hidden="true"></i>
                                               </a>
                                        </td>
                                     </tr>
                                    @endforeach
                                  @endif

                                  @else
                                  <ul class="list-group list-unstyled">
                                    <li class="border-bottom d-flex justify-content-between lh-sm mb-2 pb-2">
                                        <div><h6 class="my-0">Subtotal</h6></div>
                                        <span class="text-muted" id="cart-subtotal">  </span>
                                    </li>
                                    <li class="d-flex justify-content-between lh-sm mb-2 pb-2">
                                        <div><h6 class="my-0">Grand Total</h6></div>
                                        <span class="text-muted" id="cart-total">  </span>
                                    </li>
                                    <li>
                                        <a href="{{ route('checkout') }}" class="btn btn-dark-cerulean w-100 btn-lg mt-3">Proceed to checkout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-9 sticky-content">
                        <div class="card border-0 rounded-0 shadow-sm page-section">
                            <div class="card-body p-3 p-xl-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th class="min_width_340p">Course</th>
                                                <th>Price</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <form action="#" method="post">
                                     <tr>
                                        <td colspan="4">
                                            <p class="emptycart_msg">Your cart is empty</p>
                                        </td>
                                     </tr>

                                  @endif
                                    </form>
									</tbody>
								</table>

							</div>

                            <a href="{{ route('frontend.all.course.show') }}" class="btn btn-dark-cerulean btn-lg mt-3">Add more course</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div></div>
<!--======== main content close ==========-->

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="script.js"></script>

<script>


$(document).ready(function() {
    $(".delete-button").click(function() {
        $("#delete-modal").show();
        $("#car_id").val($(this).attr('CarId'))

    });
    $("#confirm-no").click(function() {
        $("#delete-modal").hide();
    });
    $("#confirm-yes").click(function() {
        $("#delete-modal").hide();
    });
});



$('.cartremove').on('click',function(){
    var id=$(this).attr('CarId');
    Swal.fire({
        title: "Do you Want to delete ?",
        icon: "error",
        showCancelButton: true,
        confirmButtonText: "Yes !",
        cancelButtonText: "No !",
        reverseButtons: true
        }).then((result) => {
    if (result.isConfirmed) {
        window.location ="{{ url('/remove-from-cart') }}/"+id
    }
    });
});

</script>
@endsection
