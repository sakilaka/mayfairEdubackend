<?php

namespace App\Http\Controllers\Backend\Appearance;

use App\Http\Controllers\Controller;
use App\Models\Tp_option;
use App\Models\PayWith;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ThemeOptionController extends Controller
{
	function Theme_Option()
	{
		$data['results'] = Tp_option::where('option_name', 'theme_logo')->first();
		return view("Backend.setting.appearance.theme-options", $data);
	}

	public function saveThemeLogo(Request $request)
	{
		try {
			$results = Tp_option::where('option_name', 'theme_logo')->first();
			if ($results == null) {
				$results = new Tp_option;
			}
			if ($request->hasFile('header_logo')) {
				@unlink(public_path('upload/site_setting/' . $results->header_image));
				$fileName = time() . '_header-logo.' . $request->header_logo->getClientOriginalExtension();
				$request->header_logo->move(public_path('upload/site_setting'), $fileName);

				$results->header_image = $fileName;
			}
			if ($request->hasFile('footer_logo')) {
				@unlink(public_path('upload/site_setting/' . $results->footer_image));
				$fileName = time() . '_footer-logo.' . $request->footer_logo->getClientOriginalExtension();
				$request->footer_logo->move(public_path('upload/site_setting'), $fileName);

				$results->footer_image = $fileName;
			}
			if ($request->hasFile('favicon')) {
				@unlink(public_path('upload/site_setting/' . $results->favicon));
				$fileName = time() . '_favicon.' . $request->favicon->getClientOriginalExtension();
				$request->favicon->move(public_path('upload/site_setting'), $fileName);

				$results->favicon = $fileName;
			}
			$results->option_name = 'theme_logo';
			$results->save();
			return redirect()->back()->with('success', 'Logo Updated');
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}
	}

	function Theme_Option_Home_popup()
	{
		$data['results'] = Tp_option::where('option_name', 'theme_option_home_popup')->first();
		return view("Backend.setting.appearance.theme-options-home-popup", $data);
	}
	public function saveThemeHomePopup(Request $request)
	{
		try {
			$results = Tp_option::where('option_name', 'theme_option_home_popup')->first();

			if ($results === null) {
				$results = new Tp_option;
				$results->option_name = 'theme_option_home_popup';
			}

			$valueArray = is_string($results->option_value)
				? json_decode($results->option_value, true)
				: $results->option_value ?? [];

			$valueArray['show_hide'] = $request->show_hide;
			$valueArray['redirect_url'] = $request->redirect_url;

			if ($request->hasFile('popup_image')) {
				// Handle the old image if it exists
				if (isset($valueArray['photo'])) {
					$oldImagePath = public_path(parse_url($valueArray['photo'], PHP_URL_PATH));
					if (file_exists($oldImagePath) && is_file($oldImagePath)) {
						unlink($oldImagePath);
					}
				}

				// Handle the new image upload
				$image = $request->file('popup_image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$image->move(public_path('upload/home_content/popup/'), $filename);
				$image_url = url('upload/home_content/popup/' . $filename);

				$valueArray['photo'] = $image_url;
			}

			$results->option_value = json_encode($valueArray);
			$results->save();

			return redirect()->back()->with('success', 'Home Popup Updated');
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}
	}
	function themeOptionHeader()
	{
		$data['results'] = Tp_option::where('option_name', 'theme_option_header')->first();
		return view("Backend.setting.appearance.theme-options-header", $data);
	}
	public function saveThemeHeader(Request $request)
	{
		try {
			$results = Tp_option::where('option_name', 'theme_option_header')->first();
			if ($results == null) {
				$results = new Tp_option;
			}
			$results->option_name = 'theme_option_header';
			$results->company_name = $request->company_name;
			
			$data['top_bar_text'] = $request->top_bar_text;
			$data['top_bar_url'] = $request->top_bar_url;
			$results->option_value = json_encode($data);

			$results->save();
			return redirect()->back()->with('success', 'Header Updated');
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}
	}

	function Theme_Option_Footer()
	{
		$data['results'] = Tp_option::where('option_name', 'theme_option_footer')->first();
		return view("Backend.setting.appearance.theme-options-footer", $data);
	}

	public function SaveThemeFooter(Request $request)
	{
		try {
			$results = Tp_option::where('option_name', 'theme_option_footer')->first();
			if ($results == null) {
				$results = new Tp_option;
			}
			$results->option_name = 'theme_option_footer';
			$results->address1 = $request->address1;
			$results->address2 = $request->address2;
			$results->email1 = $request->email1;
			$results->email2 = $request->email2;
			$results->license_no = $request->license_no;
			$results->phone1 = $request->phone1;
			$results->phone2 = $request->phone2;
			$results->copyright = $request->copyright;
			$results->description = $request->description;

			$results->save();
			// FacilitiyItem start

			if ($request->pay_name) {
				$pay_image = [];
				foreach ($request->file('pay_image') as $k => $image) {
					$filename = time() . $k . '.' . $image->getClientOriginalExtension();
					$image->move(public_path('upload/pay_image/'), $filename);
					$pay_image[] = $filename;
				}
				foreach ($request->pay_name as $k => $value) {
					$paywith = new PayWith();
					$paywith->tp_option_id = $results->id;
					$paywith->pay_name = $value;
					$paywith->pay_image = $pay_image[$k];
					$paywith->save();
				}
			}

			if ($request->old_pay_name) {
				foreach ($request->old_pay_name as $k => $value) {
					$paywith = PayWith::find($k);
					$paywith->tp_option_id = $results->id;
					$paywith->pay_name = $value;

					if (isset($request->file('old_pay_image')[$k])) {
						@unlink(public_path('upload/pay_image/' . $paywith->pay_image));
						$filename = time() . $k . '.' . $request->file('old_pay_image')[$k]->getClientOriginalExtension();
						$request->file('old_pay_image')[$k]->move(public_path('upload/pay_image/'), $filename);
						$paywith->pay_image = $filename;
					}
					$paywith->save();
				}
			}

			if ($request->delete_facilitiyitem) {
				foreach ($request->delete_facilitiyitem as $key => $value) {
					$facility = PayWith::find($value);
					$facility->delete();
				}
			}
			// FacilitiyItem End
			return redirect()->back()->with('success', 'Footer Updated');
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}
	}

	function Theme_Language_Switcher()
	{
		$data['results'] = Tp_option::where('option_name', 'theme_language_switcher')->first();
		return view("Backend.setting.appearance.language-switcher", $data);
	}

	public function ThemeOptionsHeader()
	{
		$results = Tp_option::where('option_name', 'theme-options-header')->first();
		if ($results) {
			$dataObj = json_decode($results->option_value);
			$data['address'] = $dataObj->address ?? '';
			$data['phone'] = $dataObj->phone ?? '';
		} else {
			$data['address'] = "";
			$data['phone'] = "";
		}
		$dat_a['datalist'] = $data;
		return view('Backend.setting.appearance.theme-options-header', $dat_a);
	}


	public function Theme_Color()
	{
		$theme_color = Tp_option::where('option_name', 'theme_color')->first();
		$data['theme_color'] = json_decode($theme_color['option_value'], true);

		return view('Backend.setting.appearance.themeoption', $data);
	}

	public function SaveThemeColor(Request $request)
	{
		try {
			$data = [
				'option_name' => 'theme_color',
				'option_value' => json_encode([
					'primary_color' => $request->input('primary_color'),
					'secondary_color' => $request->input('secondary_color'),
					'tertiary_color' => $request->input('tertiary_color'),
					/* 'btn_primary_color' => $request->input('btn_primary_color'),
					'btn_secondary_color' => $request->input('btn_secondary_color'),
					'btn_tertiary_color' => $request->input('btn_tertiary_color'), */
				])
			];

			$option = Tp_option::where('option_name', 'theme_color')->first();

			if ($option) {
				$option->update($data);
				$message = 'Theme Color Updated!';
			} else {
				Tp_option::create($data);
				$message = 'New Theme Color Added!';
			}

			return redirect()->back()->with('success', $message);
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}
	}

	function Theme_Social_Media()
	{
		$result = Tp_option::where('option_name', 'theme_social_media')->first();
		$data = json_decode($result['option_value'], true);

		return view('Backend.setting.appearance.social_media', ['data' => $data]);
	}

	public function SaveThemeSocialMedia(Request $request)
	{
		try {
			$data = $request->except('_token');
			$encodedData = json_encode($data);

			$tp_social = Tp_option::where('option_name', 'theme_social_media')->firstOrNew();
			$tp_social->option_value = $encodedData;
			$tp_social->save();

			return redirect()->back()->with('success', 'Social Media URLs Updated!');
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}
	}

	function ThemeOptionsSeo()
	{
		$results = Tp_option::where('option_name', 'theme_options_seo')->first();
		//dd($results);
		if ($results) {
			$dataObj = json_decode($results->option_value);
			// dd($dataObj->og_keywords);
			$data['og_title'] = $dataObj->og_title ?? [];
			$data['og_keywords'] = $dataObj->og_keywords ?? [];
			$data['og_description'] = $dataObj->og_description ?? '';
			$data['og_image'] = $dataObj->og_image ?? '';
		} else {
			$data['og_title'] = "";
			$data['og_keywords'] = "";
			$data['og_description'] = "";
			$data['og_image'] = "";
		}
		//dd($data);
		$dat_a['datalist'] = $data;
		return view('Backend.setting.appearance.theme-options-seo', $dat_a);
	}

	public function ThemeOptionsSeoSave(Request $request)
	{
		$res = array();

		$og_title = $request->input('og_title');
		$og_keywords = $request->input('og_keywords');
		$og_description = $request->input('og_description');
		// $og_image = $request->input('og_image');

		$gData = Tp_option::where('option_name', 'theme_options_seo')->first();
		$id = '';
		if ($gData) {
			$id = $gData->id;
		}

		$og_image = "";
		if ($request->hasFile('og_image')) {
			$fileName = rand() . time() . '.' . request()->og_image->getClientOriginalExtension();
			request()->og_image->move(public_path('upload/seo/'), $fileName);
			$og_image = $fileName;
		} else {
			if ($id) {
				$dataObj = json_decode($gData->option_value);
				$og_image = $dataObj->og_image ?? '';
			}
		}

		$validator_array = array(
			'og_title' => $request->input('og_title'),
			'og_keywords' => $request->input('og_keywords'),
			'og_description' => $request->input('og_description'),
			'og_image' => $og_image,
		);

		$validator = Validator::make($validator_array, [
			'og_title' => 'required',
			'og_keywords' => 'required',
			'og_description' => 'required',

		]);

		$errors = $validator->errors();

		if ($errors->has('og_title')) {
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('og_title');
			return redirect()->back()->with('error', $res['msg'])->withInput();
		}

		if ($errors->has('og_keywords')) {
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('og_keywords');
			return redirect()->back()->with('error', $res['msg'])->withInput();
		}

		if ($errors->has('og_description')) {
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('og_description');
			return redirect()->back()->with('error', $res['msg'])->withInput();
		}




		$option = array(
			'og_title' => $og_title,
			'og_keywords' => $og_keywords,
			'og_description' => $og_description,
			'og_image' => $og_image,

		);

		$data = array(
			'option_name' => 'theme_options_seo',
			'option_value' => json_encode($option)
		);



		if ($id == '') {
			$response = Tp_option::create($data);
			if ($response) {
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			} else {
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		} else {
			$response = Tp_option::where('id', $id)->update($data);
			@unlink(public_path("upload/seo/" . $response->og_image));
			if ($response) {
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
			} else {
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}

		// return response()->json($res);
		return redirect()->back()->with($res['msgType'], $res['msg']);
	}

	function ThemeGoogleMaps()
	{
		$results = Tp_option::where('option_name', 'google_maps_address')->first();
		if ($results) {
			$dataObj = json_decode($results->option_value);
			$data['g_location'] = $dataObj->g_location ?? '';
			$data['status'] = $dataObj->status ?? '';
		} else {
			$data['g_location'] = "";
			$data['status'] = "";
		}
		$dat_a['datalist'] = $data;
		return view("Backend.setting.appearance.theme-options-google-map", $dat_a);
	}

	function ThemeGoogleMapsSave(Request $request)
	{
		try {
			$res = array();

			$g_location = $request->input('g_location');
			$status = $request->input('status');

			$validator_array = array(
				'g_location' => $request->input('g_location'),
				'status' => $request->input('status'),
			);

			$validator = Validator::make($validator_array, [
				'g_location' => 'required',
				'status' => 'required',
			]);

			$errors = $validator->errors();

			if ($errors->has('g_location')) {
				$res['msgType'] = 'error';
				$res['msg'] = $errors->first('g_location');
				return redirect()->back()->with('error', $res['msg'])->withInput();
			}
			if ($errors->has('status')) {
				$res['msgType'] = 'error';
				$res['msg'] = $errors->first('status');
				return redirect()->back()->with('error', $res['msg'])->withInput();
			}

			$option = array(
				'g_location' => $g_location,
				'status' => $status,

			);

			$data = array(
				'option_name' => 'google_maps_address',
				'option_value' => json_encode($option)
			);

			$gData = Tp_option::where('option_name', 'google_maps_address')->get();

			$id = '';
			foreach ($gData as $row) {
				$id = $row['id'];
			}

			if ($id == '') {
				$response = Tp_option::create($data);
				if ($response) {
					$res['msgType'] = 'success';
					$res['msg'] = __('New Data Added Successfully');
				} else {
					$res['msgType'] = 'error';
					$res['msg'] = __('Data insert failed');
				}
			} else {
				$response = Tp_option::where('id', $id)->update($data);
				if ($response) {
					$res['msgType'] = 'success';
					$res['msg'] = __('Google Map Data Updated Successfully');
				} else {
					$res['msgType'] = 'error';
					$res['msg'] = __('Google Map Data update failed');
				}
			}
			return redirect()->back()->with($res['msgType'], $res['msg']);
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}
	}

	function ThemeOptionsSocialLogin()
	{
		$results = Tp_option::where('option_name', 'social_login')->first();
		if ($results) {
			$dataObj = json_decode($results->option_value);
			$data['google_client_id'] = $dataObj->google_client_id ?? '';
			$data['google_secret_id'] = $dataObj->google_secret_id ?? '';
			// $data['google_re_uri'] = $dataObj->google_re_uri ?? '';

			$data['fb_client_id'] = $dataObj->fb_client_id ?? '';
			$data['fb_secret_id'] = $dataObj->fb_secret_id ?? '';
			// $data['fb_re_uri'] = $dataObj->fb_re_uri ?? '';

		} else {
			$data['fb_client_id'] = "";
			$data['fb_secret_id'] = "";
			// $data['fb_re_uri'] = "";

			$data['google_client_id'] = "";
			$data['google_secret_id'] = "";
			// $data['google_re_uri'] = "";
		}
		$dat_a['datalist'] = $data;
		return view('Backend.setting.appearance.theme-options-social-login', $dat_a);
	}

	function ThemeOptionsSocialLoginSave(Request $request)
	{
		$res = array();

		$google_app_id = $request->input('google_client_id');
		$google_secret_id = $request->input('google_secret_id');
		// $google_re_uri = $request->input('google_re_uri');

		$fb_client_id = $request->input('fb_client_id');
		$fb_secret_id = $request->input('fb_secret_id');
		// $fb_re_uri = $request->input('fb_re_uri');

		$validator_array = array(
			'google_client_id' => $request->input('google_client_id'),
			'google_secret_id' => $request->input('google_secret_id'),
			// 'google_re_uri' => $request->input('google_re_uri'),

			'fb_client_id' => $request->input('fb_client_id'),
			'fb_secret_id' => $request->input('fb_secret_id'),
			// 'fb_re_uri' => $request->input('fb_re_uri'),
		);

		$validator = Validator::make($validator_array, [
			'google_client_id' => 'required',
			'google_secret_id' => 'required',
			// 'google_re_uri' => 'required',

			'fb_client_id' => 'required',
			'fb_secret_id' => 'required',
			// 'fb_re_uri' => 'required',
		]);

		$errors = $validator->errors();

		if ($errors->has('google_client_id')) {
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('google_client_id');
			return redirect()->back()->with('error', $res['msg'])->withInput();
		}
		if ($errors->has('google_secret_id')) {
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('google_secret_id');
			return redirect()->back()->with('error', $res['msg'])->withInput();
		}
		// if($errors->has('google_re_uri')){
		// 	$res['msgType'] = 'error';
		// 	$res['msg'] = $errors->first('google_re_uri');
		// 	return redirect()->back()->with('error', $res['msg'])->withInput();
		// }

		if ($errors->has('fb_client_id')) {
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('fb_client_id');
			return redirect()->back()->with('error', $res['msg'])->withInput();
		}
		if ($errors->has('fb_secret_id')) {
			$res['msgType'] = 'error';
			$res['msg'] = $errors->first('fb_secret_id');
			return redirect()->back()->with('error', $res['msg'])->withInput();
		}
		// if($errors->has('fb_re_uri')){
		// 	$res['msgType'] = 'error';
		// 	$res['msg'] = $errors->first('fb_re_uri');
		// 	return redirect()->back()->with('error', $res['msg'])->withInput();
		// }

		$option = array(
			'google_client_id' => $google_app_id,
			'google_secret_id' => $google_secret_id,
			// 'google_re_uri' => $google_re_uri,

			'fb_client_id' => $fb_client_id,
			'fb_secret_id' => $fb_secret_id,
			// 'fb_re_uri' => $fb_re_uri,

		);

		$data = array(
			'option_name' => 'social_login',
			'option_value' => json_encode($option)
		);

		$gData = Tp_option::where('option_name', 'social_login')->get();
		// dd($data);
		$id = '';
		foreach ($gData as $row) {
			$id = $row['id'];
		}

		if ($id == '') {
			$response = Tp_option::create($data);
			if ($response) {
				$res['msgType'] = 'success';
				$res['msg'] = __('New Data Added Successfully');
			} else {
				$res['msgType'] = 'error';
				$res['msg'] = __('Data insert failed');
			}
		} else {
			$response = Tp_option::where('id', $id)->update($data);
			if ($response) {
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Updated Successfully');
			} else {
				$res['msgType'] = 'error';
				$res['msg'] = __('Data update failed');
			}
		}
		return redirect()->back()->with($res['msgType'], $res['msg']);
	}

	function ThemePaymentGateway()
	{
		$results = Tp_option::where('option_name', 'payment_gateway')->first();
		if ($results) {
			$dataObj = json_decode($results->option_value);
			$data['stripe_publice_key'] = $dataObj->stripe_publice_key ?? '';
			$data['stripe_secret_key'] = $dataObj->stripe_secret_key ?? '';
			$data['stripe_currency'] = $dataObj->stripe_currency ?? '';
			$data['stripe_icon'] = $dataObj->stripe_icon ?? '';
			$data['stripe_status'] = $dataObj->stripe_status ?? '';

			$data['paypal_client_id'] = $dataObj->paypal_client_id ?? '';
			$data['paypal_secret_key'] = $dataObj->paypal_secret_key ?? '';
			$data['paypal_currency'] = $dataObj->paypal_currency ?? '';
			$data['paypal_icon'] = $dataObj->paypal_icon ?? '';
			$data['sand_box_mode'] = $dataObj->sand_box_mode ?? '';
			$data['paypal_status'] = $dataObj->paypal_status ?? '';
		} else {
			$data['stripe_publice_key'] = "";
			$data['stripe_secret_key'] = "";
			$data['stripe_currency'] = "";
			$data['stripe_icon'] = "";
			$data['stripe_status'] = "";

			$data['paypal_client_id'] = "";
			$data['paypal_secret_key'] = "";
			$data['paypal_currency'] = "";
			$data['paypal_icon'] = "";
			$data['sand_box_mode'] = "";
			$data['paypal_status'] = "";
		}
		$dat_a['datalist'] = $data;
		return view('Backend.setting.appearance.paymentgateway', $dat_a);
	}

	function ThemePaymentGatewaySave(Request $request)
	{
		$gData = Tp_option::where('option_name', 'payment_gateway')->first();
		// dd($gData);
		$id = '';
		if ($gData) {
			$id = $gData->id;
		}
		$res = array();

		$stripe_publice_key = $request->input('stripe_publice_key');
		$stripe_secret_key = $request->input('stripe_secret_key');
		$stripe_currency = $request->input('stripe_currency');

		// if(isset($request->stripe_icon)){
		if ($request->hasFile('stripe_icon')) {
			// @unlink(public_path("upload/paymentgateway/".));
			$fileName = rand() . time() . '.' . request()->stripe_icon->getClientOriginalExtension();
			request()->stripe_icon->move(public_path('upload/paymentgateway/'), $fileName);
			$stripe_icon = $fileName;
		} else {
			if ($id) {
				$dataObj = json_decode($gData->option_value);
				$stripe_icon = $dataObj->stripe_icon ?? '';
			} else {
				$stripe_icon = '';
			}
		}


		// $stripe_icon = $request->input('stripe_icon');

		if (isset($request->stripe_status)) {
			$stripe_status = $request->input('stripe_status');
		} else {
			$stripe_status = '0';
		}

		$paypal_client_id = $request->input('paypal_client_id');
		$paypal_secret_key = $request->input('paypal_secret_key');
		$paypal_currency = $request->input('paypal_currency');

		// if(isset($request->paypal_icon)){
		if ($request->hasFile('paypal_icon')) {
			$fileName = rand() . time() . '.' . request()->paypal_icon->getClientOriginalExtension();
			request()->paypal_icon->move(public_path('upload/paymentgateway/'), $fileName);
			$paypal_icon = $fileName;
		} else {
			if ($id) {
				$dataObj = json_decode($gData->option_value);
				$paypal_icon = $dataObj->paypal_icon ?? '';
			} else {
				$paypal_icon = '';
			}
		}

		// $paypal_icon = $request->input('paypal_icon');

		if (isset($request->sand_box_mode)) {
			$sand_box_mode = $request->input('sand_box_mode');
		} else {
			$sand_box_mode = '0';
		}

		if (isset($request->paypal_status)) {
			$paypal_status = $request->input('paypal_status');
		} else {
			$paypal_status = '0';
		}



		$option = array(
			'stripe_publice_key' => $stripe_publice_key ?? "",
			'stripe_secret_key' => $stripe_secret_key ?? "",
			'stripe_currency' => $stripe_currency ?? "",
			'stripe_icon' => $stripe_icon ?? "",
			'stripe_status' => $stripe_status ?? 0,

			'paypal_client_id' => $paypal_client_id ?? "",
			'paypal_secret_key' => $paypal_secret_key ?? "",
			'paypal_currency' => $paypal_currency ?? "",
			'paypal_icon' => $paypal_icon ?? "",
			'sand_box_mode' => $sand_box_mode ?? 0,
			'paypal_status' => $paypal_status ?? 0,

		);

		$data = array(
			'option_name' => 'payment_gateway',
			'option_value' => json_encode($option)
		);



		if ($id == '') {
			// dd($data);
			$response = Tp_option::create($data);
			if ($response) {
				return redirect()->back()->with('sucess', __('New Data Added Successfully'));
			} else {
				return redirect()->back()->with('error', __('Data insert failed'));
			}
		} else {
			$response = Tp_option::where('id', $id)->update($data);
			if ($response) {
				return redirect()->back()->with('sucess', __('Data Updated Successfully'));
			} else {
				return redirect()->back()->with('error', __('Data update failed'));
			}
		}

		// return response()->json($res);
	}

	function ThemeCustomCss()
	{

		$results = Tp_option::where('option_name', 'theme_custom_css')->first();
		if ($results) {
			$dataObj = json_decode($results->option_value);
			$data['custom_headre_css'] = $dataObj->custom_headre_css ?? '';
		} else {
			$data['custom_headre_css'] = "";
		}
		$dat_a['datalist'] = $data;
		return view('Backend.setting.appearance.theme-options-custom_css', $dat_a);
	}

	function SaveThemeCustomCss(Request $request)
	{
		try {
			$res = array();

			$custom_headre_css = $request->input('custom_headre_css');

			$option = array(
				'custom_headre_css' => $custom_headre_css,

			);

			$data = array(
				'option_name' => 'theme_custom_css',
				'option_value' => json_encode($option)
			);

			$gData = Tp_option::where('option_name', 'theme_custom_css')->get();
			// dd($data);
			$id = '';
			foreach ($gData as $row) {
				$id = $row['id'];
			}

			if ($id == '') {
				$response = Tp_option::create($data);
				if ($response) {
					$res['msgType'] = 'success';
					$res['msg'] = __('New Data Added Successfully');
				} else {
					$res['msgType'] = 'error';
					$res['msg'] = __('Data insert failed');
				}
			} else {
				$response = Tp_option::where('id', $id)->update($data);
				if ($response) {
					$res['msgType'] = 'success';
					$res['msg'] = __('Custom CSS Data Updated Successfully');
				} else {
					$res['msgType'] = 'error';
					$res['msg'] = __('Custom CSS Data update failed');
				}
			}

			return redirect()->back()->with($res['msgType'], $res['msg']);
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}
	}

	function ThemeCustomHtml()
	{

		$results = Tp_option::where('option_name', 'theme_custom_html')->first();
		if ($results) {
			$dataObj = json_decode($results->option_value);
			$data['custom_headre_html'] = $dataObj->custom_headre_html ?? '';
			$data['custom_body_html'] = $dataObj->custom_body_html ?? '';
			$data['custom_footer_html'] = $dataObj->custom_footer_html ?? '';
		} else {
			$data['custom_headre_html'] = "";
			$data['custom_body_html'] = "";
			$data['custom_footer_html'] = "";
		}
		$dat_a['datalist'] = $data;
		return view('Backend.setting.appearance.theme-options-custom_html', $dat_a);
	}

	function SaveThemeCustomHtml(Request $request)
	{
		try {
			$res = array();

			$custom_headre_html = $request->input('custom_headre_html');
			$custom_body_html = $request->input('custom_body_html');
			$custom_footer_html = $request->input('custom_footer_html');

			$option = array(
				'custom_headre_html' => $custom_headre_html,
				'custom_body_html' => $custom_body_html,
				'custom_footer_html' => $custom_footer_html,

			);

			$data = array(
				'option_name' => 'theme_custom_html',
				'option_value' => json_encode($option)
			);

			$gData = Tp_option::where('option_name', 'theme_custom_html')->get();

			$id = '';
			foreach ($gData as $row) {
				$id = $row['id'];
			}

			if ($id == '') {
				$response = Tp_option::create($data);
				if ($response) {
					$res['msgType'] = 'success';
					$res['msg'] = __('New Data Added Successfully');
				} else {
					$res['msgType'] = 'error';
					$res['msg'] = __('Data insert failed');
				}
			} else {
				$response = Tp_option::where('id', $id)->update($data);
				if ($response) {
					$res['msgType'] = 'success';
					$res['msg'] = __('Custom HTML Data Updated Successfully');
				} else {
					$res['msgType'] = 'error';
					$res['msg'] = __('Custom HTML Data update failed');
				}
			}

			return redirect()->back()->with($res['msgType'], $res['msg']);
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}
	}

	function ThemeCustomJs()
	{
		$results = Tp_option::where('option_name', 'theme_custom_js')->first();
		if ($results) {
			$dataObj = json_decode($results->option_value);
			$data['custom_head_js'] = $dataObj->custom_head_js ?? '';
			$data['custom_body_js'] = $dataObj->custom_body_js ?? '';
			$data['custom_footer_js'] = $dataObj->custom_footer_js ?? '';
		} else {
			$data['custom_head_js'] = "";
			$data['custom_body_js'] = "";
			$data['custom_footer_js'] = "";
		}
		$dat_a['datalist'] = $data;
		return view("Backend.setting.appearance.theme-options-custom_js", $dat_a);
	}
	function SaveThemeCustomJs(Request $request)
	{
		try {
			$res = array();

			$custom_head_js = $request->input('custom_head_js');
			$custom_body_js = $request->input('custom_body_js');
			$custom_footer_js = $request->input('custom_footer_js');

			$option = array(
				'custom_head_js' => $custom_head_js,
				'custom_body_js' => $custom_body_js,
				'custom_footer_js' => $custom_footer_js,

			);

			$data = array(
				'option_name' => 'theme_custom_js',
				'option_value' => json_encode($option)
			);

			$gData = Tp_option::where('option_name', 'theme_custom_js')->get();

			$id = '';
			foreach ($gData as $row) {
				$id = $row['id'];
			}

			if ($id == '') {
				$response = Tp_option::create($data);
				if ($response) {
					$res['msgType'] = 'success';
					$res['msg'] = __('New Data Added Successfully');
				} else {
					$res['msgType'] = 'error';
					$res['msg'] = __('Data insert failed');
				}
			} else {
				$response = Tp_option::where('id', $id)->update($data);
				if ($response) {
					$res['msgType'] = 'success';
					$res['msg'] = __('Custom JS Updated Successfully');
				} else {
					$res['msgType'] = 'error';
					$res['msg'] = __('Custom JS update failed');
				}
			}

			return redirect()->back()->with($res['msgType'], $res['msg']);
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}
	}
}
