<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class categoriesController extends Controller {

    public function __construct() {
        $this->middleware(function($request, $next) {
            if (!$this->canAccess('categories')) {
                abort(403);
            }
            return $next($request);
        });
    }



    public function getCategories(Request $request) {
        $categories = Category::with(['parentCategory'])->when($request->trash, function($query) {
            $query->onlyTrashed();
        })->paginate($request->limit ?? 10);

        return $this->success($categories);
    }

    public function getCategory($categoryId) {
        $category = Category::find($categoryId);

        return $this->success($category);
    }

    public function createCategory(Request $request) {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'nullable|string',
            'parent' => 'nullable|exists:categories,id'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $category = Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'parent' => $request->parent
        ]);

        return $this->success($category, 'Category Added Successfully');

    }

    public function updateCategory(Request $request) {
        $validate = Validator::make($request->all(), [
            'item_id' => 'required|exists:categories,id',
            'title' => 'required',
            'description' => 'nullable|string',
            'parent' => 'nullable|exists:categories,id'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $category = Category::find($request->item_id);

        $category->update([
            'title' => $request->title,
            'description' => $request->description,
            'parent' => $request->parent
        ]);

        return $this->success($category, 'Category Updated Successfully');

    }

    public function deleteCategories(Request $request) {
        $validate = Validator::make($request->all(), [
            'item_ids' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $categories_ids = explode(',', $request->item_ids);

        $categories = Category::whereIn('id', $categories_ids);

        $categories->delete();

        return $this->success(null, 'Categories Deleted Successfully');

    }

}
