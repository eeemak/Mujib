<?php

namespace App\Model;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function post_categories(){
        return $this->belongsToMany(PostCategory::class, 'post_with_categories', 'post_id', 'post_category_id');
    }
    public function post_type(){
        return $this->belongsTo(PostType::class, 'post_type_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
