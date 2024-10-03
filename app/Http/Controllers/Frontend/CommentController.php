<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function blogComment(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'blog_id' => 'required|exists:blogs,id',
        ]);
        
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->blog_id = $request->blog_id;
        $comment->content = $request->content;
        // dd($comment);
        $comment->save();
    
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
