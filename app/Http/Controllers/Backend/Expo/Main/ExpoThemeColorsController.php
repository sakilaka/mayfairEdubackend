<?php

namespace App\Http\Controllers\Backend\Expo\Main;

use App\Http\Controllers\Controller;
use App\Models\Expo;
use Illuminate\Http\Request;

class ExpoThemeColorsController extends Controller
{
    /**
     * manage expo theme colors -> index - page
     */
    public function expo_theme_colors($expo_id)
    {
        $data['expo'] = Expo::where('unique_id', $expo_id)->select('unique_id', 'title', 'theme_colors')->first();
        return view('Backend.events.expo.main.theme_colors.index', $data);
    }

    /**
     * manage expo theme colors (update)
     */
    public function expo_theme_colors_update(Request $request, $expo_id)
    {
        $expo = Expo::where('unique_id', $expo_id)->first();

        if (!$expo) {
            redirect(route('admin.expo.index'))->with('error', 'Something Wrong With Expo');
        }

        try {
            $expo->update([
                'theme_colors' => json_encode($request->except('_token'))
            ]);

            return redirect()->back()->with('success', 'Theme colors has been updated for expo - ' . $expo->title);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
