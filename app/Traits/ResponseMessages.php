<?php

namespace App\Traits;

trait ResponseMessages {

    public function success($result, $message = 'success', $addons = []) {

        $response = $addons + [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    public function error($error, $messages = [], $code = 400) {

        $response = [
            'success' => false,
            'data' => $messages,
            'message' => $error
        ];

        return response()->json($response, $code);
    }

}
