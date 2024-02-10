<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class usersController extends Controller {

    public function __construct() {
        $this->middleware(function($request, $next) {
            if (!$this->canAccess('users')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function getUsers(Request $request) {
        $users = User::with(['permission'])->when($request->search, function($query, $search) {
            $query->where('name', 'LIKE', "%$search%")->where('username', 'LIKE', "%$search%");
        })->when($request->permission, function($query, $permission) {
            $query->where('role', '=', $permission);
        })->paginate($request->limit ?? 10);

        return $this->success($users);
    }

    public function create(Request $request) {

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmation',
            'role' => 'required|exists:permissions,id',
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return $this->success($user, 'User Added Successfully');
    }

    public function update(Request $request) {

        $validate = Validator::make($request->all(), [
            'item_id' => 'required',
            'name' => 'required',
            'username' => 'required',
            'password' => 'nullable|confirmation',
            'role' => 'required|exists:permissions,id',
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $user = User::find($request->item_id);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' =>  $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role
        ]);

        return $this->success($user, 'User Updated Successfully');
    }

    public function delete(Request $request) {
        $validate = Validator::make($request->all(), [
            'item_ids' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $users_ids = explode(',', $request->item_ids);

        $users = User::whereIn('id', $users_ids);

        $users->delete();

        return $this->success(null, 'Users Deleted Successfully');

    }


}
