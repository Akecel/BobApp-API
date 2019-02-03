<?php

namespace App\Http\Resources\File;

use Illuminate\Http\Resources\Json\JsonResource;

class File extends JsonResource
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
            'type' => 'file',
            'id' => (string)$this->id,
            'attributes' => [
                'url' => $this->url,
                'created_at' => (string)$this->created_at,
                'updated_at' => (string)$this->updated_at,
            ],
            'relationships' => new FileRelationshipResource($this),
            'links' => [
                'self' => route('v2.file.show', ['file' => $this->id]),
            ],
        ];
    }
}
