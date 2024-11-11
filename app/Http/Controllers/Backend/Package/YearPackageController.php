<?php

namespace App\Http\Controllers\Backend\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessPackagesYear;
use Illuminate\Support\Facades\DB;

class YearPackageController extends Controller
{
     /**** Show All Brand ****/

     public function all_year_package(){

        $Year_packages = DB::table('business_packages_years')->orderBy('id', 'desc')->get();

        return view('Backend.BusinessPackages.YearBusinessPackages.All_Year_Package', compact('Year_packages'));
    }

   /***** Start Home Add Brand ******/

   public function add_year_package(Request $request){

    $request->validate([
        'name' => 'required',
        'text' => 'required',
        'price' => 'required',
        'item' => 'required'
    ]);

    $Year_packages = new BusinessPackagesYear();

    $Year_packages->name = $request->name;
    $Year_packages->text = $request->text;
    $Year_packages->price = $request->price;
    $Year_packages->item = $request->item;

    $Year_packages->save();

    return redirect()->route('admin.all_year_package');

    }

    /**** Edit Brand ****/
    public function edit_year_package($id){

        $Year_packages = BusinessPackagesYear::find($id);

        return view('Backend.BusinessPackages.YearBusinessPackages.Update_Year_Package', compact('Year_packages'));

    }

    /**** Update Brand ****/
    public function update_year_package(Request $request, $id){

        $request->validate([
        'name' => 'required',
        'text' => 'required',
        'price' => 'required',
        'item' => 'required',
         ]);

         $Year_packages = BusinessPackagesYear::find($id);

        $Year_packages->name = $request->name;
        $Year_packages->text = $request->text;
        $Year_packages->price = $request->price;
        $Year_packages->item = $request->item;
        $Year_packages->package_status = $request->package_status;
        $Year_packages->update();

        return redirect()->route('admin.all_year_package');
    }


    /******* Brand Delete  **********/

    public function delete_year_package(Request $request){

        $Year_packages = BusinessPackagesYear::find($request->year_pack_id);

        $Year_packages->delete();

        return redirect()->route('admin.all_year_package');
    }

    //Status section
    public function year_status_toggle($id)
    {
        $Year_packages = BusinessPackagesYear::find($id);
        if($Year_packages->package_status == 0)
        {
            $Year_packages->package_status = 1;
        }elseif($Year_packages->package_status == 1)
        {
            $Year_packages->package_status = 0;
        }
        $Year_packages->update();
        return redirect()->back()->with('success', 'Status Changed Successfully'); 
    }

}
