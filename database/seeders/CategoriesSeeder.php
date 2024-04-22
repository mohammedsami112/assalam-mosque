<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'title' => 'فعليات الجمعية',
            'deletable' => false,
        ]);
        Category::create([
            'title' => 'اخبار الجمعية',
            'deletable' => false,
        ]);
    }
}