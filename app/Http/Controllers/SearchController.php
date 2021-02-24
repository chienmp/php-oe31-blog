<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Category;
use App\Models\Post;

class SearchController extends Controller
{
    public function search(SearchRequest $request)
    {
        $categories = Category::all();
        $query = $request->input('query');
        $posts = Post::where('title', 'LIKE', "%$query%")->get();

        return view('search', compact('posts', 'query', 'categories'));
    }

}
