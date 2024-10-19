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

        $data['exhibitors'] = University::whereIn('id', $exhibitor_ids)
            ->select('id', 'name', 'address', 'position_in_expo')
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($university) use ($expo_exhibitors) {
                $exhibitor_data = collect($expo_exhibitors)->firstWhere('exhibitor', $university->id);
                $university->show_on_home = $exhibitor_data['show_on_home'] ?? false;
                return $university;
            });

        $data['available_universities'] = $universities->whereNotIn('id', $exhibitor_ids)->sortByDesc('created_at');
        return view('Backend.events.expo.main.exhibitor.index', $data);
    }

    /**
     * edit exhibitor
     */
    public function exhibitor_edit($expo_id, $exhibitor_id)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('unique_id', 'exhibitors')->first();

        if (!$data['expo']) {
            return back()->with('error', 'Expo Not Found!');
        }

        $exhibitors = json_decode($data['expo']->exhibitors, true) ?? [];

        $exhibitor = null;
        foreach ($exhibitors as $exhibitorData) {
            if ($exhibitorData['exhibitor'] == $exhibitor_id) {
                $exhibitor = $exhibitorData;
                break;
            }
        }

        if (!$exhibitor) {
            return back()->with('error', 'Exhibitor Not Found!');
        }

        $data['exhibitor'] = $exhibitor;
        $data['university'] = University::select('id', 'name')->find($exhibitor_id);
        return view('Backend.events.expo.main.exhibitor.edit', $data);
    }

    /**
     * update exhibitor
     */
    public function exhibitor_update(Request $request, $expo_id, $exhibitor_id)
    {
        $exhibitor = University::select('exhibitor_desc')->find($exhibitor_id);

        if (!$exhibitor) {
            return back()->with('error', 'Exhibitor Not Found!');
        }

        $exhibitor->exhibitor_desc = $request->description;
        $exhibitor->save();

        return redirect(route('admin.expo.exhibitors.index', ['expo_id' => $expo_id]))->with('success', 'Exhibitor Description Has Been Updated!');
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
            $expo = Expo::where('unique_id', $expo_id)->first();
            $existing_exhibitors = json_decode($expo->exhibitors, true) ?? [];

            foreach ($request->university_id as $university_id) {
                $exists = false;
                foreach ($existing_exhibitors as $exhibitor) {
                    if ($exhibitor['exhibitor'] == $university_id) {
                        $exists = true;
                        break;
                    }
                }

                if (!$exists) {
                    $existing_exhibitors[] = [
                        'exhibitor' => $university_id,
                        'show_on_home' => false,
                    ];
                }
            }

            $expo->update(['exhibitors' => json_encode($existing_exhibitors)]);

            return back()->with('success', 'Selected universities have been marked as exhibitors!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * delete exhibitor
     */
    public function exhibitors_destroy(Request $request, $expo_id)
    {
        try {
            $expo = Expo::where('unique_id', $expo_id)->first();

            if (!$expo) {
                return back()->with('error', 'Expo not found!');
            }

            $exhibitors = json_decode($expo->exhibitors, true) ?? [];

            $updated_exhibitors = array_filter($exhibitors, function ($exhibitor) use ($request) {
                return $exhibitor['exhibitor'] != $request->exhibitor_id;
            });

            $expo->update(['exhibitors' => json_encode(array_values($updated_exhibitors))]);

            $university = University::find($request->exhibitor_id);
            if ($university) {
                $university->exhibitor_desc = null;
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
    public function exhibitors_toggle_show_in_expo($expo_id, $exhibitor_id)
    {
        $expo = Expo::where('unique_id', $expo_id)->first();

        if (!$expo) {
            return back()->with('error', 'Expo not found!');
        }

        $exhibitors = json_decode($expo->exhibitors, true) ?? [];

        $found = false;
        foreach ($exhibitors as &$exhibitor) {
            if ($exhibitor['exhibitor'] == $exhibitor_id) {
                $exhibitor['show_on_home'] = !$exhibitor['show_on_home'];
                $message = $exhibitor['show_on_home']
                    ? 'Exhibitor is now being shown in the expo.'
                    : 'Exhibitor is no longer being shown in the expo.';
                $found = true;
                break;
            }
        }

        if (!$found) {
            return back()->with('error', 'Exhibitor not found in the expo list!');
        }

        $expo->update(['exhibitors' => json_encode($exhibitors)]);
        return redirect()->back()->with('success', $message);
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
