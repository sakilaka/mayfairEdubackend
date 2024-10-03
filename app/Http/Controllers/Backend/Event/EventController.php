<?php

namespace App\Http\Controllers\Backend\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\CourseLanguage;
use App\Models\CourseRequisite;
use App\Models\CourseLearn;
use App\Models\Category;
use App\Models\User;
use App\Models\EventSchedule;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['events'] = Event::orderBy('id', 'desc')->get();
        return view("Backend.events.event.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $data['hosts'] = User::where('status','1')->where('type','4')->get();
        $data['instrutors'] = User::where('status', '1')->where('type', '7')->get();
        $data["categorys"] = Category::where('parent_id', '=', 0)->where('type', 'event')->get();
        $data['languages'] = CourseLanguage::orderBy('id', 'desc')->where('status', 1)->get();
        return view("Backend.events.event.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $event = new Event();
            // $car->slug = SlugService::createSlug(Car::class, 'slug', $request->name);
            $event->category_id = $request->category_id ?? 0;
            // $event->host_id = $request->host_id ?? 0;

            $event->name = $request->name ?? "";

            $event->startdate = $request->startdate ?? "";
            $event->enddate = $request->enddate ?? "";

            $event->language_id = $request->language_id ?? 0;
            $event->organization_name = $request->organization_name;
            $event->location = $request->location;
            // $event->eventstarttime = $request->eventstarttime;
            $event->fee = $request->fee;
            $event->about = $request->about ?? "";

            if ($request->hasFile('image')) {
                $fileName = rand() . time() . '.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/event/'), $fileName);
                $event->image = $fileName;
            }

            $event->save();

            // Schedule Start
            if (isset($request->schedulename) && count($request->schedulename) > 0 && $request->schedulename != null) {
                //    if($request->schedulename){
                foreach ($request->schedulename as $k => $value) {
                    if ($value != null && $value != "") {
                        $schedule = new EventSchedule();
                        $schedule->event_id = $event->id;
                        $schedule->schedulename = $value;
                        $schedule->instrutor_id = $request->instrutor_id[$k];
                        $schedule->day_id = $request->day_id[$k];
                        $schedule->scheduledate = $request->scheduledate[$k];
                        $schedule->schedulestart_time = $request->schedulestart_time[$k];
                        $schedule->scheduleend_time = $request->scheduleend_time[$k];
                        $schedule->save();
                    }
                }
            }
            //Schedule End


            DB::commit();
            return redirect()->route('admin.event.index')->with('success', 'Event Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
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
        $data['events'] = Event::find($id);
        // $data['hosts'] = User::where('status','1')->where('type','4')->get();
        $data['instrutors'] = User::where('status', '1')->where('type', '7')->get();
        $data["categorys"] = Category::where('parent_id', '=', 0)->where('type', 'event')->get();
        $data['languages'] = CourseLanguage::orderBy('id', 'desc')->where('status', 1)->get();
        return view("Backend.events.event.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $event = Event::find($id);
            // $car->slug = SlugService::createSlug(Car::class, 'slug', $request->name);
            $event->category_id = $request->category_id ?? 0;
            $event->host_id = $request->host_id ?? 0;

            $event->name = $request->name ?? "";
            $event->startdate = $request->startdate ?? "";
            $event->enddate = $request->enddate ?? "";
            $event->organization_name = $request->organization_name;
            $event->location = $request->location;
            // $event->eventstarttime = $request->eventstarttime;

            $event->language_id = $request->language_id ?? 0;
            $event->fee = $request->fee;
            $event->about = $request->about ?? "";

            if ($request->hasFile('image')) {
                @unlink(public_path("upload/event/" . $event->image));
                $fileName = rand() . time() . '.' . request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/event/'), $fileName);
                $event->image = $fileName;
            }

            $event->save();

            // Schedule Start
            if (isset($request->schedulename) && count($request->schedulename) > 0 && $request->schedulename != null) {
                // if($request->schedulename){
                foreach ($request->schedulename as $k => $value) {
                    if ($value != null && $value != "") {
                        $schedule = new EventSchedule();
                        $schedule->event_id = $event->id;
                        $schedule->schedulename = $value;
                        $schedule->instrutor_id = $request->instrutor_id[$k];
                        $schedule->day_id = $request->day_id[$k];
                        $schedule->scheduledate = $request->scheduledate[$k];
                        $schedule->schedulestart_time = $request->schedulestart_time[$k];
                        $schedule->scheduleend_time = $request->scheduleend_time[$k];
                        $schedule->save();
                    }
                }
            }

            if (isset($request->old_schedulename) && count($request->old_schedulename) > 0 && $request->old_schedulename != null) {
                // if($request->old_schedulename){
                foreach ($request->old_schedulename as $k => $value) {
                    if ($value != null && $value != "") {
                        $schedule = EventSchedule::find($k);
                        $schedule->event_id = $event->id;
                        $schedule->schedulename = $value;
                        $schedule->instrutor_id = $request->old_instrutor_id[$k];
                        $schedule->day_id = $request->old_day_id[$k];
                        $schedule->scheduledate = $request->old_scheduledate[$k];
                        $schedule->schedulestart_time = $request->old_schedulestart_time[$k];
                        $schedule->scheduleend_time = $request->old_scheduleend_time[$k];
                        $schedule->save();
                    }
                }
            }

            if ($request->delete_eventschedule) {
                foreach ($request->delete_eventschedule as $k => $value) {
                    $courselearn = EventSchedule::find($value);
                    $courselearn->delete();
                }
            }
            //Schedule End


            DB::commit();
            return redirect()->route('admin.event.index')->with('success', 'Event Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $event = Event::find($request->event_id);
            @unlink(public_path('upload/event/' . $event->image));

            foreach ($event->courserequisites as $courserequisite) {
                $courserequisite->delete();
            }

            foreach ($event->courselearns as $courselearn) {
                $courselearn->delete();
            }

            foreach ($event->eventschedules as $eventschedule) {
                $eventschedule->delete();
            }
            $event->delete();
            return back()->with('success', 'Event Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function status($id)
    {
        try {
            $event = Event::find($id);
            if ($event->status == 0) {
                $event->status = 1;
            } elseif ($event->status == 1) {
                $event->status = 0;
            }
            $event->update();
            return back()->with('success', 'Status Changed');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
}
