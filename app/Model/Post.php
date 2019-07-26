<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function post_categories(){
        return $this->belongsToMany(PostCategory::class, 'post_with_categories', 'post_id', 'post_category_id');
    }
}
