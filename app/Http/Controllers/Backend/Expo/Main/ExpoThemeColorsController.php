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
        return view('Backend.events.expo.main.join.index', $data);
    }

    /**
     * manage expo theme colors (update)
     */
    public function expo_theme_colors_update(Request $request, $expo_id)
    {
        
    }
}
