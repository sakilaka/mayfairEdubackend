<?php

namespace App\Http\Controllers\Backend\Expo;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use App\Models\ExpoUser;
use App\Models\University;
use Illuminate\Http\Request;

class ExpoUserPanelController extends Controller
{
    public function dashboard()
    {
        $data['userData'] = auth()->guard('expo')->user();
        $data['expo'] = Expo::where('unique_id', $data['userData']['expo_id'])->select('unique_id', 'title', 'additional_contents', 'universities')->first();

        $data['exhibitors'] = [];
        foreach (json_decode($data['expo']->universities) ?? [] as $exhibitor_id) {
            $exhibitor = University::find($exhibitor_id);

            if ($exhibitor) {
                $data['exhibitors'][] = $exhibitor;
            }
        }

        $data['exhibitors'] = collect($data['exhibitors']);
        return view('Expo-User-Panel.index', $data);
    }

    public function index()
    {
        return redirect(route('user.dashboard'));
    }

    public function editUserInfo($id)
    {
        $data['userData'] = auth()->guard('expo')->user();
        $data['expo'] = Expo::where('unique_id', $data['userData']['expo_id'])->select('unique_id', 'title', 'additional_contents', 'universities')->first();

        return view('Expo-User-Panel.profile.profile_edit', $data);
    }

    public function updateUserInfo(Request $request, $id)
    {
        try {
            $expoModule = ExpoUser::findOrFail($id);

            $expoModule->id_type = $request->id_type;
            $expoModule->id_no = $request->id_no;
            $expoModule->first_name = $request->first_name;
            $expoModule->last_name = $request->last_name;
            $expoModule->email = $request->email;
            $expoModule->phone = $request->phone;
            $expoModule->nationality = $request->nationality;
            $expoModule->sex = $request->sex;
            $expoModule->dob = $request->dob;
            $expoModule->profession = $request->profession;
            $expoModule->institution = $request->institution;
            $expoModule->program = $request->program;
            $expoModule->degree = $request->degree;

            if ($request->hasFile('photo')) {
                $image = base64_encode(file_get_contents($request->file('photo')->path()));
                $expoModule->photo = 'data:' . $request->file('photo')->getMimeType() . ';base64,' . $image;
            }

            $expoModule->save();

            return back()->with(['success' => 'Expo data has been updated successfully!']);
        } catch (\Exception $e) {
            return back()->with(['error' => 'Something went wrong!']);
        }
    }


    public function my_tickets()
    {
        $data['userData'] = auth()->guard('expo')->user();
        $data['expo'] = Expo::where('unique_id', $data['userData']['expo_id'])->select('unique_id', 'title', 'additional_contents', 'universities')->first();

        return view('Expo-User-Panel.tickets', $data);
    }
}
