<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DonationType;
use App\Models\Gallary;
use App\Models\Page;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class globalController extends Controller {

    private function getSettings() {
        $settings = Setting::whereIn('name', ['phone_number', 'google_map', 'facebook', 'youtube', 'instagram', 'tiktok'])->get();

        return $settings;
    }
    private function getCategories() {
        $categories = Category::select(['id', 'title'])->with(['childCategories' => function($query) {
            $query->select(['id', 'title', 'parent']);
        }])->get();

        return $categories;
    }

    private function getDonationTypes() {
        $donationTypes = DonationType::select(['id', 'title', 'thumbnail'])->orderBy('id', 'desc')->get();
        $donationTypes->each(function($type) {
            $type->setAppends([]);
        });

        return $donationTypes;
    }

    private function getLatestPosts() {
        $latestPosts = Post::select(['id', 'title', 'slug', 'thumbnail', 'author', 'created_at'])->where('status', '=', 1)->without(['postCategory'])->orderBy('id', 'desc')->take(3)->get();

        return $latestPosts;
    }

    private function getGallery() {
        $gallery = Gallary::select(['id', 'image'])->get();

        return $gallery;
    }

    private function getPages() {
        $pages = Page::select(['id', 'title', 'slug'])->get();

        return $pages;
    }

    public function home() {

        $data = [
            'settings' => $this->getSettings(),
//            'categories' => $this->getCategories(),
            'donation_types' => $this->getDonationTypes(),
//            'latest_posts' => $this->getLatestPosts(),
            'gallery' => $this->getGallery(),
            'pages' => $this->getPages()
        ];


        return $this->success($data);

    }

}
