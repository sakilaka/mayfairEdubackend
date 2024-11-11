<?php

namespace App\Http\Controllers\Backend\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Testimonial;

class ReviewController extends Controller
{

    public function courseReviewStore(Request $request)
    {
        $request->validate([
            'ratting' => 'required',
            'comment' => 'required',
        ]);

        $review = new Review();
        $review->ratting = $request->ratting;
        $review->course_id = $request->course_id ?? 0;
        $review->ebook_id = $request->ebook_id ?? 0;
        $review->university_id = $request->university_id ?? 0;
        $review->comment = $request->comment;
        $review->type = $request->type;
        $review->user_id = auth()->user()->id;
        $review->save();
        return redirect()->back()->with('success', 'Review Added Successfully');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['reviews'] = Review::orderBy('id', 'desc')->get();
        return view("Backend.review.index", $data);
    }


    public function indexPharmacy()
    {
        $data['reviews'] = Review::where('vendor_type', 7)->orderBy('id', 'desc')->get();
        return view("Backend.pharmacy.review", $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.home.partner.create");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $review = Review::find($request->review_id);
            $review->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function editReview($id)
    {
        $data['review'] = Review::find($id);
        return view('Backend.review.update', $data);
    }

    public function updateReview(Request $request, $id)
    {
        try {
            $review = Review::find($id);
            $review->user_id = $request->user_id;
            // $review->course_id = $request->course_id ?? '';
            // $review->ebook_id = $request->ebook_id ?? '';
            $review->ratting = $request->ratting;
            $review->comment = $request->comment;
            $review->type = $request->type;
            $review->save();
            return redirect()->route('admin.review.index')->with('success', 'Review Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
