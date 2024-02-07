<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class donationsController extends Controller {

    public function __construct() {
        $this->middleware(function($request, $next) {
            if (!$this->canAccess('donations')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function getDonations(Request $request) {

        $donations = Donation::paginate($request->limit ?? 10);

        return $this->success($donations);

    }

}
