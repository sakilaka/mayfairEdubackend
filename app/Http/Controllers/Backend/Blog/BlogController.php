<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\University;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['blogs'] = Blog::orderBy('id', 'desc')->get();
        return view("Backend.blog.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data["categorys"] = Category::where('parent_id', '=', 0)->where('type', 'blog')->get();
        $data["sub_categories"] = Category::where('parent_id', '!=', 0)->where('is_sub', 0)->orderBy('position', 'asc')->get();
        $data['tags'] = Tag::where('type', 'blog')->orderBy('id', 'desc')->where('status', 1)->get();
        $data['topics'] = Topic::where('type', 'blog')->orderBy('id', 'desc')->where('status', 1)->get();
        return view("Backend.blog.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            //'short_description' => 'required',
            'description' => 'required',
            //'image' => 'required',
            // 'video' => 'required',
            //'video_link' => 'required',
            // 'position' => 'required',
        ]);

        $blog = new Blog();

        if ($request->child_category_id) {
            $blog->category_id = $request->child_category_id;
        } else {

            if ($request->sub_category_id) {
                $blog->category_id = $request->sub_category_id;
            } else {
                $blog->category_id = $request->category_id;
            }
        }

        $blog->topic_id = $request->topic_id;

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->author = $request->author;
        $blog->sub_banner = $request->sub_banner;
        $blog->slug = SlugService::createSlug(Blog::class, 'slug', $request->title);
        $blog->video_link = "https://" . preg_replace('#^https?://#', '', $request->video_link);

        if ($request->hasFile('image')) {
            $fileName = rand() . time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/blog/'), $fileName);
            $blog->image = $fileName;
        }

        if ($request->hasFile('video_thumbnail')) {
            $fileName = rand() . time() . '.' . request()->video_thumbnail->getClientOriginalExtension();
            request()->video_thumbnail->move(public_path('upload/blog/'), $fileName);
            $blog->video_thumbnail = $fileName;
        }

        if ($request->hasFile('author_image')) {
            $fileName = rand() . time() . '_author_image.' . request()->author_image->getClientOriginalExtension();
            request()->author_image->move(public_path('upload/blog/'), $fileName);
            $blog->author_image = $fileName;
        }

        $blog->save();


        if ($request->tag) {
            foreach ($request->tag as $value) {
                $blog_tag = new Tag();
                $blog_tag->blog_id = $blog->id;
                $blog_tag->name = $value;
                $blog_tag->type = 'blog';
                $blog_tag->save();
            }
        }

        return redirect()->route('blog.index')->with('success', 'Blog Added Successfully');
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
        $blog = Blog::find($id);
        if ($blog->b_category->parent_id == 0) {
            $data["cat_id"] = $blog->b_category->id;
            $data["sub_cat_id"] = 0;
            $data["child_cat_id"] = 0;
            $data["sub_categories"] = $blog->b_category->sub;
            $data["child_categories"] = [];
        } else {
            if ($blog->b_category->is_sub == 0) {
                $data["cat_id"] = $blog->b_category->parent->id;
                $data["sub_cat_id"] = $blog->b_category->id;
                $data["child_cat_id"] = 0;
                $data["sub_categories"] = $blog->b_category->parent->sub;
                $data["child_categories"] = $blog->b_category->sub;
            } else {

                $data["cat_id"] = $blog->b_category->parent->parent->id;
                $data["sub_cat_id"] = $blog->b_category->parent->id;
                $data["child_cat_id"] = $blog->b_category->id;
                $data["sub_categories"] = $blog->b_category->parent->parent->sub;
                //dd( $banner->category);
                $data["child_categories"] = $blog->b_category->parent->sub;
            }
        }


        $data["blog"] = $blog;
        $data["categories"] = Category::where('parent_id', 0)->where('type', 'blog')->get();
        $data['topics'] = Topic::where('type', 'blog')->orderBy('id', 'desc')->where('status', 1)->get();
        return view("Backend.blog.update", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required',
            //'short_description' => 'required',
            'description' => 'required',
            //'image' => 'required',
            //'video' => 'required',
            // 'video_link' => 'required',
            // 'position' => 'required',
        ]);

        $blog = Blog::find($id);
        if ($request->child_category_id) {
            $blog->category_id = $request->child_category_id;
        } else {

            if ($request->sub_category_id) {
                $blog->category_id = $request->sub_category_id;
            } else {
                $blog->category_id = $request->category_id;
            }
        }
        $blog->topic_id = $request->topic_id;
        $blog->title = $request->title;
        // $blog->position = $request->position;
        $blog->sort_description = $request->sort_description;
        $blog->description = $request->description;
        $blog->author = $request->author;
        $blog->sub_banner = $request->sub_banner;
        $blog->slug = SlugService::createSlug(Blog::class, 'slug', $request->title);
        $blog->video_link = "https://" . preg_replace('#^https?://#', '', $request->video_link);
        $blog->status = 1;

        if ($request->hasFile('image')) {
            @unlink(public_path("upload/blog/" . $blog->image));
            $fileName = rand() . time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('upload/blog/'), $fileName);
            $blog->image = $fileName;
        }

        if ($request->hasFile('video_thumbnail')) {
            @unlink(public_path("upload/blog/" . $blog->video_thumbnail));
            $fileName = rand() . time() . '.' . request()->video_thumbnail->getClientOriginalExtension();
            request()->video_thumbnail->move(public_path('upload/blog/'), $fileName);
            $blog->video_thumbnail = $fileName;
        }

        if ($request->hasFile('author_image')) {
            @unlink(public_path("upload/blog/" . $blog->author_image));
            $fileName = rand() . time() . '_author_image.' . request()->author_image->getClientOriginalExtension();
            request()->author_image->move(public_path('upload/blog/'), $fileName);
            $blog->author_image = $fileName;
        }

        $blog->update();



        Tag::where('blog_id', $id)->get()->each->delete();

        if ($request->tag) {
            foreach ($request->tag as $value) {
                $blog_tag = new Tag();
                $blog_tag->blog_id = $blog->id;
                $blog_tag->name = $value;
                $blog_tag->type = 'blog';
                $blog_tag->save();
            }
        }

        // $tags = $request->input('tag', []); // Get the selected tags from the request
        // $blog->tag()->sync($tags);


        return redirect()->route('blog.index')->with('success', 'Blog Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $blog = Blog::find($request->blog_id);
            $path = public_path("upload/blog/" . $blog->image);
            @unlink($path);

            $path = public_path("upload/blog/" . $blog->video_thumbnail);
            @unlink($path);

            foreach ($blog->tag as $item) {
                $item->delete();
            }

            $blog->delete();
            return redirect()->route('blog.index')->with('success', 'Blog Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function status_toggle($id)
    {
        try {
            $blog = Blog::find($id);
            if ($blog->status == 0) {
                $blog->status = 1;
            } elseif ($blog->status == 1) {
                $blog->status = 0;
            }
            $blog->update();
            return redirect()->route('blog.index')->with('success', 'Status Updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    public function blogComment()
    {
        $data['blog_comments'] = Comment::all();
        return view('Backend.blog.blog_comment', $data);
    }
    public function blogCommentEdit($id)
    {
        $data['blog_comment'] = Comment::find($id);
        return view('Backend.blog.blog_comment_update', $data);
    }
    public function blogCommentUpdate(Request $request, $id)
    {
        $blog_comment = Comment::find($id);
        $blog_comment->blog_id = $request->blog_id;
        $blog_comment->user_id = $request->user_id;
        $blog_comment->content = $request->content;
        $blog_comment->update();
        return redirect()->route('blog.comments')->with('success', 'Comment Updated Successfully');
    }
    public function blogCommentDelete(Request $request)
    {
        $blog_comment = Comment::find($request->blog_comment_id);
        $blog_comment->delete();
        return redirect()->back()->with('success', 'Blog Delete Successfully');
    }

    ///add new tag
    public function addSelect2(Request $request)
    {
        // return $request->all();
        if ($request->type == "blog") {
            $tag = new Tag();
            $tag->name = $request->val;
            $tag->type = 'blog';
            $tag->save();
            return response()->json(['status' => 'ok', 'res_data' => $tag]);
        }
    }

    public function manageBlogTopic()
    {
        $data['topics'] = Topic::where('type', 'blog')->get();
        return view('Backend.blog.topic.index', $data);
    }
    public function createBlogTopic()
    {
        return view('Backend.blog.topic.create');
    }
    public function storeBlogTopic(Request $request)
    {
        $topic = new Topic();
        $topic->name = $request->name;
        $topic->type = 'blog';
        $topic->save();
        return redirect()->route('blog.manage_topic')->with('success', 'Topic added Successfully');
    }
    public function editBlogTopic($id)
    {
        $data['topic'] = Topic::find($id);
        return view('Backend.blog.topic.update', $data);
    }
    public function updateBlogTopic(Request $request, $id)
    {
        $topic = Topic::find($id);
        $topic->name = $request->name;
        $topic->status = 1;
        $topic->type = 'blog';
        $topic->update();
        return redirect()->route('blog.manage_topic')->with('success', 'Topic updated Successfully');
    }
    public function status_toggleBlogTopic($id)
    {
        try {
            $topic = Topic::find($id);
            if ($topic->status == 0) {
                $topic->status = 1;
            } elseif ($topic->status == 1) {
                $topic->status = 0;
            }
            $topic->update();
            return redirect()->route('blog.manage_topic')->with('success', 'Status Updated');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }
    public function destroyBlogTopic(Request $request)
    {
        try {
            $topic = Topic::find($request->topic_id);
            $topic->delete();
            return redirect()->back()->with('success', 'Topic Deleted Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something Went Wrong!');
        }
    }


    ///Blog search by Topic
    public function getBlogByTopic(Request $request, $id)
    {
        if ($id == 0) {
            $data['blogs'] = Blog::where('status', 1)->get();
        } else {
            $data['blogs'] = Blog::where('topic_id', $id)->get();
        }
        return view('Frontend.pages.blog_topic_ajax', $data);
    }
}
