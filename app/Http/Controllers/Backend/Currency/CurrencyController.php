<?php

namespace App\Http\Controllers\Backend\Currency;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
	//Currency page load
	public function getCurrencyPageLoad()
	{

		$data['currencies'] = Currency::orderBy("id", "desc")->get();

		return view('Backend.currency.index', $data);
	}
	function getCurrencyTableData(Request $request)
	{
		return view('Backend.currency.create');
	}

	//Save data for Currency
	public function saveCurrencyData(Request $request)
	{
		try {
			$data = [
				'currency_name' => $request->currency_name,
				'currency_icon' => $request->currency_icon,
				'exchange_rate' => $request->exchange_rate,
				'is_default' => $request->is_default ?? 0,
			];

			Currency::create($data);

			return redirect()->route('admin.manage_currency')->with('success', 'Currency Created Successfully');
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}
	}

	public function editCurrency($id)
	{
		$data['currency'] = Currency::find($id);
		return view('Backend.currency.update', $data);
	}

	public function updateCurrency(Request $request, $id)
	{
		$currency = Currency::find($id);

		try {
			$data = [
				'currency_name' => $request->currency_name,
				'currency_icon' => $request->currency_icon,
				'exchange_rate' => $request->exchange_rate,
				'is_default' => $request->is_default ?? 0,
			];

			$currency->update($data);

			return redirect()->route('admin.manage_currency')->with('success', 'Currency Updated Successfully');
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Something Went Wrong!');
		}

		return redirect()->route('admin.manage_currency')->with('message', 'Currency Update Successfully, Thank you.');
	}

	//Get data for Label by id
	public function getCurrencyById(Request $request)
	{
		$data = Currency::where('id', $request->id)->first();
		return response()->json($data);
	}

	//Delete data for Labels
	public function deleteCurrency(Request $request)
	{
		$currency = Currency::find($request->currency_id);
		$currency->delete();

		return redirect()->back()->with('success', 'Currency Deleted Successfully');
	}

	//Bulk Action for Labels
	public function bulkActionCurrency(Request $request)
	{
		$res = array();

		$idsStr = $request->ids;
		$idsArray = explode(',', $idsStr);

		$BulkAction = $request->BulkAction;

		if ($BulkAction == 'delete') {
			$response = Currency::whereIn('id', $idsArray)->delete();
			if ($response) {
				$res['msgType'] = 'success';
				$res['msg'] = __('Data Removed Successfully');
			} else {
				$res['msgType'] = 'error';
				$res['msg'] = __('Data remove failed');
			}
		}

		return response()->json($res);
	}
}
