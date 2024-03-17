<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DonationType;
use App\Models\Gallary;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class globalController extends Controller {

    private function getSettings() {
        $settings = Setting::whereIn('name', ['phone_number', 'email', 'address1', 'address2'])->get();

        return $settings;
    }
    private function getCategories() {
        $categories = Category::select(['id', 'title'])->with(['childCategories' => function($query) {
            $query->select(['id', 'title', 'parent']);
        }])->get();

        return $categories;
    }

    private function getDonationTypes() {
        $donationTypes = DonationType::select(['id', 'title', 'thumbnail'])->orderBy('id', 'desc')->take(4)->get();
        $donationTypes->each(function($type) {
            $type->setAppends([]);
        });

        return $donationTypes;
    }

    private function getLatestPosts() {
        $latestPosts = Post::select(['id', 'title', 'slug', 'thumbnail', 'author', 'created_at'])->without(['postCategory'])->orderBy('id', 'desc')->take(3)->get();

        return $latestPosts;
    }

    private function getGallery() {
        $gallery = Gallary::select(['id', 'image'])->get();

        return $gallery;
    }

    public function home() {

        $data = [
            'settings' => $this->getSettings(),
//            'categories' => $this->getCategories(),
            'donation_types' => $this->getDonationTypes(),
            'latest_posts' => $this->getLatestPosts(),
            'gallery' => $this->getGallery()
        ];


        return $this->success($data);

    }

}
