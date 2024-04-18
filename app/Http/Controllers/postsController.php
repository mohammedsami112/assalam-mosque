<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class postsController extends Controller
{
    public function getPost($postId) {
        $post = Post::find($postId);

        return $this->success($post);
    }

    public function getPosts(Request $request) {
        $posts = Post::where('category', '=', $request->categoryId ?? 1)->take(3)->get();

        return $this->success($posts);

    }

}
