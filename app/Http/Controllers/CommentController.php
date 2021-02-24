<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $post){
        $comment = new Comment();
        $comment->post_id = $post;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();
        $postComment = Post::findOrFail($post)->load('comments');

        $data =[
            "total" =>  $postComment->comments()->count(),
            'comment' => $postComment,
        ];

        return response()->json($data) ;
    }
}
