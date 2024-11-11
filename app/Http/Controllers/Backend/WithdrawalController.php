<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tp_option;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function manageWithdrawalRequest()
    {   
        $data['withdrawals'] = Withdrawal::orderBy('id', 'desc')->get();
        return view('Backend.withdrawal.index', $data);
    }
    public function editWithdrawalRequest($id)
    {   
        $data['withdrawal'] = Withdrawal::find($id);
        return view('Backend.withdrawal.update', $data);
    }
    public function updateWithdrawalRequest(Request $request, $id)
    {   
        $withdrawal = Withdrawal::find($id);
        $fee= \App\Models\Tp_option::where('option_name', 'commission')->first();
        if($fee->withdrawal_fee){
            $w_fee =$fee->withdrawal_fee;
            // dd($seller_percent);
        }
        if($request->status == 1){
            if($withdrawal->status != $request->status){
                $user =  $withdrawal->user;
                $user->current_balance = $user->current_balance - ($withdrawal->amount+ $w_fee);
                // $user->current_balance = $user->current_balance - ($withdrawal->amount+$withdrawal->fee);
                $user->save();
            }  
        }
        if($withdrawal->status == 1 && $request->status != 1){
            $user =  $withdrawal->user;
            $user->current_balance = $user->current_balance + ($withdrawal->amount+ $w_fee);
            $user->save();
        }
      
        $withdrawal->transaction_id = $request->transaction_id;
        $withdrawal->status = $request->status;
        $withdrawal->note = $request->note;
        $withdrawal->update();
        return redirect()->back()->with('message', 'Withdrawal Status Change Successfully, Thank You.');
    }



    public function manageCommission(Request $request)
    {
       // dd('hi');
        $data['commission'] = Tp_option::where('option_name', 'commission')->first();
        return view('Backend.setting.appearance.commission', $data);
    }
    public function setCommission(Request $request)
    {
        $commission = Tp_option::where('option_name', 'commission')->first();
        if($commission == null){
            $commission = new Tp_option();
        }

        //$commission = new Tp_option();
        $commission->seller_commission = $request->seller_commission;
        $commission->teacher_commission = $request->teacher_commission;
        $commission->withdrawal_fee = $request->withdrawal_fee;
        $commission->save();
        return redirect()->back()->with('message', 'Commission update successfully, Thank you.');
        
    }
}
