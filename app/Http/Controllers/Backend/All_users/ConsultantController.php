<?php

namespace App\Http\Controllers\Backend\All_users;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Mail\ConsultantFrogotPassword;
use App\Models\Country;
use App\Models\Level;
use App\Models\StudentApplication;
use Illuminate\Support\Facades\Hash;

class ConsultantController extends Controller
{
    public function index()
    {
        $consultants = User::where('type', '7')->orderBy('id', 'desc')->get();
        $continents = Continent::where('status', 1)->get();
    
        $partners = User::where('role', 'partner')->get()->map(function ($partner) {
            $total_students = User::where([
                ['partner_ref_id', '=', $partner->id],
                ['role', '=', 'student']
            ])->count();
    
            $total_applications = StudentApplication::where(function ($query) use ($partner) {
                $query->where('partner_ref_id', 'like', '%"partner":' . $partner->id . '%')
                      ->orWhere('partner_ref_id', 'like', '%"manager":' . $partner->id . '%')
                      ->orWhere('partner_ref_id', 'like', '%"support":' . $partner->id . '%');
            })->count();
    
            // Find the star value based on the total applications
            $star = Level::where('eligibility_range_min', '<=', $total_applications)
                         ->where('eligibility_range_max', '>=', $total_applications)
                         ->value('star_value');
    
            return [
                'partner' => $partner,
                'total_students' => $total_students,
                'total_applications' => $total_applications,
                'star' => $star,
            ];
        });
    
        return view("Backend.all_users.consultant.index", compact('consultants', 'continents', 'partners'));
    }
    
    

    

    function indexAjax(Request $request)
    {

        //return $request;
        $columns = array(
            0 => 'id',
            1 => 'image',
            2 => 'name',
            3 => 'continent',
            4 => 'mobile',
            5 => 'email',
            6 => 'status',
            7 => 'action',
        );

        $totalData = User::where('type', '7')->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        //====DataTale Default Filtering=====    
        if (empty($search)) {
            $users = User::where('type', '7')->offset($start);
            if (!empty($request->input('continent'))) {
                $users = $users->where('continent_id', $request->input('continent'));
            }
            if (!empty($request->input('country'))) {
                $users = $users->where('country', $request->input('country'));
            }
            $users = $users->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {

            $users = User::where('type', '7')->where(function ($q) use ($search) {
                $q->where("vendor_name", "LIKE", "%{$search}%");
            });
            if (!empty($request->input('continent'))) {
                $users = $users->where('continent_id', $request->input('continent'));
            }
            if (!empty($request->input('country'))) {
                $users = $users->where('country', $request->input('country'));
            }
            $totalFiltered = $users->count();
            $users = $users->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        }
        //======================

        $data = array();
        if (!empty($users)) {
            $i = $start == 0 ? 1 : $start + 1;
            foreach ($users as $user) {
                $nestedData['id'] = $i++;
                $nestedData['image'] = '<img src="' . $user->image_show . '" alt="" width="60px" height="40px" srcset="">';
                $nestedData['name'] = $user->name;
                $nestedData['continent'] = $user->continents?->name;

                $nestedData['mobile'] = $user->mobile;
                $nestedData['email'] = $user->email;
                if ($user->status == 0) {
                    $nestedData['status'] = '<a href="' . route('admin.consultant.status', $user->id) . '" class="btn btn-sm btn-warning">Inactive</a>';
                } else if ($user->status == 1) {
                    $nestedData['status'] = '<a href="' . route('admin.consultant.status', $user->id) . '" class="btn btn-sm btn-success">Active</a>';
                } else {
                    $nestedData['status'] = '--';
                }
                $nestedData['action'] = "";
                $nestedData['action'] .= '<a class="btn text-info" href="' . route('admin.consultant.edit', $user->id) . '"><i class="icon ion-compose tx-28"></i></a>';
                $nestedData['action'] .= '<button class="btn text-danger bg-white"  value="' . $user->id . '" id="dataDeleteModal"><i class="icon ion-trash-a tx-28"></i></button>';
                $nestedData['action'] .= '<button class="btn text-white bg-info changePass" value="' . $user->id . '">Change Password</button>';

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        return json_encode($json_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['continents'] = Continent::where('status', 1)->get();
        return view("Backend.all_users.consultant.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = new User;

            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->nid = $request->nid;
            $user->gender = $request->gender;
            $user->dob = $request->dob;

            $user->qualification = $request->qualification;
            $user->experience = $request->experience;
            $user->language = $request->language;
            $user->country = $request->country;

            $user->address = $request->address ?? "";
            $user->institution = $request->institution ?? "";
            $user->designation = $request->designation ?? "";
            $user->description = $request->description ?? "";
            $user->continent_id = $request->continent_id ?? "";
            $user->type = 7;
            $user->password = Hash::make(12345678);

            //Social Information
            $user->facebook_url = $request->facebook_url;
            $user->twitter_url = $request->twitter_url;
            $user->google_plus_url = $request->google_plus_url;
            $user->instagram_url = $request->instagram_url;

            if ($request->hasFile('image')) {
                $fileName = rand() . time() . '_consultant_image.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/users/'), $fileName);
                $user->image = $fileName;
            }

            $user->save();

            $send_mail = $request->email;
            $details['email'] =  $send_mail;
            $details['send_item'] = new ConsultantFrogotPassword($user);
            dispatch(new \App\Jobs\SendEmailJob($details));

            DB::commit();
            return redirect()->route('admin.consultant.index')->with('success', 'Partner Add Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
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
        $data["consultant"] = $consultant = User::find($id);
        $data['continents'] = Continent::where('status', 1)->get();
        $data['countries'] = Country::all();
        $data['levels'] = Level::all();
        return view("Backend.all_users.consultant.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);

            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->nid = $request->nid;
            $user->dob = $request->dob;

            $user->gender = $request->gender;
            $user->qualification = $request->qualification;
            $user->experience = $request->experience;
            $user->language = $request->language;
            $user->country = $request->country;
            $user->status = 1;

            $user->type = 7;
            $user->address = $request->address ?? "";
            $user->institution = $request->institution ?? "";
            $user->designation = $request->designation ?? "";
            $user->description = $request->description ?? "";
            // $user->continent_id = $request->continent_id ?? "";

            //Social Information
            $user->facebook_url = $request->facebook_url;
            $user->twitter_url = $request->twitter_url;
            $user->google_plus_url = $request->google_plus_url;
            $user->instagram_url = $request->instagram_url;
            // star 
            $user->star = $request->star;


            if ($request->hasFile('image')) {
                @unlink(public_path('upload/users/' . $user->image));
                $fileName = rand() . time() . '_consultant_image.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/users/'), $fileName);
                $user->image = $fileName;
            }
            $user->save();

            DB::commit();
            return redirect()->route('admin.consultant.index')->with('success', 'Partner Update Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $user =  User::find($request->consultant_id);
            @unlink(public_path('upload/users/' . $user->image));

            $user->delete();
            return back()->with('success', 'Partner Profile Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    function changePassword(Request $request)
    {
        try {
            $user =  User::find($request->user_id);
            $user->password = $request->password;
            $user->save();
            return redirect()->back()->with('success', 'Partner Profile Password Changed Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function consultantsForgetPasswordMail(Request $request, $id)
    {
        $data['user'] = $user = User::find($id);
        return view('user.consultants.consultants_forget_password', $data);
    }

    // public function resetForgotPasswordConsultants(Request $request, $id)
    // {

    //     $request->validate([
    //         'password' => 'required|min:8|confirmed',
    //     ]);
    //     $user = User::find($id);
    //     $user->password = $request->password;
    //     $user->update();
    //     return redirect('/sign-in')->with('success', 'Your password is updated, Thank You.');
    // }

    public function status($id)
    {
        try {
            $user = User::find($id);
            if ($user->status == 0) {
                $user->status = 1;
            } elseif ($user->status == 1) {
                $user->status = 0;
            }
            $user->update();
            return redirect()->route('admin.consultant.index')->with('success', 'Status change successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
}