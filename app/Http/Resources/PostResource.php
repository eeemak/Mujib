<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'post_detail' => $this->post_detail,
            'short_post' => $this->short_post,
            'file_extension' => $this->file_extension,
            'file_path' => $this->file_path,
            'user_id' => $this->user_id,
            'user_full_name' => $this->user->full_name,
            'post_type_id' => $this->post_type_id,
            'post_type_name' => $this->post_type->name,
            'post_categories' => $this->post_categories,
            'added_from_ip' => $this->added_from_ip,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
