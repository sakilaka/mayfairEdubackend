<?php

namespace App\Http\Controllers\Backend\Hr_management\Bank;
use App\Http\Controllers\Controller;
use App\Models\Hrbank;
use App\Models\Hrbankbranch;
use Illuminate\Http\Request;

class HrbankController extends Controller
{

    public function home()
    {
        $bank=Hrbank::latest()->where('bank_type', 'offline')->get();
        return view('Backend.Hr_management.Bank.Bank',compact('bank'));
    }
    public function mobile_bank()
    {
        $bank=Hrbank::latest()->where('bank_type', 'mobile')->get();
        return view('Backend.Hr_management.Bank.Mobile_bank',compact('bank'));
    }
    public function internet_bank()
    {
        $bank=Hrbank::latest()->where('bank_type', 'internet')->get();
        return view('Backend.Hr_management.Bank.Internet_bank',compact('bank'));
    }

    public function branch()
    {
        $banks=Hrbank::latest()->where('bank_type', 'offline')->get();
        $bank=Hrbankbranch::latest()->get();

        return view('Backend.Hr_management.Bank.branch',compact('bank','banks'));
    }

    public function add_bank(Request $request)
    {
        $request->validate([
            'bank_name' => 'required',
            'bank_type' => 'required'
        ]);
        $bank = new Hrbank();
        $bank->bank_name = $request->bank_name;
        $bank->bank_type = $request->bank_type;
        $bank->save();
        return redirect()->back()->with('success', 'Add Success');
    }
    public function add_branch(Request $request)
    {
        $request->validate([
            'bank_id' => 'required',
            'bank_branch' => 'required'
        ]);
        $bank = new Hrbankbranch();
        $bank->hrbank_id = $request->bank_id;
        $bank->branch = $request->bank_branch;
        $bank->save();
        return redirect()->back()->with('success', 'Add Success');
    }

    public function edit_bank($id)
    {
        $bank = Hrbank::find($id);
        return view('Backend.Hr_management.Bank.Update_bank', compact('bank'));
    }
    public function edit_branch($id)
    {
        $banks=Hrbank::latest()->where('bank_type', 'offline')->get();
        $bank = Hrbankbranch::find($id);
        return view('Backend.Hr_management.Bank.Update_branch', compact('bank','banks'));
    }

    public function update_bank(Request $request)
    {
        $request->validate([
            'bank_id' => 'required',
            'bank_type' => 'required',
            'bank_name' => 'required',
        ]);

        $bank = Hrbank::find($request->bank_id);
        $bank->bank_name = $request->bank_name;
        $bank->update();
        if($request->bank_type == 'mobile'){
            return redirect()->route('admin.bank.mobile_bank')->with('success', 'Update Success');
        }elseif($request->bank_type == 'offline'){
        return redirect()->route('admin.bank.home')->with('success', 'Update Success');
        }elseif($request->bank_type == 'internet'){
            return redirect()->route('admin.bank.internet_bank')->with('success', 'Update Success');
            }
    }


    public function update_branch(Request $request)
    {
        $request->validate([
            'bank_id' => 'required',
            'branch_id' => 'required',
            'branch_name' => 'required',
        ]);

        $bank = Hrbankbranch::find($request->branch_id);

        $bank->hrbank_id = $request->bank_id;
        $bank->branch = $request->branch_name;
        $bank->update();
            return redirect()->route('admin.bank.branch')->with('success', 'Update Success');

    }

    public function delete_bank($id)
    {
        $brand = Hrbank::find($id);
        $brand->delete();
        return redirect()->back()->with('success', 'Delete Success');
    }
    public function delete_branch($id)
    {
        $branch = Hrbankbranch::find($id);
        $branch->delete();
        return redirect()->back()->with('success', 'Delete Success');
    }
}
