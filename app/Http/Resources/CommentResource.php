<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'commentable_id' => $this->commentable_id,
            'commentable_type' => $this->commentable_type,
            'commented_id' => $this->commented_id,
            'commented_user' => $this->commented,
            'commented_type' => $this->commented_type,
            'comment' => $this->comment,
            'approved' => $this->approved,
            'rate' => $this->rate,
            'parent_id' => $this->parent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
