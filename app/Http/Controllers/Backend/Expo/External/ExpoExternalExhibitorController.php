<?php

namespace App\Http\Controllers\Backend\Expo\External;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class ExpoExternalExhibitorController extends Controller
{
    /**
     * index of exhibitors
     */
    public function exhibitors_index()
    {
        $universities = University::all();

        $data['available_universities'] = $universities->where('is_exhibitor', false)->sortByDesc('created_at');
        $data['exhibitors'] = $universities->where('is_exhibitor', true)->sortByDesc('created_at');

        return view('Backend.events.expo.external.exhibitor.index', $data);
    }

    /**
     * edit exhibitor
     */
    public function exhibitor_edit($exhibitor_id)
    {
        $data['exhibitor'] = University::find($exhibitor_id);

        if (!$data['exhibitor']) {
            return back()->with('error', 'Exhibitor Not Found!');
        }

        return view('Backend.events.expo.external.exhibitor.edit', $data);
    }

    /**
     * update exhibitor
     */
    public function exhibitor_update(Request $request, $exhibitor_id)
    {
        $exhibitor = University::find($exhibitor_id);

        if (!$exhibitor) {
            return back()->with('error', 'Exhibitor Not Found!');
        }

        $exhibitor->exhibitor_site_desc = $request->description;
        $exhibitor->save();

        return redirect(route('admin.expo-site.exhibitors.index'))->with('success', 'Exhibitor Description Has Been Updated!');
    }

    /**
     * exhibitor details
     */
    public function exhibitor_details($exhibitor_id)
    {
        $data['exhibitor'] = University::find($exhibitor_id);

        if (!$data['exhibitor']) {
            return back()->with('error', 'Exhibitor Not Found!');
        }

        return view('Frontend.pages.exhibitor_details', $data);
    }

    /**
     * add exhibitor
     */
    public function exhibitors_store(Request $request)
    {
        try {
            foreach ($request->university_id as $university_id) {
                $university = University::find($university_id);

                if ($university) {
                    $university->is_exhibitor = true;
                    $university->save();
                }
            }

            return back()->with('success', 'Selected universities have been marked as exhibitors!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * delete exhibitor
     */
    public function exhibitors_destroy(Request $request)
    {
        try {
            $university = University::find($request->exhibitor_id);

            if ($university) {
                $university->is_exhibitor = null;
                $university->save();

                return back()->with('success', $university->name . ' has been removed from exhibitors list!');
            } else {
                return back()->with('error', 'University not found!');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * toggle show in expo
     */
    public function exhibitors_toggle_show_in_expo($exhibitor_id)
    {
        $exhibitor = University::find($exhibitor_id);

        if ($exhibitor) {
            $current_status = $exhibitor->show_in_expo;

            if ($current_status != 1) {
                $exhibitor->show_in_expo = 1;
                $message = $exhibitor->name . ' is now being shown in the expo.';
            } else {
                $exhibitor->show_in_expo = 0;
                $message = $exhibitor->name . ' is no longer being shown in the expo.';
            }

            $exhibitor->save();

            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'Exhibitor not found or something went wrong!');
        }
    }

    /**
     * change exhibitor position in expo
     */
    public function exhibitors_postion_in_expo(Request $request)
    {
        try {
            $exhibitor = University::where(['id' => $request->exhibitor_id, 'is_exhibitor' => true])->first();
            $exhibitor->position_in_expo = $request->current_position;
            $exhibitor->save();

            return redirect()->back()->with('success', 'Exhibitor position has changed!');
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Something Went Wrong!');
        }
    }
}
