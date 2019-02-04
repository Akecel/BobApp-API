<?php

namespace App\Http\Resources\FileType;

use Illuminate\Http\Resources\Json\JsonResource;

class FileType extends JsonResource
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
            'type' => 'file_type',
            'id' => (string)$this->id,
            'attributes' => [
                'title' => $this->title,
            ],
            'relationships' => new FileTypeRelationshipResource($this),
            'links' => [
                'self' => route('type.show', ['type' => $this->id]),
            ],
        ];
    }
}
