<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class permissionsController extends Controller {

    public function __construct() {
        $this->middleware(function($request, $next) {
            if (!$this->canAccess('permissions')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function getPermissions(Request $request) {
        $permissions = Permission::withCount(['users'])->paginate($request->limit ?? 10);

        return $this->success($permissions);
    }

    public function getPermission($permissionId) {
        $permission = Permission::find($permissionId);

        return $this->success($permission);
    }

    public function create(Request $request) {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $permission = Permission::create([
            'title' => $request->title,
            'privilege' => $request->privilege
        ]);

        return $this->success($permission, 'Permission Added Successfully');

    }

    public function update(Request $request) {
        $validate = Validator::make($request->all(), [
            'item_id' => 'required',
            'title' => 'required',
            'privilege' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $permission = Permission::find($request->item_id);

        $permission->update([
            'title' => $request->title,
            'privilege' => $request->privilege
        ]);

        return $this->success($permission, 'Permission Updated Successfully');

    }

    public function delete(Request $request) {
        $validate = Validator::make($request->all(), [
            'item_ids' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $permission_ids = explode(',', $request->item_ids);

        $permissions = Permission::whereIn('id', $permission_ids);

        $permissions->delete();

        return $this->success(null, 'Permissions Deleted Successfully');

    }


}
