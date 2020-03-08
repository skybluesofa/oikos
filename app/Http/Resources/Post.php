<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Skybluesofa\Microblog\Status;
use Skybluesofa\Microblog\Visibility;
use DateTime;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $refl = new \ReflectionClass(Visibility::class);
        $visibilities = array_flip($refl->getConstants());
        
        $refl = new \ReflectionClass(Status::class);
        $statuses = array_flip($refl->getConstants());

        return [
            'journal' => $this->journal_id,
            'post' => $this->id,
            'user' => $this->userName(),
            'title' => $this->title,
            'content' => $this->content,
            'images' => $this->images,
            'visibility' => $visibilities[$this->visibility],
            'status' => $statuses[$this->status],
            'available_on' => $this->available_on,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
