<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class commentsController extends Controller {

    public function __construct() {
        $this->middleware(function($request, $next) {
            if (!$this->canAccess('comments')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function getComments(Request $request) {

        $comments = Comment::with(['post'])->when($request->search, function($query, $search) {
            $query->where('content', 'LIKE', "%$search%");
        })->when($request->post_id, function($query, $post_id) {
            $query->where('post_id', '=', $post_id);
        })->paginate($request->limit ?? 10);

        return $this->success($comments);

    }

    public function delete(Request $request) {

        $validate = Validator::make($request->all(), [
            'item_ids' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $comments_ids = explode(',', $request->item_ids);

        $comments = Comment::whereIn('id', $comments_ids);

        $comments->delete();

        return $this->success(null, 'Comments Deleted Successfully');

    }


}
