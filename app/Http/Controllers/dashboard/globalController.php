<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class globalController extends Controller {

    public function permissionsList() {
        $permissions = Permission::select(['id', 'title'])->get();

        return $this->success($permissions);

    }

}
