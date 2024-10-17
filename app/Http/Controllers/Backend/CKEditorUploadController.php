<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CKEditorUploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'uploaded' => false,
                'error' => ['message' => $validator->errors()->first('upload')]
            ]);
        }

        if ($request->hasFile('upload')) {
            $image = $request->file('upload');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/ckeditor5'), $imageName);
            $imageUrl = asset('uploads/ckeditor5/' . $imageName);
            
            return response()->json([
                'uploaded' => true,
                'url' => $imageUrl
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error' => ['message' => 'Image upload failed.']
        ]);
    }
}
