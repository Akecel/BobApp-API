<?php

namespace App\Http\Resources\Folder;

use Illuminate\Http\Resources\Json\JsonResource;

class Folder extends JsonResource
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
            'type' => 'folder',
            'id' => (string)$this->id,
            'attributes' => [
                'title' => $this->title,
                'created_at' => (string)$this->created_at,
                'updated_at' => (string)$this->updated_at,
            ],
            'relationships' => new FolderRelationshipResource($this),
            'links' => [
                'self' => route('folder.show', ['folder' => $this->id]),
            ],
        ];
    }
}
