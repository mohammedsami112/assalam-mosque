<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Traits\ResponseMessages;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ResponseMessages;

    public function canAccess($role) {
        $permission = Permission::find(Auth::guard('sanctum')->user()->role);

        if ($permission == null) {
            return false;
        }

        $privilege = $permission->privilege == '*' ? '*' : explode(',', $permission->privilege);

        return $privilege == '*' ? true : in_array($role, $privilege);

    }

}
