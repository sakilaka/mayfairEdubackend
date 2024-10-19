<?php

namespace App\Http\Controllers\Backend\Expo\Main;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use App\Models\University;
use Illuminate\Http\Request;

class ExpoMainExhibitorController extends Controller
{
    /**
     * index of exhibitors
     */
    public function exhibitors_index($expo_id)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('unique_id', 'title', 'exhibitors')->first();

        $universities = University::all();
        $expo_exhibitors = json_decode($data['expo']->exhibitors, true) ?? [];
        $exhibitor_ids = array_column($expo_exhibitors, 'exhibitor');

        $data['exhibitors'] = $universities->whereIn('id', $exhibitor_ids)->sortByDesc('created_at');
        $data['available_universities'] = $universities->whereNotIn('id', $exhibitor_ids)->sortByDesc('created_at');

        return view('Backend.events.expo.main.exhibitor.index', $data);
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

        return view('Backend.events.expo.main.exhibitor.edit', $data);
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

        $exhibitor->exhibitor_desc = $request->description;
        $exhibitor->save();

        return redirect(route('admin.expo.exhibitors.index'))->with('success', 'Exhibitor Description Has Been Updated!');
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
    public function exhibitors_store(Request $request, $expo_id)
    {
        try {
            $expo = Expo::where('unique_id', $expo_id)->select('unique_id', 'exhibitors')->first();

            $exhibitors = [];

            foreach ($request->university_id as $university_id) {
                $exhibitors[] = [
                    'exhibitor' => $university_id,
                    'show_on_home' => false,
                ];
            }

            $expo->exhibitors = json_encode($exhibitors);
            return $expo;
            $expo->save();

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
