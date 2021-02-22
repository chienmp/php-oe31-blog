<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Tag;
use Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $filename = $request->image->getClientOriginalName();
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->image = $filename;
        $post->status = isset($request->status);
        $post->save();
        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);
        $request->image->storeAs('public/image', $filename);
        Alert::success(trans('success'), trans('created'));

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->name = $request->name;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->status = isset($request->status);
        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $post->image = $filename;
            $request->image->storeAs('public/image', $filename);
        }
        $post->save();
        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);
        Alert::success(trans('success'), trans('updated'));

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->categories()->detach();
        Post::destroy($id);
        Alert::success(trans('success'), trans('deleted'));

        return redirect()->back();
    }
}
