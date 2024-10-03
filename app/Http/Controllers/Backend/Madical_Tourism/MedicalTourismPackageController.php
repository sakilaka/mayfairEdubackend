<?php

namespace App\Http\Controllers\Backend\Madical_Tourism;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Continent;
use App\Models\Country;
use App\Models\Package;
use App\Models\PackageDetails;
use App\Models\PackageTagLine;
use App\Models\State;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class MedicalTourismPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['packages'] = Package::where('type', 1)->get();
        return view('Backend.medical_tourism.package.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['continents'] = Continent::all();
        return view('Backend.medical_tourism.package.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $package = new Package();

        $package->continent_id = $request->continent_id ?? 0;
        $package->country_id = $request->country_id ?? 0;
        $package->state_id = $request->state_id ?? 0;
        $package->city_id = $request->city_id ?? 0;

        $package->name = $request->name ?? '';
        $package->slug = SlugService::createSlug(Package::class, 'slug', $request->name);
        $package->price = $request->price ?? 0;
        $package->discount = $request->discount ?? 0;
        $package->shortdetail = $request->shortdetail;
        $package->type = 1;


        if($request->hasFile('image')){
            // @unlink(public_path("upload/package/".$package->image));
            $fileName = rand().time().'_tourism_package.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/package/'),$fileName);
            $package->image = $fileName;
        }
        // dd($package);
        $package->save();
        if($request->tagline){
            $tagline_image=[];
            if($request->tagline_image){
                foreach($request->file('tagline_image') as $k=>$image){
                    $filename=time().$k.'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('upload/package/'), $filename);
                    $tagline_image[]=$filename;
                }
            }

            foreach($request->tagline as $k=>$line){
                $packagetagline= New PackageTagLine();
                $packagetagline->package_id=$package->id;
                $packagetagline->title = $line;
                $packagetagline->icon=@$tagline_image[$k];
                $packagetagline->save();
                foreach($request->details[$k] as $detail){
                    $packagedetails= New PackageDetails;
                    $packagedetails->packagetagline_id = $packagetagline->id;
                    $packagedetails->package_id = $package->id;
                    $packagedetails->text=$detail;
                    // dd($packagedetails);
                    $packagedetails->save();
                }
            }
        }



        return redirect()->back()->with('message','Package Create Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $data['package'] = $package = Package::find($id);
       $data['continents'] = Continent::all();
       $data['cities'] = City::where('state_id', $package->state->id)->get();
       $data['states'] = State::where('country_id', $package->country->id)->get();
       $data['countries'] = Country::where('continent_id', $package->continent->id)->get();
       $data["package"]=$package;

        return view('Backend.medical_tourism.package.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $package = Package::find($id);

        $package->continent_id = $request->continent_id;
        $package->country_id = $request->country_id;
        $package->state_id = $request->state_id;
        $package->city_id = $request->city_id;

        $package->name = $request->name;
        $package->slug = SlugService::createSlug(Package::class, 'slug', $request->name);
        $package->price = $request->price;
        $package->discount = $request->discount;
        $package->shortdetail = $request->shortdetail;
        $package->type = 1;


        if($request->hasFile('image')){
            @unlink(public_path("upload/package/".$package->image));
            $fileName = rand().time().'_tourism_package.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/package/'),$fileName);
            $package->image = $fileName;
        }
        // dd($package);
        $package->save();
        if($request->tagline){
            $tagline_image=[];
            if($request->tagline_image){
                foreach($request->file('tagline_image') as $k=>$image){
                    $filename=time().$k.'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('upload/package/'), $filename);
                    $tagline_image[]=$filename;
                }
            }
            if($request->tagline){
                foreach($request->tagline as $k=>$line){
                    $packagetagline= New PackageTagLine;
                    $packagetagline->package_id=$package->id;
                    $packagetagline->title = $line;

                    $packagetagline->icon=$tagline_image[$k];
                    $packagetagline->save();
                    if(isset($request->details[$k])){
                        foreach($request->details[$k] as $detail){
                            $packagedetails= New PackageDetails;
                            $packagedetails->packagetagline_id=$packagetagline->id;
                            $packagedetails->package_id = $package->id;
                            $packagedetails->text=$detail;
                            $packagedetails->save();
                        }
                    }
                }
            }
        }
        if($request->old_tagline){
            foreach($request->old_tagline as $k=>$line){
                $packagetagline=  PackageTagLine::find($k);
                $packagetagline->package_id=$package->id;
                $packagetagline->title = $line;
                if(isset($request->file('old_tagline_image')[$k])){
                    @unlink(public_path('upload/package/'.$packagetagline->icon));
                    $filename=time().$k.'.'.$request->file('old_tagline_image')[$k]->getClientOriginalExtension();
                    $request->file('old_tagline_image')[$k]->move(public_path('upload/package/'), $filename);
                    $packagetagline->icon==$filename;
                }
                $packagetagline->save();
                if(isset($request->old_details[$k])){
                    foreach($request->old_details[$k] as $j=>$detail){
                        $packagedetails=  PackageDetails::find($j);
                        $packagedetails->packagetagline_id=$packagetagline->id;
                        $packagedetails->package_id = $package->id;
                        $packagedetails->text=$detail;
                        $packagedetails->save();
                    }
                }
                if(isset($request->details[$k])){
                    foreach($request->details[$k] as $detail){
                        $packagedetails= New PackageDetails;
                        $packagedetails->packagetagline_id=$packagetagline->id;
                        $packagedetails->package_id = $package->id;
                        $packagedetails->text=$detail;
                        // dd($packagedetails);
                        $packagedetails->save();
                    }
                }

            }
        }
        //dd($request->all());
        if($request->delete_details){
            foreach($request->delete_details as $detail){
                $packagedetails= PackageDetails::find($detail);
                $packagedetails->delete();
            }
        }
        if($request->delete_tagline){
            foreach($request->delete_tagline as $val){
                $packagetagline=  PackageTagLine::find($val);
                @unlink(public_path('upload/package/'.$packagetagline->icon));
                foreach($packagetagline->details as $detail){

                    $detail->delete();
                }
                $packagetagline->delete();
            }
        }

        return redirect()->back()->with('message','Package Delete Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(Request $request)
    {
        $package= Package::find($request->package_id);
        $path = public_path("upload/package/".$package->image);
        @unlink($path);
        foreach($package->packageitems as $packageitem)
        {
            $packageitem->delete();
        }
        $package->delete();
        return redirect()->back()->with('message', 'Package Delete Successfully.');
    }


    public function status_toggle($id)
    {
        $package = Package::find($id);
        if($package->status == 0)
        {
            $package->status = 1;
        }elseif($package->status == 1)
        {
            $package->status = 0;
        }
        $package->update();
        return redirect()->back();
    }

}
