<?php

namespace App\Http\Controllers\Backend\Service;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function vendorList(){
        $data['vendors'] = User::where('type',7)->get();
       return view("Backend.vendor.vendor_list", $data);
    }
    public function vendorCreate()
    {
        return view('Backend.vendor.vendor_create');
    }
    public function vendorStore(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);
        $vendor = New User();
        $vendor->type = 7;
        $vendor->fname = $request->fname ?? '';
        $vendor->lname = $request->lname ?? '';
        $vendor->email = $request->email ?? '';
        $vendor->mobile = $request->mobile ?? '';
        $vendor->nid = $request->nid ?? '';
        $vendor->gender = $request->gender ?? '';
        $vendor->shop_name = $request->shop_name ?? '';
        $vendor->shop_address = $request->shop_address ?? '';
        $vendor->trade_licence_number = $request->trade_licence_number ?? '';
        $vendor->address = $request->address ?? '';
        $vendor->password = 12345678;

        if($request->hasFile('shop_image')){
            $fileName = rand().time().'_vendor.'.request()->image->getClientOriginalExtension();
            request()->shop_image->move(public_path('upload/users/'),$fileName);
            $vendor->shop_image = $fileName;
        }


        $vendor->save();
        return redirect()->back()->with('message','Vendor Created Successfully');
    }
    public function vendorEdit($id)
    {
        $data['vendor']= User::find($id);
        return view('Backend.vendor.vendor_update', $data);
    }
    public function vendorUpdate(Request $request, $id)
    {

        // $request->validate([
        //     'fname' => 'required',
        //     'lname' => 'required',
        //     'email' => 'required',
        //     'mobile' => 'required',
        // ]);
        $vendor = User::find($id);
        $vendor->type = 7;
        $vendor->fname = $request->fname ?? '';
        $vendor->lname = $request->lname ?? '';
        $vendor->email = $request->email ?? '';
        $vendor->mobile = $request->mobile ?? '';
        $vendor->nid = $request->nid ?? '';
        $vendor->gender = $request->gender ?? '';
        $vendor->dob = $request->dob ?? '';
        $vendor->shop_name = $request->shop_name ?? '';
        $vendor->shop_address = $request->shop_address ?? '';
        $vendor->trade_licence_number = $request->trade_licence_number ?? '';
        $vendor->address = $request->address ?? '';

        if($request->hasFile('shop_image')){
            @unlink(public_path('upload/users/'.$vendor->shop_image));
            $fileName = rand().time().'_vendor.'.request()->shop_image->getClientOriginalExtension();
            request()->shop_image->move(public_path('upload/users/'),$fileName);
            $vendor->shop_image = $fileName;
        }

        $vendor->update();
        return redirect()->route('admin.vendor_user.list')->with('message','Vendor Info Update Successfully');
    }
    public function vendorDestroy(Request $request)
    {
        $vendor = User::find($request->user_id);
        @unlink(public_path('upload/users/'.$vendor->shop_image));
        $vendor->delete();
        return redirect()->route('admin.vendor_user.list')->with('message', 'Vendor Delete Successfully, Thank You.');
    }

    public function changePassword(Request $request){
        $user =  User::find($request->user_id);
        // dd($request);
        $user->password = $request->password;
        $user->save();
        return redirect()->back()->with('message','Vendor Password Changed Successfully');
    }
}
