<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    public function posts(){
        return $this->belongsToMany(Post::class, 'post_with_categories', 'post_category_id', 'post_id');
    }
}
