<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class globalController extends Controller {

    public function permissionsList() {
        $permissions = Permission::select(['id', 'title'])->get();

        return $this->success($permissions);

    }

    public function categoriesList() {
        $categories = Category::select(['id', 'title'])->where('parent', '=', NUll)->get();

        return $this->success($categories);

    }


    public function abilities() {
        $permission = Permission::find(Auth::user()->role)->privilege;



        return $this->success(explode(',', $permission));
    }

}
