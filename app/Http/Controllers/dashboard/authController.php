<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authController extends Controller {

    public function login(Request $request) {
        $validate = Validator::make($request->all(), [
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return $this->error('Username Or Password Invalid', [], 401);
        }

        $user = Auth::user();
        $success = [
            'token' => $user->createToken('AuthToken')->plainTextToken,
            'user' => $user,
        ];

        return $this->success($success, 'Login Successfully');

    }

    public function changePassword(Request $request) {
        $validate = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $auth = Auth::user();

        if (!Hash::check($request->current_password, $auth->password)) {
            return $this->error('Current Password Invalid');
        }

        $user = User::find($auth->id);
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return $this->success(null, 'Password Changed Successfully');


    }

    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();
        return $this->success(null, 'Logout Successfully');

    }

}
