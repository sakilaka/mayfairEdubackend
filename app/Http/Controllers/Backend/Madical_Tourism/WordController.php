<?php

namespace App\Http\Controllers\Backend\Madical_Tourism;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Continent;
use App\Models\Country;
use App\Models\State;
use App\Models\Thana;
use App\Models\Union;
use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['words'] = Word::all();
        return view('Backend.medical_tourism.word.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $data['continents'] = Continent::all();
        $data['countries'] = Country::all();
        $data['states'] = State::all();
        return view('Backend.medical_tourism.word.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $word = new Word();
        $word->continent_id = $request->continent_id;
        $word->country_id = $request->country_id;
        $word->state_id = $request->state_id;
        $word->city_id = $request->city_id;
        $word->thana_id = $request->thana_id;
        $word->union_id = $request->union_id;
        $word->name = $request->name;
        if($request->hasFile('image')){
            $fileName = rand().time().'_word_image.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/words/'),$fileName);
            $word->image = $fileName;
        }
        $word->save();
        return redirect()->back()->with('message', 'Word Create Successfully, Thank You.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        $data['word'] = $word = Word::find($id);

        $data['continents'] = Continent::all();
        $data['unions'] = Union::where('thana_id', $word->thana->id)->get();
        $data['thanas'] = Thana::where('city_id', $word->city->id)->get();
        $data['cities'] = City::where('state_id', $word->state->id)->get();
        $data['states'] = State::where('country_id', $word->country->id)->get();
        $data['countries'] = Country::where('continent_id', $word->continent->id)->get();


        return view('Backend.medical_tourism.word.update', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $word = Word::find($id);
        $word->continent_id = $request->continent_id;
        $word->country_id = $request->country_id;
        $word->state_id = $request->state_id;
        $word->city_id = $request->city_id;
        $word->thana_id = $request->thana_id;
        $word->union_id = $request->union_id;
        $word->name = $request->name;
        if($request->hasFile('image')){
            @unlink(public_path('upload/words/'.$word->image));
            $fileName = rand().time().'_word_image.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/words/'),$fileName);
            $word->image = $fileName;
        }
        $word->update();
        return redirect()->route('word.index')->with('message', 'Word Update Successfully, Thank You.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $word = Word::find($request->word_id);
        @unlink(public_path('upload/words/'.$word->image));
        $word->delete();
        return back()->with('message','Word Deleted Successfully');
    }

    public function status_toggle($id)
    {
        $word = Word::find($id);
        if($word->status == 0)
        {
            $word->status = 1;
        }elseif($word->status == 1)
        {
            $word->status = 0;
        }
        $word->update();
        return redirect()->back()->with('message', 'Status updated');
    }
}
