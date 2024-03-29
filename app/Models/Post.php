<?php

namespace App\Models;

use App\Models\Scopes\PostsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';

    protected $guarded = [];

    protected $hidden = ['category', 'author'];

    protected $with = ['postCategory', 'postAuthor'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function postCategory() {
        return $this->hasOne(Category::class, 'id', 'category')->select(['id', 'title']);
    }
    public function postAuthor() {
        return $this->hasOne(User::class, 'id', 'author')->select(['id', 'name']);
    }

}
