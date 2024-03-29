<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class pagesController extends Controller
{
    public function getPage($pageId) {
        $page = Page::find($pageId);

        return $this->success($page);
    }
}
