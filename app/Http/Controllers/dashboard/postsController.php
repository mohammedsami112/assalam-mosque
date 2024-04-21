<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class postsController extends Controller {

    public function __construct() {
        $this->middleware(function($request, $next) {
            if (!$this->canAccess('posts')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function getPosts(Request $request) {
        $posts = Post::when($request->search, function($query, $search) {
            $query->where('title', 'LIKE', "%$search%");
        })->paginate($request->limit ?? 10);

        return $this->success($posts);
    }

    public function getPost($postId) {
        $post = Post::find($postId);

        return $this->success($post);
    }

    public function create(Request $request) {

        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'thumbnail' => 'nullable|image',
            'status' => 'required',
            'category' => 'required:exists:categories,id',
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        if ($request->file('thumbnail')) {
            $thumbnail = Storage::disk('public')->put('thumbnails', $request->file('thumbnail'));
        }

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->body,
            'slug' => str_replace(' ', '-', $request->title),
            'thumbnail' => $thumbnail ? Storage::disk('public')->url($thumbnail) : null,
            'status' => $request->status,
            'category' => $request->category,
            'author' => Auth::user()->id
        ]);

        return $this->success($post, 'Post Added Successfully');

    }

    public function update(Request $request) {

        $validate = Validator::make($request->all(), [
            'item_id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'thumbnail' => 'nullable|image',
            'status' => 'required',
            'category' => 'required|exists:categories,id'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $post = Post::find($request->item_id);

        $thumbnail = null;
        if ($request->file('thumbnail')) {
            if ($post->thumbnail != null) {
                Storage::disk('public')->delete('thumbnails', basename($post->thumbnail));
            }
            $thumbnail = Storage::disk('public')->put('thumbnails', $request->file('thumbnail'));
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->body,
            'slug' => str_replace(' ', '-', $request->title),
            'thumbnail' => $thumbnail ? Storage::disk('public')->url($thumbnail) : $post->thumbnail,
            'status' => $request->status,
            'category' => $request->category
        ]);

        return $this->success($post, 'Post Updated Successfully');

    }

    public function delete(Request $request) {
        $validate = Validator::make($request->all(), [
            'item_ids' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $posts_ids = explode(',', $request->item_ids);

        $posts = Post::whereIn('id', $posts_ids);

        $posts->delete();

        return $this->success(null, 'Posts Deleted Successfully');

    }

}
