<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class pagesController extends Controller
{

    public function __construct() {
        $this->middleware(function($request, $next) {
            if (!$this->canAccess('pages')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function getPages(Request $request) {
        $pages = Page::paginate($request->limit ?? 10);

        return $this->success($pages);
    }

    public function getPage($pageId) {
        $page = Page::find($pageId);

        return $this->success($page);
    }

//    public function create(Request $request) {
//
//        $validate = Validator::make($request->all(), [
//            'title' => 'required',
//            'body' => 'required',
//        ]);
//
//        if ($validate->fails()) {
//            return $this->error('Validation Error', $validate->errors());
//        }
//
//        if ($request->file('thumbnail')) {
//            $thumbnail = Storage::disk('public')->put('thumbnails', $request->file('thumbnail'));
//        }
//
//        $post = Post::create([
//            'title' => $request->title,
//            'content' => $request->body,
//            'slug' => Str::slug($request->title),
//            'thumbnail' => $thumbnail ? Storage::disk('public')->url($thumbnail) : null,
//            'status' => $request->status,
//            'category' => $request->category,
//            'author' => Auth::user()->id
//        ]);
//
//        return $this->success($post, 'Post Added Successfully');
//
//    }

    public function update(Request $request) {

        $validate = Validator::make($request->all(), [
            'item_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $page = Page::find($request->item_id);


        $page->update([
            'title' => $request->title,
            'content' => $request->body,
            'slug' => Str::slug($request->title),
        ]);

        return $this->success($page, 'Page Updated Successfully');

    }

//    public function delete(Request $request) {
//        $validate = Validator::make($request->all(), [
//            'item_ids' => 'required'
//        ]);
//
//        if ($validate->fails()) {
//            return $this->error('Validation Error', $validate->errors());
//        }
//
//        $posts_ids = explode(',', $request->item_ids);
//
//        $posts = Post::whereIn('id', $posts_ids);
//
//        $posts->delete();
//
//        return $this->success(null, 'Posts Deleted Successfully');
//
//    }

}
