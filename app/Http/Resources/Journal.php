<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Skybluesofa\Microblog\Visibility;

class Journal extends JsonResource
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
        
        return [
            'journal' => $this->id,
            'visibility' => $visibilities[$this->visibility],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
