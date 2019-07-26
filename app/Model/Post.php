<?php

namespace App\Model;
use Actuallymab\LaravelComment\Contracts\Commentable;
use Actuallymab\LaravelComment\HasComments;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Post extends Model implements Commentable
{
    use HasComments;

    public function canBeRated(): bool
    {
        return true; // default false
    }
    public function mustBeApproved(): bool
    {
        return false; // default false
    }
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
