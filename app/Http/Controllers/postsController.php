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
}
