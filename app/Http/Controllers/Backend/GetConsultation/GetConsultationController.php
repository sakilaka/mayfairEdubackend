<?php

namespace App\Http\Controllers\Backend\GetConsultation;

use App\Http\Controllers\Controller;
use App\Models\GetConsultation;
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
        return $request->all();
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

        // Apply filters if present
        if ($request->has('status') && $request->input('status') != '' && $request->input('status') != 'all') {
            $query->where('status', $request->input('status'));
        }

        $data['consultations'] = $query->get();
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
}
