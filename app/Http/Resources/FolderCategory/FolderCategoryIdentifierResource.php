<?php

namespace App\Http\Resources\FolderCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class FolderCategoryIdentifierResource extends JsonResource
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
        ];
    }
}