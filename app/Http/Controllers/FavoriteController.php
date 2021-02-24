<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class FavoriteController extends Controller
{
    public function add($id)
    {
        $post = Post::findOrFail($id);
        $user= Auth::user();
        $favorite = $user->favoritePosts()->where('post_id', $post->id)->count();
        $total = $post->with('usersFavorite')->withCount('usersFavorite')->find($id);
        if ($favorite == 0)
        {
            $user->favoritePosts()->attach($post);
        } else {
            $user->favoritePosts()->detach($post);
        }

        return response()->json([
            'status' => $favorite,
        ]);
    }

    public function favorPost()
    {
        $categories = Category::all();
        $posts = Auth::user()->favoritePosts()->get();

        return view('favorite', compact('posts', 'categories'));
    }
}
