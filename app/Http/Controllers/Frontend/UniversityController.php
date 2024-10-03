<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AskQuestion;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\City;
use App\Models\Country;
use App\Models\University;
use Illuminate\Http\Request;

use App\Models\Continent;
use App\Models\Course;
use App\Models\Department;
use App\Models\Review;
use App\Models\Scholarship;
use App\Models\State;
use App\Models\User;

class UniversityController extends Controller
{
    public function index()
    {
        $data['continents'] = Continent::withCount('universities')->where('status', 1)->get();
        $univerties = University::where('status', 1);

        if (request()->onsearch_val == false) {
            if (request()->input('search_val')) {
                $search = request()->input('search_val');
                $s_continents = Continent::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_countries = Country::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_states = State::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_cities = City::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $univerties = $univerties->where(function ($query) use ($search, $s_continents, $s_countries, $s_states, $s_cities) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhereIn('continent_id', $s_continents)
                        ->orWhereIn('country_id', $s_countries)
                        ->orWhereIn('state_id', $s_states)
                        ->orWhereIn('city_id', $s_cities);
                });
            }

            if (request()->input('continent')) {
                $univerties = $univerties->where('continent_id', request()->input('continent'));
                $select_continent = request()->input('continent');
            } else {
                $select_continent =  0;
            }
            if (request()->input('country')) {
                $univerties = $univerties->where('country_id', request()->input('country'));
                $select_country = Country::find(request()->input('country'));
                if ($select_continent == 0) {
                    $select_continent = $select_country->continent->id;
                    $select_country =  $select_country->id;
                } else {
                    $select_country =  $select_country->id;
                }
            } else {
                $select_country =  0;
            }
            if (request()->input('state')) {
                $univerties = $univerties->where('state_id', request()->input('state'));

                $select_state = State::find(request()->input('state'));
                if ($select_country == 0) {
                    $select_country = $select_state->country->id;
                    $select_state =  $select_state->id;
                } else {
                    $select_state =  $select_state->id;
                }
            } else {
                $select_state =  0;
            }
            if (request()->input('city')) {
                $univerties = $univerties->where('city_id', request()->input('city'));

                $select_city = City::find(request()->input('city'));
                if ($select_state == 0) {
                    $select_state = $select_city->state->id;
                    $select_city =  $select_city->id;
                } else {
                    $select_city =  $select_city->id;
                }
            } else {
                $select_city =  0;
            }
        } else {
            $select_continent = 0;
            $select_country = 0;
            $select_state = 0;
            $select_city = 0;
            if (request()->input('search_val')) {
                $search = request()->input('search_val');

                $s_continents = Continent::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_countries = Country::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_states = State::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_cities = City::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');

                $univerties = $univerties->where(function ($query) use ($search, $s_continents, $s_countries, $s_states, $s_cities) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhereIn('continent_id', $s_continents)
                        ->orWhereIn('country_id', $s_countries)
                        ->orWhereIn('state_id', $s_states)
                        ->orWhereIn('city_id', $s_cities);
                });
            }
        }

        $data['select_search'] = request()->input('search_val');
        $data['countries'] = $countries = Country::withCount('university')->where('continent_id', $select_continent)->where('status', 1)->get();
        $data['states'] = $states = State::withCount('universities')->where('status', 1)->get();
        $data['cities'] = $cities = City::withCount('universities')->where('state_id', $select_state)->where('status', 1)->get();

        $data['select_continent'] = $select_continent;
        $data['select_country'] = $select_country;
        $data['select_state'] = $select_state;
        $data['select_city'] = $select_city;
        $data['universities'] = $univerties->get();


        $data['banner'] = Banner::where('type', 'university')->first();
        return view('Frontend.university.index', $data);
    }

    function ajaxFilterUniversity(Request $request)
    {

        $data['continents'] = $continents = Continent::withCount('universities')->where('status', 1)->get();
        $univerties = University::where('status', 1);

        if (request()->onsearch_val == false || request()->onsearch_val == 'false') {

            if (request()->input('search_val')) {

                $search = request()->input('search_val');

                $s_continents = Continent::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_countries = Country::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_states = State::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_cities = City::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');

                $univerties = $univerties->where(function ($query) use ($search, $s_continents, $s_countries, $s_states, $s_cities) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhereIn('continent_id', $s_continents)
                        ->orWhereIn('country_id', $s_countries)
                        ->orWhereIn('state_id', $s_states)
                        ->orWhereIn('city_id', $s_cities);
                });
            }

            if (request()->input('continent')) {
                $univerties = $univerties->where('continent_id', request()->input('continent'));
                $select_continent = request()->input('continent');
            } else {
                $select_continent =  0;
            }

            if ($tag = request()->input('tags')) {
                $univerties = $univerties->where(function ($query) use ($tag) {
                    $query->whereRaw('JSON_CONTAINS(tags, \'["' . $tag . '"]\')');
                });
            }

            if (request()->input('country')) {
                $univerties = $univerties->where('country_id', request()->input('country'));
                $select_country = Country::find(request()->input('country'));
                if ($select_continent == 0) {
                    $select_continent = $select_country->continent->id;
                    $select_country =  $select_country->id;
                } else {
                    $select_country =  $select_country->id;
                }
            } else {
                $select_country =  0;
            }
            if (request()->input('state')) {
                $univerties = $univerties->where('state_id', request()->input('state'));

                $select_state = State::find(request()->input('state'));
                if ($select_country == 0) {
                    $select_country = $select_state->country->id;
                    $select_state =  $select_state->id;
                } else {
                    $select_state =  $select_state->id;
                }
            } else {
                $select_state =  0;
            }
            if (request()->input('city')) {
                $univerties = $univerties->where('city_id', request()->input('city'));

                $select_city = City::find(request()->input('city'));
                if ($select_state == 0) {
                    $select_state = $select_city->state->id;
                    $select_city =  $select_city->id;
                } else {
                    $select_city =  $select_city->id;
                }
            } else {
                $select_city =  0;
            }
        } else {
            $select_continent = 0;
            $select_country = 0;
            $select_state = 0;
            $select_city = 0;

            if (request()->input('search_val')) {
                $search = request()->input('search_val');

                $s_continents = Continent::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_countries = Country::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_states = State::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_cities = City::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_majors = Department::where('name', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');
                $s_scholarship = Scholarship::where('title', 'like', '%' . $search . '%')->where('status', 1)->get()->pluck('id');

                $univerties = $univerties->where(function ($query) use ($search, $s_continents, $s_countries, $s_states, $s_cities, $s_majors, $s_scholarship) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('short_name', 'like', '%' . $search . '%')
                        ->orWhereIn('continent_id', $s_continents)
                        ->orWhereIn('country_id', $s_countries)
                        ->orWhereIn('state_id', $s_states)
                        ->orWhereIn('city_id', $s_cities)
                        ->orWhere(function ($query) use ($s_majors) {
                            foreach ($s_majors as $major_id) {
                                $query->orWhere('major_id', 'like', '%"' . $major_id . '"%');
                            }
                        })
                        ->orWhere(function ($query) use ($s_scholarship) {
                            foreach ($s_scholarship as $scholarship_id) {
                                $query->orWhere('scholarships', 'like', '%"' . $scholarship_id . '"%');
                            }
                        });
                });
            }
        }

        $data['select_search'] = request()->input('search_val');

        if ($tag = request()->input('tags')) {
            $univerties = $univerties->where(function ($query) use ($tag) {
                $query->whereRaw('JSON_CONTAINS(tags, \'["' . $tag . '"]\')');
            });
        }


        $data['countries'] = $countries = Country::withCount('university')->where('continent_id', $select_continent)->where('status', 1)->get();

        $data['states'] = $states = State::withCount('universities')->where('status', 1)->get();

        $data['cities'] = $cities = City::withCount('universities')->where('state_id', $select_state)->where('status', 1)->get();


        $data['select_continent'] = $select_continent;
        $data['select_country'] = $select_country;
        $data['select_state'] = $select_state;
        $data['select_city'] = $select_city;
        $data['universities'] = $univerties->get();

        return view('Frontend.university.ajax-university-filter', $data);
    }
    function getcitybyCountry()
    {
        $cities = City::withCount('university')->has('university')->where('status', 1)->get();
        $cities_arr = $cities->toArray();
        return $cities_arr;
    }



    public function universityDetails($id)
    {
        $data['university'] = $university = University::find($id);
        $data['scholarships'] = Scholarship::where('status', 1)->get();
        $data['majors'] = Department::where('status', 1)->get();

        $continent = $university->continent_id;

        $data['reviews'] = Review::where('university_id', $university->id)->get();

        $data['consultant'] = User::where('continent_id', $continent)
            ->where('type', 7)->where('status', 1)
            ->first();

        $data['university_courses'] = Course::where('university_id', $university->id)->latest()->get();
        return view('Frontend.university.university_details', $data);
    }



    public function question(Request $request)
    {
        $qus = new AskQuestion();
        $qus->university_id = $request->university_id ?? 0;
        $qus->program_id = $request->program_id ?? 0;
        $qus->name = $request->name;
        $qus->email = $request->email;
        $qus->question = $request->question;
        // $qus->answer = $request->answer;
        $qus->type = $request->type;
        $qus->save();
        return redirect()->back()->with('message', 'Your message is send successfully, we will responce as soon as possible. Thank you.');
    }
}
