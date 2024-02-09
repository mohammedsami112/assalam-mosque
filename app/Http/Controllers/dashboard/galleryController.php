<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gallary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class galleryController extends Controller {

    public function __construct() {
        $this->middleware(function($request, $next) {
            if (!$this->canAccess('gallery')) {
                abort(403);
            }
            return $next($request);
        });
    }

    public function getGallery(Request $request) {
        $gallery = Gallary::paginate($request->limit ?? 10);

        return $this->success($gallery);
    }

    public function addImage(Request $request) {

        $validate = Validator::make($request->all(), [
            'image' => 'required|image'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $image = Storage::disk('public')->put('gallery', $request->file('image'));

        Gallary::create([
            'image' => Storage::disk('public')->url($image),
        ]);

        $this->success(null, 'Image Added Successfully');
    }

    public function update(Request $request) {

        $validate = Validator::make($request->all(), [
            'item_id' => 'required',
            'image' => 'required|image'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $gallery = Gallary::find($request->item_id);
        Storage::disk('public')->delete('gallery', basename($gallery->image));
        $image = Storage::disk('public')->put('gallery', $request->file('image'));

       $gallery->update([
            'image' => Storage::disk('public')->url($image),
        ]);

        $this->success(null, 'Image Updated Successfully');
    }

    public function delete(Request $request) {
        $validate = Validator::make($request->all(), [
            'item_ids' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->error('Validation Error', $validate->errors());
        }

        $images_ids = explode(',', $request->item_ids);

        $images = Gallary::whereIn('id', $images_ids);

        $images->delete();

        return $this->success(null, 'Images Deleted Successfully');

    }


}
