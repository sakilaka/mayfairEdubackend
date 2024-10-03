<?php

namespace App\Http\Controllers\Backend\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserContact;

class ContactController extends Controller
{
    public function index()
    {
        $data['contacts'] = UserContact::where('contact_type', 'contact')->orderBy('id', 'desc')->get();
        return view("Backend.contact.index", $data);
    }

    public function destroy(Request $request)
    {
        try {
            $contact = UserContact::find($request->contact_id);
            $contact->delete();
            return redirect()->route('user.contact.index')->with('success', 'Contact Deleted Successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('user.contact.index')->with('error', 'Something Went Wrong!');
        }
    }

    public function eventIndex()
    {
        $data['contacts'] = UserContact::where('contact_type', 'event')->orderBy('id', 'desc')->get();
        return view("Backend.events.contact.index", $data);
    }

    public function eventContactEdit($id)
    {
        $data['contact'] = UserContact::find($id);
        return view("Backend.events.contact.update", $data);
    }

    public function eventContactUpdate(Request $request, $id)
    {
        //dd($request->all());
        $contact = UserContact::find($id);
        $contact->details = $request->details;
        $contact->save();
        return  redirect()->route('admin.event.contact.index')->with('success', 'Event Leave Comment Update Successfully');
    }
}
