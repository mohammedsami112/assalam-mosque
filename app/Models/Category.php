<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $guarded = [];

    protected $hidden = ['parent'];

    public function parentCategory() {
        return $this->hasOne(Category::class, 'id', 'parent');
    }

    public function childCategories() {
        return $this->hasMany(Category::class, 'parent', 'id');
    }

}
