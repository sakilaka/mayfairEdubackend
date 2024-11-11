<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\PayWith;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    function getSiteSetting(Request $request) {
        $data['site_setting'] = SiteSetting::FirstorNew();
        $data['paywiths'] = PayWith::where('id','desc')->get();
        return view("Backend.setting.about_company", $data);
    }
    function setSiteSetting(Request $request) {
        $site_setting = SiteSetting::first();
        if($site_setting == null){
            $site_setting = New SiteSetting;
        }
        $site_setting->company_name=$request->company_name;
        $site_setting->right_text=$request->right_text;

        $site_setting->address_title1=$request->address_title1;
        $site_setting->address_title2=$request->address_title2;

        $site_setting->address1=$request->address1;
        $site_setting->address2=$request->address2;
        $site_setting->email1=$request->email1;
        $site_setting->email2=$request->email2;
        $site_setting->license_no=$request->license_no;
        $site_setting->web_title=$request->web_title;
        $site_setting->phone1=$request->phone1;
        $site_setting->phone2=$request->phone2;

        $site_setting->facebook="https://" . preg_replace('#^https?://#', '',$request->facebook);
        $site_setting->twitter="https://" . preg_replace('#^https?://#', '',$request->twitter);
        $site_setting->instagram="https://" . preg_replace('#^https?://#', '',$request->instagram);
        $site_setting->youtube="https://" . preg_replace('#^https?://#', '',$request->youtube);
        $site_setting->payment_title=$request->payment_title;
        $site_setting->design_link_text=$request->design_link_text;
        $site_setting->design_by_text=$request->design_by_text;
        if($request->hasFile('header_logo')){
            @unlink(public_path('upload/site_setting/'.$site_setting->header_image));
            $fileName = time().'_header-logo.'.$request->header_logo->getClientOriginalExtension();
            $request->header_logo->move(public_path('upload/site_setting'), $fileName);

            $site_setting->header_image =$fileName;
        }
        if($request->hasFile('footer_logo')){
            @unlink(public_path('upload/site_setting/'.$site_setting->footer_image));
            $fileName = time().'_footer-logo.'.$request->footer_logo->getClientOriginalExtension();
            $request->footer_logo->move(public_path('upload/site_setting'), $fileName);

            $site_setting->footer_image =$fileName;
        }
        if($request->hasFile('favicon')){
            @unlink(public_path('upload/site_setting/'.$site_setting->favicon));
            $fileName = time().'_favicon.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('upload/site_setting'), $fileName);

            $site_setting->favicon =$fileName;
        }
        if($request->hasFile('payment_image')){
            @unlink(public_path('upload/site_setting/'.$site_setting->payment_image));
            $fileName = time().'_payment_image.'.$request->payment_image->getClientOriginalExtension();
            $request->payment_image->move(public_path('upload/site_setting'), $fileName);

            $site_setting->payment_image =$fileName;
        }
        $site_setting->save();

//dd($request->pay_image);
            // pay With start

            if($request->pay_name){
                $pay_image=[];
                foreach($request->file('pay_image') as $k=>$image){
                    $filename=time().$k.'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('upload/pay_image/'), $filename);
                    $pay_image[]=$filename;
                }
                foreach( $request->pay_name as $k=>$value){
                    $paywith = new PayWith();
                    $paywith->sitesetting_id = $site_setting->id;
                    $paywith->pay_name = $value;
                    $paywith->pay_image =$pay_image[$k];
                    $paywith->save();
                }
            }

            if($request->old_pay_name){
                foreach($request->old_pay_name as $k => $value){
                    $paywith = PayWith::find($k);
                    $paywith->sitesetting_id = $site_setting->id;
                    $paywith->pay_name = $value;

                    if(isset($request->file('old_pay_image')[$k])){
                        @unlink(public_path('upload/pay_image/'.$paywith->pay_image));
                        $filename=time().$k.'.'.$request->file('old_pay_image')[$k]->getClientOriginalExtension();
                        $request->file('old_pay_image')[$k]->move(public_path('upload/pay_image/'), $filename);
                        $paywith->pay_image=$filename;
                    }
                    // $paywith->pay_image = $request->old_pay_image[$k];
                    $paywith->save();
                }
            }

            if($request->delete_facilitiyitem){
                foreach($request->delete_facilitiyitem as $key => $value){
                    $facility = PayWith::find($value);
                    $facility->delete();

                }
            }
        // pay With  End



        return back()->with("success", "Update Successfully!");
    }
}
