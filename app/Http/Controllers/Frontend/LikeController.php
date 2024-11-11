<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike($id)
    {
        $user = Auth::user();
        $blog = Blog::findOrFail($id);
    
        // Toggle the like status for the user and the blog post
        $user->likedBlogs()->toggle($blog);
        
        return $user->likedBlogs->contains($blog) ? 1 :0;
    }
}
