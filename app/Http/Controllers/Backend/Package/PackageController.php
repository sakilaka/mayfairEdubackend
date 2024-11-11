<?php

namespace App\Http\Controllers\Backend\Package;

use App\Http\Controllers\Controller;
use App\Models\BusinessPackages;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Package;
use App\Models\Category;
use App\Models\PackageDetails;
use App\Models\PackageOption;
use App\Models\PackageTagLine;

class PackageController extends Controller
{
    public function all_package(){

        $packages = BusinessPackages::orderBy('id', 'desc')->get();

        return view('Backend.BusinessPackages.Package.All_Package', compact('packages'));
    }

   /***** Start Home Add Brand ******/

   public function add_package(Request $request){

    $request->validate([
        'name' => 'required',
        'text' => 'required',
        // 'price' => 'required',
        // 'item' => 'required'
    ]);
// dd($request);
    $package = new BusinessPackages();

    $package->name = $request->name;
    $package->text = $request->text;
    $package->price = $request->price;
    $package->discount = $request->discount;
    $package->package_type = $request->package_type;

    $package->save();

    foreach($request->package_option as $option){
        $package_option =New PackageOption;
        $package_option->package_id=$package->id;
        $package_option->title=$option;
        $package_option->save();

    }

    return redirect()->route('admin.all_package');

    }

    /**** Edit Brand ****/
    public function edit_package($id){

        $packages = BusinessPackages::find($id);

        return view('Backend.BusinessPackages.Package.Update_Package', compact('packages'));

    }

    /**** Update Brand ****/
    public function update_package(Request $request, $id){

        $request->validate([
        'name' => 'required',
        'text' => 'required',
        // 'price' => 'required',
        // 'item' => 'required',
         ]);

         $packages = BusinessPackages::find($id);

        $packages->name = $request->name;
        $packages->text = $request->text;
        $packages->price = $request->price;
        $packages->discount = $request->discount;
        $packages->item = $request->item;
        $packages->package_status = $request->package_status;
        $packages->package_type = $request->package_type;
        $packages->update();

        foreach($packages->options as $option){
            $option->delete();
        }

        foreach($request->package_option as $option){
            $package_option =New PackageOption();
            $package_option->package_id=$packages->id;
            $package_option->title=$option;
            $package_option->save();

        }

        return redirect()->route('admin.all_package');
    }


    /******* Brand Delete  **********/

    public function delete_package(Request $request){

        $packages = BusinessPackages::find($request->package_id_delete);

        $packages->delete();

        return redirect()->route('admin.all_package');
    }

     //Status section
     public function package_status_toggle($id)
     {
         $packages = BusinessPackages::find($id);
         if($packages->package_status == 0)
         {
             $packages->package_status = 1;
         }elseif($packages->package_status == 1)
         {
             $packages->package_status = 0;
         }
         $packages->update();
         return redirect()->back()->with('success', 'Status Changed Successfully');
     }
}
