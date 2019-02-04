<?php

namespace App\Http\Resources\FolderCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class FolderCategory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

     
    public function toArray($request)
    {
        return [
            'type' => 'category',
            'id' => (string)$this->id,
            'attributes' => [
                'title' => $this->title,
            ],
            'relationships' => new FolderCategoryRelationshipResource($this),
            'links' => [
                'self' => route('category.show', ['category' => $this->id]),
            ],
        ];
    }
}
