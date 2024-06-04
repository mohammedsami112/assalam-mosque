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

    public function create(Request $request) {

        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $post = Page::create([
            'title' => $request->title,
            'content' => $request->body,
            'slug' => Str::slug($request->title),
        ]);

        return $this->success($post, 'Page Added Successfully');

    }

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

    public function delete(Request $request) {
        $validate = Validator::make($request->all(), [
            'item_ids' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $pages_ids = explode(',', $request->item_ids);

        $pages = Page::whereIn('id', $pages_ids);

        $pages->delete();

        return $this->success(null, 'Pages Deleted Successfully');

    }

}
