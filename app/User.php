<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Actuallymab\LaravelComment\CanComment;
use Actuallymab\LaravelComment\Contracts\Commentable;
use Actuallymab\LaravelComment\Models\Comment;
use App\Model\UserInstitutions;
use App\Model\District;
use App\Model\Thana;
use App\Model\PoliceStation;
use App\Model\Village;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    use CanComment;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "full_name",
        "email",
        "username",
        "phone",
        "password",
        "district_id",
        "thana_id",
        "police_station_id",
        "village_id",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function institution(){
        return $this->hasMany(UserInstitutions::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function thana(){
        return $this->belongsTo(Thana::class);
    }
    public function police_station(){
        return $this->belongsTo(PoliceStation::class);
    }
    public function village(){
        return $this->belongsTo(Village::class);
    }
    public function comment(Commentable $commentable, string $commentText = '', int $rate = 0, int $parent_id = null): Comment
    {
        $commentModel = config('comment.model');

        $comment = new $commentModel([
            'comment'        => $commentText,
            'rate'           => $commentable->canBeRated() ? $rate : null,
            'approved'       => $commentable->mustBeApproved() && !$this->canCommentWithoutApprove() ? false : true,
            'commented_id'   => $this->primaryId(),
            'commented_type' => get_class(),
            'parent_id' => $parent_id,
        ]);

        $commentable->comments()->save($comment);

        return $comment;
    }
}
