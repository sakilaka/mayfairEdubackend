<?php

namespace App\Http\Controllers\Backend\GetConsultation;

use App\Http\Controllers\Controller;
use App\Models\Continent;
use App\Models\Country;
use App\Models\GetConsultation;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class GetConsultationController extends Controller
{
    /**
     * Show get consultation form - web
     */
    public function get_consultation()
    {
        return view('Frontend.pages.get_consultation');
    }

    /**
     * Store get consultation form data - web
     */
    public function get_consultation_store(Request $request, $consultation_id = null)
    {
        try {
            if ($consultation_id) {
                $get_consultation = GetConsultation::find($consultation_id);
            } else {
                $get_consultation = new GetConsultation();
            }

            $get_consultation->name = $request->name;
            $get_consultation->phone = $request->phone;
            $get_consultation->email = $request->email;
            $get_consultation->major = $request->major;
            $get_consultation->degree = $request->degree;
            $get_consultation->result = $request->result;
            $get_consultation->status = $request->status ?? 'submitted';
            $get_consultation->note = $request->note ?? '';
            $get_consultation->save();

            if ($consultation_id) {
                $response = [
                    'success' => 'Consultation form has been updated!'
                ];
                return redirect(route(('admin.get_consultation.index')))->with($response);
            } else {
                $response = [
                    'success' => 'Free Consultation form has been submitted!',
                    'status' => 'submitted'
                ];
                return redirect()->back()->with($response);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * Show all consultation form data - admin
     */
    public function index(Request $request)
    {
        $query = GetConsultation::latest();

        if ($request->has('status') && $request->input('status') != '' && $request->input('status') != 'all') {
            $query->where('status', $request->input('status'));
        }

        $data['consultations'] = $query->get();

        $data['all_managers'] = User::where('role', 'manager')->orderBy('name', 'asc')->get();
        $data['all_supports'] = User::where('role', 'support')->orderBy('name', 'asc')->get();

        return view('Backend.get_consultation.index', $data);
    }

    /**
     * Edit consultation form - admin
     */
    public function edit($id)
    {
        $data['consultation'] = GetConsultation::find($id);
        return view('Backend.get_consultation.edit', $data);
    }

    /**
     * View consultation form data - admin
     */
    public function view($id)
    {
        $consultation = GetConsultation::find($id);
        return response([
            'consultation' => $consultation
        ]);
    }

    /**
     * Delete consultation form - admin
     */
    public function delete(Request $request)
    {
        $consultation = GetConsultation::find($request->consultation_id);

        if ($consultation) {
            $consultation->delete();
            return redirect()->back()->with('success', 'Consultation Form Has Been Deleted!');
        } else {
            return redirect()->back()->with('error', 'Consultation Form Not Found!');
        }
    }

    public function assignConsultationToEmployee(Request $request)
    {
        try {
            $consultation = GetConsultation::findOrFail($request->consultation_id);

            $managerId = isset($request->manager_id) ? (int) $request->manager_id : null;
            $supportId = isset($request->support_id) ? (int) $request->support_id : null;

            $newPartnerRefId = array_filter([
                'manager' => $managerId,
                'support' => $supportId,
            ]);

            $consultation->partner_ref_id = !empty($newPartnerRefId) ? json_encode($newPartnerRefId) : null;
            $consultation->save();

            foreach ($newPartnerRefId as $role => $id) {
                if ($id) {
                    $user = User::find($id);

                    if ($user) {
                        $notification = new Notification();
                        $notification->partner_id = $user->id;
                        $notification->user_id = $user->id;
                        $notification->text = 'Consultation for ' . '\'' . $consultation->name . '\'' . ' has been assigned to ' . ucwords($role) . ' - ' . $user->name;
                        $notification->save();
                    }
                }
            }

            return redirect()->back()->with('success', 'Consultation assigned to selected employees successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function fetchConsultationSupports($consultation_id)
    {
        try {
            $consultation = GetConsultation::findOrFail($consultation_id);
            $partner_ref_data = json_decode($consultation->partner_ref_id, true) ?? [];

            $manager_id = $partner_ref_data['manager'] ?? null;
            $support_id = $partner_ref_data['support'] ?? null;

            $getUserData = function ($user) {
                $countryName = null;
                $continentName = null;

                if ($user) {
                    if ($user->country_id) {
                        $countryId = (int) $user->country;
                        $countryName = Country::find($countryId)?->name;
                    }

                    if ($user->continent_id) {
                        $continentId = (int) $user->continent_id;
                        $continentName = Continent::find($continentId)?->name;
                    }
                }

                return $user ? [
                    'name' => $user->name,
                    'role' => ucwords(str_replace('_', ' ', $user->role)),
                    'address' => $user->address,
                    'country' => $countryName,
                    'continent' => $continentName,
                    'phone' => $user->mobile,
                    'email' => $user->email,
                    'photo' => $user->image_show,
                ] : null;
            };

            $managerData = $getUserData(User::find($manager_id));
            $supportData = $getUserData(User::find($support_id));

            return response()->json([
                'success' => true,
                'data' => [
                    'manager' => $managerData,
                    'support' => $supportData,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch consultation data.',
            ]);
        }
    }
}
