<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();
        return $this->success(null, 'Logout Successfully');

    }

}
