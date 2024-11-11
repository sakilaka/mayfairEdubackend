<?php

namespace App\Http\Controllers\Backend\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Client;

class ClientController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['clients'] = Client::orderBy('id', 'desc')->get();
        return view("Backend.home.client.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Backend.home.client.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //dd($request->all());
         $request->validate([
            'name' => 'required',
            'link' => 'required',
            'image' => 'required',
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->link = "https://" . preg_replace('#^https?://#', '',$request->link);

        if($request->hasFile('image')){
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/client/'),$fileName);
            $client->image = $fileName;
        }
        $client->save();
        return redirect()->route('home-client.index')->with('message','Clients Add Successfully');
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
        $data["client"]= Client::find($id);
        return view("Backend.home.client.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'link' => 'required',
           // 'image' => 'required',
        ]);

        $client = Client::find($id);
        $client->name = $request->name;
        $client->link = "https://" . preg_replace('#^https?://#', '',$request->link);

        if($request->hasFile('image')){
            @unlink(public_path("upload/client/".$client->image));
            $fileName = rand().time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/client/'),$fileName);
            $client->image = $fileName;
        }

        $client->save();
        return redirect()->route('home-client.index')->with('message','Clients Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $client= Client::find($request->home_client_id);
        $path = public_path("upload/client/".$client->image);
        @unlink($path);

        $client->delete();
        return redirect()->route('home-client.index');

    }

    public function status_toggle($id)
    {
        $client = Client::find($id);
        if($client->status == 0)
        {
            $client->status = 1;
        }elseif($client->status == 1)
        {
            $client->status = 0;
        }
        $client->update();
        return redirect()->route('home-client.index');
    }
}
