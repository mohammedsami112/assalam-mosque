<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Permission;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class globalController extends Controller {

    public function home() {
        $success = [];

        if ($this->canAccess('users')) {
            $success['total_users'] = User::count();
        }

        if ($this->canAccess('posts')) {
            $success['total_posts'] = Post::count();
        }

        if ($this->canAccess('donations')) {
            $success['total_donations'] = Donation::sum('amount');
            $success['latest_donations'] = Donation::orderBy('id', 'desc')->take(10)->get();
        }

        return $this->success($success);
    }

    public function permissionsList() {
        $permissions = Permission::select(['id', 'title'])->get();

        return $this->success($permissions);

    }

    public function categoriesList(Request $request) {
        $categories = Category::select(['id', 'title'])->when($request->parent, function($query) {
            $query->where('parent', '=', NUll);
        })->get();

        return $this->success($categories);

    }


    public function abilities() {
        $permission = Permission::find(Auth::user()->role)->privilege;



        return $this->success(explode(',', $permission));
    }

}
