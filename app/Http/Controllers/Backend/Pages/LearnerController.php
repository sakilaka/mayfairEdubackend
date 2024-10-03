<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\learnerPageSetup;

class LearnerController extends Controller
{
    public function learnerPage()
    {
        $data['learner'] = learnerPageSetup::first();
        return view('Backend.setting.page.learner', $data);
    }

    public function learnerPageSetup(Request $request)
    {
        try {
            $learner = learnerPageSetup::first();
            if ($learner == null) {
                $learner = new learnerPageSetup();
            }

            $learner->top_title = $request->top_title;
            $learner->description1 = $request->description1;
            $learner->button1 = $request->button1;

            $learner->tleftcontent = $request->tleftcontent;
            $learner->tmiddlecontent = $request->tmiddlecontent;
            $learner->trightcontent = $request->trightcontent;
            $learner->bleftcontent = $request->bleftcontent;
            $learner->bmiddlecontent = $request->bmiddlecontent;
            $learner->brightcontent = $request->brightcontent;

            $learner->tlefttext = $request->tlefttext;
            $learner->trighttext = $request->trighttext;
            $learner->middletext = $request->middletext;
            $learner->blefttext = $request->blefttext;
            $learner->brighttext = $request->brighttext;

            if ($request->hasFile('image1')) {
                @unlink(public_path('upload/learner/' . $learner->image1));
                $fileName = time() . '_image.' . $request->image1->getClientOriginalExtension();
                $request->image1->move(public_path('upload/learner'), $fileName);
                $learner->image1 = $fileName;
            }
            $learner->save();

            return back()->with("success", "Updated Successfully!");
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
}
