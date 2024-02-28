<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\DonationType;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class donationsTypesController extends Controller
{
    public function __construct() {
        $this->middleware(function($request, $next) {
            if (!$this->canAccess('donations')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function getTypes(Request $request) {

        $donationTypes = DonationType::paginate($request->limit ?? 10);

        return $this->success($donationTypes);

    }

    public function getType($typeId) {

        $donationType = DonationType::find($typeId);

        return $this->success($donationType);

    }

    public function create(Request $request) {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'thumbnail' => 'nullable|image',
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        if ($request->file('thumbnail')) {
            $thumbnail = Storage::disk('public')->put('donation-types', $request->file('thumbnail'));
        }

        $type = DonationType::create([
            'title' => $request->title,
            'thumbnail' => $thumbnail ? Storage::disk('public')->url($thumbnail) : null,
        ]);

        return $this->success($type, 'Type Added Successfully');
    }

    public function update(Request $request) {
        $validate = Validator::make($request->all(), [
            'item_id' => 'required',
            'title' => 'required',
            'thumbnail' => 'nullable|image',
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $type = DonationType::find($request->item_id);

        $thumbnail = null;
        if ($request->file('thumbnail')) {
            if ($type->thumbnail != null) {
                Storage::disk('public')->delete('donation-types', basename($type->thumbnail));
            }
            $thumbnail = Storage::disk('public')->put('donation-types', $request->file('thumbnail'));
        }

        $type->update([
            'title' => $request->title,
            'thumbnail' => $thumbnail ? Storage::disk('public')->url($thumbnail) : $type->thumbnail,
        ]);

        return $this->success($type, 'Type Updated Successfully');
    }

    public function delete(Request $request) {
        $validate = Validator::make($request->all(), [
            'item_ids' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $types_ids = explode(',', $request->item_ids);

        $types = DonationType::whereIn('id', $types_ids);

        $types->delete();

        return $this->success(null, 'Types Deleted Successfully');

    }
}
