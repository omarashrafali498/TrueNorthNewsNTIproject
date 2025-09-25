<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category_post');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'category_tag');
    }
}
