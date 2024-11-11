@section('title')
 Theme Option
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
	color: #686868;
}
ul.tabs-nav li a i.fa {
	margin-right: 10px;
}
ul.tabs-nav li a:hover,
ul.tabs-nav li a.active {
	background-color: #ffffff;
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


		<div class="row mt-25">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-lg-12">
								{{ __('Color') }}
							</div>
						</div>
					</div>
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
							{{-- success message start --}}
							<!--Data Entry Form-->
							<form novalidate="" data-validate="parsley" id="DataEntry_formId">
								<div class="row">
									<div class="col-lg-8">
										<div class="form-group">
											<label for="font_text">{{ __('Font Text') }}</label>
											<select name="font_text" id="font_text" class="chosen-select form-control">
                                            @php
                                                $font_list= [
                                                    'Aclonica',
                                                    'Almarai',
                                                    'Allan',
                                                    'Annie Use Your Telescope',
                                                    'Anonymous Pro',
                                                    'Allerta Stencil',
                                                    'Allerta',
                                                    'Amaranth',
                                                    'Amiri',
                                                    'Anton',
                                                    'Archivo',
                                                    'Architects Daughter',
                                                    'Arimo',
                                                    'Artifika',
                                                    'Arvo',
                                                    'Asset',
                                                    'Astloch',
                                                    'Bangers',
                                                    'Bentham',
                                                    'Bevan',
                                                    'Bigshot One',
                                                    'Bowlby One',
                                                    'Bowlby One SC',
                                                    'Brawler',
                                                    'Buda:300',
                                                    'Cabin',
                                                    'Calligraffitti',
                                                    'Candal',
                                                    'Cantarell',
                                                    'Cairo',
                                                    'Cardo',
                                                    'Carter One',
                                                    'Caudex',
                                                    'Cedarville Cursive',
                                                    'Cherry Cream Soda',
                                                    'Chewy',
                                                    'Chivo',
                                                    'Coda',
                                                    'Coming Soon',
                                                    'Copse',
                                                    'Corben:700',
                                                    'Cousine',
                                                    'Covered By Your Grace',
                                                    'Crafty Girls',
                                                    'Crimson Text',
                                                    'Crushed',
                                                    'Cuprum',
                                                    'Damion',
                                                    'Dancing Script',
                                                    'Dawning of a New Day',
                                                    'DM Sans',
                                                    'Didact Gothic',
                                                    'Droid Sans',
                                                    'Droid Sans Mono',
                                                    'Droid Serif',
                                                    'EB Garamond',
                                                    'Expletus Sans',
                                                    'Fontdiner Swanky',
                                                    'Forum',
                                                    'Francois One',
                                                    'Geo',
                                                    'Give You Glory',
                                                    'Goblin One',
                                                    'Goudy Bookletter 1911',
                                                    'Gravitas One',
                                                    'Gruppo',
                                                    'Hammersmith One',
                                                    'Holtwood One SC',
                                                    'Homemade Apple',
                                                    'Inconsolata',
                                                    'Indie Flower',
                                                    'IM Fell DW Pica',
                                                    'IM Fell DW Pica SC',
                                                    'IM Fell Double Pica',
                                                    'IM Fell Double Pica SC',
                                                    'IM Fell English',
                                                    'IM Fell English SC',
                                                    'IM Fell French Canon',
                                                    'IM Fell French Canon SC',
                                                    'IM Fell Great Primer',
                                                    'IM Fell Great Primer SC',
                                                    'Inter',
                                                    'Irish Grover',
                                                    'Irish Growler',
                                                    'Istok Web',
                                                    'Josefin Sans',
                                                    'Josefin Slab',
                                                    'Jost',
                                                    'Judson',
                                                    'Jura',
                                                    'Jura:500',
                                                    'Jura:600',
                                                    'Just Another Hand',
                                                    'Just Me Again Down Here',
                                                    'Kameron',
                                                    'Kenia',
                                                    'Kranky',
                                                    'Kreon',
                                                    'Kristi',
                                                    'La Belle Aurore',
                                                    'Lato:100',
                                                    'Lato:100italic',
                                                    'Lato:300',
                                                    'Lato',
                                                    'Lato:bold',
                                                    'Lato:900',
                                                    'League Script',
                                                    'League Spartan',
                                                    'Lekton',
                                                    'Libre Baskerville',
                                                    'Limelight',
                                                    'Lobster',
                                                    'Lobster Two',
                                                    'Lora',
                                                    'Love Ya Like A Sister',
                                                    'Loved by the King',
                                                    'Luckiest Guy',
                                                    'Maiden Orange',
                                                    'Mako',
                                                    'Manrope',
                                                    'Maven Pro',
                                                    'Maven Pro:500',
                                                    'Maven Pro:700',
                                                    'Maven Pro:900',
                                                    'Meddon',
                                                    'MedievalSharp',
                                                    'Megrim',
                                                    'Merriweather',
                                                    'Metrophobic',
                                                    'Michroma',
                                                    'Miltonian Tattoo',
                                                    'Miltonian',
                                                    'Modern Antiqua',
                                                    'Monofett',
                                                    'Monoton',
                                                    'Molengo',
                                                    'Montserrat',
                                                    'Mountains of Christmas',
                                                    'Muli:300',
                                                    'Muli',
                                                    'M PLUS Rounded 1c',
                                                    'Neucha',
                                                    'Neuton',
                                                    'News Cycle',
                                                    'Nixie One',
                                                    'Nobile',
                                                    'Noto Nastaliq Urdu',
                                                    'Noto Sans',
                                                    'Noto Sans JP',
                                                    'Noto Sans Bengali',
                                                    'Nova Cut',
                                                    'Nova Flat',
                                                    'Nova Mono',
                                                    'Nova Oval',
                                                    'Nova Round',
                                                    'Nova Script',
                                                    'Nova Slim',
                                                    'Nova Square',
                                                    'Nunito:light',
                                                    'Nunito',
                                                    'Nunito Sans',
                                                    'OFL Sorts Mill Goudy TT',
                                                    'Old Standard TT',
                                                    'Open Sans:300',
                                                    'Open Sans',
                                                    'Open Sans:600',
                                                    'Open Sans:800',
                                                    'Open Sans Condensed:300',
                                                    'Orbitron',
                                                    'Orbitron:500',
                                                    'Orbitron:700',
                                                    'Orbitron:900',
                                                    'Oswald',
                                                    'Over the Rainbow',
                                                    'Reenie Beanie',
                                                    'Pacifico',
                                                    'Patrick Hand',
                                                    'Paytone One',
                                                    'Permanent Marker',
                                                    'Philosopher',
                                                    'Play',
                                                    'Playfair Display',
                                                    'Plus Jakarta Sans',
                                                    'Podkova',
                                                    'Poppins',
                                                    'PT Sans',
                                                    'PT Sans Narrow',
                                                    'PT Sans Narrow:regular,bold',
                                                    'PT Serif',
                                                    'PT Serif Caption',
                                                    'Puritan',
                                                    'Quattrocento',
                                                    'Quattrocento Sans',
                                                    'Quicksand',
                                                    'Radley',
                                                    'Raleway',
                                                    'Raleway:100',
                                                    'Redressed',
                                                    'Rock Salt',
                                                    'Rokkitt',
                                                    'Roboto',
                                                    'Roboto Condensed',
                                                    'Roboto Slab',
                                                    'Rubik',
                                                    'Ruslan Display',
                                                    'Scheherazade',
                                                    'Schoolbell',
                                                    'Shadows Into Light',
                                                    'Shanti',
                                                    'Sigmar One',
                                                    'Six Caps',
                                                    'Slackey',
                                                    'Smythe',
                                                    'Sniglet:800',
                                                    'Source Sans Pro',
                                                    'Special Elite',
                                                    'Stardos Stencil',
                                                    'Sue Ellen Francisco',
                                                    'Sunshiney',
                                                    'Swanky and Moo Moo',
                                                    'Syncopate',
                                                    'Tajawal',
                                                    'Tangerine',
                                                    'Tenor Sans',
                                                    'Terminal Dosis Light',
                                                    'The Girl Next Door',
                                                    'Tinos',
                                                    'Urbanist',
                                                    'Ubuntu',
                                                    'Ultra',
                                                    'Unkempt',
                                                    'UnifrakturCook:bold',
                                                    'UnifrakturMaguntia',
                                                    'Varela',
                                                    'Varela Round',
                                                    'Vibur',
                                                    'Vollkorn',
                                                    'VT323',
                                                    'Waiting for the Sunrise',
                                                    'Wallpoet',
                                                    'Walter Turncoat',
                                                    'Wire One',
                                                    'Work Sans',
                                                    'Yanone Kaffeesatz',
                                                    'Yanone Kaffeesatz:300',
                                                    'Yanone Kaffeesatz:400',
                                                    'Yanone Kaffeesatz:700',
                                                    'Yeseva One',
                                                    'Zeyada',
                                                ];
                                            @endphp
											@foreach($font_list as $row)
												<option {{ $row == $datalist['font_text'] ? "selected=selected" : '' }} value="{{ $row }}">
													{{ $row }}
												</option>
											@endforeach
											</select>
										</div>
                                        <div class="form-group">
											<label for="font_text">{{ __('Font Heading') }}</label>
											<select name="font_heading" id="font_heading" class="chosen-select form-control">

											@foreach($font_list as $row)
												<option {{ $row == $datalist['font_heading'] ? "selected=selected" : '' }} value="{{ $row }}">
													{{ $row }}
												</option>
											@endforeach
											</select>
										</div>
										<div class="form-group">
											<label>{{ __('Color brand') }}<span class="red">*</span></label>
											<div id="color_brand_picker" class="input-group tw-picker">
												<input name="color_brand" id="color_brand" type="text" value="{{ $datalist['color_brand'] == '' ? '#61a402' : $datalist['color_brand'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>

										<div class="form-group">
											<label>{{ __('Color brand dark') }}<span class="red">*</span></label>
											<div id="color_brand_dark_picker" class="input-group tw-picker">
												<input name="color_brand_dark" id="color_brand_dark" type="text" value="{{ $datalist['color_brand_dark'] == '' ? '#65971e' : $datalist['color_brand_dark'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>

										<div class="form-group">
											<label>{{ __('Color brand 2') }}<span class="red">*</span></label>
											<div id="color_brand_2_picker" class="input-group tw-picker">
												<input name="color_brand_2" id="color_brand_2" type="text" value="{{ $datalist['color_brand_2'] == '' ? '#daeac5' : $datalist['color_brand_2'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>

										<div class="form-group">
											<label>{{ __('Primary color') }}<span class="red">*</span></label>
											<div id="primary_color_picker" class="input-group tw-picker">
												<input name="primary_color" id="primary_color" type="text" value="{{ $datalist['primary_color'] == '' ? '#fdfff8' : $datalist['primary_color'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>

										<div class="form-group">
											<label>{{ __('Secondary color') }}<span class="red">*</span></label>
											<div id="secondary_color_picker" class="input-group tw-picker">
												<input name="secondary_color" id="secondary_color" type="text" value="{{ $datalist['secondary_color'] == '' ? '#8d949d' : $datalist['secondary_color'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>

										<div class="form-group">
											<label>{{ __('Warning color') }}<span class="red">*</span></label>
											<div id="warning_color_picker" class="input-group tw-picker">
												<input name="warning_color" id="warning_color" type="text" value="{{ $datalist['warning_color'] == '' ? '#595959' : $datalist['warning_color'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>

										<div class="form-group">
											<label>{{ __('Danger color') }}<span class="red">*</span></label>
											<div id="danger_color_picker" class="input-group tw-picker">
												<input name="danger_color" id="danger_color" type="text" value="{{ $datalist['danger_color'] == '' ? '#e7e7e7' : $datalist['danger_color'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>

										<div class="form-group">
											<label>{{ __('Success color') }}<span class="red">*</span></label>
											<div id="success_color_picker" class="input-group tw-picker">
												<input name="success_color" id="success_color" type="text" value="{{ $datalist['success_color'] == '' ? '#232424' : $datalist['success_color'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>

										<div class="form-group">
											<label>{{ __('Text color') }}<span class="red">*</span></label>
											<div id="text_color_picker" class="input-group tw-picker">
												<input name="text_color" id="text_color" type="text" value="{{ $datalist['text_color'] == '' ? '#ffffff' : $datalist['text_color'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>
                                        <div class="form-group">
											<label>{{ __('Heading color') }}<span class="red">*</span></label>
											<div id="heading_color_picker" class="input-group tw-picker">
												<input name="heading_color" id="heading_color" type="text" value="{{ $datalist['heading_color'] == '' ? '#ffffff' : $datalist['heading_color'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>
                                        <div class="form-group">
											<label>{{ __('Grey 1') }}<span class="red">*</span></label>
											<div id="grey_1_picker" class="input-group tw-picker">
												<input name="grey_1" id="grey_1" type="text" value="{{ $datalist['grey_1'] == '' ? '#ffffff' : $datalist['grey_1'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>
                                        <div class="form-group">
											<label>{{ __('Grey 2') }}<span class="red">*</span></label>
											<div id="grey_2_picker" class="input-group tw-picker">
												<input name="grey_2" id="grey_2" type="text" value="{{ $datalist['grey_2'] == '' ? '#ffffff' : $datalist['grey_2'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>
                                        <div class="form-group">
											<label>{{ __('Grey 4') }}<span class="red">*</span></label>
											<div id="grey_4_picker" class="input-group tw-picker">
												<input name="grey_4" id="grey_4" type="text" value="{{ $datalist['grey_4'] == '' ? '#ffffff' : $datalist['grey_4'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>
                                        <div class="form-group">
											<label>{{ __('Grey 9') }}<span class="red">*</span></label>
											<div id="grey_9_picker" class="input-group tw-picker">
												<input name="grey_9" id="grey_9" type="text" value="{{ $datalist['grey_9'] == '' ? '#ffffff' : $datalist['grey_9'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>
                                        <div class="form-group">
											<label>{{ __('Muted color') }}<span class="red">*</span></label>
											<div id="muted_color_picker" class="input-group tw-picker">
												<input name="muted_color" id="muted_color" type="text" value="{{ $datalist['muted_color'] == '' ? '#ffffff' : $datalist['muted_color'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>
                                        <div class="form-group">
											<label>{{ __('Body color') }}<span class="red">*</span></label>
											<div id="body_color_picker" class="input-group tw-picker">
												<input name="body_color" id="body_color" type="text" value="{{ $datalist['body_color'] == '' ? '#ffffff' : $datalist['body_color'] }}" class="form-control"/>
												<span class="input-group-addon"><i></i></span>
											</div>
										</div>

									</div>
									<div class="col-lg-4"></div>
								</div>

								<div class="row tabs-footer mt-15">
									<div class="col-lg-12">
										<a id="submit-form" href="javascript:void(0);" class="btn blue-btn">{{ __('Save') }}</a>
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

@section('scripts')
<!-- css/js -->
<link rel="stylesheet" href="{{asset('backend/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}">
<script src="{{asset('backend/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('backend/pages/theme_option_color.js')}}"></script>
@endsection
