<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(config('post.home'));
        $categories = Category::all();

        return view('posts', compact('posts', 'categories'));
    }

    public function details($id)
    {
        $post = Post::findOrFail($id);
        $blogKey = config('post.blog') . $post->id;
        if (!session()->has($blogKey)) {
            $post->increment('view_count');
            session()->put($blogKey, config('post.viewcount'));
        }
        $randomposts = Post::where('id', '<>', $id)->get()->random(config('post.randomposts'));
        $categories = Category::all();

        return view('post', compact('post', 'randomposts', 'categories'));
    }

    public function showPostByCate($id)
    {
        $categories = Category::all();
        $category = $categories->where('id', $id)->first()->load('posts');
        $posts = $categories->posts;

        return view('category', compact('posts', 'categories'));
    }

    public function showPostByTag($id)
    {
        $categories = Category::all();
        $tag = Tag::findOrFail($id);
        $posts = $tag->posts;

        return view('tag', compact('tag', 'posts', 'categories'));
    }
}
