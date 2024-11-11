@extends('Frontend.layouts.master-layout')
@section('title','- Library')
@section('head')

@endsection
@section('main_content')

<br>
<div class="content_search" style="margin-top:70px">


	<div class="align-items-center d-flex py-5 full_page_cover">
		<div class="container-lg">
			<div class="row g-3 align-items-center reverse-md">
				<div class="col-xl-4 offset-xl-2 col-md-6">
					<h2 class="fw-bolder text-dark-cerulean text-uppercase" style="color: #fff;">{{ $library->title1 }}</h2>
					<p class="fs-6 my-4" style="color: var(--text_color)">{!! $library->description !!}</p>
					{{-- @php
						$date1 = new DateTime("2007-03-24");
						$date2 = new DateTime("now");
						$interval = $date1->diff($date2);
						$total_days = ($interval->y * 365) + ($interval->y * 365) +$interval->d;
						print_r($interval);
					@endphp --}}
					<div id="timer" class="d-flex align-items-center my-4 border-bottom pb-4">
						<div id="days" class="fs-2 bg-light-blue p-3 me-2 rounded text-center w-25"></div>
						<div id="hours" class="fs-2 bg-light-blue p-3 me-2 rounded text-center w-25"></div>
						<div id="minutes" class="fs-2 bg-light-blue p-3 me-2 rounded text-center w-25"></div>
						<div id="seconds" class="fs-2 bg-light-blue p-3 me-2 rounded text-center w-25"></div>
					</div>
					<p class="fs-6" style="color: var(--text_color)">{{ $library->title2 }}</p>
					<form action="{{ route('frontend.subscription') }}" method="POST">
						@csrf
						<div class="input-group">
							<input type="text" class="form-control form-control-lg" name="email" placeholder="example@email.com" aria-label="Recipient's username" aria-describedby="button-addon2">
							<button class="btn btn-primary-light-bg fw-medium" type="submit">Subscribe</button>
						</div>
					</form>
				</div>
				<div class="col-xl-4 col-md-6 text-lg-end">
					<img src="{{ $library->image_show }}" class="img-fluid" alt="">
				</div>
			</div>
		</div>
	</div>


	
</div>


@include('Frontend.layouts.parts.news-letter')

@endsection
@section('script')

{{-- <script src="{{ asset('frontend') }}/application/modules/frontend/views/themes/default/assets/js/countdown.js"></script> --}}
<script>
	function makeTimer() {
	
    
		var countdowntime = "{{ date('d F Y H:i:s',strtotime($library->timer)) }}";
		
		
		var endTime = new Date(countdowntime);
		endTime = (Date.parse(endTime) / 1000);
			
		var now = new Date();
		now = (Date.parse(now) / 1000);
		
		if(now < endTime){
				
			var timeLeft = endTime - now;

			var days = Math.floor(timeLeft / 86400);
			var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
			var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
			var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

			if (hours < "10") {
				hours = "0" + hours;
			}
			if (minutes < "10") {
				minutes = "0" + minutes;
			}
			if (seconds < "10") {
				seconds = "0" + seconds;
			}

			$("#days").html(days + "<p class='timeText fs-6 mb-0'>Days</p>");
			$("#hours").html(hours + "<p class='timeText fs-6 mb-0'>Hours</p>");
			$("#minutes").html(minutes + "<p class='timeText fs-6 mb-0'>Mins</p>");
			if(days == '0' && hours == '00' && minutes == '00' &&  seconds == '01'){
				$("#seconds").html("00" + "<p class='timeText fs-6 mb-0'>Sec</p>");
			}else{
				$("#seconds").html(seconds + "<p class='timeText fs-6 mb-0'>Sec</p>");
			}
		}

	}
	setInterval(function () {
		makeTimer();
		
	}, 1000);
	</script>
@endsection


	
