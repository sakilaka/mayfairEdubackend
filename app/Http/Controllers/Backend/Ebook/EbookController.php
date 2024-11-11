<?php

namespace App\Http\Controllers\Backend\Ebook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Ebook;
use App\Models\EbookAudioContent;
use App\Models\EbookContent;
use App\Models\EbookVideoContent;
use App\Models\RelatedEbook;

class EbookController extends Controller
{
    public function index()
    {
        $data['ebooks'] = Ebook::where('type','ebook')->orderBy('id', 'desc')->get();
        return view("Backend.ebook.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['ebooks'] = Ebook::where('type','ebook')->orderBy('id', 'desc')->get();
        $data['selerys'] = User::where('type','5')->where('status','1')->orderBy('id', 'desc')->get();
        $data["categories"] = Category::where('parent_id', '=' ,0)->where('type','ebook')->get();
        $data["sub_categories"] = Category::where('parent_id', '!=' ,0)->where('type','home')->where('is_sub',0)->orderBy('id', 'desc')->get();
        return view("Backend.ebook.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // dd($request->all());
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',

        ]);
        try{
            DB::beginTransaction();
            $ebook = new Ebook();
            $ebook->category_id = $request->category_id;
            $ebook->sub_category_id = $request->sub_category_id;
            $ebook->user_id = $request->user_id;
            $ebook->title = $request->title;
            $ebook->headline = $request->headline;
            $ebook->lesson = $request->lesson;
            $ebook->fee = $request->fee;
            $ebook->discount = $request->discount;
            $ebook->discount_type = $request->discount_type;
            $ebook->short_desctiption = $request->short_desctiption;
            $ebook->long_desctiption = $request->long_desctiption;
            $ebook->type='ebook';

            if($request->hasFile('image')){
                $fileName = rand().time().'_ebook_image.'.request()->image->getClientOriginalExtension();
                request()->image->move(public_path('upload/ebook/'),$fileName);
                $ebook->image = $fileName;
            }

            if($request->hasFile('content_audio')){
                $fileName = rand().time().'_ebook_audio.'.request()->content_audio->getClientOriginalExtension();
                request()->content_audio->move(public_path('upload/ebook/'),$fileName);
                $ebook->content_audio = $fileName;
            }

            $ebook->save();

            if($request->relatedebook_id){
                foreach( $request->relatedebook_id as $value){
                    $relatedebook = new RelatedEbook();
                    $relatedebook->ebook_id = $ebook->id;
                    $relatedebook->relatedebook_id = $value;
                    $relatedebook->save();
                }
            }

            if($request->audio_file){
                foreach( $request->audio_file as $k=>$value){

                    $audio = new EbookAudioContent();
                    $audio->ebook_id = $ebook->id;
                    $audio->audio_name = $request->audio_name[$k];

                    $filename=$request->audio_name[$k].'-'.$ebook->title.'_ebook_audio_file'.'.'.$value->getClientOriginalExtension();
                    $value->move(public_path('upload/ebook/audio/'), $filename);
                    $audio->audio_file=$filename;

                    $audio->is_free = $request->is_free_audio[$k] ?? 0;
                    $audio->save();
                }
            }


            if($request->video_file){
                foreach( $request->video_file as $k=>$value){
                    $video = new EbookVideoContent();
                    $video->ebook_id = $ebook->id;
                    $video->video_name = $request->video_name[$k];

                    $filename=$request->video_name[$k].'-'.$ebook->title.'_ebook_video_file'.'.'.$value->getClientOriginalExtension();
                    // $filename=time().$k.'_ebook_video_file'.'.'.$value->getClientOriginalExtension();
                    $value->move(public_path('upload/ebook/video/'), $filename);
                    $video->video_file=$filename;

                    $video->is_free = $request->is_free_video[$k] ?? 0;
                    $video->save();
                }
            }

            DB::commit();
            return redirect()->route('admin.ebook.index')->with('message','Ebook Add Successfully');
        }catch(\Exception $e){
            DB::rollBack();
            dd($e);
            return back()->with ('error_message', $e->getMessage());
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
       // dd('hi');
       $data['ebook'] = $ebook = Ebook::find($id);
       $data['ebooks'] = Ebook::where('type','ebook')->orderBy('id', 'desc')->get();
       $data['selerys'] = User::where('type','5')->where('status','1')->orderBy('id', 'desc')->get();
       $data["categories"] = Category::where('parent_id', '=' ,0)->where('type','ebook')->get();
       $data["sub_categories"] = Category::where('parent_id',$ebook->category_id)->orderBy('id', 'desc')->get();
        return view("Backend.ebook.update",$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
       $request->validate([
        'user_id' => 'required',
        'title' => 'required',

    ]);
    try{
        DB::beginTransaction();
        $ebook = Ebook::find($id);
        $ebook->category_id = $request->category_id;
        $ebook->sub_category_id = $request->sub_category_id;
        $ebook->user_id = $request->user_id;
        $ebook->title = $request->title;
        $ebook->headline = $request->headline;
        $ebook->lesson = $request->lesson;
        $ebook->fee = $request->fee;
        $ebook->discount = $request->discount;
        $ebook->discount_type = $request->discount_type;
        $ebook->short_desctiption = $request->short_desctiption;
        $ebook->long_desctiption = $request->long_desctiption;
        $ebook->type='ebook';

        if($request->hasFile('image')){
            $fileName = rand().time().'_ebook_image.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/ebook/'),$fileName);
            $ebook->image = $fileName;
        }

        if($request->hasFile('content_audio')){
            @unlink(public_path('upload/ebook/'.$ebook->content_audio));
            $fileName = rand().time().'_ebook_audio.'.request()->content_audio->getClientOriginalExtension();
            request()->content_audio->move(public_path('upload/ebook/'),$fileName);
            $ebook->content_audio = $fileName;
        }

        $ebook->save();


        RelatedEbook::where('ebook_id',$id)->get()->each->delete();
        // dd($request->type_age);
        if($request->relatedebook_id){
            foreach( $request->relatedebook_id as $value){
                $relatedebook = new RelatedEbook();
                $relatedebook->ebook_id = $ebook->id;
                $relatedebook->relatedebook_id = $value;
                $relatedebook->save();
            }
        }

        //update audio file

         //add audio file

        if($request->audio_file){
            foreach( $request->audio_file as $k=>$value){

                $audio = new EbookAudioContent();
                $audio->ebook_id = $ebook->id;
                $audio->audio_name = $request->audio_name[$k];

                // $filename=time().$k.'_ebook_audio_file'.'.'.$value->getClientOriginalExtension();
                $filename=$request->audio_name[$k].'-'.$ebook->title.'_ebook_audio_file'.'.'.$value->getClientOriginalExtension();
                $value->move(public_path('upload/ebook/audio/'), $filename);
                $audio->audio_file=$filename;

                $audio->is_free = $request->is_free_audio[$k] ?? 0;
                $audio->save();
            }
        }

        // dd($request->old_audio_name);

        if($request->old_audio_name){
            foreach($request->old_audio_name as $k => $value){
                $audio = EbookAudioContent::find($k);
                $audio->ebook_id = $ebook->id;
                $audio->audio_name = $value;
                $audio->is_free =$request->old_is_free_audio[$k] ?? 0;

                if(isset($request->file('old_audio_file')[$k])){
                    @unlink(public_path('upload/ebook/audio/'.$audio->audio_file));
                    $filename=$request->old_audio_name[$k].'-'.$ebook->title.'_ebook_audio_file'.'.'.$request->file('old_audio_file')[$k]->getClientOriginalExtension();
                    $request->file('old_audio_file')[$k]->move(public_path('upload/ebook/audio/'), $filename);
                    $audio->audio_file=$filename;
                }

                $audio->update();
            }
        }

        //delete audio file
        if($request->delete_audio_file){
            foreach($request->delete_audio_file as $k => $value){
                $audio = EbookAudioContent::find($value);
                @unlink(public_path('upload/ebook/audio/'.$audio->audio_file));
                $audio->delete();

            }
        }


        //update video file

        // dd($request->old_video_name);

        if($request->old_video_name){
            foreach($request->old_video_name as $k=>$value){
                $video=EbookVideoContent::find($k);
                $video->ebook_id = $ebook->id;
                $video->video_name = $request->old_video_name[$k];
                $video->is_free = $request->old_is_free_video[$k] ?? 0;

                if(isset($request->file('old_video_file')[$k])){
                    @unlink(public_path('upload/ebook/video/'.$video->video_file));
                    $filename=$request->old_video_name[$k].'-'.$ebook->title.'_ebook_video'.'.'.$request->file('old_video_file')[$k]->getClientOriginalExtension();
                    $request->file('old_video_file')[$k]->move(public_path('upload/ebook/video/'), $filename);
                    $audio->video_file=$filename;
                }

                $video->save();
               }

        }

        //delete Video file
        if($request->delete_video_file){
            foreach($request->delete_video_file as $k => $value){
                $video = EbookVideoContent::find($value);
                @unlink(public_path('upload/ebook/video/'.$video->video_file));
                $video->delete();
            }
        }

        //add video file
        if($request->video_file){
            foreach( $request->video_file as $k=>$value){
                $video = new EbookVideoContent();
                $video->ebook_id = $ebook->id;
                $video->video_name = $request->video_name[$k];
                $filename=$request->video_name[$k].'-'.$ebook->title.'_ebook_video_file'.'.'.$value->getClientOriginalExtension();
                $value->move(public_path('upload/ebook/video/'), $filename);
                $video->video_file=$filename;
                $video->is_free = $request->is_free_video[$k] ?? 0;
                $video->save();
            }
        }



        DB::commit();
        return redirect()->route('admin.ebook.index')->with('message','Ebook Update Successfully');
    }catch(\Exception $e){
        DB::rollBack();
        dd($e);
        return back()->with ('error_message', $e->getMessage());
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $ebook =  Ebook::find($request->ebook_id);
        @unlink(public_path('upload/ebook/'.$ebook->image));

        foreach($ebook->audio as $item){
            @unlink(public_path('upload/ebook/audio'.$item->audio_file));
            $item->delete();
        }
        foreach($ebook->video as $item){
            @unlink(public_path('upload/ebook/audio'.$item->video_file));
            $item->delete();
        }

        foreach($ebook->ebooks as $item){
            $item->delete();
        }

        $ebook->delete();
        return back()->with('message','Ebook Deleted Successfully');
    }

    function changePassword(Request $request){
        $user =  User::find($request->user_id);
        $user->password = $request->password;
        $user->save();
        return redirect()->back()->with('message','Teacher Profile Password Changed Successfully');
    }

    public function status($id)
    {
        $ebook = Ebook::find($id);
        if($ebook->status == 0)
        {
            $ebook->status = 1;
        }elseif($ebook->status == 1)
        {
            $ebook->status = 0;
        }
        $ebook->update();
        return redirect()->route('admin.ebook.index');
    }






}
